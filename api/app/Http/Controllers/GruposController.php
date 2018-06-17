<?php

namespace App\Http\Controllers;

use App\Grupos;
use Illuminate\Http\Request;

class GruposController extends Controller
{
    function index() {
        return Grupos::all();
    }

    function show($id) {
        return Grupos::where('nome', $id)->first();
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
