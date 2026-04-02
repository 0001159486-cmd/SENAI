<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    /**
     * Exibe a listagem de alunos com busca.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Busca por nome se houver o parâmetro 'search'
        $alunos = Aluno::when($search, function ($query, $search) {
            return $query->where('nome', 'like', "%{$search}%");
        })->paginate(10);

        return view('alunos.index', compact('alunos'));
    }

    /**
     * Mostra o formulário de criação.
     */
    public function create()
    {
        return view('alunos.create');
    }

    /**
     * Salva um novo aluno no banco de dados.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:alunos,email',
            'telefone' => 'required|string',
            'data_nascimento' => 'required|date',
            'curso' => 'required|string',
            'matricula' => 'required|unique:alunos,matricula',
        ]);

        Aluno::create($validated);

        return redirect()->route('alunos.index')->with('success', 'Aluno cadastrado com sucesso!');
    }

    /**
     * Exibe os detalhes de um aluno específico.
     */
    public function show(Aluno $aluno)
    {
        return view('alunos.show', compact('aluno'));
    }

    /**
     * Mostra o formulário de edição.
     */
    public function edit(Aluno $aluno)
    {
        return view('alunos.edit', compact('aluno'));
    }

    /**
     * Atualiza os dados do aluno.
     */
    public function update(Request $request, Aluno $aluno)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:alunos,email,' . $aluno->id,
            'telefone' => 'required|string',
            'data_nascimento' => 'required|date',
            'curso' => 'required|string',
            'matricula' => 'required|unique:alunos,matricula,' . $aluno->id,
        ]);

        $aluno->update($validated);

        return redirect()->route('alunos.index')->with('success', 'Aluno atualizado com sucesso!');
    }

    /**
     * Remove o aluno do banco de dados.
     */
    public function destroy(Aluno $aluno)
    {
        $aluno->delete();

        return redirect()->route('alunos.index')->with('success', 'Aluno excluído com sucesso!');
    }
}