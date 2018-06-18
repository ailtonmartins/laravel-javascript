<?php

namespace App\Http\Controllers;

use App\Grupos;
use Illuminate\Http\Request;

class GruposController extends Controller
{
    function index() {
        $grupos = Grupos::all();

        if ( count($grupos) > 0 ) {
            foreach ( $grupos as $k => $v ) {
              $grupos[$k]['times'] = Grupos::find($grupos[$k]->id)->times;
            }
        }

        return response()->json($grupos , 201);
    }

    function show($id) {
        return response()->json(Grupos::where('nome', $id)->first(), 201);
    }

    function store() {
        return "Admin";
    }

    function update() {
        return "Admin";
    }

    function destroy() {
        return "Admin";
    }


}
