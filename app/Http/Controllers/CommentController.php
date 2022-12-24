<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index(Request $request){
        return view('adm.comment', ['comment'=>Comment::all()]);
    }
    public function store(Request $request){
        $validate = $request->validate([
            'content'=>'required',
            'product_id'=>'required|numeric|exists:products,id',
        ]);
        Auth::user()->comments()->create($validate);
        return redirect()->back()->with('message', __('messages.comment_saved'));
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
        return redirect()->route('products.show',$comment->product_id)->with('message', __('messages.comment_updated'));
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();
        return back()->with('message', __('messages.comment_deleted'));
    }
}
