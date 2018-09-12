<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Product;
use Illuminate\Http\RedirectResponse;
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
        $data = [
        'title' => $request->getTitle(),
        'price' => $request->getPrice(),
        'context' => $request->getContext(),
        'active' => $request->getActive(),
        'cover' => $request->getCover() ? $request->getCover()->store('products') : null,
            ];

        $product = Product::create($data);

        $product->categories()->attach($request->getCategoriesIds());

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
        $product->active = $request->getActive();

        if($request->getCover()){
            $product->cover = $request->getCover()->store('products');
        }

        $product->update($request->all());

        $product->categories()->sync($request->getCategoriesIds());

        return redirect()->route('admin.products.index')
            ->with('success','Product updated successfully');
    }
}