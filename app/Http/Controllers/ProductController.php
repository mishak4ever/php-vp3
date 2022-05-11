<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends MagazineController
{

    public function __construct()
    {
//        parent::__construct();
    }

    public function index()
    {

        return view('home', [
            'magazine_categories' => $this->getMagazineCategories(),
            'logged_user' => $this->getAuthUser(),
        ]);
    }

    public function view($id)
    {
        $product = \App\Models\Product::find($id);
        $mediaItems = $product->getThumbsForSite('product_images');
        $product->image_url = $mediaItems[0]['thumb_url'];
        $category = \App\Models\Category::find($product->category_id);
        return view('product', [
            'magazine_categories' => $this->getMagazineCategories(),
            'category' => $category,
            'product' => $product,
            'random_products' => $this->getMagazineRandomProducts(),
            'logged_user' => $this->getAuthUser(),
        ]);
    }

}
