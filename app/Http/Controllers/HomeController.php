<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class HomeController extends MagazineController
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
//        parent::__construct();
    }

    /**
     * Show the application home page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($page = 1)
    {

        $all_products_count = Product::All()->count();
        $total_pages = ($all_products_count % self::PRODUCT_PER_PAGE) > 0 ? intdiv($all_products_count, self::PRODUCT_PER_PAGE) + 1 : intdiv($all_products_count, self::PRODUCT_PER_PAGE);
        $products = Product::All()->forPage($page, self::PRODUCT_PER_PAGE);
        $products->map(function (&$product, &$key) {
            $mediaItems = $product->getThumbsForSite('product_images');
            $product->image_url = $mediaItems[0]['thumb_url'];
        }, $products);
//        dd(compact('total_pages', 'page'));
        return view('home', [
            'magazine_categories' => $this->getMagazineCategories(),
            'products' => $products,
            'total_pages' => $total_pages,
            'page' => $page,
            'logged_user' => $this->getAuthUser(),
        ]);
    }

    /**
     * Show the application about page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function about()
    {

        return view('about', [
            'magazine_categories' => $this->getMagazineCategories(),
            'random_products' => $this->getMagazineRandomProducts(),
            'logged_user' => $this->getAuthUser(),
        ]);
    }

    /**
     * Show the application news page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function news()
    {

        return view('news', [
            'magazine_categories' => $this->getMagazineCategories(),
            'random_products' => $this->getMagazineRandomProducts(),
            'logged_user' => $this->getAuthUser(),
        ]);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
//        dd(Auth::user());
        return redirect('/');
    }

}
