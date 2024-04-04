<?php
header('Content-Type: application/json');
include ("Parsial/connect.php");
$dataTableQuery = sprintf("SELECT nama_barang, SUM(quantity) AS Total from item_penjualan GROUP BY nama_barang");
$result = $koneksi->query($dataTableQuery);
$data = array();
foreach($result as $row) {
    $data[] = $row;
}
$result -> close();
$koneksi -> close();
print json_encode($data);
?>
