<?php

require_once('./htmltopdf/WkHtmlToPdf.php');

$options = array(
//    'binPath' => 'D:/wkhtmltopdf/bin/wkhtmltopdf',
    'binPath' => "/opt/wkhtmltox/bin/wkhtmltopdf",
    'binName' => 'wkhtmltopdf',
    'tmp' => "./tmp"
);

if (isset($_REQUEST['url']) && $_REQUEST['url'] !== '') {
    $url = $_REQUEST['url'];
    $zohoId = $_REQUEST['zoho_id'];
    $fileName = $zohoId . time() . ".pdf";
    $pdf = new WkHtmlToPdf($options);
    $pdf->addPage($url);
    $pdf->saveAs("./static/$fileName");

    $return = array(
        'url' => $_SERVER['HTTP_HOST'] . str_replace("index.php", "", $_SERVER['PHP_SELF']) . 'static/' . $fileName
    );
    echo json_encode($return);
}