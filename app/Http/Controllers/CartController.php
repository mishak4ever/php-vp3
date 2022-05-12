<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\Settings;
use App\Mail\ModelEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class CartController extends MagazineController
{

    public $cart_products = null;

    public function index()
    {
        $cart_products = $this->cartGetGoods();
        $total_cost = 0;
        if ($cart_products && is_array($cart_products)) {
            foreach ($cart_products as $prod_id) {
                $product = Product::find($prod_id);
                $mediaItems = $product->getThumbsForSite('product_images');
                $product->image_url = $mediaItems[0]['thumb_url'];
                $products[] = $product;
                $total_cost += $product->price;
            }
        }
//        dd($this->logged_user);
        return view('cart2', [
            'magazine_categories' => $this->getMagazineCategories(),
            'cart_products' => $products ?? [],
            'total_cost' => $total_cost,
            'cart_goods_count' => $cart_products ? count($cart_products) : 0,
            'logged_user' => $this->getAuthUser(),
        ]);
    }

    public function add($id)
    {
        $this->cartAddGood($id);
        return count($this->cartGetGoods());
    }

    public function delete($id)
    {
        $this->cartDeleteGood($id);
        return redirect()->action([self::class, 'index']);
    }

    public function clear()
    {
        $this->cartClearGoods();
        return redirect()->action([self::class, 'index']);
    }

    public function getCount()
    {
        return $this->cartGetGoods() ? count($this->cartGetGoods()) : 0;
    }

    public function addOrder(Request $request)
    {
        $cart_products = $this->cartGetGoods();
        $total_cost = 0;
        $categories = [];
        if ($cart_products && is_array($cart_products)) {
            foreach ($cart_products as $prod_id) {
                $product = Product::find($prod_id);
                $total_cost += $product->price;
                $categories[] = $product->category->id;
            }
        }
        $order_form = $request->post();
        $user = User::where('email', $order_form['user_email'])->first();
        $registered = 0;
        if ($user) {
//            dd($user);
        } else {
            $generate_pass = str_random(8);
            $user = User::create([
                        "name" => $order_form['user_name'],
                        "email" => $order_form['user_email'],
                        'password' => Hash::make($generate_pass),
                            ]
            );
            $user->save();
            $registered = 1;
            $registerMailModel = (new ModelEmail([
                        'name' => $user->name,
                        'email' => $user->email,
                        'password' => $generate_pass,
                        'sender' => 'Администрация сайта',
                        'sitename' => env('APP_URL', 'SiteName'),
                            ]))->setTheme('Регистрация на сайте');
            Mail::to($user->email)->send($registerMailModel);
        }
        $order = Order::create([
                    "title" => "Заказ от " . date("d.m.Y"),
                    "user_id" => $user->id,
                    "products" => json_encode($cart_products),
                    "categories" => json_encode($categories),
                    "active" => 1,
                    "complete" => 0,
                    "cost" => $total_cost,
        ]);
        $orderMailModel = (new ModelEmail([
                    'name' => $user->name,
                    'email' => $user->email,
                    'order_id' => $order->id,
                    'sender' => 'Администрация сайта',
                    'sitename' => env('APP_URL', 'SiteName'),
                        ], 'mail.order'))->setTheme('Заказ на сайте');
        $default_manager_email = Settings::where('key', 'default_user_email')->first()->value;
        Mail::to($default_manager_email)->send($orderMailModel);
        Mail::to($user->email)->send($orderMailModel);
        Auth::login($user);
        $this->cartClearGoods();
//        return redirect()->action([OrderController::class, 'index'], ['page' => 1, 'registered' => 1]);
        return redirect()->route('orders.index.page', ['indexPage' => 1])->with(['registered' => $registered]);
    }

}
