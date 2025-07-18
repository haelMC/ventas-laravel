<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $usuarios = User::orderBy('name')->get();
        return view('usuarios.index', compact('usuarios'));
    }
}
