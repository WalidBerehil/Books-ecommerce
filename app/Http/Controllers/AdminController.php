<?php

namespace App\Http\Controllers;

use App\Author;
use App\Category;
use App\Order;
use App\Order_Product;
use App\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin')
            ->except(["showAdminLoginForm", "adminLogin", "UserToOrders"]);
    }

    public function index()
    {
        return view("admin.index")->with([
            "products" => Product::all(),
            "orders" => Order::all()
        ]);
    }

    public function showAdminLoginForm()
    {
        return view("admin.auth.login");
    }

    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:4'
        ]);

        if (auth()->guard("admin")->attempt([
            'email' => $request->email,
            'password' => $request->password
        ], $request->get("remember"))) {
            return redirect("/admin");
        } else {
            return redirect()->route("admin.login");
        }
    }

    public function adminLogout()
    {
        auth()->guard("admin")->logout();
        return redirect()->route("admin.login");
    }

    public function getProducts()
    {
        return view("admin.products.index")->with([
            "products" => Product::latest()->paginate(5)
        ]);
    }

    public function getOrders()
    {

        return view("admin.orders.index")->with([
            "orders" => Order::latest()->paginate(5)
        ]);
    }

    public function getCategories()
    {
        return view("admin.categories.index")->with([
            "categories" => Category::latest()->paginate(5)
        ]);
    }

    public function getAuthors()
    {
        return view("admin.authors.index")->with([
            "authors" => Author::latest()->paginate(5)
        ]);
    }

    public function UserToOrders()
    {
        return view("user.orders.index")->with([
            "orders" => Order::where('user_id', auth()->user()->id)->latest()->paginate(5)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function showOrderProducts($order)
    {
        dd($order);
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
}
