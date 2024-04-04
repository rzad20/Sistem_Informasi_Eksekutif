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
                    <h2>Tambah Data Barang</h2>
                    <hr>
                </div>
                <div class="row">
                    <form class="add-form" enctype="multipart/form-data" method="post">
                        <div class="row gy-2 my-2 align-items-center">
                            <div class="col-lg-2">
                                <label for="inputid" class="col-form-label">ID Barang</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" id="inputid" name ="id_barang" class="custom-form-control" value="<?php echo getBarangId();?>" readonly>
                            </div>
                        </div>
                        <div class="row gy-2 my-2 align-items-center">
                            <div class="col-lg-2">
                                <label for="inputnama" class="col-form-label">Nama Barang</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" id="inputnama" name ="nama_barang" class="custom-form-control" placeholder="Masukkan Nama Barang" required>
                            </div>
                        </div>
                        <div class="row gy-2 my-2 align-items-center">
                            <div class="col-lg-2">
                                <label for="inputharga" class="col-form-label">Harga Barang</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="number" id="inputharga" name ="harga_barang" class="custom-form-control" placeholder="Masukkan Harga Barang" required>
                            </div>
                        </div>
                        <div class="row gy-2 my-2 align-items-center">
                            <div class="col-lg-2">
                                <label for="stokbarang" class="col-form-label">Stok Barang</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="number" id="stokbarang" name ="stok_barang" class="custom-form-control" placeholder="Masukkan Stok Barang" required>
                            </div>
                        </div>
                        <div class="row gy-2 my-2 align-items-center">
                            <div class="col-lg-2">
                                <label for="inputgambar" class="col-form-label">Gambar Produk</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="file" id="inputgambar" name="gambar_produk" class="form-control" accept="image/*" onchange="previewImage(event)" required>
                                <img id="preview" src="#" alt="Preview Gambar" style="display: none; max-width: 200px; margin-top: 10px;">
                            </div>
                        </div>
                        <div class="row gy-2 my-2 align-items-center">
                            <div class="col-lg-12">
                                <button type="submit" name="submit" class="custom-button"> Tambah Data </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </article>
    </main>
    <?php
    // Establish your database connection here

    if(isset($_POST['submit'])) {
        $id_barang = $_POST['id_barang'];
        $nama_barang = $_POST['nama_barang'];
        $harga_barang = $_POST['harga_barang'];
        $stok_barang = $_POST['stok_barang'];
        
        // Handling the uploaded image
        $uploadDir = 'img/';  // Set the appropriate path
        $uploadedFile = $_FILES['gambar_produk']['tmp_name'];
        $fileExtension = strtolower(pathinfo($_FILES['gambar_produk']['name'], PATHINFO_EXTENSION));
        $newFileName = $id_barang . '.' . $fileExtension;
        $targetPath = $uploadDir . $newFileName;

        if (move_uploaded_file($uploadedFile, $targetPath)) {
            $tambahData = "INSERT into data_barang SET
            ID = '$id_barang',
            Nama_Barang='$nama_barang',
            Harga_Barang=$harga_barang,
            Stok_Barang =$stok_barang,
            file_gambar='$newFileName'
            ";

            if($result = $koneksi->query($tambahData)) {
                echo"
                <script>
                alert('Berhasil Tambah Barang')
                </script>
                ";
                echo "
                <script>
                    window.open('index.php','_self')
                </script>
                ";
            }
        } else {
            echo "
            <script>
                alert('Gagal mengunggah gambar.')
            </script>
            ";
        }
    }
    ?>
    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var preview = document.getElementById('preview');
                preview.src = reader.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>
</html>
