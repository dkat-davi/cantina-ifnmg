<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
</head>

<body>
    
    <main>
        <form method="get">
            <fieldset>
                <legend>Novo Usuário</legend>
                <label for="nome">Nome:</label>
                <input type="text"  id="nome"> <br>
                <label for="email">E-mail:</label>
                <input type="text"  id="email"> <br>
                <label for="senha">Senha:</label>
                <input type="password"  id="senha"> <br>
                <label for="nascimento">Data de Nascimeto:</label>
                <input type="date"  id="nascimento"> <br>
                <label for="usuario">Tipo de usuário</label>
                <select name="usuario" id="usuario">
                    <option value="caixa">Caixa</option>
                    <option value="cliente">Cliente</option>
                    <option value="gerente">Gerente</option>
                </select>
                <button type="submit">Cadastrar</button>
            </fieldset>
        </form>
    </main>
</body>

</html>