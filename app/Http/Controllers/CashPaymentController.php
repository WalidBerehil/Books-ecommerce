<?php

namespace App\Http\Controllers;

use App\Order;
use App\Order_Product;
use App\User;
use Illuminate\Http\Request;

class CashPaymentController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware("auth");
    }



    public function paymentSuccess(Request $request, User $user)
    {
        //$user = User::where("id", auth()->user()->id)->get();
        if (auth()->user()->full_info == 0) {
            return redirect()->route('user.profile')->with([
                'errorLink' => 'Complete profile'
            ]);
        } else {
            $total = 0;
            foreach (\Cart::getContent() as $item) {

                $total += $item->price * $item->quantity;
            }
            $order = Order::create([
                "user_id" => auth()->user()->id,
                "status" => "Shipping",
                "total" => $total,
                //Test if it work ( old value was : 1 )
                "qty" => \Cart::getContent()->count(),
                "price" => 2,
                "paid" => 0
            ]);

            foreach (\Cart::getContent() as $item) {
                Order_Product::create([
                    "order_id" => $order->id,
                    "product_id" => $item->id,
                    "qty" => $item->quantity,
                    "price" => $item->price
                ]);
                \Cart::clear();
            }
            return redirect()->route('cart.index')->with([
                'success' => 'Paid successfully'
            ]);
        }
    }
}
