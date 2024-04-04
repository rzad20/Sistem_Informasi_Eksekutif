<?php
include_once("Parsial/connect.php");
session_start();
$check = $_SESSION['login_username'];
if(!isset($check)) {
    header("Location:login.php");
}

//Generate Nomor Customer Otomatis
function getCustomerId(){
    $koneksi = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);
    $query = "SELECT max(ID) As max_id from data_pelanggan order by ID DESC";
    if($result = $koneksi->query($query)) {
        $row = $result-> fetch_assoc();
        $max_id = $row['max_id'];

        if($max_id===null) {
            $cid = "1001";
        }
        else {
            $cid = ($max_id + 1);
        }
        //free memory associated with a result
        $result->free();
        //close connection
        $koneksi->close();
        return $cid;
    }
}
function getBarangId() {
    $koneksi = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);
    $query = "SELECT max(ID) As max_id from data_barang order by ID";
    if($result = $koneksi->query($query)) {
        $row = $result-> fetch_assoc();
        $max_id = $row['max_id'];

        if($max_id===null) {
            $bid = "2001";
        }
        else {
            $bid = ($max_id + 1);
        }
        //free memory associated with a result
        $result->free();
        //close connection
        $koneksi->close();
        return $bid;
    }
}

function getInvoiceId() {
    $koneksi = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);
    $query = "SELECT MAX(ID) As max_id from penjualan order by ID";
    if($result = $koneksi->query($query)) {
        $row = $result-> fetch_assoc();
        $max_id = $row['max_id'];

        if($max_id===null) {
            $bid = "3001";
        }
        else {
            $bid = (max_id + 1);
        }
        //free memory associated with a result
        $result->free();
        //close connection
        $koneksi->close();
        return $bid;
    }
}

function getUserId() {
    $koneksi = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);
    $query = "SELECT MAX(ID) As max_id from user_login order by ID";
    if($result = $koneksi->query($query)) {
        $row = $result-> fetch_assoc();
        $max_id = $row['max_id'];

        if($max_id===null) {
            $bid = "4001";
        }
        else {
            $bid = ($max_id + 1);
        }
        //free memory associated with a result
        $result->free();
        //close connection
        $koneksi->close();
        return $bid;
    }
}
function getCustomers(){
    $koneksi = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);
    $query = "SELECT * FROM data_pelanggan ORDER BY Nama_Pelanggan ASC";
    $results = $koneksi->query($query);
    print '
    <table class="table table-striped table-hover table-bordered dataTable" id="customer-table">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Nomor Telepon</th>
            <th>Alamat</th>
            <th>Kota</th>
            <th>Provinsi</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>';
    if($results) {
        while($row=$results->fetch_assoc()) {
            print'
                <tr>
                <td>'.$row["Nama_Pelanggan"].'</td>
                <td>'.$row["No_Pelanggan"].'</td>
                <td>'.$row["Alamat"].'</td>
                <td>'.$row["Kota"].'</td>
                <td>'.$row["Provinsi"].'</td>
                <td>
                <a href="editPelanggan.php?id='.$row["ID"].'" class="btn btn-primary btn-sm"><i class="icon_on_list fa-solid fa-pen-to-square"></i></a>
                <a data-customer-id="'.$row["ID"].'" class="delete-customer btn btn-danger btn-sm"
                data-bs-toggle="modal" data-bs-target="#delete_customer"><i class="icon_on_list fa-solid fa-trash"></i></a>
                </td>
                </tr>
            ';
        }
        print '
        </tbody>
        </table>
        ';
    }
    else {
        print '
        <tr>
        <td>Tidak Ada Data Pelanggan</td>
        </tr>
        </tbody>
        </table>
        ';
    }
          //bersihkan memori dari hasil
          $results->free();
          //tutup koneksi database setelah fungsi dipanggil
          $koneksi->close();
}
function getCustomersMobile(){
    $koneksi = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);
    $query = "SELECT * FROM data_pelanggan ORDER BY Nama_Pelanggan ASC";
    $results = $koneksi->query($query);
    print '
    <table class="table table-striped table-hover table-bordered dataTable" id="mobile-table">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Nomor Telepon</th>
            <th>Alamat</th>
            <th>Kota</th>
            <th>Provinsi</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>';
    if($results) {
        while($row=$results->fetch_assoc()) {
            print'
                <tr>
                <td>'.$row["Nama_Pelanggan"].'</td>
                <td>'.$row["No_Pelanggan"].'</td>
                <td>'.$row["Alamat"].'</td>
                <td>'.$row["Kota"].'</td>
                <td>'.$row["Provinsi"].'</td>
                <td>
                <a href="editPelanggan.php?id='.$row["ID"].'" class="btn btn-primary btn-sm"><i class="icon_on_list fa-solid fa-pen-to-square"></i></a>
                <a data-customer-id="'.$row["ID"].'" class="delete-customer btn btn-danger btn-sm"
                data-bs-toggle="modal" data-bs-target="#delete_customer"><i class="icon_on_list fa-solid fa-trash"></i></a>
                </td>
                </tr>
            ';
        }
        print '
        </tbody>
        </table>
        ';
    }
    else {
        print '
        <tr>
        <td>Tidak Ada Data Pelanggan</td>
        </tr>
        </tbody>
        </table>
        ';
    }
          //bersihkan memori dari hasil
          $results->free();
          //tutup koneksi database setelah fungsi dipanggil
          $koneksi->close();
}

