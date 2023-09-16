<?php

namespace App\Rules;

use Closure;
use App\Models\Cart;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class CartProductExistingRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param string $attribute
     * @param mixed $value
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $productExistInCart = Cart::query()->where('product_id', $value)->authUser()->exists();
        if ($productExistInCart)
        {
            $fail('product already added in cart');
        }
    }
}
