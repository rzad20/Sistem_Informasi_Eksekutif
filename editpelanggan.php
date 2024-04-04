<?php 
include 'functions.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'Parsial/head.php';?>
</head>
<body>
    <?php include 'Parsial/header.php';
    $getID=$_GET['id'];
    $editcustomer = "SELECT * FROM data_pelanggan WHERE ID='". $koneksi->real_escape_string($getID) ."'";
    $hasilQuery = mysqli_query($koneksi,$editcustomer);
    if($hasilQuery) {
        while($rowEdit = mysqli_fetch_assoc($hasilQuery)) {
            $namaCustomer = $rowEdit['Nama_Pelanggan'];
            $nomorcustomer = $rowEdit['No_Pelanggan'];
            $alamatCustomer = $rowEdit['Alamat'];
            $kelurahanCustomer = $rowEdit['Kelurahan'];
            $kotaCustomer = $rowEdit['Kota'];
            $provinsiCustomer = $rowEdit['Provinsi'];
        }
    }
    $koneksi->close();
    
    ?>
    <main>
        <?php include 'Parsial/sidebar.php';?>
        <article>
            <div class="container">
                <div class="row">
                    <h2>Edit Data Pelanggan</h2>
                    <hr>
                </div>
                <div class="row">  
                    <div id="response" class="alert alert-success" style="display:none;">
                        <a href="#" class="close" data-bs-dismiss="alert"><i class="fa-solid fa-circle-xmark"></i></a>
                        <div class="message"></div>
                </div>
                <div class="row">
                        <form class="add-form" id="update_customer" method="post">
                        <input type="hidden" name="action" value="update_customer">
                        <div class="row gy-2 my-2 align-items-center">
                            <div class="col-lg-6">
                                <input type="hidden" id="inputid" name ="id_customer" class="custom-form-control" value="<?php echo $getID;?>" readonly>
                            </div>
                        </div>
                        <div class="row gy-2 my-2 align-items-center">
                            <div class="col-lg-2">
                                <label for="inputnama" class="col-form-label">Nama Pelanggan</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" id="inputnama" name ="nama_customer" class="custom-form-control" 
                                value="<?php echo $namaCustomer; ?>" required>
                            </div>
                        </div>
                        <div class="row gy-2 my-2 align-items-center">
                            <div class="col-lg-2">
                                <label for="inputnomor" class="col-form-label">Nomor HP</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" id="inputnomor" name ="nomor_customer" 
                                class="custom-form-control" value="<?php echo $nomorcustomer; ?>" required>
                            </div>
                        </div>
                        <div class="row gy-2 my-2 align-items-center">
                            <div class="col-lg-2">
                                <label for="inputalamat" class="col-form-label">Alamat</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" id="inputalamat" name ="alamat_customer" 
                                class="address-custom-form-control" value="<?php echo $alamatCustomer;?>" required>
                            </div>
                        </div>
                        <div class="row gy-2 my-2 align-items-center">
                            <div class="col-lg-2">
                                <label for="inputkelurahan" class="col-form-label">Kelurahan</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" id="inputkelurahan" name ="kelurahan_customer" 
                                class="custom-form-control" value="<?php echo $kelurahanCustomer;?>" required>
                            </div>
                        </div>
                        <div class="row gy-2 my-2 align-items-center">
                            <div class="col-lg-2">
                                <label for="inputkota" class="col-form-label">Kota</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" id="inputkota" name ="kota_customer"
                                 class="custom-form-control" value="<?php echo $kotaCustomer; ?>" required>
                            </div>
                        </div>
                        <div class="row gy-2 my-2 align-items-center">
                            <div class="col-lg-2">
                                <label for="inputprovinsi" class="col-form-label">Provinsi</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" id="inputprovinsi" name ="provinsi_customer" 
                                class="custom-form-control" value="<?php echo $provinsiCustomer; ?>" required>
                            </div>
                        </div>
                        <div class="row gy-2 my-2 align-items-center">
                            <div class="col-lg-12">
                                <button type="submit" name="submit" class="custom-button" id="action_edit_customer"> Edit Data </button>
                            </div>
                        </div>
                        </form>
                </div>
            </diV>
        </article>
    </main>
    <?php include 'Parsial/footer.php';?>