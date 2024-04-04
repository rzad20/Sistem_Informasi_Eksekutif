<?php include 'functions.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'Parsial/head.php';?>
</head>
<body>
    <?php include 'Parsial/header.php';?>
    <main>
        <?php include 'excsidebar.php';?>
        <article>
        <div class="container">
          <div class="row">
            <h2>Laporan Penjualan</h2>
            <hr>
          </div>
          <div class="row d-flex flex-row">
            <div class="col-lg-4 d-flex flex-row gap-2 align-items-center">
              <label for="filter_tanggal" class="col-form-label">Pilih Tanggal</label>
              <input type="text" id="filter_tanggal2" name ="filter_tanggal" class="drilldown-form-control" required>
          </div>
            <!-- <div class="col-lg-4 d-flex flex-row gap-2 align-items-center">
              <label for="bulan_selector_drilldown" class="col-form-label">Pilih Bulan</label>
              <select id="bulan_selector_drilldown" class="drilldown-form-control">
                <option value="Pilih Bulan">Pilih Bulan</option>
              </select>
          </div> -->
          <div class="row chart-wrapper">
            <canvas id="omsetChart"></canvas>
          </div>
          <div class="row mx-3"> 
          <table class="table ta   ble-striped table-hover table-bordered dataTable" id="omset_table">
            <thead>
                <tr>
                    <th>ID Barang</th>
                    <th>Nama Barang </th>
                    <th>Penjualan </th>
                </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
          </div>
           </div>
        </article>
    </main>
  
    <?php include 'Parsial/footer.php';?>