<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CartService
{
    public function addProduct(int $productId): Model|Builder
    {
        return Cart::query()->create([
            'user_id' => auth()->id(),
            'product_id' => $productId,
            'price' => $this->calculateCartPrice($productId, 1)
        ]);
    }

    public function updateProductQuantity(int $productId, int $quantity): Model|Builder|Collection
    {
        $cart = Cart::query()->authUser()->where('product_id', $productId)->first();
        $cart->update([
            'quantity' => $quantity,
            'price' => $this->calculateCartPrice($productId, $quantity)
        ]);

        return $cart;
    }

    public function removeCart($productId): bool
    {
        return Cart::query()->authUser()->where('product_id', $productId)?->delete();
    }

    public function calculateCartPrice(int $productId, int $quantity): float|int
    {
        return Product::query()->find($productId)->price * $quantity;
    }
}
