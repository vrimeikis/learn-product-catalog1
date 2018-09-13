<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\Repositories\ProductRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\RedirectResponse;
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
        $categories = Category::all();

        return view('admin.products.create', compact('categories'));
    }

    /**
     * @param ProductRequest $request
     * @return RedirectResponse
     */
    public function store(ProductRequest $request): RedirectResponse
    {
        try {
            /** @var Product $product */
            $product = $this->productRepository->create([
                'title' => $request->getTitle(),
                'price' => $request->getPrice(),
                'context' => $request->getContext(),
                'active' => $request->isActive() ? '1' : '0',
                'cover' => $request->getCover() ? $request->getCover()->store(self::COVER_DIRECTORY) : null,
            ]);

            $product->categories()->attach($request->getCategoriesIds());

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
     * @param Product $product
     * @return View
     */
    public function edit(Product $product): View
    {
        $categories = Category::all();

        return view('admin.products.edit',compact('product', 'categories'));
    }

    /**
     * @param ProductRequest $request
     * @param int $productId
     * @return RedirectResponse
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function update(ProductRequest $request, int $productId): RedirectResponse
    {
        try {
            $data = [
                'title' => $request->getTitle(),
                'price' => $request->getPrice(),
                'context' => $request->getContext(),
                'active' => $request->isActive() ? '1' : '0',
                'cover' => $request->getCover() ? $request->getCover()->store(self::COVER_DIRECTORY) : null,
            ];

            /** @var Product $product */
            $product = $this->productRepository->updateOrCreate($data, ['id' => $productId]);

            $product->categories()->sync($request->getCategoriesIds());

            return redirect()->route('admin.products.index')
                ->with('status', 'Product updated successfully');
        } catch (\Exception $exception) {
            return redirect()
                ->route('admin.products.edit', $this->productRepository->find($productId))
                ->with('error', $exception->getMessage());
        }
    }
}
