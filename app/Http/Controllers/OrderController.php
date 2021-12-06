<?php

namespace App\Http\Controllers;

use App\Order;
use App\Order_Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin')->except(["userOrder", "index"]);;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("user.orders.index")->with([
            "orders" => Order::where('user_id', auth()->user()->id)->latest()->paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
        $total = 0;
        foreach (Order_Product::where("order_id", $order->id)->get() as $item) {

            $total += $item->price * $item->qty;
        }
        return view("admin.orders.show")->with([
            "order" => $order,
            "order_products" => Order_Product::where("order_id", $order->id)->get(),
            "total" => $total
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function userOrder($id)
    {
        $total = 0;
        foreach (Order_Product::where("order_id", Crypt::decrypt($id))->get() as $item) {

            $total += $item->price * $item->qty;
        }
        return view("user.orders.show")->with([
            "order" =>  Order::where("id", Crypt::decrypt($id))->first(),
            "order_products" => Order_Product::where("order_id", Crypt::decrypt($id))->get(),
            "total" => $total
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
        $order->update([
            "delivered" => 1
        ]);
        return redirect()->back()->withSuccess("Order updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
        $order->delete();
        return redirect()->back()->withSuccess("Order deleted");
    }
}
