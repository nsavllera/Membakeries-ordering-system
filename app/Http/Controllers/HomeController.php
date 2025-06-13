<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\Item;
use App\Models\User;
use Illuminate\Support\Carbon;
use Carbon\CarbonPeriod;
use IcehouseVentures\LaravelChartjs\Facades\Chartjs;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Get last 5 added products
        $recentProducts = Item::orderBy('created_at', 'desc')->take(5)->get();

        $totalOrders = Orders::count();
        $totalCustomers = User::where('role', 'customer')->count(); // adjust role logic
        $totalProducts = Item::count();

        // Set start and end of date range
        $start = Carbon::parse(Orders::min("created_at"))->startOfWeek();
        $end = Carbon::now()->endOfWeek();

        // Create a weekly period
        $period = CarbonPeriod::create($start, '1 week', $end);

        
         // Build weekly sales data
        $salesPerWeek = collect($period)->map(function ($date) {
        $startOfWeek = $date->copy()->startOfWeek();
        $endOfWeek = $date->copy()->endOfWeek();

            return [
                "total_sales" => Orders::whereBetween("created_at", [$startOfWeek, $endOfWeek])->sum("total"), 
                "week" => $startOfWeek->format("Y-m-d") . ' - ' . $endOfWeek->format("Y-m-d"),
            ];
        });

        $data = $salesPerWeek->pluck("total_sales")->toArray();
        $labels = $salesPerWeek->pluck("week")->toArray();

        $stats = [
            'preparing' => Orders::where('status', 'preparing')->count(),
            'on_delivery' => Orders::where('status', 'on delivery')->count(),
            'pickup_ready' => Orders::where('status', 'can be pickuped')->count(),
        ];
        // Pass to Blade view
        return view('home', compact('recentProducts','stats', 'labels', 'data','totalOrders', 'totalCustomers', 'totalProducts'));
    }

}
