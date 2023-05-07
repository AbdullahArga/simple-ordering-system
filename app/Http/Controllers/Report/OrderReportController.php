<?php

namespace app\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;

class OrderReportController extends Controller
{
    /**
     * 
     */


    /**
     * Show the form for creating a new resource.
     */
    public function ordersByCity(Request $request)
    {
        $filterYear = $request->input('year'); //2020-2
        $filterMonth = $request->input('month'); //2020-2

        $query = Order::query();
        $query->join('customers', 'customers.id', '=', 'orders.customer_id');
        $query->join('order_detail', 'orders.id', '=', 'order_detail.order_id');

        //filter
        $query->when($filterYear, function ($query, $filterYear) {
            return $query->whereYear('orders.event_at', Carbon::parse($filterYear)->year);
        });
        $query->when($filterMonth, function ($query, $filterMonth) {
            return $query->whereMonth('orders.event_at', Carbon::parse($filterMonth)->month);
        });

        return $query->selectRaw("city, sum(total) as total, count(DISTINCT orders.id) as count , sum(order_detail.count) number_of_items")
            ->groupBy('city')
            ->get();
    }
}
