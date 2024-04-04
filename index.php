<?php include("functions.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'Parsial/head.php';?>
</head>
<body>
    <?php include 'Parsial/header.php';?>
    <main id="main">
        <?php include'Parsial/sidebar.php';?>
        <article>
            <div class="container">
                <div class="row">
                    <h2>Dashboard</h2>
                    <hr>
                </div>
                <div class="d-flex flex-row justify-content-between row">
                    <h4>Summary</h4>
                    <div class="info col-lg-3">
                        <div class="stats var1">
                            <h2>
                            <?php
                            $pelanggan = mysqli_query($koneksi, 'SELECT * FROM data_pelanggan');
                            echo "$pelanggan->num_rows";
                            ?>
                            </h2>
                            <span class="stats-title">Pelanggan</span>
                        </div>
                        <div class="details">
                            <a href="listpelanggan.php" class="text-decoration-none">Lihat Detail</a>
                        </div>
                    </div>
                    <div class="info col-lg-3">
                        <div class="stats var2">
                            <h2>
                            <?php
                            $barang = mysqli_query($koneksi, 'SELECT * FROM data_barang');
                            echo "$barang->num_rows";
                            ?>
                            </h2>
                            <span class="stats-title">Barang</span>
                        </div>
                        <div class="details">
                            <a href="listbarang.php" class="text-decoration-none">Lihat Detail</a>
                        </div>
                    </div>
                    <div class="info col-lg-3">
                        <div class="stats var3">
                            <h2>
                            <?php
                            $penjualan = mysqli_query($koneksi, 'SELECT * FROM penjualan');
                            echo "$penjualan->num_rows";
                            ?>
                            </h2>
                            <span class="stats-title">Penjualan</span>
                        </div>
                        <div class="details">
                            <a href="listpenjualan.php" class="text-decoration-none">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <!-- <h4>Penjualan Terbaru</h4>
                <hr>
                <div class="row">
                
                </div> -->
            </div>
      
        </article>
    </main>
<?php include 'Parsial/footer.php';?>