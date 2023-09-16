<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Services\CartService;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\CartResource;
use App\Http\Resources\CartListResource;
use App\Http\Requests\Cart\AddProductRequest;
use App\Http\Requests\Cart\RemoveProductRequest;
use App\Http\Requests\Cart\SetProductQuantityRequest;

class CartController extends Controller
{
    public function __construct(public CartService $cartService)
    {
        //
    }

    public function addProductInCart(AddProductRequest $request): JsonResponse
    {
        $cart = $this->cartService->addProduct($request->post('product_id'));

        return response()->json(['status' => 200, 'success' => true, 'data' => new CartResource($cart)]);
    }

    public function removeProductFromCart(RemoveProductRequest $request): JsonResponse
    {
        $removed = $this->cartService->removeCart($request->post('product_id'));

        return response()->json(['status' => $removed ? 200 : 404, 'success' => $removed]);
    }

    public function setCartProductQuantity(SetProductQuantityRequest $request): JsonResponse
    {
        $cart = $this->cartService->updateProductQuantity(
            $request->post('product_id'),
            $request->post('quantity')
        );

        return response()->json(['status' => 200, 'success' => true, 'data' => new CartResource($cart)]);
    }

    public function getUserCart(): JsonResponse
    {
        $carts = Cart::query()->authUser()->get();

        return response()->json(CartListResource::collection($carts));
    }
}
