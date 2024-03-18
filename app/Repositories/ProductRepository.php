<?php

namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{

    public function allProducts()
    {
        return Product::latest()->paginate(10);
    }

    public function storeProduct($data)
    {
        return Product::create($data);
    }

    public function findProduct($id)
    {
        return Product::find($id);
    }

    public function updateProduct($data, $id)
    {
        $product = Product::where('id', $id)->first();
        $product->name = $data['name'];
        $product->detail = $data['detail'];
        $product->category_id = $data['category_id'];
        $product->image;
        $product->save();
    }

    public function destroyProduct($id)
    {
        $product = Product::find($id);
        $product->delete();
    }
}
