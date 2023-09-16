<?php

namespace App\Http\Requests\Cart;

use App\Rules\CartProductExistingRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'product_id' => [
                'required',
                new CartProductExistingRule,
                Rule::exists('products', 'id')->where(function (Builder $query) {
                    return $query->where('quantity', '>',0);
                })
            ],
        ];
    }
}
