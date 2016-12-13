<?php

namespace MichaelT\Component;

abstract class BaseRequest extends \Illuminate\Foundation\Http\FormRequest
{
    public function authorize()
    {
        return true;
    }

    abstract public function rules();
}
