<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Log;
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


        try {
                $gmail = new GmailServices();
                $adminEmail = env('ADMIN_EMAIL');
                $gmail->sendEmail(
                    $adminEmail,
                    '📦 New Order Received',
                    "
                    <div style='font-family: Arial, sans-serif; padding: 20px; max-width: 600px; border: 1px solid #ccc; border-radius: 10px; background: #f9f9f9;'>
                        <h2 style='color: #388e3c;'>New Order Alert</h2>
                        <p>A new order has just been placed by <strong>{$order->user->name}</strong>.</p>
                        <p><strong>Order ID:</strong> #{$order->id}</p>
                        <p><strong>Total:</strong> RM " . number_format($order->total, 2) . "</p>
                        <p><strong>Status:</strong> Preparing</p>
                        <p>Log in to the admin panel to review and process the order.</p>
                    </div>
                    "
                );
        } catch (\Exception $e) {
                Log::error('Failed to send admin email: ' . $e->getMessage());
        }

        
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


    public function updateStatus(Request $request, $orderId, GmailServices $gmail)
    {
        $validated = $request->validate([
            'status' => 'required|in:preparing,on delivery,can be pickuped,delivered,canceled',
        ]);

        $order = Orders::with('user')->findOrFail($orderId);
        $oldStatus = $order->status;
        $order->status = $validated['status'];
        $order->save();

        if ($order->user && $order->user->email) {
            Log::info("Sending Gmail to: $order->user");
            $gmail->sendEmail(
                $order->user->email,
                "Order #{$order->id} Status Updated",
                "
                <div style='font-family: Arial, sans-serif; max-width: 600px; margin: auto; border: 1px solid #e0e0e0; padding: 20px; border-radius: 10px; background-color: #fafafa;'>
                    <h2 style='color: #2e7d32;'>🍰 Membakeries Order Update</h2>
                    <p>Hi <strong>{$order->user->name}</strong>,</p>

                    <p>We wanted to let you know that the status of your order <strong>#{$order->id}</strong> has been updated:</p>

                    <div style='padding: 10px 15px; background-color: #f1f8e9; border: 1px solid #c5e1a5; border-radius: 5px; margin: 15px 0;'>
                        <strong>Status:</strong> <span style='color: #2e7d32;'>{$order->status}</span><br>
                        <small style='color: #888;'>Previously: {$oldStatus}</small>
                    </div>

                    <p>We appreciate your order and will keep you updated as it progresses.</p>

                    <p style='margin-top: 30px;'>Thank you,<br><strong>Membakeries Team</strong></p>

                    <hr style='margin: 20px 0; border: none; border-top: 1px solid #ddd;'>
                    <small style='color: #999;'>This is an automated message. Please do not reply.</small>
                </div>
                "
            );
        }

        return redirect()->route('order.index')->with('message', 'Order status updated and email sent!');
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
