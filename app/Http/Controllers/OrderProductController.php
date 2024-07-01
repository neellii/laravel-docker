<?php

namespace App\Http\Controllers;

use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderProductController extends Controller
{
    /**
     * ShopCart Order checkout
     */
    public function index()
    {
        $orders = OrderProduct::where('user_id', Auth::id())->get()->groupBy('order_id');

        return view('payments.list', compact('orders'));
    }
}
