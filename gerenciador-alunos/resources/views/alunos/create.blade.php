<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <h2 class="text-xl font-bold mb-4">Cadastrar Aluno</h2>

                <form action="{{ route('alunos.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label>Nome Completo</label>
                            <input type="text" name="nome" class="w-full border-gray-300 rounded-md" required>
                        </div>
                        <div>
                            <label>E-mail</label>
                            <input type="email" name="email" class="w-full border-gray-300 rounded-md" required>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label>Telefone</label>
                                <input type="text" name="telefone" class="w-full border-gray-300 rounded-md">
                            </div>
                            <div>
                                <label>Data de Nascimento</label>
                                <input type="date" name="data_nascimento" class="w-full border-gray-300 rounded-md">
                            </div>
                        </div>
                        <div>
                            <label>Curso</label>
                            <input type="text" name="curso" class="w-full border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label>Matrícula</label>
                            <input type="text" name="matricula" class="w-full border-gray-300 rounded-md">
                        </div>
                    </div>
                    <button type="submit" class="mt-6 bg-green-600 text-white px-6 py-2 rounded font-bold">Salvar Aluno</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>