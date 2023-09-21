<?php
    session_start();
    
    if(!isset($_SESSION['contavinculada'])){
        header('location:vincular-conta.php');
        exit;
    }

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <?php
    //Autenticação no Mercado Livre
    // require_once('../functions/f_apiSellerPromotions.php');
    // echo 'seu acesso USER ID é: ' . $_SESSION['user']['user_id'];
    // 
    ?>

    <main>
        <h2>Opções:</h2>
        <hr>

        <?php if (isset($_SESSION['alert'])) { ?><p><?php echo $_SESSION['alert']; unset($_SESSION['alert']); ?></p>
           
           <div class="clicavel"><a href="export/table.xlsx" download>Download do Arquivo</a></div>

        <?php } ?>
        <?php if (isset($_SESSION['alert-contavinculada'])) { ?><p><?php echo $_SESSION['alert-contavinculada']; unset($_SESSION['alert-contavinculada']); } ?></p>
        <nav>
            <a href="planilha.php"><button onclick="notificacao()">Gerar planilha de precificação</button></a>
        </nav>
        <hr>
        <div class="clicavel"><a href="../scripts/s_desvincular_conta.php">Desvincular conta</a></div>
    </main>

    <script>
        // Exibe a notificação
        function notificacao() {
            alert('Clique em "OK" para CONFIRMAR a criação da sua planilha.')
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>