<?php include 'functions.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'Parsial/head.php';?>
</head>
<body>
    <?php include 'Parsial/header.php';?>
    <main>
        <?php include 'Parsial/sidebar.php';?>
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
            <div class="col-lg-4 d-flex flex-row gap-2 align-items-center">           
            <div class="form-group">
                <label for="chartType">Tipe Grafik:</label>
                <select class="form-select" id="chartType">
                    <option value="bar">Bar</option>
                    <option value="line">Line</option>
                    <option value="pie">Pie</option>
                </select>
            </div>
          </div>
          </div>
          <div class="row chart-wrapper">
            <canvas id="omsetChart"></canvas>
          </div>
          <div class="row mx-3"> 
          <table class="table table-striped table-hover table-bordered dataTable" id="omset_table">
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
          <div class="row d-flex flex-row justify-content-center">
          <button id="printButton2" class="btn btn-primary">Cetak Laporan</button>
          </div>
          </div>
           </div>
        </article>
    </main>
  
    <?php include 'Parsial/footer.php';?>