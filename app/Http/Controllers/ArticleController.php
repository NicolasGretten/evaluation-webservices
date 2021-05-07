<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Redacteur;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function createSearchForm(Request $request){

        return view('search', ['categories'=> $categories = Category::all(), 'results'=> $this->search($request) ]);
    }

    public function createUpdateForm(Request $request){

        return view('updateArticle', [
            'article'=> Article::where('id', '=', $request->id)->first(),
            'categories'=> $categories = Category::all(),
            'redacteurs'=> Redacteur::all()
            ]);
    }

    public function createForm(Request $request){

        return view('ajoutArticle', [
            'categories'=> $categories = Category::all(),
            'redacteurs'=> Redacteur::all()
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function list(): JsonResponse
    {
        try {
            $list = Article::orderBy('id', 'ASC')->get();

            return response()->json($list);

        } catch(Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        try {
            $this->validate($request, [
                'titre'=>'required|string',
                'category_id'=>'required|exists:categories,id',
                'redacteur_id'=>'required|exists:redacteurs,id',
                'resumeCourt'=>'required|string',
                'description'=>'required|string',
            ]);

            $article = new Article();
            $article->titre = strtolower($request->titre);
            $article->category_id = $request->category_id;
            $article->redacteur_id = $request->redacteur_id;
            $article->resumeCourt = strtolower($request->resumeCourt);
            $article->description = strtolower($request->description);
            $article->save();

            return response()->json($article);

        } catch(Exception $e){
            return response()->json(['succes'=>false, 'message'=>$e->getMessage()], 500);
        }
    }

    /**
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        try {
            $this->validate($request, [
                'titre'=>'required|string',
                'category_id'=>'required|exists:categories,id',
                'redacteur_id'=>'required|exists:redacteurs,id',
                'resumeCourt'=>'required|string',
                'description'=>'required|string',
            ]);

            $article = Article::where('id','=', $request->id)->first();

            if (empty($article)){
                throw new Exception('L\'article n\'existe pas.', 404);
            }

            $article->titre = strtolower($request->input('titre', $article->getOriginal('titre')));
            $article->category_id = $request->input('category_id', $article->getOriginal('category_id'));
            $article->redacteur_id = $request->input('redacteur_id', $article->getOriginal('redacteur_id'));
            $article->resumeCourt = strtolower($request->input('resumeCourt', $article->getOriginal('resumeCourt')));
            $article->description = strtolower($request->input('description', $article->getOriginal('description')));
            $article->save();

            return response()->json($article);

        } catch(Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * @return JsonResponse
     */
    public function delete(Request $request): JsonResponse
    {
        try {

            $article = Article::where('id','=',$request->id)->first();

            if (empty($article)){
                throw new Exception('L\'article n\'existe pas.', 404);
            }

            $article->delete();

            return response()->json($article);

        } catch(Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }

    public function search(Request $request)
    {
        try {

            if (!empty($request->category_id) and empty($request->titre)){
                $category = Category::where('id', '=', $request->category_id)->with('articles')->get();
                if ($category->isEmpty()){
                    return response()->json(['success'=>true, 'Message'=>'No Match'], 404);
                }
                return response()->json($category->first()->articles);
            }

            if (!empty($request->titre) and empty($request->category)){
                $titre = Article::where('titre', 'like', '%' . strtolower($request->titre ). '%')->get();
                if ($titre->isEmpty()){
                    return response()->json(['success'=>true, 'Message'=>'No Match'], 404);
                }
                return response()->json($titre);
            }

            if (!empty($request->category) and !empty($request->titre)){


                $article = Article::where('category_id','=',  $request->category_id)->where('titre', 'like', '%' . strtolower($request->titre ). '%')->get();

                if ($article->isEmpty()){
                    return response()->json(['success'=>true, 'Message'=>'No Match'], 404);
                }

                return response()->json($article);
            }

            return response()->json('No Match', 400);

        } catch(Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }

}
