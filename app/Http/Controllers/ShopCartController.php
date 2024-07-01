<?php

namespace App\Http\Controllers;

use App\Models\ShopCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\ShopCart\StoreRequest;
use App\Http\Requests\ShopCart\UpdateRequest;

class ShopCartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = ShopCart::where('user_id', Auth::id())->get();
        return view('home.shopcart', compact('cart'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();

        $current = ShopCart::where('product_id', $data['product_id'])->where('user_id', $data['user_id'])->first();

        if($current) {
            $data['quantity'] = $data['quantity'] + $current->quantity;
            $current->update($data);
        } else {
            ShopCart::create($data);
        }

        Session::flash('success-ajax', 'Cart updated!');
        return View::make('partials/flash');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();

        ShopCart::find($id)->update($data);

        Session::flash('success-ajax', 'Cart updated!');
        return View::make('partials/flash');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ShopCart::find($id)->delete();
        Session::flash('success-ajax', 'Cart updated!');
        return View::make('partials/flash');
    }
}
