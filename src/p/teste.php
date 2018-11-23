<?php

require __DIR__ . '/../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet; //classe responsável pela manipulação da planilha

use PhpOffice\PhpSpreadsheet\Writer\Xlsx; //classe que salvará a planilha em .xlsx


$spreadsheet = new Spreadsheet(); //instanciando uma nova planilha

$sheet = $spreadsheet->getActiveSheet(); //retornando a aba ativa

$sheet->setCellValue('A1', 'Nome'); //Definindo a célula A1

$sheet->setCellValue('B1', 'Nota 1'); //Definindo a célula B1

$sheet->setCellValue('C1', 'Nota 2');

$sheet->setCellValue('D1', 'Media');

$sheet->setCellValue('A2', 'pokemaobr');

$sheet->setCellValue('B2', 5);

$sheet->setCellValue('C2', 3.5);

$sheet->setCellValue('D2', '=((B2+C2)/2)'); //Definindo a fórmula para o cálculo da média

$sheet->setCellValue('A3', 'bob');

$sheet->setCellValue('B3', 7);

$sheet->setCellValue('C3', 8);

$sheet->setCellValue('D3', '=((B3+C3)/2)');

$sheet->setCellValue('A4', 'boina');

$sheet->setCellValue('B4', 9);

$sheet->setCellValue('C4', 9);

$sheet->setCellValue('D4', '=((B4+C4)/2)');


$writer = new Xlsx($spreadsheet); //Instanciando uma nova planilha

$filename = 'tabela'.'.xlsx';

$writer->save("../download/$filename"); //salvando a planilha na extensão definida

$file_location = 'http://localhost:81/portal/src/download/'. $filename;

?>

<input type="button" value="Put Your Text Here" onclick="window.location.href='<?=$file_location?>'" />
