<x-app-layout>
    <x-slot name="header">
        {{ __('Minhas Tarefas') }}
    </x-slot>

    <div class="row mb-4 align-items-center">
        <div class="col">
            <p class="text-muted mb-0">Gerencie suas atividades diárias</p>
        </div>
        <div class="col-auto">
            <a href="{{ route('tasks.create') }}" class="btn btn-primary px-4 py-2 fw-bold shadow-sm">
                + Nova Tarefa
            </a>
        </div>
    </div>

    <div class="card p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold mb-0">Lista de Atividades</h5>
            <form method="GET" action="{{ route('tasks.index') }}" class="d-flex gap-2">
                <select name="status" class="form-select form-select-sm border-0 bg-light" onchange="this.form.submit()">
                    <option value="">Filtrar Status</option>
                    <option value="pendente" {{ request('status') == 'pendente' ? 'selected' : '' }}>Pendentes</option>
                    <option value="concluida" {{ request('status') == 'concluida' ? 'selected' : '' }}>Concluídas</option>
                </select>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="bg-light">
                    <tr>
                        <th class="border-0">Tarefa</th>
                        <th class="border-0 text-center">Prioridade</th>
                        <th class="border-0">Prazo</th>
                        <th class="border-0">Status</th>
                        <th class="border-0 text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tasks as $task)
                        <tr>
                            <td>
                                <div class="fw-semibold text-dark">{{ $task->title }}</div>
                                <small class="text-muted">{{ Str::limit($task->description, 40) }}</small>
                            </td>
                            <td class="text-center">
                                @php
                                    $color = ['alta' => 'danger', 'media' => 'warning', 'baixa' => 'info'][$task->priority];
                                @endphp
                                <span class="badge rounded-pill text-bg-{{ $color }} px-3">
                                    {{ ucfirst($task->priority) }}
                                </span>
                            </td>
                            <td class="text-muted">
                                {{ \Carbon\Carbon::parse($task->due_date)->format('d/m/Y') }}
                            </td>
                            <td>
                                <span class="dot {{ $task->status == 'concluida' ? 'bg-success' : 'bg-warning' }} d-inline-block rounded-circle" style="width: 10px; height: 10px;"></span>
                                {{ ucfirst($task->status) }}
                            </td>
                            <td class="text-end">
                                <div class="btn-group">
                                    @if($task->status == 'pendente')
                                        <form action="{{ route('tasks.complete', $task) }}" method="POST" class="d-inline">
                                            @csrf @method('PATCH')
                                            <button class="btn btn-sm btn-light text-success" title="Concluir"><i class="bi bi-check2"></i> ✓</button>
                                        </form>
                                    @endif
                                    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-light text-primary">✎</a>
                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-light text-danger" onclick="return confirm('Excluir?')">✕</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">Nenhuma tarefa encontrada.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>