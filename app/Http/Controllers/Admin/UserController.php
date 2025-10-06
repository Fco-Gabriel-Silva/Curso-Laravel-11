<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        // $users = User::all(); (ou User::get();) // retorna todos os usuários cadastrados.
        // $users = User::first(); // retorna o primeiro usuário cadastrado.
        $users = User::paginate(20); // retornar todos os usuários, porém separados por paginação.
        //dd($users); //dd() - dump and die: é tipo um "console.log" só que do Laravel..

        return view("admin.users.index", compact("users")); // compact() - cria um array associativo. Ex: return view("admin.users.index", ["users" => $users]);
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
        // dd($request->validated()); // Pega apenas os campos que passaram pela validação *MAIS SEGURO*

        User::create($request->validated());

        return redirect()
            ->route("users.index")
            ->with("success", "Usuário criado com sucesso!"); // ->with('chave', 'valor') - É uma informação temporária armazenada na sessão do usuário que só dura até a próxima requisição.
    }

    public function edit(string $id)
    {
        // Formas de recuperar o usuário no bando de dados pelo id:
        // $user = User::where('id', "=", $id)->first(); // ->get() - retorna uma colletion; ->first() - retorna o primeiro ou NULL;
        // $user = User::where('id', $id)->first(); // No contexto de APi, usa-se ->firstOrFail(), que retorna o primeiro registro ou retorna o erro 404; Se não passar o critério de comparação, ele já entende que é o "=";
        if (!$user = User::find($id)) {
            return redirect()->route('users.index')->with('message', "Usuário não encontrado");
        }

        return view('admin.users.edit', compact("user"));
    }

    public function update(UpdateUserRequest $request, string $id)
    {
        if (!$user = User::find($id)) {
            return back()->with('message', "Usuário não encontrado");
        }

        $data = $request->only('name', 'email');

        if ($request->password) {
            $data['password'] = bcrypt($request->password); //bcrypt() - Salva a senha criptografada com hash seguro
        }

        $user->update($data);

        return redirect()
            ->route("users.index")
            ->with("success", "Usuário criado com sucesso!");
    }

    public function show(string $id)
    {
        if (!$user = User::find($id)) {
            return redirect()->route('users.index')->with('message', 'Usuário não encontrado');
        }

        return view("admin.users.show", compact('user'));
    }

    public function destroy(string $id)
    {
        if (!$user = User::find($id)) {
            return redirect()->route('users.index')->with('message', 'Usuário não encontrado');
        }
        if (Auth::user()->id === $user->id) { // Também pode ser: auth()->user()->id;
            return back()->with("message", "Você não pode deletar o seu próprio perfil");
        }
        $user->delete();

        return redirect()
            ->route("users.index")
            ->with("success", "Usuário deletado com sucesso!");
    }
}
