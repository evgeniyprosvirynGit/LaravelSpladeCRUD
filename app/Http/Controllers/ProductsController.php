<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Repositories\ProductRepositoryInterface;
use App\SpladeTables\ProductSpladeTable;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Repositories\ProductRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Splade;

class ProductsController extends BaseController
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @return Factory|View|Application
     */
    public function index(Request $request): Factory|View|Application
    {
        $products = $this->productRepository
            ->all()
            ->paginate(perPage: $request->perPage ?: ProductSpladeTable::PER_PAGE_DEFAULT)
            ->withQueryString();

        return view('products.index', [
            'products' => ProductSpladeTable::create($products),
        ]);
    }

    /**
     * @param Product $product
     * @return Factory|View|Application
     */
    public function edit(Product $product): Factory|View|Application
    {
        return view('products.edit', [
            'product' => $product,
        ]);
    }

    /**
     * @param ProductRequest $request
     */
    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        $this->productRepository
            ->setRequest($request)
            ->update(productId: $product->id);

        Splade::toast('product updated!')
            ->autoDismiss(afterSeconds: config('splade.toast_delay'));

        return redirect()->route('products.index');
    }

    /**
     * @param Product $product
     *
     * @return Application|Factory|View
     */
    public function show(Product $product): Application|Factory|View
    {
        return view('products.show', [
            'product' => $product,
        ]);
    }

    /**
     * @return Application|Factory|View
     */
    public function create(): Application|Factory|View
    {
        return view('products.create', [
            'product' => new Product(),
        ]);
    }


    /**
     * @return RedirectResponse
     */
    public function store(ProductRequest $request): RedirectResponse
    {
        $this->productRepository
            ->setRequest(request: $request)
            ->create();

        Splade::toast('product created!')
            ->autoDismiss(afterSeconds: config('splade.toast_delay'));

        return redirect()->route('products.index');
    }

    /**
     * @param Product $product
     *
     * @return RedirectResponse
     */
    public function destroy(Product $product): RedirectResponse
    {
        $this->productRepository->delete(productId: $product->id);

        return redirect()->route('products.index');
    }
}
