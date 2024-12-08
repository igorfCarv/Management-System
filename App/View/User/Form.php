<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
</head>
<body>
    <fieldset>
        <legend>Cadastro de Usuários</legend>
        <form method="post" action="/user/form/save">
            <input type="hidden" value="<?= $model->id ?>" name="id" />

            <label for="name">Nome:</label>
            <input type="text" name="name" value="<?= $model->name ?>" id="name" />

            <label for="email">Email:</label>
            <input type="text" name="email" value="<?= $model->email ?>" id="email" />

            <label for="password">Senha:</label>
            <input type="text" name="password" value="<?= $model->password ?>" id="password" />

            <button type="submit">Cadastrar</button>
        </form>
    </fieldset>
</body>
</html>