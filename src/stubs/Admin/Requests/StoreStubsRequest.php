<?php
namespace App\Components\Stubs\Admin\Requests;

use MichaelT\Requests\BaseRequest;

class StoreStubsRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => 'bail|required|string'
        ];
    }
}
