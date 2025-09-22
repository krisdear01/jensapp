<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;

class ProductRepository
{
    public function getAll()
    {
        return Product::latest()->get();
    }

    public function getCategories()
    {
        return Category::latest()->get();
    }

    public function getSuppliers()
    {
        return Supplier::latest()->get();
    }

    public function store(array $data)
    {
        return Product::create($data);
    }

    public function find(int $id)
    {
        return Product::findOrFail($id);
    }

    public function update(int $id, array $data)
    {
        $product = Product::findOrFail($id);
        $product->update($data);
        return $product;
    }

    public function delete(int $id)
    {
        return Product::findOrFail($id)->delete();
    }
}