function popCustomers(){
    $koneksi = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);
    $query = "SELECT * FROM data_pelanggan ORDER BY Nama_Pelanggan ASC";
    $results = $koneksi->query($query);
    print '
    <div>
    <table class="table table striped table-hover table-bordered dataTable" id="customer-table">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Nomor Telepon</th>
            <th>Alamat</th>
            <th>Kota</th>
            <th>Provinsi</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    </div>';
    if($results) {
        while($row=$results->fetch_assoc()) {
            print'
                <tr>
                <td>'.$row["Nama_Pelanggan"].'</td>
                <td>'.$row["No_Pelanggan"].'</td>
                <td>'.$row["Alamat"].'</td>
                <td>'.$row["Kota"].'</td>
                <td>'.$row["Provinsi"].'</td>
                <td>
                    <a href="#" class="btn btn-primary btn-xs customer-select"
                    customer_ID="'.$row["ID"].'"
                    customer_name="'.$row["Nama_Pelanggan"].'"
                    customer_number="'.$row["No_Pelanggan"].'"
                    customer_address = "'.$row["Alamat"].'"
                    customer_city = "'.$row["Kota"].'"
                    customer_kel = "'.$row["Kelurahan"].'"
                    customer_prov = "'.$row["Provinsi"].'"
                    > Pilih </a>
                </td>
                </tr>
            ';
        }
        print '
        </tbody>
        </table>
        ';
    }
    else {
        print '
        <tr>
        <td>Tidak Ada Data Pelanggan</td>
        </tr>
        </tbody>
        </table>
        ';
    }
          //bersihkan memori dari hasil
          $results->free();
          //tutup koneksi database setelah fungsi dipanggil
          $koneksi->close();
    
}

