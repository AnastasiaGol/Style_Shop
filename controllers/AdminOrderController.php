<?php

/**
 * Контроллер AdminOrderController
 * Управление заказами в админпанели
 */
class AdminOrderController extends AdminBase {

    /**
     * Action для страницы "Управление заказами"
     */
    public function actionIndex() {
// Проверка доступа
        self::checkAdmin();

// Получаем список заказов
        $ordersList = Order::getOrdersList();

// Подключаем вид
        require_once(ROOT . '/views/admin_order/index.php');
        return true;
    }

    /**
     * Action для страницы "Редактирование заказа"
     */
    public function actionUpdate($id) {
// Проверка доступа
        self::checkAdmin();

// Получаем данные о конкретном заказе
        $order = Order::getOrderById($id);

// Обработка формы
        if (isset($_POST['submit'])) {
// Если форма отправлена   
// Получаем данные из формы
            $userName = $_POST['userName'];
            $userPhone = $_POST['userPhone'];
            $userComment = $_POST['userComment'];
            $date = $_POST['date'];
            $status = $_POST['status'];

// Сохраняем изменения
            Order::updateOrderById($id, $userName, $userPhone, $userComment, $date, $status);

// Перенаправляем пользователя на страницу управлениями заказами
            header("Location: /admin/order/view/$id");
        }

// Подключаем вид
        require_once(ROOT . '/views/admin_order/update.php');
        return true;
    }

    /**
     * Action для страницы "Просмотр заказа"
     */
    public function actionView($id) {
// Проверка доступа
        self::checkAdmin();

// Получаем данные о конкретном заказе
        $order = Order::getOrderById($id);

// Получаем массив с идентификаторами и количеством товаров
        $productsQuantity = json_decode($order['products'], true);

// Получаем массив с индентификаторами товаров
        $productsIds = array_keys($productsQuantity);

// Получаем список товаров в заказе
        $products = Product::getProdustsByIds($productsIds);

// Подключаем вид
        require_once(ROOT . '/views/admin_order/view.php');
        return true;
    }

    /**
     * Action для страницы "Удалить заказ"
     */
    public function actionDelete($id) {
// Проверка доступа
        self::checkAdmin();

// Обработка формы
        if (isset($_POST['submit'])) {
// Если форма отправлена
// Удаляем заказ
            Order::deleteOrderById($id);

// Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin/order");
        }

// Подключаем вид
        require_once(ROOT . '/views/admin_order/delete.php');
        return true;
    }

