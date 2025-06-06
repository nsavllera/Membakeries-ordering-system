<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('report.salesreport.index');
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
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        //
    }

    public function generateReport(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        $sales = $this->generateReportQuery($fromDate, $toDate);

        return view('report.salesreport.generateReport', ['sales' => $sales]);
    }

    /**
     * Query for generating the report based on date range.
     */



    private function generateReportQuery($fromDate, $toDate)
    {
        $query = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('items', 'order_items.items_id', '=', 'items.id')
            ->select(
                'items.id as items_id',
                'items.name as product_name',
                DB::raw('SUM(order_items.quantity) as total_quantity'),
                DB::raw('SUM(order_items.quantity * order_items.price) as total_sales')
            )
            ->groupBy('items.id', 'items.name')
            ->orderBy('items.name', 'asc');

        if ($fromDate && $toDate) {
            $query->whereBetween('orders.created_at', [$fromDate, $toDate]);
        } elseif ($fromDate) {
            $query->where('orders.created_at', '>=', $fromDate);
        } elseif ($toDate) {
            $query->where('orders.created_at', '<=', $toDate);
        }

        return $query->get();
    }


}
