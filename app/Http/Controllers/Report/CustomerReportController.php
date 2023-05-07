<?php

namespace app\Http\Controllers\Report;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class CustomerReportController extends Controller
{
    /**
     * 
     */


    /**
     * Show the form for creating a new resource.
     */
    public function customerByCity(Request $request)
    {
        $filterYear = $request->input('year'); //2020
        $filterMonth = $request->input('month'); //02

        $query = Customer::query();
        $query->leftJoin('orders', 'customers.id', '=', 'orders.customer_id');

        //filter
        $query->when($filterYear, function ($query, $filterYear) {
            return $query->whereYear('orders.event_at', Carbon::parse($filterYear)->year);
        });
        $query->when($filterMonth, function ($query, $filterMonth) {
            return $query->whereMonth('orders.event_at', Carbon::parse($filterMonth)->month);
        });

        return $query->selectRaw("name, city, sum(total) as total, count(orders.id) as count")
            ->groupBy('name', 'city')
            ->get();
    }
}
