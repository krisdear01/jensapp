<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Exports\ProductExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductImport;
use App\Models\Product;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function AllProduct()
    {
        $product = $this->productService->getAllProducts();
        return view('backend.product.all_product', compact('product'));
    }

    public function AddProduct()
    {
        $data = $this->productService->getCreationData();
        return view('backend.product.add_product', $data);
    }

    public function StoreProduct(Request $request)
    {
        $this->productService->storeProduct($request);

        $notification = array(
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product')->with($notification);
    }

    public function EditProduct($id)
    {
        $product = $this->productService->getProductById($id);
        $data = $this->productService->getCreationData();
        $data['product'] = $product;
        return view('backend.product.edit_product', $data);
    }

    public function UdateProduct(Request $request)
    {
        $this->productService->updateProduct($request, $request->id);

        $notification = array(
            'message' => 'Product Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product')->with($notification);
    }

    public function DeleteProduct($id)
    {
        $this->productService->deleteProduct($id);

        $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function BarcodeProduct($id){

        $product = Product::findOrFail($id);
        return view('backend.product.barcode_product',compact('product'));

    }// End Method 


    public function ImportProduct(){

        return view('backend.product.import_product');

    }// End Method 


    public function Export(){

        return Excel::download(new ProductExport,'products.xlsx');

    }// End Method 


    public function Import(Request $request){

        Excel::import(new ProductImport, $request->file('import_file'));

         $notification = array(
            'message' => 'Product Imported Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 
    }// End Method 
}
