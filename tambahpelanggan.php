<?php include 'functions.php';?>
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
                    <h2>Tambah Data Pelanggan</h2>
                    <hr>
                </div>
                <div class="row">  
                    <div id="response" class="alert alert-success" style="display:none;">
                        <a href="#" class="close" data-bs-dismiss="alert"><i class="fa-solid fa-circle-xmark"></i></a>
                        <div class="message"></div>
                </div>
                <div class="row">
                        <form class="add-form" id="customer_baru" method="post">
                        <input type="hidden" name="action" value="customer_baru">
                        <div class="row gy-2 my-2 align-items-center">
                            <div class="col-lg-2">
                                <label for="inputid" class="col-form-label">ID Pelanggan</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" id="inputid" name ="id_customer" class="custom-form-control" value="<?php echo getCustomerId(); ?>" readonly>
                            </div>
                        </div>
                        <div class="row gy-2 my-2 align-items-center">
                            <div class="col-lg-2">
                                <label for="inputnama" class="col-form-label">Nama Pelanggan</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" id="inputnama" name ="nama_customer" class="custom-form-control" placeholder="Masukkan Nama Pelanggan" required>
                            </div>
                        </div>
                        <div class="row gy-2 my-2 align-items-center">
                            <div class="col-lg-2">
                                <label for="inputnomor" class="col-form-label">Nomor HP</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" id="inputnomor" name ="nomor_customer" class="custom-form-control" placeholder="Masukkan Nomor HP" required>
                            </div>
                        </div>
                        <div class="row gy-2 my-2 align-items-center">
                            <div class="col-lg-2">
                                <label for="inputalamat" class="col-form-label">Alamat</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" id="inputalamat" name ="alamat_customer" class="address-custom-form-control" placeholder="Masukkan Alamat Lengkap" required>
                            </div>
                        </div>
                        <div class="row gy-2 my-2 align-items-center">
                            <div class="col-lg-2">
                                <label for="inputkelurahan" class="col-form-label">Kelurahan</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" id="inputkelurahan" name ="kelurahan_customer" class="custom-form-control" placeholder="Masukkan Kelurahan" required>
                            </div>
                        </div>
                        <div class="row gy-2 my-2 align-items-center">
                            <div class="col-lg-2">
                                <label for="inputkota" class="col-form-label">Kota</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" id="inputkota" name ="kota_customer" class="custom-form-control" placeholder="Masukkan Kecamatan" required>
                            </div>
                        </div>
                        <div class="row gy-2 my-2 align-items-center">
                            <div class="col-lg-2">
                                <label for="inputprovinsi" class="col-form-label">Provinsi</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" id="inputprovinsi" name ="provinsi_customer" class="custom-form-control" placeholder="Masukkan Provinsi" required>
                            </div>
                        </div>
                        <div class="row gy-2 my-2 align-items-center">
                            <div class="col-lg-12">
                                <button type="submit" name="submit" class="custom-button" id="action_customer_baru"> Tambah Data </button>
                            </div>
                        </div>
                        </form>
                </div>
            </diV>
        </article>
    </main>
    <?php include 'Parsial/footer.php';?>