<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $status = $request->input('status');

        $order = Orders::with(['user', 'items.product'])
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->get();

        return view('order.index', compact('order', 'status'));
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
        //
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
        $order = Orders::findOrFail($orderId);

        $order->status = $request->input('status');
        $order->save();

        return redirect()->route('order.index')->with('success', 'Order status updated successfully!');
    }
}
