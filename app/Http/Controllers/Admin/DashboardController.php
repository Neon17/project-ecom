<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        try {
            return view('admin.dashboard.index', [
                'generalStats' => $this->generalStats(),
                'orderStats' => $this->orderStats(),
                'paymentStats' => $this->paymentStats(),
                'recentOrders' => $this->recentOrders(),
                'recentPayments' => $this->recentPayments(),
                'revenueData' => $this->revenueData(),
                'topProducts' => $this->topProducts(),
                'salesTrends' => $this->salesTrends(),
            ]);
        } catch (\Exception $e) {
            Log::error('Dashboard error: ' . $e->getMessage());
            return back()->with('error', 'Unable to load dashboard data');
        }
    }

    public function generalStats()
    {
        try {
            return [
                'total_orders' => Order::count(),
                'total_products' => Product::count(),
                'total_users' => User::count(),
                'total_categories' => Category::count(),
            ];
        } catch (\Exception $e) {
            Log::error('General stats error: ' . $e->getMessage());
            return [
                'total_orders' => 0,
                'total_products' => 0,
                'total_users' => 0,
                'total_categories' => 0,
            ];
        }
    }

    public function orderStats()
    {
        try {
            return [
                'completed' => Order::where('status', 'completed')->count(),
                'pending' => Order::where('status', 'pending')->count(),
                'processing' => Order::where('status', 'processing')->count(),
                'cancelled' => Order::where('status', 'cancelled')->count(),
            ];
        } catch (\Exception $e) {
            Log::error('Order stats error: ' . $e->getMessage());
            return [
                'completed' => 0,
                'pending' => 0,
                'processing' => 0,
                'cancelled' => 0,
            ];
        }
    }

    public function paymentStats()
    {
        try {
            return [
                'pending' => Payment::where('status', 'pending')->count(),
                'completed' => Payment::where('status', 'completed')->count(),
                'failed' => Payment::where('status', 'failed')->count(),
            ];
        } catch (\Exception $e) {
            Log::error('Payment stats error: ' . $e->getMessage());
            return [
                'pending' => 0,
                'completed' => 0,
                'failed' => 0,
            ];
        }
    }

    public function recentOrders()
    {
        try {
            return Order::with('user')->latest()->take(5)->get();
        } catch (\Exception $e) {
            Log::error('Recent orders error: ' . $e->getMessage());
            return collect();
        }
    }

    public function recentPayments()
    {
        try {
            $payments = Payment::with('user')->latest()->take(5)->get();
            info($payments);
            return $payments;
        } catch (\Exception $e) {
            Log::error('Recent payments error: ' . $e->getMessage());
            return collect();
        }
    }

    public function revenueData()
    {
        try {
            // Get revenue for last 30 days
            $days = 30;
            $revenueData = [];
            $labels = [];
            
            for ($i = $days - 1; $i >= 0; $i--) {
                $date = now()->subDays($i)->format('Y-m-d');
                $labels[] = now()->subDays($i)->format('M d');
                
                $revenue = Payment::whereDate('created_at', $date)
                    ->where('status', 'completed')
                    ->sum('total_amount');
                    
                $revenueData[] = $revenue / 100; // Convert from paisa to NPR
            }
            
            // Calculate total revenue and growth
            $currentMonthRevenue = Payment::where('status', 'completed')
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->sum('total_amount') / 100;
                
            $lastMonthRevenue = Payment::where('status', 'completed')
                ->whereMonth('created_at', now()->subMonth()->month)
                ->whereYear('created_at', now()->subMonth()->year)
                ->sum('total_amount') / 100;
                
            $growthPercentage = $lastMonthRevenue > 0 
                ? (($currentMonthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100 
                : 0;
            
            return [
                'labels' => $labels,
                'data' => $revenueData,
                'total' => $currentMonthRevenue,
                'growth' => round($growthPercentage, 1),
            ];
        } catch (\Exception $e) {
            Log::error('Revenue data error: ' . $e->getMessage());
            return [
                'labels' => [],
                'data' => [],
                'total' => 0,
                'growth' => 0,
            ];
        }
    }

    public function topProducts()
    {
        try {
            // Get top 5 products by order quantity
            $topProducts = Product::withCount(['orderItems as total_sold' => function ($query) {
                $query->selectRaw('sum(quantity)');
            }])
            ->orderBy('total_sold', 'desc')
            ->take(5)
            ->get();
            
            return $topProducts;
        } catch (\Exception $e) {
            Log::error('Top products error: ' . $e->getMessage());
            return collect();
        }
    }

    public function salesTrends()
    {
        try {
            // Get order counts for last 7 days
            $days = 7;
            $labels = [];
            $orderCounts = [];
            
            for ($i = $days - 1; $i >= 0; $i--) {
                $date = now()->subDays($i);
                $labels[] = $date->format('D');
                
                $count = Order::whereDate('created_at', $date->format('Y-m-d'))->count();
                $orderCounts[] = $count;
            }
            
            return [
                'labels' => $labels,
                'data' => $orderCounts,
            ];
        } catch (\Exception $e) {
            Log::error('Sales trends error: ' . $e->getMessage());
            return [
                'labels' => [],
                'data' => [],
            ];
        }
    }
}
