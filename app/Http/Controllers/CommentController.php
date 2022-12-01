<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request){
        return view('adm.comment', ['comment'=>Comment::all()]);
    }
    public function store(Request $request,Comment $comment){
        Comment::create([


            'content'=>$request->input('content'),
            'user_id'=>$request->input('user_id'),
            'product_id'=>$request->input('product_id'),

        ]);
        return redirect()->back();
    }
    public function edit(Comment $comment)
    {
        return view('comment.edit', ['comment' => $comment,'product'=>$comment->product,'user'=>$comment->user]);
    }

    public function update(Request $request, Comment $comment)
    {
        $comment->update([
            'content'=>$request->input('content'),
        ]);
        return redirect()->route('products.show',$comment->product_id);
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();
        return redirect()->route('products.show',$comment->product_id);
    }
}
