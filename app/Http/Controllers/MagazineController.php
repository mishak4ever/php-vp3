<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Order;

abstract class MagazineController extends BaseController
{

    const PRODUCT_PER_PAGE = 6;

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

//    public $magazine_categories = null;
//    public $magazine_orders = null;
//    public $magazine_cart_goods = null;
//    public $magazine_random_products = null;
    public $logged_user = null;
    public $logged_user_id = null;

    public function __construct()
    {
//        $this->logged_user_id = Auth::user()->getAuthIdentifier();
//        $this->logged_user = Auth::user();
    }

    protected function getMagazineCategories()
    {
        return Category::all();
    }

    protected function getMagazineRandomProducts()
    {
        $magazine_random_products = Product::inRandomOrder()->limit(3)->get();
        $magazine_random_products->map(function (&$product, &$key) {
            $mediaItems = $product->getThumbsForSite('product_images');
            $product->image_url = $mediaItems[0]['thumb_url'];
        }, $magazine_random_products);
        return $magazine_random_products;
    }

    protected function cartHasGoods(): bool
    {
        return (!empty($this->cartGetGoods()) && is_array($this->cartGetGoods()));
    }

    protected function cartAddGood($id)
    {
        if (!$this->cartHasGoods())
            session()->put('cart_products', [$id]);
        else
            session()->push('cart_products', $id);
        session()->save();
        return $this->cartGetGoods();
    }

    protected function cartDeleteGood($id)
    {
        $cart_products = $this->cartGetGoods();
        if ($cart_products && is_array($cart_products)) {
            foreach ($cart_products as $key => $value) {
                if ($value == $id) {
                    unset($cart_products[$key]);
                    break;
                }
            }
            session()->put('cart_products', $cart_products);
            session()->save();
        }
    }

    public function cartClearGoods()
    {
        session()->put('cart_products', []);
        session()->save();
        return true;
    }

    public function cartGetGoods()
    {
        return session()->get('cart_products');
    }

    public function getAuthUser()
    {
        return Auth::user();
    }

}
