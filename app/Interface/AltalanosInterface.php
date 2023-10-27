<?php

namespace App\Interface;

use Illuminate\Http\Request;

interface AltalanosInterface
{
    public function list(Request $request);
    public function save(Request $request);
    public function delete(Request $request);
    public function edit(Request $request);
}