function getBarang(){
    $koneksi = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);
    $query = "SELECT * FROM data_barang ORDER BY Nama_Barang ASC";
    $results = $koneksi->query($query);
    print '
    <table class="table table-striped table-hover table-bordered dataTable" id="customer-table">
    <thead>
        <tr>
            <th>Nama Barang</th>
            <th>Harga Barang</th>
            <th>Stok Tersedia</th>
            <th>Gambar</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>';
    if($results) {
        while($row=$results->fetch_assoc()) {
            print'
                <tr>
                <td>'.$row["Nama_Barang"].'</td>
                <td>'.$row["Harga_Barang"].'</td>
                <td>'.$row["Stok_Barang"].'</td>
                <td><img style="width:30%; border-radius:20px;"src="img/'.$row["file_gambar"].'"></td>
                <td>
                <a href="editbarang.php?id='.$row["ID"].'" class="btn btn-primary btn-sm"
                ><i class="icon_on_list fa-solid fa-pen-to-square"></i></a>
                <a data-barang-id="'.$row["ID"].'" class="btn btn-danger btn-sm delete-barang"
                data-bs-toggle="modal" data-bs-target="#delete_barang"><i class="icon_on_list fa-solid fa-trash"></i></a>
                </td>
                </tr>
            ';
        }
        print '
        </tbody>
        </table>
        ';
    }
    else {
        print '
        <tr>
        <td>Tidak Ada Data Pelanggan</td>
        </tr>
        </tbody>
        </table>
        ';
    }
          //free memory associated with a result
          $results->free();
          //close connection
          $koneksi->close();
}
function popBarang(){
    $koneksi = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);
    $query = "SELECT * FROM data_barang ORDER BY Nama_Barang ASC";
    $results = $koneksi->query($query);
    print '
    <table class="table table striped table-hover table-bordered dataTable" id="customer-table">
    <thead>
        <tr>
            <th>Nama Barang</th>
            <th>Harga Barang</th>
            <th>Stok Tersedia</th>
            <th>Gambar</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>';
    if($results) {
        while($row=$results->fetch_assoc()) {
            print'
                <tr>
                <td>'.$row["Nama_Barang"].'</td>
                <td>'.$row["Harga_Barang"].'</td>
                <td>'.$row["Stok_Barang"].'</td>
                <td><img src="img/'.$row["file_gambar"].'" alt="Gambar Produk" style="max-width: 50px;"></td>
               <td>
                    <a href="#" class="btn btn-primary btn-xs selected"
                    barang_ID="'.$row["ID"].'"
                    nama_barang="'.$row["Nama_Barang"].'"
                    harga_barang="'.$row["Harga_Barang"].'"
                    stok_barang="'.$row["Stok_Barang"].'"
                    gambar_produk="'.$row["file_gambar"].'"
                    > Pilih </a>
                </td>
                </tr>
            ';
        }
        print '
        </tbody>
        </table>
        ';
    }
    else {
        print '
        <tr>
        <td>Tidak Ada Data Pelanggan</td>
        </tr>
        </tbody>
        </table>
        ';
    }
          //free memory associated with a result
          $results->free();
          //close connection
          $koneksi->close();
}
function splitDataByMonth($data)
{
    $dataByMonth = array();
    foreach ($data as $row) {
        $date = date('F Y', strtotime($row['tanggal_pembelian']));
        if (!isset($dataByMonth[$date])) {
            $dataByMonth[$date] = array();
        }
        $dataByMonth[$date][] = $row;
    }
    return $dataByMonth;
}

