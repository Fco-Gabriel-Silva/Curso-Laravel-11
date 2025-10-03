<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
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

    public function create()
    {
        return view("admin.users.create");
    }

    public function store(StoreUserRequest $request)
    {
        // "Request $request" é a mesma coisa que: "$request = new Request();"

        /*   
        $user = new User;
        $user->name = "Fulano";
        $user->email = "fulano@example";
        $user->save(); // salva o usuário no banco de dados
        */

        // dd($request->get('name')); // get('nome-do-campo') - pega o valor do campo (OBS: ele só pega um único campo).
        // dd($request->all()); // pega todos os dados (campos) do formulário.
        // dd($request->only("name", "email")); // pega apenas os campos "name" e "email" (OBS: ele pega mais de um campo).
        // dd($request->except("_token")); // pega todos os campos exceto "_token" (OBS: ele pega mais de um campo).
        // dd(User::create($request->all())); // persiste os dados do formulário no banco de dados.

        User::create($request->all());

        return redirect()
            ->route("users.index")
            ->with("success", "Usuário criado com sucesso!"); // ->with('chave', 'valor') - É uma informação temporária armazenada na sessão do usuário que só dura até a próxima requisição.
    }
}
