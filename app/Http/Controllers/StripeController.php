<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ShopCart;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class StripeController extends Controller
{
     /**
     *  Checkout request handling
     */
    public function checkout()
    {
        try {
            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));

            $products = ShopCart::where('user_id', Auth::id())->get();
            $lineItems = [];
            $totalPrice = 0;
            foreach($products as $product)
            {
                $totalPrice += $product->product->price * $product->quantity;
                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $product->product->title,
                            'description' => $product->product->author,
                            'metadata' => [$product->product_id]
                        ],
                        'unit_amount' => $product->product->price * 100,
                    ],
                    'quantity' => $product->quantity,              
                ];
            }

            $checkout_session = $stripe->checkout->sessions->create([
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => route('checkout.success', [], true)."?session_id={CHECKOUT_SESSION_ID}",
                'cancel_url' => route('checkout.cancel', [], true),
            ]);

            try {
                DB::beginTransaction();

                $order = new Order();
                $order->status = 0;
                $order->total = $totalPrice;
                $order->note = $checkout_session->id;
                $order->user_id = Auth::id();
                $order->save();

                DB::commit();
            } catch (\Exception $e) {
                report($e);
            }

            return redirect($checkout_session->url);

        } catch (\Exception $e) {
            report($e);
        }
    }

     /**
     * After Success checkout handling
     */
    public function success(Request $request)
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));
        $session_id = $request->get('session_id');

        $session = $stripe->checkout->sessions->retrieve($session_id);

        try {
            if(!$session) {
                throw new NotFoundHttpException;
            }

            $order = Order::where('note', $session->id)->where('status', 0)->first();
            if(!$order) {
                throw new NotFoundHttpException();
            }

            try {
                DB::beginTransaction();

                $data = [];

                $order->status = 1;
                $order->update();

                $cartProducts = ShopCart::where('user_id', Auth::id())->get();
                
                foreach($cartProducts as $item)
                {
                    $data[] = [
                        'user_id' => Auth::id(),
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'price' => $item->product->price,
                        'quantity' => $item->quantity,
                        'amount' =>$item->product->price * $item->quantity,
                        'note' => null,
                        'status' => 1,
                        "created_at" =>  \Carbon\Carbon::now(),
                        "updated_at" => \Carbon\Carbon::now(),
                    ];
                }

                OrderProduct::insert($data);

                ShopCart::where('user_id', Auth::id())->delete();

                DB::commit();

                $orders = OrderProduct::where('order_id', $order->id)->get();

            } catch (\Exception $e) {
                report($e);
            }

            return view('payments.success');

        } catch (\Exception $e) {
            report($e);
        }
    }

     /**
     * Cancelled checkout handling
     */
    public function cancel() 
    {
        return redirect()->back()->with('error', 'Somethimg went wrong. Try again later');
    }
}
