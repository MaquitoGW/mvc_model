<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário teste</title>
</head>
<body>
    <form action="<?= $response::route("recive") ?>" method="post" enctype="multipart/form-data">
        <label for="name">Nome:</label>
        <input type="text" name="name">
        <br>

        <input type="file" name="valor">

        <br>
        <br>
        <button>Enviar</button>
    </form>
</body>
</html>