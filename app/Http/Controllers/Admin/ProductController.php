<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(20);
        $categories = Category::all();
        return view("admin.product.index", compact(["products","categories"]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view("admin.product.create", compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images/product'), $imageName);
        $data['image'] = 'images/product/' . $imageName;

        Product::create($data);

        return redirect()->route("admin.products.index")->with("success","Product created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view("admin.product.show", compact("product"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view("admin.product.edit", compact("categories","product"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Product $product)
    {
        $data = $request->validated();

        if(isset($data['image'])) {

            if($product->image != '' && $product->image != null) {
                $image_old = public_path() . '/' . $product->image;
                unlink($image_old);
            }

            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/product'), $imageName);
            $data['image'] = 'images/product/' . $imageName;
        }

        $product->update($data);

        return redirect()->route('admin.products.show', $product->id)->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route("admin.products.index")->with("success","Product deleted successfully");
    }  
}