function getInvoice(){
    $koneksi = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);
    $query = "SELECT * FROM penjualan ORDER BY ID ASC";
    $results = $koneksi->query($query);
    print '
    <table class="table table-striped table-hover table-bordered dataTable" id="customer-table">
    <thead>
        <tr>
            <th>No.Invoice </th>
            <th>Pelanggan</th>
            <th>Tanggal Invoice</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>';
    if($results) {
        while($row=$results->fetch_assoc()) {
            $idPelanggan = $row["ID_Pelanggan"];
            $query2 = "SELECT * FROM data_pelanggan WHERE ID='$idPelanggan'";
            $result2 = $koneksi->query($query2);
            $row2 = $result2->fetch_assoc();
            
            print'
                <tr>
                <td>'.$row["ID"].'</td>
                <td>'.$row2["Nama_Pelanggan"].'</td>
                <td>'.$row["Tanggal_Pembelian"].'</td>
                <td>'.$row["Total"].'</td>
                <td>
                <a href="edit_invoice.php?id='.$row["ID"].'" class="btn btn-primary btn-sm"><i class="icon_on_list fa-solid fa-pen-to-square"></i></a>
                <a href="#" data-invoice-id="'.$row["ID"].'"" class="btn btn-danger btn-sm delete-invoice" data-bs-toggle="modal" data-bs-target="#deleteinvoice"><i class="icon_on_list fa-solid fa-trash"></i></a>
                <a href="listinvoice/PRNT_'.$row["ID"].'.pdf" class="btn btn-primary btn-sm" id="detail_invoice"><i class="fa-solid fa-print"></i></i></a>
                </td>
                </tr>
            ';
        }
        print '
        </tbody>
        </table>
        ';
    }
    else {
        print '
        <tr>
        <td>Tidak Ada Data Invoice</td>
        </tr>
        </tbody>
        </table>
        ';
    }
          //bersihkan memori dari hasil
          $results->free();
          $result2->free();
          //tutup koneksi database setelah fungsi dipanggil
          $koneksi->close();
}

function getCurrentInvoice(){
    $koneksi = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);
    $query = "SELECT * FROM penjualan ORDER BY Tanggal_Pembelian DESC LIMIT 3";
    $results = $koneksi->query($query);
    print '
    <table class="table table-striped table-hover table-bordered dataTable" id="report-table">
    <thead>
        <tr>
            <th>No.Invoice </th>
            <th>Pelanggan</th>
            <th>Tanggal Invoice</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>';
    if($results) {
        while($row=$results->fetch_assoc()) {
            $idPelanggan = $row["ID_Pelanggan"];
            $query2 = "SELECT * FROM data_pelanggan WHERE ID='$idPelanggan'";
            $result2 = $koneksi->query($query2);
            $row2 = $result2->fetch_assoc();
            
            print'
                <tr>
                <td>'.$row["ID"].'</td>
                <td>'.$row2["Nama_Pelanggan"].'</td>
                <td>'.$row["Tanggal_Pembelian"].'</td>
                <td>'.$row["Total"].'</td>
                </tr>
            ';
        }
        print '
        </tbody>
        </table>
        ';
    }
    else {
        print '
        <tr>
        <td>Tidak Ada Data Invoice</td>
        </tr>
        </tbody>
        </table>
        ';
    }
          //bersihkan memori dari hasil
          $results->free();
          $result2->free();
          //tutup koneksi database setelah fungsi dipanggil
          $koneksi->close();
}

function getUser(){
    $koneksi = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);
    $query = "SELECT * FROM user_login ORDER BY ID ASC";
    $results = $koneksi->query($query);
    print '
    <table class="table table-striped table-hover table-bordered dataTable" id="customer-table">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Username</th>
            <th>Posisi</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>';
    if($results) {
        while($row=$results->fetch_assoc()) {
            print'
                <tr>
                <td>'.$row["Nama"].'</td>
                <td>'.$row["Username"].'</td>
                <td>'.$row["Posisi"].'</td>
                <td>
                <a href="edituser.php?id='.$row["ID"].'" class="btn btn-primary btn-sm"
                ><i class="icon_on_list fa-solid fa-pen-to-square"></i></a>
                <a data-barang-id="'.$row["ID"].'" class="btn btn-danger btn-sm delete-user"
                data-bs-toggle="modal" data-bs-target="#delete_user"><i class="icon_on_list fa-solid fa-trash"></i></a>
                </td>
                </tr>
            ';
        }
        print '
        </tbody>
        </table>
        ';
    }
    else {
        print '
        <tr>
        <td>Tidak Ada Data Pelanggan</td>
        </tr>
        </tbody>
        </table>
        ';
    }
          //free memory associated with a result
          $results->free();
          //close connection
          $koneksi->close();
}
?>