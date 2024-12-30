<?php
use Illuminate\Support\Facades\Crypt;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Clientes</title>
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>
<body>
  <div class="top-bar">
    <div class="user-info">
        <p>Usuário logado: <span id="nome-usuario">João Silva</span></p>
    </div>
    <a id="btn-logout" class="btn btn-logout" href="{{route("logout")}}">Logout</a>
  </div>
        <div class="card">
            <div class="card-header">
                <h2>Cadastro de Clientes</h2>
            </div>
            <div class="card-content">
                <form class="form" method="POST" action="{{route("create_project")}}">

                  @csrf

                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" id="nome" name="name" >
                        @error("name")
                        <small style="color:red">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="idade">Idade</label>
                        <input type="text" id="idade" name="age" >
                        @error("age")
                        <small style="color:red">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email" >
                        @error("email")
                        <small style="color:red">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="cpf">CPF</label>
                        <input type="text" id="cpf" name="cpf" >
                        @error("cpf")
                        <small style="color:red">{{$message}}</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn">Cadastrar</button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2>Clientes Cadastrados</h2>
            </div>

          
          @foreach($clientes as $cliente)
          @if($cliente->user_id === Auth::user()->id)
            <div class="card-content">
                <ul class="user-list">

                    <li class="user-item">
                        <p><strong>Nome:</strong> {{$cliente->name}}</p>
                        <p><strong>Idade:</strong> {{$cliente->age}}</p>
                        <p><strong>Email:</strong> {{$cliente->email}}</p>
                        <p><strong>CPF:</strong> {{$cliente->cpf}}</p>
                    </li>

                    <form action="{{route("delete_cliente")}}" method="POST">
                      @csrf
                      <input type="hidden" name="cliente_id" value="{{Crypt::encrypt($cliente->id)}}" ">
                      <button>Deletar</button>
                    </form>
                
                </ul>
            </div>
          @endif  
          @endforeach
        </div>
    </div>
</body>
</html>

