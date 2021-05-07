<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Articles') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 text-center">
                    <table class="table-auto border">
                        <thead class="">
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Titre</th>
                            <th scope="col">Résumé</th>
                            <th scope="col">Catégorie</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($data as $article)
                            <tr class="p-3 border">
                                <th scope="row" class="p-3 border">{{ $article->id }}</th>
                                <td class="p-3 border">{{ $article->titre }}</td>
                                <td class="p-3 border">{{ $article->resumeCourt }}</td>
                                <td class="p-3 border">{{ $article->categorie }}</td>
                                <td class="p-3 border">
                                    <a href='/articles/{{$article->id}}/update' class="btn m-1 btn-primary">Modifier</a>
                                    <a href='/articles/{{$article->id}}/delete' class="btn btn-danger" >Supprimer</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <a href="{{ route('AddArticle') }}" class="btn mt-5 btn-primary">Ajouter un article</a>
                </div>
            </div>
        </div>
    </div>
    <script>


    </script>
</x-app-layout>
