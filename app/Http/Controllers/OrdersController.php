<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;
use App\Events\NewOrderCreated;
use App\Http\Controllers\GmailServices;
class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, GmailServices $gmail)
    {
        $status = $request->input('status');
        $search = $request->input('search');

        $query = Orders::with(['user', 'items.product', 'delivery'])
            ->leftJoin('deliveries', 'orders.delivery_id', '=', 'deliveries.id')
            ->when($status, fn($q) => $q->where('orders.status', $status))
            ->when($search, function ($q) use ($search) {
                $q->where(function ($query) use ($search) {
                    $query->where('orders.id', 'like', "%{$search}%")
                        ->orWhereHas('user', fn($u) => $u->where('name', 'like', "%{$search}%"));
                });
            })
            ->orderByRaw("FIELD(orders.status, 'preparing', 'on delivery', 'can be pickuped', 'delivered', 'canceled')")
            ->orderBy('deliveries.delivery_datetime', 'asc')
            ->select('orders.*');

        $orders = $query->simplePaginate(5);

        // Send email for newly created unnotified orders
        $unnotifiedOrders = Orders::with('user')
            ->where('is_notified', false)
            ->latest()
            ->get();

        foreach ($unnotifiedOrders as $order) {
            if ($order->user) {
                $gmail->sendEmail(
                    $order->user->email,
                    'New Order Received',
                    "<p>Hi {$order->user->name}, your order <strong>#{$order->id}</strong> is being processed.</p>"
                );

                $order->is_notified = true;
                $order->save();
            }
        }


        return view('order.index', compact('orders', 'status', 'search'));
    }





    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        
        $order = new Orders();
        $order->user_id = $request->user()->id;
        $order->status = 'preparing';
        $order->total = $request->input('total');
        $order->delivery_id = $request->input('delivery_id');
        $order->save();



        
        event(new NewOrderCreated($order));

        return response()->json(['message' => 'Order created successfully'], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(Orders $orders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Orders $orders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Orders $orders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orders $orders)
    {
        //
    }

   public function updateStatus(Request $request, $orderId)
    {
        $validated = $request->validate([
            'status' => 'required|in:preparing,on delivery,can be pickuped,delivered,canceled',
        ]);

        $order = Orders::findOrFail($orderId);
        $order->status = $validated['status'];
        $order->save();

        return redirect()->route('order.index')->with('message', 'Order status updated successfully!');
    }

    public function checkNewOrders(Request $request)
    {
        $latestOrderTime = $request->input('last_checked_at');

        $newOrders = Orders::where('created_at', '>', $latestOrderTime)->count();

        session()->flash('new-order', true);


        return response()->json(['new-order' => $newOrders]);
    }

    public function showInvoice($id)
    {
        $order = Orders::with(['user', 'items.product', 'delivery', 'payment'])->findOrFail($id);

        return view('order.invoice', compact('order'));
    }



}
