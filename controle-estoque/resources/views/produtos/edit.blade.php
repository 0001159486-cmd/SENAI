<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($produto) ? 'Editar Produto' : 'Cadastrar Novo Produto' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form action="{{ isset($produto) ? route('produtos.update', $produto->id) : route('produtos.store') }}" method="POST">
                    @csrf
                    @if(isset($produto)) @method('PUT') @endif

                    <div class="space-y-4">
                        <div>
                            <x-input-label for="nome" value="Nome do Produto" />
                            <x-text-input id="nome" name="nome" type="text" class="mt-1 block w-full" :value="old('nome', $produto->nome ?? '')" required />
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="categoria" value="Categoria" />
                                <x-text-input id="categoria" name="categoria" type="text" class="mt-1 block w-full" :value="old('categoria', $produto->categoria ?? '')" required />
                            </div>
                            <div>
                                <x-input-label for="fornecedor" value="Fornecedor" />
                                <x-text-input id="fornecedor" name="fornecedor" type="text" class="mt-1 block w-full" :value="old('fornecedor', $produto->fornecedor ?? '')" required />
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="quantidade" value="Quantidade" />
                                <x-text-input id="quantidade" name="quantidade" type="number" class="mt-1 block w-full" :value="old('quantidade', $produto->quantidade ?? '')" required />
                            </div>
                            <div>
                                <x-input-label for="preco" value="Preço" />
                                <x-text-input id="preco" name="preco" type="number" step="0.01" class="mt-1 block w-full" :value="old('preco', $produto->preco ?? '')" required />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="descricao" value="Descrição" />
                            <textarea name="descricao" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('descricao', $produto->descricao ?? '') }}</textarea>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('produtos.index') }}" class="mr-4 text-sm text-gray-600 underline">Cancelar</a>
                            <x-primary-button>Salvar Produto</x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>