<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários</title>
</head>
<body>
    <table>
        <tr>
            <th></th>
            <th>Id:</th>
            <th>Nome:</th>
            <th>Email:</th>
        </tr>
        <?php foreach($model->rows as $row): ?>
        <tr>
            <td>
                <a href="/user/delete?id=<?= $row->id ?>">X</a>
            </td>

            <td><?= $row->id ?></td>

            <td>
                <a href="/user/form?id=<?= $row->id ?>"><?= $row->name ?></a>
            </td>

            <td><?= $row->email ?></td>
        </tr>
        <?php endforeach ?>
        <?php if(count($model->rows) == 0): ?>
            <tr colspan="3">
                <td>
                    Nenhum registro encontrado.
                </td>
            </tr>
            <tr colspan="1">
                <td>
                <a href="/user/form">Novo Registro</a>
                </td>
            </tr>
        <?php endif ?>
    </table>
</body>
</html>