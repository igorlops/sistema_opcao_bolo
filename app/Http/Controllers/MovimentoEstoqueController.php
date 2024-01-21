<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovimentoEstoqueRequest;
use App\Models\MovimentosEstoque;
use Illuminate\Http\Request;

class MovimentoEstoqueController extends Controller
{
    public function destroy(int $id)
    {
        MovimentosEstoque::destroy($id);
        return redirect()->back();
    }
    public function store(MovimentoEstoqueRequest $request)
    {
        MovimentosEstoque::create($request->all());
        return redirect()->back();
    }
}
