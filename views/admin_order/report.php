<?php

require_once( "fpdf/fpdf.php" );
$textColour = array(0, 0, 0);
$headerColour = array(100, 100, 100);
$tableHeaderTopTextColour = array(255, 255, 255);
$tableHeaderTopFillColour = array(125, 152, 179);
$tableHeaderTopProductTextColour = array(0, 0, 0);
$tableHeaderTopProductFillColour = array(143, 173, 204);
$tableHeaderLeftTextColour = array(99, 42, 57);
$tableHeaderLeftFillColour = array(184, 207, 229);
$tableBorderColour = array(50, 50, 50);
$tableRowFillColour = array(213, 170, 170);
$reportName = "Sales Report";
$reportNameYPos = 160;
$logoFile = ROOT . "/fpdf/logo.png";
$logoXPos = 50;
$logoYPos = 108;
$logoWidth = 110;
$columnLabels = array("ID order", "User", "Date", "Price");
$chartXPos = 20;
$chartYPos = 250;
$chartWidth = 160;
$chartHeight = 80;
$chartXLabel = "Product";
$chartYLabel = "2009 Sales";
$chartYStep = 20000;

$chartColours = array(
array(255, 100, 100),
 array(100, 255, 100),
 array(100, 100, 255),
 array(255, 255, 100),
);

$data = array(
array(9940, 10100, 9490, 11730),
 array(19310, 21140, 20560, 22590),
 array(25110, 26260, 25210, 28370),
 array(27650, 24550, 30040, 31980),
);
/**
  Создаем титульную страницу
 * */
$pdf = new FPDF('P', 'mm', 'A4');
$pdf->SetTextColor($textColour[0], $textColour[1], $textColour[2]);
$pdf->AddPage();

// Логотип
$pdf->Image($logoFile, $logoXPos, $logoYPos, $logoWidth);

// Название отчета
$pdf->SetFont('Arial', 'B', 24);
$pdf->Ln($reportNameYPos);
$pdf->Cell(0, 15, $reportName, 0, 0, 'C');

/**
  Создаем колонтитул, заголовок и вводный текст
 * */
$pdf->AddPage();
$pdf->SetTextColor($headerColour[0], $headerColour[1], $headerColour[2]);
$pdf->SetFont('Arial', '', 17);
$pdf->Cell(0, 15, $reportName, 0, 0, 'C');
$pdf->SetTextColor($textColour[0], $textColour[1], $textColour[2]);


/**
  Создаем таблицу
 * */
$pdf->SetDrawColor($tableBorderColour[0], $tableBorderColour[1], $tableBorderColour[2]);
$pdf->Ln(15);

// Создаем строку заголовков
$pdf->SetFont('Arial', 'B', 15);

// Остальные ячейки заголовков
$pdf->SetTextColor($tableHeaderTopTextColour[0], $tableHeaderTopTextColour[1], $tableHeaderTopTextColour[2]);
$pdf->SetFillColor($tableHeaderTopFillColour[0], $tableHeaderTopFillColour[1], $tableHeaderTopFillColour[2]);

for ($i = 0;
$i < count($columnLabels);
$i++) {
$pdf->Cell(36, 12, $columnLabels[$i], 1, 0, 'C', true);
}

$pdf->Ln(12);

// Создаем строки с данными

$fill = false;
$row = 0;
$ordersList = getOrdersList();
foreach ($ordersList as $order) {
// Create the data cells
$pdf->SetTextColor($textColour[0], $textColour[1], $textColour[2]);
$pdf->SetFillColor($tableRowFillColour[0], $tableRowFillColour[1], $tableRowFillColour[2]);
$pdf->SetFont('Arial', '', 15);
$pdf->Cell(36, 12, $order['id'], 1, 0, 'C', $fill);
$pdf->Cell(36, 12, $order['user_name'], 1, 0, 'C', $fill);
$pdf->Cell(36, 12, $order['user_phone'], 1, 0, 'C', $fill);
$pdf->Cell(36, 12, $order['date'], 1, 0, 'C', $fill);
$pdf->Cell(36, 12, $order['status'], 1, 0, 'C', $fill);


$row++;
$fill = !$fill;
$pdf->Ln(12);
}

/* * *
  Выводим PDF
 * * */

$pdf->Output("report.pdf", "I");
