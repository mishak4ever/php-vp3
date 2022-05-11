<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class CategoryController extends MagazineController
{

    public function __construct()
    {
//        parent::__construct();
    }

    public function index()
    {
        return redirect()->action([HomeController::class, 'index'], ['indexPage' => 1]);
    }

    public function view($id, $page = 1)
    {
//        dd(compact('id', 'page'));
        $category = \App\Models\Category::find($id);
        if ($category) {
            $all_products = Product::where("category_id", $id)->get()->count();
            $total_pages = ($all_products % self::PRODUCT_PER_PAGE) > 0 ? intdiv($all_products, self::PRODUCT_PER_PAGE) + 1 : intdiv($all_products, self::PRODUCT_PER_PAGE);
            $products = Product::where("category_id", $id)->get()->forPage($page, self::PRODUCT_PER_PAGE);
            $products->map(function (&$product, &$key) {
                $mediaItems = $product->getThumbsForSite('product_images');
                $product->image_url = $mediaItems[0]['thumb_url'];
            }, $products);
            return view('category', [
                'magazine_categories' => $this->getMagazineCategories(),
                'category' => $category,
                'products' => $products,
                'total_pages' => $total_pages,
                'page' => $page,
                'logged_user' => $this->getAuthUser(),
            ]);
        }
        return redirect()->action([HomeController::class, 'index'], ['indexPage' => 1]);
    }

}
