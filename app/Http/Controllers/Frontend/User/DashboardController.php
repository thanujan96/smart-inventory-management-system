<?php

namespace App\Http\Controllers\Frontend\User;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
/**
 * Class DashboardController.
 */
class DashboardController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('frontend.user.dashboard');
    }

    public function showOrder(Order $orders)
    {
        $orders = Auth::user()->orders;
           
        return view('frontend.user.orders',compact('orders'));
    }
}
