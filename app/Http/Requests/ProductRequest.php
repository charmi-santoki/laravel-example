<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(Request $request): array
    {
        if ($request->has('id')) {
            return [
                'name' => 'required|string|max:255',
                'detail' => 'required|string|max:255',
                'category_id' => 'required',
            ];
        } else {
            return [
                'name' => 'required|string|max:255',
                'detail' => 'required|string|max:255',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'category_id' => 'required',
            ];
        }
    }
}
