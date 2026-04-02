<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Listagem de Alunos</h2>
                    <a href="{{ route('alunos.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        + Novo Aluno
                    </a>
                </div>

                <form action="{{ route('alunos.index') }}" method="GET" class="mb-6 flex gap-2">
                    <input type="text" name="search" placeholder="Pesquisar por nome..." value="{{ request('search') }}" class="border-gray-300 rounded-md shadow-sm w-full">
                    <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded">Buscar</button>
                </form>

                <table class="min-w-full border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="p-3 text-left">Matrícula</th>
                            <th class="p-3 text-left">Nome</th>
                            <th class="p-3 text-left">Curso</th>
                            <th class="p-3 text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alunos as $aluno)
                        <tr class="border-b">
                            <td class="p-3">{{ $aluno->matricula }}</td>
                            <td class="p-3">{{ $aluno->nome }}</td>
                            <td class="p-3">{{ $aluno->curso }}</td>
                            <td class="p-3 text-center flex justify-center gap-2">
                                <a href="{{ route('alunos.edit', $aluno->id) }}" class="text-yellow-600">Editar</a>
                                <form action="{{ route('alunos.destroy', $aluno->id) }}" method="POST" onsubmit="return confirm('Tem certeza?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600">Excluir</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $alunos->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>