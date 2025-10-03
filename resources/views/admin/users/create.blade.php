@extends('admin.layouts.app')
@section('title', 'Criar Novo Usuário')

@section('content')
<h1>Novo Usuário</h1>

<!-- Formas de renderizar o componente: -->
{{-- @include('admin.includes.errors') --}}
<x-alert />

<form action="{{ route('users.store') }}" method="post">
    <!-- @csrf() -> token para validação de sessão -->
    <!-- <input type="hidden" name="_token" value={{ csrf_token() }}> -> mesma coisa que "@csrf()" -->
    @csrf()
    <!-- {{ old('nome_campo') }} - cria uma sessão com os valores do formulário antes de fazer o submit, podendo reutilizar esses valores mesmo depois do submit -->
    <input type="text" name="name" placeholder="Nome" value="{{ old('name') }}">
    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
    <input type="password" name="password" placeholder="Senha">
    <button type="submit">Enviar</button>
</form>
@endsection