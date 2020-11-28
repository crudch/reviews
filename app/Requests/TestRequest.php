<?php

namespace App\Requests;

use System\Http\FormRequest;

class TestRequest extends FormRequest
{
    protected static array $messages = [
        'foo.email' => 'Test for Foo',
    ];

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => 'required|min:5',
            'short' => 'required|min:10',
            'slug'  => 'required|min:5',
            'image' => 'required',
            'body'  => 'required',
        ];
    }
}
