<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\ProductCategories;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function products()
    {
        return view('product.product', [
            "products" => Products::all(),
        ]);
    }

    public function create()
    {
        return view('product.create', [
            "categories" => ProductCategories::all(),
        ]);
    }

    public function productsCreate(Request $request)
    {
        $rules = $request->validate([
            'name' => 'required',
            'code' => 'required',
            'product_categories_id' => 'required',
            'price' => 'required',
            'purchase_price' => 'required',
            'short_description' => 'required',
            'description' => 'required',
        ]);

        if ($request->has('status')) {
            $rules['status'] = $request->status;
        }

        if ($request->has('new_product')) {
            $rules['new_product'] = $request->new_product;
        }

        if ($request->has('best_seller')) {
            $rules['best_seller'] = $request->best_seller;
        }

        if ($request->has('featured')) {
            $rules['featured'] = $request->featured;
        }

        Products::create($rules);

        return redirect('product')->with('success', 'Data telah tersimpan');
    }

    public function showEdit(Products $products)
    {
        return view('product.edit', [
            'product' => $products,
            'categories' => ProductCategories::all()
        ]);
    }

    public function productsEdit(Request $request, Products $products)
    {

        $rules = $request->validate([
            'name' => 'required',
            'code' => 'required',
            'product_categories_id' => 'required',
            'price' => 'required',
            'purchase_price' => 'required',
            'short_description' => 'required',
            'description' => 'required',
        ]);

        if ($request->has('status')) {
            $rules['status'] = $request->status;
        }

        if ($request->has('new_product')) {
            $rules['new_product'] = $request->new_product;
        }

        if ($request->has('best_seller')) {
            $rules['best_seller'] = $request->best_seller;
        }

        if ($request->has('featured')) {
            $rules['featured'] = $request->featured;
        }

        Products::where('id', $products->id)->update($rules);

        return redirect('/product');
    }

    public function productsDelete(Products $products)
    {
        Products::destroy($products->id);
        return redirect('product');
    }

    public function getPrice() {
        $produk = Products::find(request('id'));
        return $produk->purchase_price;
    }
}
