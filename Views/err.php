<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $message ?> - <?= $code ?></title>
    <style>
        :root {
            --primaria: #0366d6;
            --background: #0f1114;
            --backgroundCL: #161b22;
            --cinzaFFF: #cfcfcf;
            --other: #2f363d;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: var(--background);
            color: var(--other);
            display: flex;
            justify-content: center;
            height: 100vh;
            flex-wrap: wrap;
            align-content: center;
        }

        .error-message {
            font-size: 1.5rem;
            margin: 20px 0;
        }

        footer {
            font-size: 0.9rem;
            width: 100%;
            text-align: center;
        }

        footer a {
            color: #0366d6;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <p class="error-message"><?= $code ?> | <?= $message ?></p>
    <footer>&copy; <?= date("Y") ?> MVC Model por <a href="https://github.com/maquitogw">MaquitoGW</a></footer>
</body>

</html>
<?php
exit;
?>