<?php

namespace App\Http\Controllers;

use App\Models\Symbol;
use App\Models\Teeth;
use Illuminate\Http\Request;

class OdontogramController extends Controller
{
    public function create()
    {
        $symbols = Symbol::all();
        $teeths = Teeth::all();
        return view('odontogram.create', compact(['symbols', 'teeths']));
    }
}
