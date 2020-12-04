<?php

namespace App\Http\Requests\Commodity;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCommodityRequest extends FormRequest
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
        $commodity = $this->route('commodity');

        return [
            'title' => [
                Rule::unique('commodities')->ignore($commodity),
            ]
        ];
    }
}
