<?php

namespace App\Http\Controllers;

use App\Http\Requests\Products\ImportProductsRequests;
use App\Imports\ProductsImport;
use App\Models\Product;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function importProducts(ImportProductsRequests $request)
    {
        Excel::import(new ProductsImport(), $request->file);

        return response('success');
    }

    public function getProductCount()
    {
        return Product::query()->count();
    }

    public function getProducts()
    {
        return Product::query()->paginate();
    }
}
