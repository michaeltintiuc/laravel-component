<?php
namespace App\Components\Stubs\Admin\Requests;

use MichaelT\Component\BaseRequest;

class StoreStubsRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => 'bail|required|string'
        ];
    }
}
