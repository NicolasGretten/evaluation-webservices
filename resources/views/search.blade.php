<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Recherche') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="text-center">
                        <form action="{{route('search')}}" method="get" enctype="multipart/form-data">
                            @csrf
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif

                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="form m-auto">
                                <label for="titre" class="col-sm-2 col-form-label">Titre</label>
                                <input class="form-control" type="text" name="titre"/>
                                <label for="categorie" class="col-sm-2 col-form-label">Catégories</label>
                                <select class="form-control" name="category_id" id="categorie">
                                    <option value="">--choisissez une catégorie--</option>
                                    @foreach ($categories as $categorie)
                                        <option value={{$categorie->id}}>{{$categorie->libelle}}</option>
                                    @endforeach

                                </select>
                            </div>

                            <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">
                                Rechercher
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 text-center">
                    @if($results->getStatusCode() != 400)
                        @if($results->getStatusCode() != 404)
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


                                @foreach ($results->getOriginalContent() as $result)
                                    <tr class="p-3 border">
                                        <th scope="row" class="p-3 border">{{ $result->id }}</th>
                                        <td class="p-3 border">{{ $result->titre }}</td>
                                        <td class="p-3 border">{{ $result->resumeCourt }}</td>
                                        <td class="p-3 border">{{ $result->categorie }}</td>
                                        <td class="p-3 border">
                                            <button type="button" class="btn m-1 btn-primary" value="modifier">
                                                Modifier
                                            </button>
                                            <button type="button" class="btn btn-primary" value="supprimer">Supprimer
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        @endif
                    @endif
                    @if($results->getStatusCode() === 404)
                        No match
                    @endif
                    @if($results->getStatusCode() === 400)
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
