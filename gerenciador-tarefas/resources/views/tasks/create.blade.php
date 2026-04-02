<x-app-layout>
    <x-slot name="header">
        {{ __('Nova Tarefa') }}
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="mb-4">
                        <h4 class="fw-bold text-dark">Cadastrar Atividade</h4>
                        <p class="text-muted small">Preencha os detalhes abaixo para organizar seu dia.</p>
                    </div>

                    <form method="POST" action="{{ route('tasks.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-bold">Título da Tarefa</label>
                            <input type="text" name="title" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   placeholder="Ex: Reunião de Planejamento" 
                                   value="{{ old('title') }}" required autofocus>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Descrição (Opcional)</label>
                            <textarea name="description" class="form-control" rows="3" 
                                      placeholder="Detalhes adicionais sobre a tarefa...">{{ old('description') }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Prioridade</label>
                                <select name="priority" class="form-select">
                                    <option value="baixa" {{ old('priority') == 'baixa' ? 'selected' : '' }}>Baixa</option>
                                    <option value="media" {{ old('priority') == 'media' ? 'selected' : (old('priority') ? '' : 'selected') }}>Média</option>
                                    <option value="alta" {{ old('priority') == 'alta' ? 'selected' : '' }}>Alta</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Data de Entrega</label>
                                <input type="date" name="due_date" 
                                       class="form-control @error('due_date') is-invalid @enderror" 
                                       value="{{ old('due_date') }}" required>
                                @error('due_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <hr class="my-4 text-muted opacity-25">

                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('tasks.index') }}" class="text-decoration-none text-secondary">
                                <i class="bi bi-arrow-left"></i> Voltar para a lista
                            </a>
                            <button type="submit" class="btn btn-primary px-5 fw-bold shadow-sm">
                                Criar Tarefa
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>