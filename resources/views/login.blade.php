<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Usuário</title>
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>
<body>
    <div class="container">
        
        <div class="card">
            <div class="card-header">
                <h2>Login de Usuário</h2>
            </div>
            <div class="card-content">
                <form class="form" action="{{route("login")}}" method="POST">
                  @csrf
                    <div class="form-group">
                        <label for="login-nome">Nome de Usuário</label>
                        <input type="text" id="login-nome" name="username" >
                        @error("username")
                        <small style="color:red">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="login-senha">Senha</label>
                        <input type="password" id="login-senha" name="password" >
                        @error("password")
                        <small style="color:red">{{$message}}</small>
                        @enderror
                    </div>
                    @if(session("invalid_login"))
                      <p style="color: red">Login Inválido</p>
                    @endif
                    <a href="{{route("view_registro")}}">Não tenho uma conta</a>
                    <button type="submit" class="btn">Entrar</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

