<?php

namespace App\Http\Controllers;

use App\Http\Filters\ProductFilter;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Comment\StoreRequest;
use App\Http\Requests\Product\FilterRequest;

class HomeController extends Controller
{

    /**
     * Display homepage
     */
    public function index() 
    {   
        $products = Product::paginate(20);

        return view('welcome', compact('products'));
    }


    /**
     * Products filtering request
     */
    public function search(FilterRequest $request)
    {
        $data = $request->validated();

        $filter = app()->make(ProductFilter::class, ['queryParams' => array_filter($data)]);

        $products = Product::filter($filter)->paginate(20);

        $html = view('products.products-list', compact('products'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    /**
     * Display products from category
     */
    public function categoryProducts($title, $id)
    {
        $category = Category::find($id);
        $products = $category->products()->get();
        return view('home.categoryProducts', compact(['products', 'category']));
    }

    /**
     * Display single product
     */
    public function productShow($id)
    {
        $product = Product::find($id);
        $comments = $product->comments()->get();
        return view('products.product', compact(['product', 'comments']));
    }

     /**
     * Store Product's Comment/Review
     */
    public function storeComment(StoreRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();

        Comment::create($data);

        return redirect()->route("home.product.show", [$data['product_id']])->with("success","Thank you for your review");
    }
}
