<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends MagazineController
{

    const ORDERS_PER_PAGE = 10;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($page = 1)
    {
        $user = $this->getAuthUser();
        $all_orders_count = Order::where("user_id", $user->id)->get()->count();
        $total_pages = ($all_orders_count % self::ORDERS_PER_PAGE) > 0 ? intdiv($all_orders_count, self::ORDERS_PER_PAGE) + 1 : intdiv($all_orders_count, self::ORDERS_PER_PAGE);
//        $orders = Order::where("user_id", $user->id)->get()->forPage($page, self::ORDERS_PER_PAGE);
        $orders = Order::where("user_id", $user->id)->get();
//        dd(compact('total_pages', 'page'));
//        dd($orders);
        return view('cart1', [
            'magazine_categories' => $this->getMagazineCategories(),
            'orders' => $orders,
            'total_pages' => $total_pages,
            'page' => $page,
            'logged_user' => $this->getAuthUser(),
        ]);
    }

}
