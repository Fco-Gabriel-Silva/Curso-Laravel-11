@extends('admin.layouts.app')
@section('title', 'Criar Novo Usuário')

@section('content')
<h1>Novo Usuário</h1>

<form action="{{ route('users.store') }}" method="post">
    <!-- @csrf() -> token para validação de sessão -->
    <!-- <input type="hidden" name="_token" value={{ csrf_token() }}> -> mesma coisa que "@csrf()" -->
    @csrf()
    <input type="text" name="name" placeholder="Nome">
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Senha">
    <button type="submit">Enviar</button>
</form>
@endsection