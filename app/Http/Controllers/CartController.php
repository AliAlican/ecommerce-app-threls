<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cart\SynchroniseCartRequest;
use App\Http\Requests\Cart\UpdateCartQuantityRequest;
use App\Models\Cart;
use App\Repos\CartRepo;
use App\Repos\ProductRepo;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use JetBrains\PhpStorm\Pure;

class CartController extends Controller
{
    protected CartRepo $cartRepo;

    #[Pure] public function __construct()
    {
        $this->cartRepo = new CartRepo();
    }

    public function get(): Collection|array
    {
        return $this->cartRepo->getCart();
    }

    public function updateQuantity(UpdateCartQuantityRequest $request): Collection|array
    {
        Cart::query()
            ->updateOrCreate([
                'user_id' => Auth::user()->id,
                'product_id' => $request->get('id')
            ], ['quantity' => $request->get('quantity')]);

        return $this->cartRepo->getCart();
    }

    public function emptyCart()
    {
        $repo = new CartRepo();
        return $repo->emptyCart();
    }

    public function syncCart(SynchroniseCartRequest $request): bool
    {
        $repo = new ProductRepo();
        $data = $repo->structureProductData($request->get('products'));
        $this->cartRepo->emptyCart();
        return Cart::query()->insert($data);
    }
}
