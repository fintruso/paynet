@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Usuários</h1>

    <form method="GET" action="{{ route('home') }}" class="mb-4">
        <div class="row g-2">
            <div class="col-md-4">
                <input type="text" name="name" class="form-control" placeholder="Filtrar por nome" value="{{ request('name') }}">
            </div>
            <div class="col-md-4">
                <input type="text" name="email" class="form-control" placeholder="Filtrar por email" value="{{ request('email') }}">
            </div>
            <div class="col-md-4">
                <button class="btn btn-primary">Filtrar</button>
                <a href="{{ route('home') }}" class="btn btn-secondary">Limpar</a>
            </div>
        </div>
    </form>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Perfil</th>
                <th>Data de Cadastro</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4">Nenhum usuário encontrado.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div>
        {{ $users->withQueryString()->links() }}
    </div>
</div>
@endsection
