<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'website_name' => [
                'nullable'
            ],
            'website_url' => [
                'nullable'
            ],
                'page_title' => [
                    'nullable'
                ],
                'meta_keyword' => [
                    'nullable'
                ],
                'meta_description' => [
                    'nullable'
                ],
                'address' => [
                    'nullable'
                ],
                'phone1' => [
                    'nullable'
                ],
                'phone2' =>[
                    'nullable'
                ],
                'email1' =>[
                    'nullable'
                ],
                'email2' => [
                    'nullable'
                ],
                'facebook' => [
                    'nullable'
                ],
                'twitter' =>[
                    'nullable'
                ],
                'instagram' => [
                    'nullable'
                ],
                'youtube' => [
                    'nullable'
                ],
        ];
    }
}
