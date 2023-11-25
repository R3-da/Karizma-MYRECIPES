<?php

namespace App\Http\Requests;

use Config;
use Illuminate\Foundation\Http\FormRequest;

class RecipeRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name'         => 'required|max:126',
            'ingredients'  => 'required',
            'instructions' => 'required',
            'duration'     => 'required|integer',
            'status'       => 'in:active,inactive,deleted'
        ];
    }

    public function authorize()
    {
        return true;
    }
}
