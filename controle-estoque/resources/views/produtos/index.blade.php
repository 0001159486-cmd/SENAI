<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Controle de Estoque') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="flex justify-between items-center mb-6">
                    <div class="space-x-2">
                        <a href="{{ route('produtos.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300">
                            Todos
                        </a>
                        <a href="{{ route('produtos.index', ['baixo_estoque' => 1]) }}" class="inline-flex items-center px-4 py-2 bg-red-100 border border-transparent rounded-md font-semibold text-xs text-red-700 uppercase tracking-widest hover:bg-red-200">
                            Estoque Baixo
                        </a>
                    </div>

                    <a href="{{ route('produtos.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        + Adicionar Produto
                    </a>
                </div>

                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg border border-green-200">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto border rounded-lg">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 text-sm uppercase text-gray-600 border-b">
                                <th class="px-4 py-3">Produto</th>
                                <th class="px-4 py-3">Categoria</th>
                                <th class="px-4 py-3 text-center">Qtd</th>
                                <th class="px-4 py-3 text-right">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($produtos as $p)
                                <tr class="border-b hover:bg-gray-50 {{ $p->quantidade < 5 ? 'bg-red-50' : '' }}">
                                    <td class="px-4 py-4 font-medium text-gray-900">{{ $p->nome }}</td>
                                    <td class="px-4 py-4 text-gray-500">{{ $p->categoria }}</td>
                                    <td class="px-4 py-4 text-center font-bold {{ $p->quantidade < 5 ? 'text-red-600' : '' }}">
                                        {{ $p->quantidade }}
                                    </td>
                                    <td class="px-4 py-4 text-right space-x-4">
                                        <a href="{{ route('produtos.edit', $p->id) }}" class="text-indigo-600 hover:text-indigo-900 font-bold">Editar</a>
                                        <form action="{{ route('produtos.destroy', $p->id) }}" method="POST" class="inline">
                                            @csrf 
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 font-bold" onclick="return confirm('Tem certeza que deseja excluir?')">
                                                Excluir
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-8 text-center text-gray-500">
                                        Nenhum produto encontrado. Clique em "+ Adicionar" para começar.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>