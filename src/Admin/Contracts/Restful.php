<?php

namespace MichaelT\Component\Admin\Contracts;

use Illuminate\Http\Request;

interface Restful
{
    public function index();
    public function create();
    public function show($id);
    public function edit($id);
    public function store(Request $request);
    public function update(Request $request, $id);
    public function destroy($id);
    public function destroyMultiple(Request $request);
}
