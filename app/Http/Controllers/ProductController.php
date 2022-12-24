<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function productByCategory(Category $category){
        return view('products.index', ['products'=>$category->products,'categories'=>Category::all()]);
    }
    public function orders(){
        $productsSize=null;
        if(Auth::check()){
            $productsSize=Auth::user()->productsSize()->get();
        }

        return view('products.orders',['productsSize'=>$productsSize]);
    }

    public function review(Request $request, Product $product){
        $request->validate([
            'review' => 'required|min:1|max:5'
        ]);

        $productsReview = Auth::user()->productsReview()->where('product_id', $product->id)->first();

        if($productsReview != null){
            Auth::user()->productsReview()->updateExistingPivot($product->id, ['review' => $request->input('review')]);
        }else{
            Auth::user()->productsReview()->attach($product->id, ['review' => $request->input('review')]);
        }

        return back()->with('message', __('messages.review_saved'));
    }
    public function unreview(Product $product){
        $productsReview = Auth::user()->productsReview()->where('product_id', $product->id)->first();

        if($productsReview != null){
            Auth::user()->productsReview()->detach($product->id);
        }

        return back()->with('message', __('messages.review_deleted'));
    }

    public function buy(){
        $productsSize=null;
        $sum = 0;
        if(Auth::check()){
            $productsSize=Auth::user()->productsWithStatus("in_cart")->get();
            for ($i=0;$i<count($productsSize); $i++) {
                $abc = $productsSize[$i]->pivot->number * $productsSize[$i]->price;
                $sum += $abc;
                if (Auth::user()->account > $sum){
                    Auth::user()->update(['account' => Auth::user()->account - $sum]);
                    $ids=Auth::user()->productsWithStatus("in_cart")->allRelatedIds();
                    foreach ($ids as $id){
                        Auth::user()->productsWithStatus("in_cart")->updateExistingPivot($id, ['status' => 'ordered']);
                    }
                }else{
                    return back()->with('message', __('messages.money'));
                }
            }
        }

        return back()->with('message', __('messages.product_ordered'));
    }

    public function cart(){
        $productsSize=null;
        $sum = 0;
        if(Auth::check()){
            $productsSize=Auth::user()->productsWithStatus("in_cart")->get();
            for ($i=0;$i<count($productsSize); $i++) {
                $abc = $productsSize[$i]->pivot->number * $productsSize[$i]->price;
                $sum += $abc;
            }
        }

        return view('products.cart',['productsSize'=>$productsSize, 'sum' => $sum]);
    }
    public function addcart(Request $request, Product $product){
        $request->validate([
            'size'=>'required',
            'number'=>'required'
        ]);

        $productsSize = Auth::user()->productsWithStatus("in_cart")->where('product_id', $product->id)->first();
        if($productsSize!=null){
            Auth::user()->productsWithStatus("in_cart")->updateExistingPivot($product->id,
                ['size'=>$request->input('size'),
                    'number' => $productsSize->pivot->number + $request->input('number')]);
        }else{
            Auth::user()->productsWithStatus("in_cart")->attach($product->id,
                ['size'=>$request->input('size'),
                    'number'=>$request->input('number')]);
        }

        return back()->with('message', __('messages.product_in_cart'));
    }

    public function uncart(Product $product){
        $productsSize = Auth::user()->productsWithStatus("in_cart")->where('product_id', $product->id)->first();
        if($productsSize != null){
            Auth::user()->productsWithStatus("in_cart")->detach($product->id);
        }
        return back()->with('message', __('messages.product_deleted'));
    }

    public function index()
    {
        $allProducts =  Product::all();
        return view('products.index', ['products'=>$allProducts,'categories'=>Category::all()]);

    }
    public function create(){
        $this->authorize('create', Product::class);
        return view('products.create',['categories'=>Category::all()]);
    }
    public function store(Request $request){
        $validated = $request->validate([
            'title' => 'required|max:255' ,
            'content' => 'required' ,
            'price' => 'required' ,
            'category_id' => 'required|numeric|exists:categories,id',
            'img' => 'required|image|mimes:jpg,png,jpeg,svg,gif|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max+height=2000'
        ]);

        $fileName = time().$request->file('img')->getClientOriginalName();
        $image_path = $request->file('img')->storeAs('goods', $fileName, 'public');
        $validated['img'] = '/storage/'.$image_path;

        //Product::create($validated + ['user_id'=> Auth::user()->id]);
        Auth::user()->products()->create($validated);
        return redirect()->route('products.index')->with('message', __('messages.saved'));
    }
    public function show(Product $product){

        $sizes = ['XS', 'S', 'M', 'L', 'XL'];
        $productsSize = null;
        $myReview = 0;
        if (Auth::check()) {
            $productsSize = Auth::user()->productsSize()->where('product_id', $product->id)->first();
            $productsReview = Auth::user()->productsReview()->where('product_id', $product->id)->first();
            if ($productsReview != null) {
                $myReview = $productsReview->pivot->review;
            }
        }
        return view('products.show', ['product' => $product,'c'=>$product->comments,'sizes'=>$sizes,
            'myReview' => $myReview, 'productsSize' => $productsSize]);
    }
    public function edit(Product $product)
    {
        return view('products.edit', ['product' => $product,'categories'=>Category::all()]);

    }
    public function update(Request $request, Product $product)
    {
        $validated = $product->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'price' => $request->input('price'),
            'category_id' => $request->input('category_id'),
        ]);
        return redirect()->route('products.index')->with('message', __('messages.updated'));
    }


    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);
        $product->delete();
        return redirect()->route('products.index')->with('message', __('messages.deleted'));
    }
}
