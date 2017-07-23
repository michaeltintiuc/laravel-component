<?php
namespace App\Components\Stubs\Admin\Requests;

use MichaelT\Requests\BaseRequest;

class DestroyStubsRequest extends BaseRequest
{
    public function rules()
    {
        return ['ids' => 'required|array'];
    }
}
