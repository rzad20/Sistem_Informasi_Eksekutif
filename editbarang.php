<?php 
include 'functions.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'Parsial/head.php';?>
</head>
<body>
    <?php include 'Parsial/header.php';
     $getID=$_GET['id'];
     $editBarang = "SELECT * FROM data_barang WHERE ID='". $koneksi->real_escape_string($getID) ."'";
     $hasilQuery = mysqli_query($koneksi,$editBarang);
     if($hasilQuery) {
        while($rowEdit = mysqli_fetch_assoc($hasilQuery)) {
            $namaBarang = $rowEdit['Nama_Barang'];
            $hargaBarang = $rowEdit['Harga_Barang'];
            $stokBarang = $rowEdit['Stok_Barang'];
            $gambarProduk = $rowEdit['file_gambar'];
        }
     }
     $koneksi->close();
    ?>
    <main>
        <?php include 'Parsial/sidebar.php';?>
        <article>
            <div class="container">
                <div class="row">
                    <h2>Edit Data Barang</h2>
                    <hr>
                </div>
                <div class="row">  
                    <div id="response" class="alert alert-success" style="display:none;">
                        <a href="#" class="close" data-bs-dismiss="alert"><i class="fa-solid fa-circle-xmark"></i></a>
                        <div class="message"></div>
                </div>
                <div class="row">
                    <form class="add-form" id="update_barang" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="update_barang">
                        <input type="hidden" name="id_barang" value="<?php echo $getID;?>">
                        <div class="row gy-2 my-2 align-items-center">
                            <div class="col-lg-2">
                                <label for="inputid" class="col-form-label">ID Barang</label>
                            </div>
                            <div class="col-lg-6">
                                <p><?php echo $getID; ?></p>
                            </div>
                        </div>
                        <div class="row gy-2 my-2 align-items-center">
                            <div class="col-lg-2">
                                <label for="inputnama" class="col-form-label">Nama Barang</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" id="inputnama" name ="nama_barang" class="custom-form-control" value="<?php echo $namaBarang;?>" required>
                            </div>
                        </div>
                        <div class="row gy-2 my-2 align-items-center">
                            <div class="col-lg-2">
                                <label for="inputharga" class="col-form-label">Harga Barang</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="number" id="inputharga" name ="harga_barang" class="custom-form-control" placeholder="Masukkan Harga Barang" value="<?php echo $hargaBarang;?>" required>
                            </div>
                        </div>
                        <div class="row gy-2 my-2 align-items-center">
                            <div class="col-lg-2">
                                <label for="stokbarang" class="col-form-label">Stok Barang</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="number" id="stokbarang" name ="stok_barang" class="custom-form-control" placeholder="Masukkan Stok Barang" value="<?php echo $stokBarang;?>" required>
                            </div>
                        </div>
                        <div class="row gy-2 my-2 align-items-center">
                            <div class="col-lg-2">
                                <label for="inputgambar" class="col-form-label">Gambar Produk</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="file" id="inputgambar" name="gambar_produk" class="form-control" accept="image/*">
                                <p class="mt-2">Gambar Produk Saat Ini:</p>
                                <img id="preview" src="<?php echo (!empty($gambarProduk)) ? 'img/'.$gambarProduk : ''; ?>" alt="Gambar Produk" style="max-width: 200px;">
                            </div>

                        </div>
                        <div class="row gy-2 my-2 align-items-center">
                            <div class="col-lg-12">
                                <button type="submit" name="submit" id="action_edit_barang" class="custom-button"> Edit Data </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </article>
    </main>
    <?php include 'Parsial/footer.php';?>
    <script>
    $(document).ready(function() {
        $("#inputgambar").change(function(event) {
            previewImage(event);
        });
    });

    function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var preview = document.getElementById('preview');
        preview.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>





