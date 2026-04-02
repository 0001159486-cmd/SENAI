<form action="{{ route('alunos.update', $aluno->id) }}" method="POST">
    @csrf
    @method('PUT')
    
    <input type="text" name="nome" value="{{ $aluno->nome }}" class="w-full border-gray-300 rounded-md">
    
    <button type="submit" class="mt-6 bg-blue-600 text-white px-6 py-2 rounded">Atualizar Dados</button>
</form>