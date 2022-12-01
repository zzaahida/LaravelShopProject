<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function productByCategory(Category $category){
        return view('products.index', ['products'=>$category->products,'categories'=>Category::all()]);
    }

    public function buy(){
        $ids=Auth::user()->productsWithStatus("in_cart")->allRelatedIds();
        foreach ($ids as $id){
            Auth::user()->productsWithStatus("in_cart")->updateExistingPivot($id, ['status' => 'ordered']);
        }
        return back();
    }

    public function cart(){
        $productsSize=null;
        if(Auth::check()){
            $productsSize=Auth::user()->productsWithStatus("in_cart")->get();
        }

        return view('products.cart',['productsSize'=>$productsSize]);
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

        return back();
    }

    public function uncart(Product $product){
        $productsSize = Auth::user()->productsWithStatus("in_cart")->where('product_id', $product->id)->first();
        if($productsSize != null){
            Auth::user()->productsWithStatus("in_cart")->detach($product->id);
        }
        return back();
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
        return redirect()->route('products.index')->with('message', 'Product saved successfully!');
    }
    public function show(Product $product){
        $sizes = ['XS', 'S', 'M', 'L', 'XL'];
        if(Auth::check()){
            $productsSize = Auth::user()->productsSize()->where('product_id', $product->id)->first();
        }
        return view('products.show', ['product' => $product,'c'=>$product->comments, 'productsSize'=>$productsSize,'sizes'=>$sizes]);
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
        return redirect()->route('products.index');

    }


    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);
        $product->delete();
        return redirect()->route('products.index');
    }
}
