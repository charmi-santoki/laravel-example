<?php

namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{

    public function allProducts()
    {
        return Product::with('category')->paginate(5);
    }

    public function storeProduct(array $request = [])
    {
        if (isset($request['image']) && $request['image']->isValid()) {
            $imagePath = $request['image']->store('images', 'public');
        } else {
            $imagePath = null;
        }

        $product_data = [
            "category_id"    => $request['category_id'],
            "name"     => $request['name'],
            "detail"  => $request['detail'],
            "image"   => $imagePath,
        ];

        return Product::create($product_data);
    }

    public function findProduct($id)
    {
        return Product::find($id);
    }

    public function updateProduct(array $request = [])
    {
        if (isset($request['image']) && $request['image']->isValid()) {
            $imagePath = $request['image']->store('images', 'public');
        } else {
            $imagePath = null;
        }

        $product_data = [
            "category_id"    => $request['category_id'],
            "name"     => $request['name'],
            "detail"  => $request['detail'],
            "image"   => $imagePath,
        ];
        Product::where('id',$request['product_id'])->update($product_data);
    }

    public function destroyProduct(array $where)
    {
        return Product::where($where)->delete();

    }
}
