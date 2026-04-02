<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index(Request $request)
    {
        $query = Produto::query();
        if ($request->has('baixo_estoque')) {
            $query->where('quantidade', '<', 5);
        }
        $produtos = $query->orderBy('nome')->get();
        return view('produtos.index', compact('produtos'));
    }

    public function create() { return view('produtos.create'); }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'categoria' => 'required|string',
            'quantidade' => 'required|integer|min:0',
            'preco' => 'required|numeric|min:0',
            'fornecedor' => 'required|string',
        ]);
        Produto::create($data);
        return redirect()->route('produtos.index')->with('success', 'Produto cadastrado!');
    }

    public function edit(Produto $produto) { return view('produtos.edit', compact('produto')); }

    public function update(Request $request, Produto $produto)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'categoria' => 'required|string',
            'quantidade' => 'required|integer|min:0',
            'preco' => 'required|numeric|min:0',
            'fornecedor' => 'required|string',
        ]);
        $produto->update($data);
        return redirect()->route('produtos.index')->with('success', 'Produto atualizado!');
    }

    public function destroy(Produto $produto)
    {
        $produto->delete();
        return redirect()->route('produtos.index')->with('success', 'Produto removido!');
    }
}