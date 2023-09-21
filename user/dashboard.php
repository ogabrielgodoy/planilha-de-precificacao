<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

    <?php
    //Autenticação no Mercado Livre
    session_start();
    // require_once('../functions/f_apiSellerPromotions.php');
    // echo 'seu acesso USER ID é: ' . $_SESSION['user']['user_id'];
    // 
    ?>

    <main>
        <h1>Bem vindo!</h1>
        <hr>

        <?php if (isset($_SESSION['alert'])) { ?><p><?php echo $_SESSION['alert']; unset($_SESSION['alert']); ?></p><?php } ?>

        <h2>Opções:</h2>
        <nav>
            <a href="planilha.php"><button onclick="notificacao()">Gerar planilha de precificação</button></a>
        </nav>
    </main>

    <script>
        // Exibe a notificação
        function notificacao() {
            alert('Clique em "OK" para CONFIRMAR a criação da sua planilha.')
        }
    </script>


</body>

</html>