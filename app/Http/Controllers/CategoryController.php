<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    public function createForm(){
        return view('categories');
    }

    /**
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        try {
            $this->validate($request, [
                'libelle'=>'required|string'
            ]);

            DB::beginTransaction();
            $category = new Category();
            $category->libelle = $request->libelle;
            $category->save();
            DB::commit();

            return response()->json($category);

        } catch(Exception $e){
            DB::rollBack();
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        try {
            $this->validate($request, [
                'libelle'=>'required|string'
            ]);

            $category = Category::where('id','=', $request->id)->first();

            if (empty($category)){
                throw new Exception('The category doesn\'t exist.', 404);
            }

            $category->libelle = $request->input('libelle', $category->getOriginal('libelle'));
            $category->save();

            return response()->json($category);

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

            $category = Category::where('id','=', $request->id)->first();

            if (empty($category)){
                throw new Exception('The category doesn\'t exist.', 404);
            }

            $category->delete();

            return response()->json($category);

        } catch(Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }
}
