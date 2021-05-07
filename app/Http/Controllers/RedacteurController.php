<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Redacteur;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RedacteurController extends Controller
{

    public function createForm(){
        return view('redacteurs');
    }



    /**
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        try {
            $this->validate($request, [
                'nom'=>'required|string',
                'prenom'=>'required|string',
                'email'=>'required|email'
            ]);

            DB::beginTransaction();
            $redacteur = new Redacteur();
            $redacteur->nom = $request->nom;
            $redacteur->prenom = $request->prenom;
            $redacteur->email = $request->email;
            $redacteur->save();
            DB::commit();

            return response()->json(['message'=>$redacteur]);

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
                'nom'=>'required|string',
                'prenom'=>'required|string',
                'email'=>'required|email'
            ]);

            $redacteur = Redacteur::where('id','=', $request->id)->first();

            if (empty($redacteur)){
                throw new Exception('The redacteur doesn\'t exist.', 404);
            }

            $redacteur->nom = $request->input('nom', $redacteur->getOriginal('nom'));
            $redacteur->prenom = $request->input('prenom', $redacteur->getOriginal('prenom'));
            $redacteur->email= $request->input('email', $redacteur->getOriginal('email'));
            $redacteur->save();

            return response()->json($redacteur);

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

            $redacteur = Redacteur::where('id','=', $request->id)->first();

            if (empty($redacteur)){
                throw new Exception('The redacteur doesn\'t exist.', 404);
            }

            $redacteur->delete();

            return response()->json($redacteur);

        } catch(Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }
}
