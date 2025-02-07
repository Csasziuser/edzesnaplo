<?php

namespace App\Http\Controllers;

use App\Models\bejegyzes;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Log;

class BejegyzesController extends Controller
{
    function index() {

    }

    function store(Request $request) {
        try {
            $request->validate([
                'gyakorlat'=>'required|string',
                'ismetlesszam'=>'required|min:1|max:8|integer'
            ],[
                'min'=>'Érvénytelen ismétlésszám!'
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
}
