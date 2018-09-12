<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\Repositories\ProductRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
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
     *
     */
    const COVER_DIRECTORY = 'products';

    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * ProductController constructor.
     * @param $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }


    /**
     * @return View
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function index(): View
    {
        /** @var LengthAwarePaginator $products */
        $products = $this->productRepository->makeQuery()->latest()->paginate();

        return view('admin.products.index', compact('products'));
    }


    /**
     * @return View
     */
    public function create(): View
    {
        return view('admin.products.create');
    }


    /**
     * @param ProductRequest $request
     * @return RedirectResponse
     */
    public function store(ProductRequest $request): RedirectResponse
    {
        try {
            $this->productRepository->create([
                'title' => $request->getTitle(),
                'price' => $request->getPrice(),
                'context' => $request->getContext(),
                'active' => $request->isActive() ? '1' : '0',
                'cover' => $request->getCover() ? $request->getCover()->store(self::COVER_DIRECTORY) : null,
            ]);
            return redirect()
                ->route('admin.products.index')
                ->with('success', 'Product created successfully.');
        } catch (\Exception $exception) {
            return redirect()
                ->route('admin.products.create')
                ->with('error', $exception->getMessage());
        }

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }


    /**
     * @param ProductRequest $request
     * @param int $productId
     * @return RedirectResponse
     */
    public function update(ProductRequest $request, int $productId)
    {
        try {
            $product = [
                'title' => $request->getTitle(),
                'price' => $request->getPrice(),
                'context' => $request->getContext(),
                'active' => $request->isActive() ? '1' : '0',
                'cover' => $request->getCover() ? $request->getCover()->store(self::COVER_DIRECTORY) : null,
            ];
            $this->productRepository->update($product, $productId);
            return redirect()->route('admin.products.index')
                ->with('success', 'Product updated successfully');
        } catch (\Exception $exception) {

        }

    }


}