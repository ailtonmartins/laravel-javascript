<?php

namespace App\Http\Controllers;

use App\Continentes;
use App\Grupos;
use App\Times;
use Validator;
use Illuminate\Http\Request;

class TimesController extends Controller
{
    function index() {
        return Times::with(['grupos', 'continentes'])->get();
    }

    function show($id) {
        return Times::with(['grupos', 'continentes'])->find($id);
    }

    protected function timesValidator( $data , $time = false){

        $messages = [
            'required' => 'O :attribute é obrigatório.',
            'integer' => 'O :attribute não é inteiro.',
            'max' => 'O :attribute  pode ter no maximo 120 caracteres.',
        ];

        $validator = Validator::make($data, [
            'nome' => 'required|max:120',
            'grupo' => 'required|integer',
            'continente' => 'required|integer'
        ] , $messages);

        if($validator->fails()) {
            return response()->json([
                'message'   => 'Validation Failed',
                'errors'    => $validator->errors()->all()
            ], 422);
        }

        $grupo = Grupos::find($data['grupo']);
        if ( !isset( $grupo->id ) ){
            return response()->json([
                'message'   => 'Validation Failed',
                'errors'    => ['Grupo não encontrado']
            ], 422);
        }

        if ( count( $grupo->times ) >= 4  ) {
            if ( !$time ||  $time['grupos_id'] != $data['grupo'] ) {
                return response()->json([
                    'message'   => 'Validation Failed',
                    'errors'    => [ 'Grupo ' . $grupo['nome'] . ' já tem ' .  count( $grupo->times ) . ' times']
                ], 422);
            }

        }

        $continente = Continentes::find($data['continente']);
        if ( !isset( $continente->id ) ){
            return response()->json([
                'message'   => 'Validation Failed',
                'errors'    => ['Continente não encontrado']
            ], 422);
        }
    }

    function store(Request $request) {

        $data = $request->all();

        $validator = $this->timesValidator( $data );

        if ( $validator ) {
            return $validator;
        }

        $time = new Times();
        $time->fill($data);
        $time->grupos_id = $data['grupo'];
        $time->continentes_id = $data['continente'];
        $time->save();

        return response()->json($this->show($time->id), 201);

    }

    function update(Request $request, $id) {

        $time = Times::find($id);
        if(!$time) {
            return response()->json([
                'message'   => 'Time não encontrado',
            ], 404);
        }

        $data = $request->all();

        $validator = $this->timesValidator( $data , $time);

        if ( $validator ) {
            return $validator;
        }

        $time->fill($data);
        $time->grupos_id = $data['grupo'];
        $time->continentes_id = $data['continente'];
        $time->save();

        return response()->json($this->show($time->id), 201);
    }

    function destroy($id) {
        $time = Times::find($id);
        if(!$time) {
            return response()->json([
                'message'   => 'Time não encontrado',
            ], 404);
        }

        return response()->json($time->delete(), 204);
    }
}
