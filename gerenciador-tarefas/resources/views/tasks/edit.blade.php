<x-app-layout>
    <x-slot name="header">
        {{ __('Editar Tarefa') }}
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('tasks.update', $task) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-bold small text-muted">TÍTULO</label>
                            <input type="text" name="title" class="form-control" value="{{ $task->title }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold small text-muted">DESCRIÇÃO</label>
                            <textarea name="description" class="form-control" rows="3">{{ $task->description }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold small text-muted">PRIORIDADE</label>
                                <select name="priority" class="form-select">
                                    <option value="baixa" {{ $task->priority == 'baixa' ? 'selected' : '' }}>Baixa</option>
                                    <option value="media" {{ $task->priority == 'media' ? 'selected' : '' }}>Média</option>
                                    <option value="alta" {{ $task->priority == 'alta' ? 'selected' : '' }}>Alta</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold small text-muted">STATUS</label>
                                <select name="status" class="form-select">
                                    <option value="pendente" {{ $task->status == 'pendente' ? 'selected' : '' }}>Pendente</option>
                                    <option value="concluida" {{ $task->status == 'concluida' ? 'selected' : '' }}>Concluída</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold small text-muted">DATA DE ENTREGA</label>
                            <input type="date" name="due_date" class="form-control" value="{{ $task->due_date }}" required>
                        </div>

                        <div class="d-flex justify-content-between pt-3 border-top">
                            <a href="{{ route('tasks.index') }}" class="btn btn-light px-4">Cancelar</a>
                            <button type="submit" class="btn btn-primary px-5 fw-bold shadow-sm">Atualizar Tarefa</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>