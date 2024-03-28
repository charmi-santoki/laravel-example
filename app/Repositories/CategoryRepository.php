<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class CategoryRepository implements CategoryRepositoryInterface
{

    public function allCategories()
    {
        return Category::paginate(5);
    }

    public function storeCategory(array $request = [])
    {
        $category_data = [
            "name"     => $request['name'],
            "detail"  => $request['detail'],
        ];

        return Category::create($category_data);
    }

    public function findCategory($id)
    {
        return Category::find($id);
    }

    public function updateCategory(array $request = [])
    {
        $category = Category::findOrFail($request['category_id']);

        $category_data = [
            "name" => $request['name'],
            "detail" => $request['detail'],
        ];

        Category::where('id', $request['category_id'])->update($category_data);
    }

    public function destroyCategory(array $where)
    {
        return Category::where($where)->delete();
    }
}
