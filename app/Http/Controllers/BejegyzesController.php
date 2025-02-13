<?php

namespace App\Http\Controllers;

use App\Models\bejegyzes;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

use Log;

class BejegyzesController extends Controller
{
    function index() {
        $edzesek = bejegyzes::all();
        return response()->json($edzesek,200,['Access-Control-Allow-Origin'=>'*'],JSON_UNESCAPED_UNICODE);
    }

    function store(Request $request) {
        try {
            $request->validate([
                'gyakorlat'=>'required|string',
                'ismetlesszam'=>'required|min:1|max:8|integer'
            ],[
                'min'=>'Érvénytelen ismétlésszám!',
                'integer'=>'Az ismétlésszám szám értéket kell tartalmazzon!',
                'string'=>'A(z) :attribute mező szöveges értéket kell, hogy tartalmazzon! 😶',
            ]);

        } catch (ValidationException $th) {
            //->header('Access-Control-Allow-Origin','*')
            return response()->json(['success'=>false,'message'=>$th->errors()],201,['Access-Control-Allow-Origin'=>'*'],JSON_UNESCAPED_UNICODE);
        }
        bejegyzes::create([
            'gyakorlat'=>$request->gyakorlat,
            'ismetlesszam'=>$request->ismetlesszam,
        ]);
        return response()->json(['success'=>true,'message'=>'Rekord sikeresen hozzáadva!'],201,['Access-Control-Allow-Origin'=>'*'],JSON_UNESCAPED_UNICODE);
    
    }
    function destroy(Request $request) {
        try
        {
            $b = bejegyzes::findOrFail($request->id);

            
        }
        // catch(Exception $e) catch any exception
        catch(ModelNotFoundException $e)
        {
            return response()->json(["success" => false, "message" => "Sikertelen törlés!"], 404);
        }
        $b->delete();
        return response()->json(["success" => true, "message" => "Sikeres törlés!"], 200,['Access-Control-Allow-Origin'=>'*'],JSON_UNESCAPED_UNICODE);

        
    }
}
