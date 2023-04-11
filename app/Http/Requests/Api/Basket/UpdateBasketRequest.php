<?php

namespace App\Http\Requests\Api\Basket;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBasketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'book_id' => 'exists:books,id',
            'from' => 'date',
            'to' => 'date',
            'give' => 'boolean',
            'take' => 'boolean',
            'take_date' => 'date'
        ];
    }
}
