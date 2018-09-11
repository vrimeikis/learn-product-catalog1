<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;


/**
 * Class ProductController
 * @package App\Http\Controllers\Admin
 */
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $products = Product::latest()->paginate(10);

        return view('admin.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $categories = Category::all();

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductRequest $request
     * @return RedirectResponse
     */
    public function store(ProductRequest $request): RedirectResponse
    {
            $cover = $request->file('cover')->store('products');

            $product = new Product();
            $product->title = $request->title;
            $product->price = $request->price;
            $product->context = $request->context;
            $product->cover = $cover;

            $product->categories()->attach($request->getCategoriesIds());

            $product->save();

            return redirect()
                ->route('admin.products.index')
                ->with('success', 'Product created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product $product
     * @return View
     */
    public function edit(Product $product): View
    {
        $categories = Category::all();

        return view('admin.products.edit',compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductRequest $request
     * @param  \App\Product $product
     * @return RedirectResponse
     */
    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        $product->title = $request->getTitle();
        $product->price = $request->getPrice();
        $product->context = $request->getContext();

        if($request->getCover()){
            $product->cover = $request->getCover()->store('products');
        }

        $product->categories()->sync($request->getCategoriesIds());

        $product->update($request->all());


        return redirect()->route('admin.products.index')
            ->with('success','Product updated successfully');
    }
}