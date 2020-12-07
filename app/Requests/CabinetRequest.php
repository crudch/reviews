<?php

namespace App\Requests;

use System\Http\FormRequest;

class CabinetRequest extends FormRequest
{
    protected static array $messages = [
        'id.required' => 'ID обязателен',
        'id.positive' => 'ID должен быть обязательно положительное число',
        'avatar.required' => 'Аватар фак еан',
    ];

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'id'     => 'required|positive',
            'avatar' => 'required|str|max:10'
        ];
    }
}
