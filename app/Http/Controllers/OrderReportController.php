<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Item;
use Illuminate\Http\Request;

class OrderReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('report.orderreport.index');
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

        $Orders = $this->generateReportQuery($fromDate, $toDate);

        return view('report.orderreport.generateReport', ['orders' => $Orders]);
    }

    /**
     * Query for generating the report based on date range.
     */
    private function generateReportQuery($fromDate, $toDate)
    {
        $query = Item::query();

        if ($fromDate && $toDate) {
            $query->where(function ($q) use ($fromDate, $toDate) {
                $q->whereDate('created_at', '>=', $fromDate)
                    ->whereDate('created_at', '<=', $toDate)
                    ->orWhere(function ($q) use ($fromDate, $toDate) {
                        $q->whereDate('updated_at', '>=', $fromDate)
                            ->whereDate('updated_at', '<=', $toDate);
                    });
            });
        } elseif ($fromDate) {
            $query->whereDate('created_at', '>=', $fromDate)
                  ->orWhereDate('updated_at', '>=', $fromDate);
        } elseif ($toDate) {
            $query->whereDate('created_at', '<=', $toDate)
                  ->orWhereDate('updated_at', '<=', $toDate);
        }

        return $query->get();
    }
}
