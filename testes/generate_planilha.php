<?php
session_start();
require_once('../functions/f_apiItemsSearchSeller.php');
require_once('../functions/f_apiItems.php');
require_once('../functions/f_apiSellerPromotions.php');
require_once('../functions/f_convertDateFormat.php');

$IDSITE = 'MLB';
$IDUSER = '1128872761';

$response = getAdsAccount($IDSITE, $IDUSER);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8">
	<title>Plan API</title>

	<head>

	<body>
		<?php
		// Definimos o nome do arquivo que será exportado
		$arquivo = 'teste.xls';
		// Criamos uma tabela HTML com o formato da planilha
		$html = '';
		$html .= '<table border="1">';
		$html .= '<tr>';
		$html .= '<td colspan="5">Planilha Teste</td>';
		$html .= '</tr>';

		$html .= '<tr>';
		$html .= '<td><b>Ordem</b></td>';
		$html .= '<td><b>ID</b></td>';
		$html .= '<td><b>Nome</b></td>';
		$html .= '<td><b>Canal</b></td>';
		$html .= '<td><b>Preço de venda</b></td>';
		$html .= '<td><b>Preço promocional</b></td>';
		$html .= '<td><b>Data de termino da promoção</b></td>';
		$html .= '<td><b>Taxa fixa</b></td>';
		$html .= '<td><b>Comissão</b></td>';
		$html .= '<td><b>Imposto</b></td>';
		$html .= '<td><b>Frete</b></td>';
		$html .= '<td><b>Repasse</b></td>';
		$html .= '<td><b>Marg. Contribuição</b></td>';
		$html .= '<td><b>% de lucro</b></td>';
		$html .= '</tr>';
		?>
		<?php

		foreach ($response['results'] as $res) {
			// Variaveis
			$id = $res['id'];

			// Modulo canais:
			$canais = getItems($id);

			$promo = apiSellerPromotions($_SESSION['user']['access_token'], $id);
			$promo = json_decode($promo);
			
			?>

			<?php
			$html .= "<tr>";
			$html .= "<td>" . $res["order_backend"] . "</td>";
			$html .= "<td> <a href=" . $res['permalink'] . ">" . $id . "</a></td>";
			$html .= "<td>" . $res["title"] . "</td>";

			//Acessa os canais de venda
			$html .= "<td>";
			foreach ($canais['channels'] as $canal) {

				if ($canal == 'marketplace') {
					$html .= 'Mercado Livre' . "<br>"; // Adicione um <br> para cada valor
				}

				if ($canal == 'mshops') {
					$html .= 'Mercado Shops' . "<br>"; // Adicione um <br> para cada valor
				}
				//$html .= $canal . "<br>"; // Adicione um <br> para cada valor
			}
			$html .= "</td>";

			$html .= "<td>" . $res["price"] . "</td>";
			$html .= "<td></td>";

			$html .= "<td>";

			foreach ($promo as $promotion) {
				if (isset($promotion->start_date) && isset($promotion->price) && isset($promotion->finish_date)) {
					"Nome da promoção: " . $promotion->name . "<br>";
					"Data de início da promoção: " . convertDateFormat($promotion->start_date) . "<br>";
					"Price: $" . $promotion->price . "<br>";
					"Data fim da promoção: " . convertDateFormat($promotion->finish_date) . "<br><br>";
				}
			}

			$html .= "</td>";
			$html .= "<td>" . "null" . "</td>";
			$html .= "<td>" . "null" . "</td>";
			$html .= "<td>" . "null" . "</td>";
			$html .= "<td>" . "null" . "</td>";
			$html .= "<td>" . "null" . "</td>";
			$html .= "<td>" . "null" . "</td>";
			$html .= "<td>" . "null" . "</td>";
			$html .= "</tr>";
			?>
		<?php } ?>

		<?php
		$html .= '</table>';
		// // Configurações header para forçar o download

		// header("Expires: Mon, 07 Jul 2016 05:00:00 GMT");
		// header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
		// header("Cache-Control: no-cache, must-revalidate");
		// header("Pragma: no-cache");
		// header("Content-type: application/x-msexcel");
		// header("Content-Disposition: attachment; filename=\"{$arquivo}\"");
		// header("Content-Description: PHP Generated Data");

		//Envia o conteúdo do arquivo
		echo $html;
		exit; ?>
	</body>

</html>