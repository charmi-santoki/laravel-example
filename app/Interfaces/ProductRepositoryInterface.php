<?php

namespace App\Interfaces;

Interface ProductRepositoryInterface{

    public function allProducts();
    public function storeProduct(array $data = []);
    public function findProduct($id);
    public function updateProduct(array $request = []);
    public function destroyProduct(array $where);
}
