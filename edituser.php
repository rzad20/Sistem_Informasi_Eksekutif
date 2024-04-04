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
    $edituser = "SELECT * FROM user_login WHERE ID='". $koneksi->real_escape_string($getID) ."'";
    $hasilQuery = mysqli_query($koneksi,$edituser);
    if($hasilQuery) {
        while($rowEdit = mysqli_fetch_assoc($hasilQuery)) {
            $namaUser = $rowEdit['Nama'];
            $username = $rowEdit['Username'];
            $pass = $rowEdit['Password'];
            $posisi = $rowEdit['Posisi'];
        }
    }
    $koneksi->close();
    
    ?>
    <main>
        <?php include 'Parsial/sidebar.php';?>
        <article>
        <div class="container">
                <div class="row">
                    <h2>Edit Data User</h2>
                    <hr>
                </div>
                <div class="row">  
                    <div id="response" class="alert alert-success" style="display:none;">
                        <a href="#" class="close" data-bs-dismiss="alert"><i class="fa-solid fa-circle-xmark"></i></a>
                        <div class="message"></div>
                </div>
                <div class="row">
                        <form class="add-form" id="edit_user" method="post">
                        <input type="hidden" name="action" value="edit_user">
                        <div class="row gy-2 my-2 align-items-center">
                            <div class="col-lg-2">
                                <label for="inputid" class="col-form-label">ID User</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" id="inputid" name ="id_user" class="custom-form-control" value="<?php echo $getID; ?>" readonly>
                            </div>
                        </div>
                        <div class="row gy-2 my-2 align-items-center">
                            <div class="col-lg-2">
                                <label for="inputuser" class="col-form-label">Nama User</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" id="inputuser" name ="nama_user" class="custom-form-control" value="<?php echo $namaUser; ?>" required>
                            </div>
                        </div>
                        <div class="row gy-2 my-2 align-items-center">
                            <div class="col-lg-2">
                                <label for="username" class="col-form-label">Username</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" id="username" name ="username" class="custom-form-control" value="<?php echo $username; ?>"  required>
                            </div>
                        </div>
                        <div class="row gy-2 my-2 align-items-center">
                            <div class="col-lg-2">
                                <label for="password" class="col-form-label">Password</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="password" id="password" name ="password" class="address-custom-form-control" value="<?php echo $pass;?>"  required>
                            </div>
                        </div>
                        <div class="row gy-2 my-2 align-items-center">
                            <div class="col-lg-2">
                                <label for="Posisi" class="col-form-label">Posisi</label>
                            </div>
                            <div class="col-lg-6">
                                <select name="posisi" class="custom-form-control">
                                    <option value="<?php echo $posisi;?>"><?php echo $posisi;?></option>
                                    <?php
                                      if ($posisi='Admin') {
                                        echo "<option value='Executive'>Executive</option>";
                                     }
                                     else if ($posisi='Executive') {
                                        echo "<option value='Admin'>Admin</option>";
                                     }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row gy-2 my-2 align-items-center">
                            <div class="col-lg-12">
                                <button type="submit" name="submit" class="custom-button" id="action_edit_user"> Edit Data </button>
                            </div>
                        </div>
                        </form>
                </div>
            </diV>
        </article>
    </main>
    <?php include 'Parsial/footer.php';?>