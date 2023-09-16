<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class ProductController extends Controller
{
    public function list(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('products')->with(['products' => Product::all()]);
    }

    public function show(Product $product): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('product-show', compact('product'));
    }
}
