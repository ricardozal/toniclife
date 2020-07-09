<?php


namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UpdateCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        $categoryId = $this->route('categoryId');

        return [
            'name' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Categoria necesaria',

        ];
    }
}
