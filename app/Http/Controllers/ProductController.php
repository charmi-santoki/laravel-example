<?php

namespace App\Http\Controllers;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        $products =  $this->productRepository->allProducts()->toQuery()->paginate(5);

        return view('products.index', compact('products'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'detail' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $data['image'] = $imagePath;
        } else {
            // Handle case when no image is uploaded
            return redirect()->back()->withInput()->withErrors(['image' => 'No image uploaded']);
        }

        $this->productRepository->storeProduct($data);

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

        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'detail' => 'required|string|max:255',
        ]);
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $data['image'] = $imagePath;
        } else {
            // Handle case when no image is uploaded
            return redirect()->back()->withInput()->withErrors(['image' => 'No image uploaded']);
        }
        $this->productRepository->updateProduct($request->all(), $id);

        return redirect()->route('products.index')->with('success', 'product Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        $this->productRepository->destroyproduct($id);

        return redirect()->route('products.index')->with('success', 'product Delete Successfully');
    }
}
