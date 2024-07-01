<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(15);
        // dump($categoriesWithChildren);
        // dd($categories);
        return view("admin.category.index", compact(['categories']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view("admin.category.create", compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images/category'), $imageName);
        $data['image'] = 'images/category/' . $imageName;

        Category::create($data);

        return redirect()->route("admin.categories.index")->with("success","Category created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view("admin.category.show", compact("category"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $categories = Category::all();
        return view("admin.category.edit", compact("categories","category"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Category $category)
    {
        $data = $request->validated();

        if(isset($data['image'])) {

            if($category->image != '' && $category->image != null) {
                $image_old = public_path() . '/' . $category->image;
                unlink($image_old);
            }

            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/category'), $imageName);
            $data['image'] = 'images/category/' . $imageName;
        }

        $category->update($data);

        return redirect()->route('admin.categories.show', $category->id)->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route("admin.categories.index")->with("success","Category deleted successfully");
    }

     /**
     * Get parents tree from categories table
     */
    public static function getParentsTree($category, $title)
    {
        if($category->parent_id == null)
        {
            return $title;
        }

        $parent = Category::find($category->parent_id);
        $title = $parent->title . ' > ' . $title;
        return CategoryController::getParentsTree($parent, $title);
    }
}
