<?php


namespace App\Repos;


use App\Models\Cart;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class CartRepo
{
    public function emptyCart()
    {
        return Cart::query()
            ->where('user_id', Auth::user()->id)
            ->delete();
    }

    public function getCart(): Collection|array
    {
        return Product::query()->whereHas('cart', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->get();
    }

    public function totalPayment(): float
    {
        return Product::query()->whereHas('cart', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->sum('price');
    }
}
