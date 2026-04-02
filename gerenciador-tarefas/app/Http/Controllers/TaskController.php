<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Listar as tarefas do usuário com filtro.
     */
    public function index(Request $request)
    {
        // Iniciamos a query a partir das tarefas do usuário logado
        $query = Auth::user()->tasks();

        // Filtro por status (se enviado via GET)
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Ordenar por data de entrega e pegar os resultados
        $tasks = $query->orderBy('due_date', 'asc')->get();

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Mostrar o formulário de criação.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Salvar uma nova tarefa.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority'    => 'required|in:baixa,media,alta',
            'due_date'    => 'required|date',
        ]);

        // Criar a tarefa associada ao usuário atual
        Auth::user()->tasks()->create($data);

        return redirect()->route('tasks.index')->with('success', 'Tarefa criada com sucesso!');
    }

    /**
     * Mostrar o formulário de edição.
     */
    public function edit(Task $task)
    {
        // Garantir que o usuário só edite suas próprias tarefas
        $this->authorizeUser($task);

        return view('tasks.edit', compact('task'));
    }

    /**
     * Atualizar a tarefa.
     */
    public function update(Request $request, Task $task)
    {
        $this->authorizeUser($task);

        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority'    => 'required|in:baixa,media,alta',
            'due_date'    => 'required|date',
            'status'      => 'required|in:pendente,concluida',
        ]);

        $task->update($data);

        return redirect()->route('tasks.index')->with('success', 'Tarefa atualizada!');
    }

    /**
     * Marcar como concluída (Ação rápida).
     */
    public function complete(Task $task)
    {
        $this->authorizeUser($task);

        $task->update(['status' => 'concluida']);

        return back()->with('success', 'Tarefa marcada como concluída!');
    }

    /**
     * Excluir tarefa.
     */
    public function destroy(Task $task)
    {
        $this->authorizeUser($task);
        
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Tarefa excluída!');
    }

    /**
     * Método auxiliar para segurança: verifica se a tarefa pertence ao usuário.
     */
    private function authorizeUser(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403, 'Ação não autorizada.');
        }
    }
}