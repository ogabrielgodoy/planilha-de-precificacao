<?php
session_start();
require_once('../functions/f_apiItemsSearchSeller.php');
require_once('../functions/f_apiItems.php');
require_once('../functions/f_apiSellerPromotions.php');
require_once('../functions/f_convertDateFormat.php');

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.3/xlsx.full.min.js"></script> -->
    <title>Planilha</title>
</head>

<body>

    <table border="1px" id="planilha">
        <tr>
            <th><b>Ordem</b></th>
            <th><b>ID</b></th>
            <th><b>Nome</b></th>
            <th><b>Canal</b></th>
            <th><b>Preço de venda</b></th>
            <th><b>Preço promocional</b></th>
            <th><b>Data de termino da promoção</b></th>
            <th><b>Taxa fixa</b></th>
            <th><b>Comissão</b></th>
            <th><b>Imposto</b></th>
            <th><b>Frete</b></th>
            <th><b>Repasse</b></th>
            <th><b>Marg. Contribuição</b></th>
            <th><b>% de lucro</b></th>
        </tr>
        <?php
        $IDSITE = 'MLB';
        $IDUSER = '1128872761';
        $response = getAdsAccount($IDSITE, $IDUSER);
        $total = $response['paging']['total']; // Total de resultados
        $limit = 50; // Limite de dados por vez
        $offset = 0; // Deslocamento inicial

        while ($offset < $total) {
            foreach ($response['results'] as $res) {
                // Variaveis
                $id = $res['id'];
                $canais = getItems($id);
                $promo = apiSellerPromotions($_SESSION['user']['access_token'], $id);
                $promo = json_decode($promo);
        ?>

                <tr>
                    <td><?php echo $res["order_backend"]; ?></td>
                    <td><a href="<?php echo $res['permalink']; ?>" target="_blank"><?php echo $res['id']; ?></a></td>
                    <td><?php echo $res["title"]; ?></td>
                    <td>
                        <?php

                        foreach ($canais['channels'] as $canal) {

                            if ($canal == 'marketplace') {
                                echo 'Mercado Livre' . "<br>"; // Adicione um <br> para cada valor
                            }

                            if ($canal == 'mshops') {
                                echo 'Mercado Shops' . "<br>"; // Adicione um <br> para cada valor
                            }
                            //$html .= $canal . "<br>"; // Adicione um <br> para cada valor
                        }
                        ?>
                    <td>R$<?php echo $res["original_price"]; ?></td>
                    <td> <?php echo "R$" . $res['price']; ?> </td>
                    <td>
                        <?php

                        foreach ($promo as $promotion) {
                            if (isset($promotion->finish_date)) {
                                echo "<b>Campanha:</b> " . $promotion->name . "<br>";
                                echo "<b>Termina em:</b> " . convertDateFormat($promotion->finish_date) . "<br>";
                            }
                        }
                        ?>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
        <?php
            }
            $offset += $limit; // Aumenta o deslocamento para a próxima página de resultados
        }
        ?>
    </table>

</body>

<button onclick="exportToExcel()">Exportar para Excel</button>

<script>
function exportToExcel() {
  const tabela = document.getElementById('tabela');
  const planilha = XLSX.utils.table_to_sheet(tabela);
  const nomeDoArquivo = 'dados.xlsx';

  const livro = XLSX.utils.book_new();
  XLSX.utils.book_append_sheet(livro, planilha, 'Dados');

  // Cria um objeto Blob com a planilha em formato de ArrayBuffer
  const blob = XLSX.write(livro, { bookType: 'xlsx', type: 'array' });

  // Converte o ArrayBuffer em Blob
  const blobData = new Blob([blob], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });

  // Cria um link para download
  const url = URL.createObjectURL(blobData);

  const a = document.createElement('a');
  a.href = url;
  a.download = nomeDoArquivo;
  a.style.display = 'none';
  document.body.appendChild(a);
  a.click();

  // Limpa o objeto URL após o download
  URL.revokeObjectURL(url);
}
</script>


</html>