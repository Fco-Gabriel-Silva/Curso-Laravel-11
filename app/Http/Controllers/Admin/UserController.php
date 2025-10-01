<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(20); // User::all(); //retorna o primeiro usuário cadastrado.
        //dd($users); //dd() - dump and die: é tipo um "console.log" só que do Laravel.

        return view("admin.users.index", compact("users"));
    }
}
