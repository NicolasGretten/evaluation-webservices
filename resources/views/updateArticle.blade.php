<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier un Article') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="text-center">
                        <form action="/articles/{{$article->id}}" method="post" enctype="multipart/form-data">
{{--                        <form action="" enctype="multipart/form-data">--}}
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

                            <div class="form-group m-auto">
                                <label for="titre" class="col-sm-2 col-form-label">titre</label>
                                <input class="form-control" type="text" name="titre" value="{{ $article->titre }}"/>
                                <label for="resumeCourt" class="col-sm-2 col-form-label">resumé</label>
                                <input class="form-control" type="text" name="resumeCourt" value="{{ $article->resumeCourt}}"/>
                                <label for="description" class="col-sm-2 col-form-label">Description</label>
                                <input class="form-control" type="text" name="description" value="{{ $article->description }}"/>

                                <label for="categorie" class="col-sm-2 col-form-label">Catégories</label>
                                <select class="form-control" name="category_id" id="categorie">
                                @foreach ($categories as $categorie)
                                        <option value={{$categorie->id}}>{{$categorie->libelle}}</option>
                                    @endforeach

                                </select>
                                <label for="redacteur" class="col-sm-2 col-form-label">Rédacteur</label>
                                <select class="form-control" name="redacteur_id" id="redacteur">
                                    @foreach ($redacteurs as $redacteur)
                                        <option value={{$redacteur->id}}>{{$redacteur->fullName()}}</option>
                                    @endforeach

                                </select>
                            </div>

                            <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">
                                Modifier l'article
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
