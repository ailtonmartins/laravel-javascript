<?php

namespace App\Http\Controllers;

use App\Continentes;
use Illuminate\Http\Request;

class ContinentesController extends Controller
{
    function index() {
        return Continentes::all();
    }

    function show($id) {
        return Continentes::find($id);
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
