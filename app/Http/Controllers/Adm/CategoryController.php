<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index(Request $request){
        return view('adm.category', ['category'=>Category::all()]);
    }
    public function create(){

        return view('adm.create');
    }
    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|max:255' ,
            'name_en' => 'required|max:255' ,
            'name_kz' => 'required|max:255' ,
            'name_ru' => 'required|max:255' ,
            'code' => 'required|max:255' ,
        ]);
        Category::create($validated);
        return redirect()->route('adm.categories.index')->with('message', __('messages.catcreated'));
    }
    public function destroy(Category $category)
    {

        $category->delete();
        return redirect()->route('adm.categories.index')->with('alert', __('messages.catdeleted'));
    }
}
