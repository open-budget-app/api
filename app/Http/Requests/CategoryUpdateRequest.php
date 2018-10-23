<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CategoryUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'sometimes',
                Rule::unique('categories')->where(function ($query) {
                    return $query->where([
                        'category_group_id' => $this->route('categoryGroup')->id,
                        'name' => $this->input('name'),
                    ]);
                })
            ]
        ];
    }
}
