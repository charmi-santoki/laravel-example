<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Interfaces\ProductRepositoryInterface;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
class ProductController extends Controller
{

    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $products =  $this->productRepository->allProducts();

        return view('products.index', compact('products'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = Category::all();

        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request): RedirectResponse
    {
        $this->productRepository->storeProduct($request->all());

        return redirect()->route('products.index')->with('success', 'Product Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $product = $this->productRepository->findProduct($id);

        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        $request_data =  $request->all();

        $request_data['product_id'] = $product->id;

        $this->productRepository->updateProduct($request_data);

        return redirect()->route('products.index')->with('success', 'Product Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $this->productRepository->destroyProduct([
            ['id', $product->id]
        ]);
        return redirect()->route('products.index')->with('success', 'Product Delete Successfully');
    }
}
