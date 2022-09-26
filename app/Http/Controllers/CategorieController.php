<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategories;

class CategorieController extends Controller
{
    public function categories()
    {
        return view('category.categories', [
            "categories" => ProductCategories::all()
        ]);
    }


    public function create()
    {
        return view('category.create');
    }


    public function categoriesCreate(Request $request)
    {
        $rules = $request->validate([
            'category' => 'required',
            'description' => 'required',
        ]);

        ProductCategories::create($rules);

        return redirect('categories')->with('success', 'Data telah tersimpan');
    }


    public function showEdit(ProductCategories $productCategories)
    {
        return view('category.edit', ['category' => $productCategories]);
    }

    public function categoriesEdit(Request $request, ProductCategories $productCategories)
    {
        ProductCategories::where('id', $productCategories->id)->update([
            'category' => $request->category,
            'description' => $request->description,
        ]);

        return redirect('/categories');
    }


    public function categoriesDelete(ProductCategories $productCategories)
    {
        ProductCategories::destroy($productCategories->id);
        return redirect('categories');
    }
}
