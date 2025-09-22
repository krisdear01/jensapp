<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProducts()
    {
        return $this->productRepository->getAll();
    }

    public function getCreationData()
    {
        $categories = $this->productRepository->getCategories();
        $suppliers = $this->productRepository->getSuppliers();
        return compact('categories', 'suppliers');
    }

    public function storeProduct(Request $request)
    {
        $pcode = IdGenerator::generate(['table' => 'products', 'field' => 'product_code', 'length' => 4, 'prefix' => 'PC']);

        $save_url = null;
        if ($request->file('product_image')) {
            $image = $request->file('product_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('upload/product/' . $name_gen);
            $save_url = 'upload/product/' . $name_gen;
        }

        $data = [
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'product_code' => $pcode,
            'product_garage' => $request->product_garage,
            'product_store' => $request->product_store,
            'buying_date' => $request->buying_date,
            'expire_date' => $request->expire_date,
            'buying_price' => $request->buying_price,
            'selling_price' => $request->selling_price,
            'product_image' => $save_url,
            'created_at' => Carbon::now(),
        ];

        return $this->productRepository->store($data);
    }

    public function getProductById(int $id)
    {
        return $this->productRepository->find($id);
    }

    public function updateProduct(Request $request, int $id)
    {
        $data = $request->except(['_token', '_method', 'id']);

        if ($request->file('product_image')) {
            $image = $request->file('product_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('upload/product/' . $name_gen);
            $data['product_image'] = 'upload/product/' . $name_gen;
        }

        return $this->productRepository->update($id, $data);
    }

    public function deleteProduct(int $id)
    {
        $product = $this->productRepository->find($id);
        if ($product->product_image && file_exists($product->product_image)) {
            unlink($product->product_image);
        }
        return $this->productRepository->delete($id);
    }
}
