<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Defina os cabeçalhos corretamente
$sheet->setCellValue('A1', 'Ordem');
$sheet->setCellValue('B1', 'ID');
$sheet->setCellValue('C1', 'Canal');
$sheet->setCellValue('D1', 'Preço de venda');
$sheet->setCellValue('E1', 'Preço promocional');
$sheet->setCellValue('F1', 'Data de termino da promoção');
$sheet->setCellValue('G1', 'Taxa fixa');
$sheet->setCellValue('H1', 'Comissão');
$sheet->setCellValue('I1', 'Imposto');
$sheet->setCellValue('J1', 'Frete');
$sheet->setCellValue('K1', 'Repasse');
$sheet->setCellValue('L1', 'Marg. Contribuição');
$sheet->setCellValue('M1', '% de lucro');

$data = [
    [1, 'MLB123456', 'Mercado Livre', 'R$100,00', 'R$90,00', '05/09/2023', 'R$10,00', 'null', 'null', 'null', 'null', 'null', 'null'],
    [2, 'MLB789012', 'Mercado Livre', 'R$120,00', 'R$110,00', '10/09/2023', 'R$12,00', 'null', 'null', 'null', 'null', 'null', 'null'],
    [3, 'MLB345678', 'Mercado Livre', 'R$90,00', 'R$80,00', '15/09/2023', 'R$9,00', 'null', 'null', 'null', 'null', 'null', 'null'],
];

$row = 2;
foreach ($data as $rowData) {
    $column = 'A';
    foreach ($rowData as $value) {
        $sheet->setCellValue($column . $row, $value);
        $column++;
    }
    $row++;
}

$writer = new Xlsx($spreadsheet);
$filename = 'table.xlsx';
$writer->save($filename);

echo 'Planilha gerada com sucesso!';
?>
