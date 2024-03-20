<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    protected $model;

    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    public function all()
    {
        return $this->model->latest()->get();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function createOrUpdate($id, $data)
    {
        return $this->model->updateOrCreate(['id' => $id], $data);
    }

    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }
}
