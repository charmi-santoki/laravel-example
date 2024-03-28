<?php

namespace App\Interfaces;

Interface CategoryRepositoryInterface{

    public function allCategories();
    public function storeCategory(array $data = []);
    public function findCategory($id);
    public function updateCategory(array $request = []);
    public function destroyCategory(array $where);
}
