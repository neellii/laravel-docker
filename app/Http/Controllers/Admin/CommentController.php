<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Comment\StoreRequest;
use App\Http\Requests\Comment\UpdateRequest;


class CommentController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.comment.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();

        Comment::create($data);

        return redirect()->route("admin.products.show", [$data['product_id']])->with("success","Review created succesfully");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        return view("admin.comments.edit", compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Comment $comment)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();

        $comment->update($data);

        return redirect()->route("admin.products.show", [$data['product_id']])->with("success","Review updated succesfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->back()->with("success","Comment/Revew deleted successfully");
    }
}
