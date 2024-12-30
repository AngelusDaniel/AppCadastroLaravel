<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Cadastro de Usuário</h2>
            </div>
            <div class="card-content" >
                <form class="form" action="{{route("registro")}}" method="POST">
                  @csrf  
                  <div class="form-group">
                        <label for="cadastro-nome">Nome de Usuário</label>
                        <input type="text" id="cadastro-nome" name="username">
                        @error("username")
                        <small style="color:red">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="cadastro-email">Email</label>
                        <input type="email" id="cadastro-email" name="email" >
                        @error("email")
                        <small style="color:red">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="cadastro-senha">Senha</label>
                        <input type="password" id="cadastro-senha" name="password">
                        @error("password")
                        <small style="color:red">{{$message}}</small>
                        @enderror
                    </div>
                    <a href="{{route("view_login")}}">Já tenho uma conta</a>
                    <button type="submit" class="btn">Cadastrar</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
