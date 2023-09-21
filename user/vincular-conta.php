<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vincular conta</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <main>
        <h2>Vincular conta:</h2>
        <hr>
        <form action="../scripts/s_vincular-conta.php" method="post">
            <div class="mb-3">
            <?php if (isset($_SESSION['alert-contavinculada'])) { ?><p><?php echo $_SESSION['alert-contavinculada']; unset($_SESSION['alert-contavinculada']); } ?></p>
                <label class="form-label">Código de anúncio:</label>
                <input type="text" class="form-control" name="codigoanuncio">
                <div class="form-text">Informe o MLB do anúncio para vincular sua conta.</div>
            </div>
            <button type="submit" class="btn btn-primary">Vincular</button>
        </form>
    </main>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</html>