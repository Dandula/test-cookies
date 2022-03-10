<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BuyCookies extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cookies' => 'required|integer|min:1',
        ];
    }

    /**
     * Get cookies.
     *
     * @return array
     */
    public function getCookies()
    {
        return $this->input('cookies');
    }
}