    /**
     * Action для страницы "Печать отчета"
     */
    public function actionReport() {
// Проверка доступа
        self::checkAdmin();

        // Название отчета
require(ROOT . '/fpdf/font/tfpdf.php');

$pdf = new tFPDF();
$pdf->AddPage();

// Add a Unicode font (uses UTF-8)
$pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
$pdf->SetFont('DejaVu','',14);

// Load a UTF-8 string from a file and print it
$txt = file_get_contents('HelloWorld.txt');
$pdf->Write(8,$txt);

// Select a standard font (uses windows-1252)
$pdf->SetFont('Arial','',14);
$pdf->Ln(10);
$pdf->Write(5,'The file size of this PDF is only 12 KB.');

$pdf->Output();
////require_once(ROOT . '/views/admin_order/report.php');
//        require_once( "fpdf/fpdf.php" );
//        $textColour = array(0, 0, 0);
//        $headerColour = array(100, 100, 100);
//        $tableHeaderTopTextColour = array(255, 255, 255);
//        $tableHeaderTopFillColour = array(125, 152, 179);
//        $tableHeaderTopProductTextColour = array(0, 0, 0);
//        $tableHeaderTopProductFillColour = array(143, 173, 204);
//        $tableHeaderLeftTextColour = array(99, 42, 57);
//        $tableHeaderLeftFillColour = array(184, 207, 229);
//        $tableBorderColour = array(50, 50, 50);
//        $tableRowFillColour = array(213, 170, 170);
//        $reportName = "Отчет по продажам";
//        $reportNameYPos = 160;
//        $logoFile = ROOT . "/fpdf/logo.png";
//        $logoXPos = 50;
//        $logoYPos = 108;
//        $logoWidth = 110;
//        $columnLabels = array("ID order", "User", "Phone", "Date", "Status");
//        $chartXPos = 20;
//        $chartYPos = 250;
//        $chartWidth = 160;
//        $chartHeight = 80;
//        $chartXLabel = "Product";
//        $chartYLabel = "2009 Sales";
//        $chartYStep = 20000;
//
//        $chartColours = array(
//            array(255, 100, 100),
//            array(100, 255, 100),
//            array(100, 100, 255),
//            array(255, 255, 100),
//        );
//
//        $data = array(
//            array(9940, 10100, 9490, 11730),
//            array(19310, 21140, 20560, 22590),
//            array(25110, 26260, 25210, 28370),
//            array(27650, 24550, 30040, 31980),
//        );
//        /**
//          Создаем титульную страницу
//         * */
//        $pdf->SetTextColor($textColour[0], $textColour[1], $textColour[2]);
//        $pdf->AddPage();
//        
//      
//// Логотип
//        $pdf->Image($logoFile, $logoXPos, $logoYPos, $logoWidth);
//        $pdf->Ln($reportNameYPos);
//        $pdf->Cell(0, 15, $reportName, 0, 0, 'C');
////
///**
//  Создаем колонтитул, заголовок и вводный текст
// * */
//$pdf->AddPage();
//$pdf->SetTextColor($headerColour[0], $headerColour[1], $headerColour[2]);
//$pdf->SetFont('Arial', '', 17);
//$pdf->Cell(0, 15, $reportName, 0, 0, 'C');
//$pdf->SetTextColor($textColour[0], $textColour[1], $textColour[2]);
//
//
///**
//  Создаем таблицу
// * */
//$pdf->SetDrawColor($tableBorderColour[0], $tableBorderColour[1], $tableBorderColour[2]);
//$pdf->Ln(15);
//
//// Создаем строку заголовков
//$pdf->SetFont('Arial', 'B', 15);
//
//// Остальные ячейки заголовков
//$pdf->SetTextColor($tableHeaderTopTextColour[0], $tableHeaderTopTextColour[1], $tableHeaderTopTextColour[2]);
//$pdf->SetFillColor($tableHeaderTopFillColour[0], $tableHeaderTopFillColour[1], $tableHeaderTopFillColour[2]);
//$pdf->Cell(36, 12, $columnLabels[0], 1, 0, 'C', true);
//$pdf->Cell(36, 12, $columnLabels[1], 1, 0, 'C', true);
//$pdf->Cell(36, 12, $columnLabels[2], 1, 0, 'C', true);
//$pdf->Cell(36, 12, $columnLabels[3], 1, 0, 'C', true);
//$pdf->Cell(36, 12, $columnLabels[4], 1, 0, 'C', true);
//$pdf->Cell(36, 12, $columnLabels[5], 1, 0, 'C', true);
//
//
//$pdf->Ln(12);
//
//// Создаем строки с данными
//
//$fill = false;
//$row = 0;
//$ordersList = Order::getOrdersList();
//foreach ($ordersList as $order) {
//// Create the data cells
//$pdf->SetTextColor($textColour[0], $textColour[1], $textColour[2]);
//$pdf->SetFillColor($tableRowFillColour[0], $tableRowFillColour[1], $tableRowFillColour[2]);
//$pdf->SetFont('Arial', '', 15);
//$pdf->Cell(15, 12, $order['id'], 1, 0, 'C', $fill);
//$pdf->Cell(36, 12, $order['user_name'], 1, 0, 'C', $fill);
//$pdf->Cell(40, 12, $order['user_phone'], 1, 0, 'C', $fill);
//$pdf->Cell(40, 12, $order['date'], 1, 0, 'C', $fill);
//$pdf->Cell(10, 12, $order['status'], 1, 0, 'C', $fill);
//
//
//$row++;
//$fill = !$fill;
//$pdf->Ln(12);
//}

        /*         * *
          Выводим PDF
         * * */

        $pdf->Output("report.pdf", "I");
    }

}
