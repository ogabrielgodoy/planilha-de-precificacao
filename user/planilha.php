

<?php
session_start();
require_once('../functions/f_apiItemsSearchSeller.php');
require_once('../functions/f_apiItems.php');
require_once('filtro_promotion_data.php');
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Defina os cabeçalhos corretamente
$sheet->setCellValue('A1', 'Ordem');
$sheet->setCellValue('B1', 'ID');
$sheet->setCellValue('C1', 'Titulo');
$sheet->setCellValue('D1', 'Canal');
$sheet->setCellValue('E1', 'Preço de venda');
$sheet->setCellValue('F1', 'Preço promocional');
$sheet->setCellValue('G1', 'Data de termino da promoção');
$sheet->setCellValue('H1', 'Taxa fixa');
$sheet->setCellValue('I1', 'Comissão');
$sheet->setCellValue('J1', 'Imposto');
$sheet->setCellValue('K1', 'Frete');
$sheet->setCellValue('L1', 'Repasse');
$sheet->setCellValue('M1', 'Marg. Contribuição');
$sheet->setCellValue('N1', '% de lucro');
//$sheet->setCellValue('M1', 'Saúde do anúncio');

$row = 2;

$IDSITE = 'MLB';
$IDUSER = '1128872761';
$response = getAdsAccount($IDSITE, $IDUSER);

//Paginacao
$total = $response['paging']['total']; // Total de resultados
$limit = 50; // Limite de dados por vez
$offset = 0; // Deslocamento inicial

while ($offset < $total){
foreach ($response['results'] as $res) {
    $sheet->setCellValue('A' . $row, $res['order_backend']);
    $sheet->setCellValue('B' . $row, $res['id']);
    $sheet->setCellValue('C' . $row, $res['title']);

    // Canal de venda
    $apiItems = getItems($res['id']);
    $meli = false;
    $melishops = false;
    foreach ($apiItems['channels'] as $canal) {
        if ($canal == 'marketplace') {
            $meli = true;
        }
        if ($canal == 'mshops') {
            $melishops = true;
        }
    }
    if($meli && $melishops){
        $canalresult = 'Mercado Livre e Mercado Shops';
    }elseif($meli){
        $canalresult = 'Mercado Livre';
    }elseif($melishops){
        $canalresult = 'Mercado Shops';
    }
    $sheet->setCellValue('D' . $row, $canalresult);
    // Fim canal de venda

    $sheet->setCellValue('E' . $row, $res['original_price']);
    $sheet->setCellValue('F' . $row, $res['price']);

    // $promo = filtroPromotionData($_SESSION['user']['access_token'],$res['id']);
    // $sheet->setCellValue('G' . $row, $promo);
    $sheet->setCellValue('G' . $row, '');

    $sheet->setCellValue('H' . $row, "");
    $sheet->setCellValue('I' . $row, "");
    $sheet->setCellValue('J' . $row, "");
    $sheet->setCellValue('K' . $row, "");
    $sheet->setCellValue('L' . $row, "");
    $sheet->setCellValue('M' . $row, "");
    $sheet->setCellValue('N' . $row, "");
    //$sheet->setCellValue('N' . $row, $res['health']);
    // Preencha as outras células aqui conforme necessário
    $row++;
    }
    $offset += $limit; // Aumenta o deslocamento para a próxima página de resultados
   // sleep(60); // Espera 60 segundos antes da próxima leitura da página
}
$writer = new Xlsx($spreadsheet);
$filename = 'table.xlsx';
$writer->save('export/'.$filename);

$_SESSION['alert'] = 'Planilha gerada com sucesso!';
header('location:dashboard.php');
?>
