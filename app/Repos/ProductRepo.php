<?php


namespace App\Repos;


use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ProductRepo
{
    public function structureProductData($data): array
    {
        $newData = [];
        foreach ($data as $item) {
            $tmp['product_id'] = $item['id'];
            $tmp['user_id'] = Auth::user()->id;
            $tmp['quantity'] = $item['quantity'];
            $tmp['created_at'] = Carbon::now();
            $tmp['updated_at'] = Carbon::now();
            $newData[] = $tmp;
        }
        return $newData;
    }
}
