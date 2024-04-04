<?php
include('Parsial/connect.php');
$action = isset($_POST['action']) ? $_POST['action']:"";
if($action=='fetch_report') {
    $order_column = array('nama_barang','quantity','tanggal_pembelian');
    $main_query = 'SELECT MAX(nama_barang) AS nama_barang, SUM(quantity) AS quantity, MAX(id_barang) AS id_barang from item_penjualan ';
    $search_query = 'WHERE tanggal_pembelian <= "'.date('Y-m-d').'" AND ';
        if(isset($_POST["start_date"], $_POST["end_date"]) && $_POST["start_date"] != '' && $_POST["end_date"] != '')
        {
            $search_query .= 'tanggal_pembelian >= "'.$_POST["start_date"].'" AND tanggal_pembelian <= "'.$_POST["end_date"].'" AND';
        }
        if(isset($_POST["search"]["value"]))
        {
            $search_query .= '(nama_barang LIKE "%'.$_POST["search"]["value"].'%" OR quantity LIKE "%'.$_POST["search"]["value"].'%" OR tanggal_pembelian LIKE "%'.$_POST["search"]["value"].'%")';
        }
        $group_by_query = " GROUP BY nama_barang ";
        $order_by_query = "";
        if(isset($_POST["order"]))
        {
            $order_by_query = 'ORDER BY '.$order_column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
        }
        else
        {
            $order_by_query = 'ORDER BY nama_barang DESC ';
        }
        $limit_query = '';
        if($_POST["length"] != -1)
        {
            $limit_query = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
        $statement = $koneksi->prepare($main_query . $search_query . $group_by_query . $order_by_query);
        $statement -> execute();
        $statement->store_result();
        $filtered_rows = $statement->num_rows;
        $statement2 = $koneksi->prepare($main_query . $group_by_query);
        $statement2->execute();
        $statement2->store_result();
        $total_rows = $statement2->num_rows;
        $result = $koneksi->query($main_query . $search_query . $group_by_query . $order_by_query);
        $row = $result->fetch_assoc();
        $data = array();
        foreach($result as $row) {
            $sub_array = array();
            $sub_array[] = $row['id_barang'];    
            $sub_array[] = $row['nama_barang'];
            $sub_array[] = $row['quantity'];
            $data[] = $sub_array;
        }
        $output = array(
            "draw"          =>  intval($_POST["draw"]),
            "recordsTotal"  =>  $total_rows,
            "recordsFiltered" => $filtered_rows,
            "data"          =>  $data
        );
        echo json_encode($output);
}

if($action=='fetch_omset') {
    $order_column = array('nama_barang','quantity','tanggal_pembelian');
    $main_query = 'SELECT MAX(nama_barang) AS nama_barang, SUM(sub_total_item) AS total_terjual, MAX(id_barang) AS id_barang from item_penjualan ';
    $search_query = 'WHERE tanggal_pembelian <= "'.date('Y-m-d').'" AND ';
        if(isset($_POST["start_date"], $_POST["end_date"]) && $_POST["start_date"] != '' && $_POST["end_date"] != '')
        {
            $search_query .= 'tanggal_pembelian >= "'.$_POST["start_date"].'" AND tanggal_pembelian <= "'.$_POST["end_date"].'" AND';
        }
        if(isset($_POST["search"]["value"]))
        {
            $search_query .= '(nama_barang LIKE "%'.$_POST["search"]["value"].'%" OR quantity LIKE "%'.$_POST["search"]["value"].'%" OR tanggal_pembelian LIKE "%'.$_POST["search"]["value"].'%")';
        }
        $group_by_query = " GROUP BY nama_barang ";
        $order_by_query = "";
        if(isset($_POST["order"]))
        {
            $order_by_query = 'ORDER BY '.$order_column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
        }
        else
        {
            $order_by_query = 'ORDER BY nama_barang DESC ';
        }
        $limit_query = '';
        if($_POST["length"] != -1)
        {
            $limit_query = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
        $statement = $koneksi->prepare($main_query . $search_query . $group_by_query . $order_by_query);
        $statement -> execute();
        $statement->store_result();
        $filtered_rows = $statement->num_rows;
        $statement2 = $koneksi->prepare($main_query . $group_by_query);
        $statement2->execute();
        $statement2->store_result();
        $total_rows = $statement2->num_rows;
        $result = $koneksi->query($main_query . $search_query . $group_by_query . $order_by_query);
        $row = $result->fetch_assoc();
        $data = array();
        foreach($result as $row) {
            $sub_array = array();
            $sub_array[] = $row['id_barang'];    
            $sub_array[] = $row['nama_barang'];
            $sub_array[] = $row['total_terjual'];
            $data[] = $sub_array;
        }
        $output = array(
            "draw"          =>  intval($_POST["draw"]),
            "recordsTotal"  =>  $total_rows,
            "recordsFiltered" => $filtered_rows,
            "data"          =>  $data
        );
        echo json_encode($output);
}

if($action=='invoice_baru') {
    //informasi customer
    $id_pelanggan = $_POST['id_pelanggan'];
    $namaCustomer = $_POST['nama_pelanggan'];
    $alamatCustomer = $_POST['alamat_pelanggan'];
    $kelurahanCustomer = $_POST['nama_kelurahan'];
    $kotaCustomer = $_POST['nama_kota'];
    $provinsiCustomer = $_POST['nama_provinsi'];

    //info Invoice
    $no_invoice = $_POST['nomor_invoice'];
    $tanggal_invoice = $_POST['tanggal_invoice'];
    $finalsubtotal = $_POST['final_subtotal'];
    $finaldiscount = $_POST['final_discount'];
    $shipping = $_POST['shipping'];
    $finalTotal = $_POST['final_total'];

    //tambah invoice ke database
    $query = "INSERT INTO penjualan (ID,Tanggal_Pembelian
    ,ID_Pelanggan,subtotal,Discount,Ongkos_Kirim,Total)
    VALUES(
        '".$no_invoice."',
        '".$tanggal_invoice."',
        '".$id_pelanggan."',
        '".$finalsubtotal."',
        '".$finaldiscount."',
        '".$shipping."',
        '".$finalTotal."'
    );
    ";

    //Invoice Product Items
    $html = ''; // Initialize the $html variable
    foreach($_POST['nama_barang'] as $key => $value) {
        $item_product = $value;
        $item_id=$_POST['ID_Barang'][$key];
        $item_qty = $_POST['jumlah_barang'][$key];
        $harga_item = $_POST['harga_produk'][$key];
        $diskon_item = $_POST['diskon_barang'][$key];
        $item_subtotal = $_POST['sub_total'][$key];
        //masukkan product item ke database product item
        $query .= "INSERT INTO item_penjualan
        (invoice_id,id_barang,nama_barang,
        quantity,harga_barang,diskon_barang,
        sub_total_item,tanggal_pembelian)
        VALUES (
        '".$no_invoice."',
        '".$item_id."',
        '".$item_product."',
        '".$item_qty."',
        '".$harga_item."',
        '".$diskon_item."',
        '".$item_subtotal."',
        '".$tanggal_invoice."');
        ";
        $query .= "UPDATE data_barang SET Stok_Barang = Stok_Barang - '".$item_qty."' WHERE ID = '".$item_id."';";
    }

    //delete stok
    header('Content-Type: application/json');
    //Execute Query
    if($koneksi -> multi_query($query)) {
        //Jika Simpan Berhasil
        echo json_encode(array(
            'status' => 'Berhasil',
            'message' => 'Berhasil Menyimpan Data Penjualan'
        ));
        include('printinvoice.php');
        
        $file_name = "PRNT_".$no_invoice.".pdf";
        $pdf->AddPage();
        $pdf->Write(0, 'Invoice', '', 0, 'L', true, 0, false, false, 0);
        $pdf->SetFont('helvetica', '', 12);
        $tbl = '
        <table cellspacing="0" cellpadding="1" border="1">
            <tr>
            <td width="35%"> Nomor Invoice </td>
            <td width="65%" >'.$no_invoice. '</td>
            </tr>
            <tr>
            <td width="35%"> Tanggal Pembelian </td>
            <td width="65%" > ' .$tanggal_invoice. ' </td>
            </tr>
            <tr>
            <td width="35%"> Nama Pelanggan </td>
            <td width="65%" > ' .$namaCustomer. ' </td>
            </tr>
            <tr>
            <td width="35%"> Alamat </td>
            <td width="65%" > ' .$alamatCustomer. ' </td>
            </tr>
            <tr>
            <td width="35%"> Kelurahan </td>
            <td width="65%" > ' .$kelurahanCustomer. ' </td>
            </tr>
            <tr>
            <td width="35%"> Kota </td>
            <td width="65%" > ' .$kotaCustomer. ' </td>
            </tr>
            <tr>
            <td width="35%"> Provinsi </td>
            <td width="65%" > ' .$provinsiCustomer. ' </td>
            </tr>
        </table>

        '
        ;
        $pdf->writeHTML($tbl, true, false, false, false, '');
        $tbl_header = '<table cellspacing="0" cellpadding="1" border="1">';
        $tbl_footer = '</tbody></table>';      
        $tbl_head = '
        <thead>
        <tr>
        <th>Nama Barang</th>
        <th>Qty</th>
        <th>Harga</th>
        <th>Diskon</th>
        <th>Sub Total </th>
        </tr>
        </thead>
        <tbody>
        ';
        foreach($_POST['nama_barang'] as $key => $value) {
            $item_product = $value;
            $item_id=$_POST['ID_Barang'][$key];
            $item_qty = $_POST['jumlah_barang'][$key];
            $harga_item = $_POST['harga_produk'][$key];
            $diskon_item = $_POST['diskon_barang'][$key];
            $item_subtotal = $_POST['sub_total'][$key];
            $html .='
            <tr>
            <td>'.$item_product.'</td>
            <td>'.$item_qty.'</td>
            <td>Rp'.$harga_item.'</td>
            <td>'.$diskon_item.'</td>
            <td>Rp'.$item_subtotal.'</td>
            </tr>
            ';
        }
        $pdf->writeHTML($tbl_header.$tbl_head.$html.$tbl_footer, true, false, false, false, '');
        $tbl = '
        <table cellspacing="0" cellpadding="1" border="1">
            <tr>
            <td width="30%"> Sub Total </td>
            <td width="30%" >Rp'.$finalsubtotal. '</td>
            </tr>
            <tr>
            <td width="30%"> Diskon </td>
            <td width="30%" >Rp'.$finaldiscount. '</td>
            </tr>
            <tr>
            <td width="30%"> Ongkir </td>
            <td width="30%" >Rp'.$shipping. '</td>
            </tr>
            <tr>
            <td width="30%"> Total </td>
            <td width="30%" >Rp'.$finalTotal. '</td>
            </tr>
        </table>';
        $pdf->writeHTML($tbl, true, false, false, false, '');
        $pdf->Output($file_name,'F');
    }

    $koneksi->close();
};

if($action=='user_baru') {
    //info customer
    $IdUser = $_POST['id_user'];
    $namaUser = $_POST['nama_user'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $posisi = $_POST['posisi'];
    $query = "INSERT INTO user_login (
        ID,Nama,Username,Password,Posisi)
        VALUES(?,?,?,?,?);";

    //persiapan parameter statement
    $stmt = $koneksi->prepare($query);
    if($stmt===false) {
        trigger_error('Wrong SQL: '. $query . 'Error: ' . $koneksi->error, E_USER_ERROR);
    }
    //bind paramater, tipe : S = String, I = Integer, D= Double, b=Blob */
    $stmt->bind_param(
        'sssss',$IdUser,$namaUser,$username,$password,$posisi
    );
    if($stmt->execute()) {
        //simpan berhasil
        echo json_encode(array(
            'status' => 'Success',
            'message' => "Berhasil Tambah Data User"
        ));
    } else {
        echo json_encode(array (
            'status' => 'Error',
            'message' => "Terjadi kesalahan, mohon coba lagi.<pre>'.$koneksi->error.'</pre><pre>'.$query.'</pre>'"
        ));
    }
    ///tutup koneksi database
    $koneksi->close();


}

if($action=='customer_baru') {
    //info customer
    $IdCustomer = $_POST['id_customer'];
    $namaCustomer = $_POST['nama_customer'];
    $nomorCustomer = $_POST['nomor_customer'];
    $alamatCustomer = $_POST['alamat_customer'];
    $kelurahanCustomer = $_POST['kelurahan_customer'];
    $kotaCustomer = $_POST['kota_customer'];
    $provinsiCustomer = $_POST['provinsi_customer'];   
    $query = "INSERT INTO data_pelanggan (
        ID,Nama_Pelanggan,No_Pelanggan,Alamat,Kelurahan,Kota,Provinsi)
        VALUES(?,?,?,?,?,?,?);";

    //persiapan parameter statement
    $stmt = $koneksi->prepare($query);
    if($stmt===false) {
        trigger_error('Wrong SQL: '. $query . 'Error: ' . $koneksi->error, E_USER_ERROR);
    }
    //bind paramater, tipe : S = String, I = Integer, D= Double, b=Blob */
    $stmt->bind_param(
        'sssssss',$IdCustomer,$namaCustomer,$nomorCustomer,$alamatCustomer,
        $kelurahanCustomer,$kotaCustomer,$provinsiCustomer
    );
    if($stmt->execute()) {
        //simpan berhasil
        echo json_encode(array(
            'status' => 'Success',
            'message' => "Berhasil Tambah Data Customer"
        ));
    } else {
        echo json_encode(array (
            'status' => 'Error',
            'message' => "Terjadi kesalahan, mohon coba lagi.<pre>'.$koneksi->error.'</pre><pre>'.$query.'</pre>'"
        ));
    }
    ///tutup koneksi database
    $koneksi->close();


}

if($action=='update_customer') {
    $getID=$_POST['id_customer'];
    $namaCustomer = $_POST['nama_customer'];
    $nomorCustomer = $_POST['nomor_customer'];
    $alamatCustomer = $_POST['alamat_customer'];
    $kelurahanCustomer = $_POST['kelurahan_customer'];
    $kotaCustomer = $_POST['kota_customer'];
    $provinsiCustomer = $_POST['provinsi_customer'];   
    $query = "UPDATE data_pelanggan SET
    Nama_Pelanggan = ?,
    No_Pelanggan = ?,
    Alamat = ?,
    Kelurahan = ?,
    Kota = ?,
    Provinsi = ?
    WHERE ID = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param('sssssss',
    $namaCustomer,$nomorCustomer,$alamatCustomer,$kelurahanCustomer,
    $kotaCustomer,$provinsiCustomer,$getID);
    if($stmt->execute()){
        echo json_encode(array(
            'status' => 'Success',
            'message' => "Berhasil Edit Data Customer"
        ));
    } else {
        echo json_encode(array (
            'status' => 'Error',
            'message' => "Terjadi kesalahan, mohon coba lagi.<pre>'.$koneksi->error.'</pre><pre>'.$query.'</pre>'"
        ));
    }
    ///tutup koneksi database
    $koneksi->close();

}

if($action=='delete_customer'){
    $id=$_POST["delete"];
    $query = "DELETE FROM data_pelanggan WHERE ID= ?";
    /*persiapkan Statement*/ 
    $stmt= $koneksi->prepare($query);
    if($stmt==false) {
        trigger_error('Wrong SQL: ' . $query . ' Error: ' . $koneksi->error, E_USER_ERROR);
    }
    /*bind parameters*/
    $stmt->bind_param('s',$id);
    if($stmt->execute()) {
         //if saving success
		echo json_encode(array(
			'status' => 'Success',
			'message'=> 'Data Pelanggan Berhasil Dihapus!'
		));

	} else {
	    //if unable to create new record
	    echo json_encode(array(
	    	'status' => 'Error',
	    	//'message'=> 'There has been an error, please try again.'
	    	'message' => "Terjadi kesalahan, mohon coba lagi.<pre>'.$koneksi->error.'</pre><pre>'.$query.'</pre>'"
	    ));
	}
    $koneksi->close();
    
}

if($action=='delete_barang'){
    $id=$_POST["delete"];
    $query = "DELETE FROM data_barang WHERE ID= ?";
    /*persiapkan Statement*/ 
    $stmt= $koneksi->prepare($query);
    if($stmt==false) {
        trigger_error('Wrong SQL: ' . $query . ' Error: ' . $koneksi->error, E_USER_ERROR);
    }
    /*bind parameters*/
    $stmt->bind_param('s',$id);
    if($stmt->execute()) {
         //if saving success
		echo json_encode(array(
			'status' => 'Success',
			'message'=> 'Data Barang Berhasil Dihapus!'
		));

	} else {
	    //if unable to create new record
	    echo json_encode(array(
	    	'status' => 'Error',
	    	//'message'=> 'There has been an error, please try again.'
	    	'message' => "Terjadi kesalahan, mohon coba lagi.<pre>'.$koneksi->error.'</pre><pre>'.$query.'</pre>'"
	    ));
	}
    $koneksi->close();
    
}

if ($action == 'update_barang') {
    $getID = $_POST['id_barang'];
    $namaBarang = $_POST['nama_barang'];
    $hargaBarang = $_POST['harga_barang'];
    $stokBarang = $_POST['stok_barang'];

    // Check if a new image is uploaded
    if (isset($_FILES['gambar_produk']) && $_FILES['gambar_produk']['error'] === UPLOAD_ERR_OK) {
        $uploadedFile = $_FILES['gambar_produk']['tmp_name'];
        $fileExtension = strtolower(pathinfo($_FILES['gambar_produk']['name'], PATHINFO_EXTENSION));
        $newFileName = $getID . '.' . $fileExtension;
        $targetPath = 'img/' . $newFileName;

        // Delete the old image file if it exists
        $oldImageQuery = "SELECT file_gambar FROM data_barang WHERE ID = '$getID'";
        $oldImageResult = mysqli_query($koneksi, $oldImageQuery);
        if ($oldImageResult && mysqli_num_rows($oldImageResult) > 0) {
            $oldImageRow = mysqli_fetch_assoc($oldImageResult);
            $oldImageFilename = $oldImageRow['file_gambar'];
            if ($oldImageFilename) {
                unlink('img/' . $oldImageFilename);
            }
        }

        // Move the new image file
        move_uploaded_file($uploadedFile, $targetPath);

        $query = "UPDATE data_barang SET
            Nama_Barang = '$namaBarang',
            Harga_Barang = $hargaBarang,
            Stok_Barang = $stokBarang,
            file_gambar = '$newFileName'
            WHERE ID='$getID';
        ";
    } else {
        $query = "UPDATE data_barang SET
            Nama_Barang = '$namaBarang',
            Harga_Barang = $hargaBarang,
            Stok_Barang = $stokBarang
            WHERE ID='$getID';
        ";
    }

    $result = mysqli_query($koneksi, $query);
    if ($result) {
        // If saving success
        echo json_encode(array(
            'status' => 'Success',
            'message' => 'Data Barang Berhasil Diubah!'
        ));
    } else {
        // If unable to update record
        echo json_encode(array(
            'status' => 'Error',
            'message' => "Terjadi kesalahan, mohon coba lagi. " . $koneksi->error
        ));
    }
    $koneksi->close();
}

if($action=='edit_user') {
    $getID=$_POST['id_user'];
    $namaUser = $_POST['nama_user'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "UPDATE user_login SET
        Nama = '$namaUser',
        Username = '$username',
        Password = '$password'
        WHERE ID='$getID';
    ";

    $result = mysqli_query($koneksi,$query);
    if($result) {
          //if saving success
		echo json_encode(array(
			'status' => 'Success',
			'message'=> 'Data User Berhasil Diubah!'
		));

	} else {
	    //if unable to create new record
	    echo json_encode(array(
	    	'status' => 'Error',
	    	//'message'=> 'There has been an error, please try again.'
	    	'message' => "Terjadi kesalahan, mohon coba lagi.<pre>'.$koneksi->error.'</pre><pre>'.$query.'</pre>'"
	    ));
	}
    $koneksi->close();
}

if ($action == 'edit_invoice') {
    $id = $_POST['nomor_invoice'];
    // Ambil stok sebelumnya untuk perhitungan selisih qty
    $queryGetStok = "SELECT id_barang, quantity FROM item_penjualan WHERE invoice_id='$id';";
    $resultStok = $koneksi->query($queryGetStok);
    $stokSebelumnya = [];
    while ($rowStok = $resultStok->fetch_assoc()) {
        $stokSebelumnya[$rowStok['id_barang']] = $rowStok['quantity'];
    }

    $query = "DELETE FROM penjualan WHERE ID='$id';";
    $query .= "DELETE FROM item_penjualan WHERE invoice_id='$id';";
    //informasi customer
    $id_pelanggan = $_POST['id_pelanggan'];

    //info Invoice
    $no_invoice = $_POST['nomor_invoice'];
    $tanggal_invoice = $_POST['tanggal_invoice'];
    $finalsubtotal = $_POST['final_subtotal'];
    $finaldiscount = $_POST['final_discount'];
    $shipping = $_POST['shipping'];
    $finalTotal = $_POST['final_total'];
    //tambah invoice ke database
    $query .= "INSERT INTO penjualan (ID,Tanggal_Pembelian
    ,ID_Pelanggan,subtotal,Discount,Ongkos_Kirim,Total)
    VALUES(
        '".$no_invoice."',
        '".$tanggal_invoice."',
        '".$id_pelanggan."',
        '".$finalsubtotal."',
        '".$finaldiscount."',
        '".$shipping."',
        '".$finalTotal."'
    );
    ";

    //Invoice Product Items

    foreach ($_POST['nama_barang'] as $key => $value) {
        $item_product = $value;
        $item_id = $_POST['ID_Barang'][$key];
        $item_qty = $_POST['jumlah_barang'][$key];
        $harga_item = $_POST['harga_produk'][$key];
        $diskon_item = $_POST['diskon_barang'][$key];
        $item_subtotal = $_POST['sub_total'][$key];
        //masukkan product item ke database product item
        $query .= "INSERT INTO item_penjualan
        (invoice_id,id_barang,nama_barang,
        quantity,harga_barang,diskon_barang,
        sub_total_item,tanggal_pembelian)
        VALUES (
        '".$no_invoice."',
        '".$item_id."',
        '".$item_product."',
        '".$item_qty."',
        '".$harga_item."',
        '".$diskon_item."',
        '".$item_subtotal."',
        '".$tanggal_invoice."'
        );
        ";
        //ubah stok barang terkait di tabel data_barang
        $selisihQty = $item_qty - $stokSebelumnya[$item_id];
        $query .= "UPDATE data_barang SET Stok_Barang = Stok_Barang + '".$selisihQty."' WHERE ID = '".$item_id."';";
    }

    //Execute Query
    if ($koneksi->multi_query($query)) {
        //Jika Simpan Berhasil
        echo json_encode(array(
            'status' => 'Berhasil',
            'message' => 'Berhasil Mengubah Data Penjualan'
        ));
    }
    $koneksi->close();
}

if ($action == 'delete_invoice') {
    $deleteID = $_POST["delete"];
    // Ambil stok sebelumnya untuk penambahan stok kembali
    $queryGetStok = "SELECT id_barang, quantity FROM item_penjualan WHERE invoice_id='$deleteID';";
    $resultStok = $koneksi->query($queryGetStok);
    $stokSebelumnya = [];
    while ($rowStok = $resultStok->fetch_assoc()) {
        $stokSebelumnya[$rowStok['id_barang']] = $rowStok['quantity'];
    }

    $Query = "DELETE FROM penjualan WHERE ID ='$deleteID';";
    $Query .= "DELETE FROM item_penjualan WHERE invoice_id ='$deleteID';";
    unlink('listinvoice/PRNT_'.$deleteID.'.pdf');

    // Tambahkan stok kembali ke data_barang
    foreach ($stokSebelumnya as $item_id => $quantity) {
        $Query .= "UPDATE data_barang SET Stok_Barang = Stok_Barang + '".$quantity."' WHERE ID = '".$item_id."';";
    }

    if ($koneksi->multi_query($Query)) {
        //Jika Simpan Berhasil
        echo json_encode(array(
            'status' => 'Berhasil',
            'message' => 'Berhasil Menghapus Data Penjualan'
        ));
    } else {
        echo json_encode(array(
	    	'status' => 'Error',
	    	'message' => "Terjadi kesalahan, mohon coba lagi.<pre>'.$koneksi->error.'</pre><pre>'.$query.'</pre>'"
	    ));
    }
    $koneksi->close();
}

if($action=='login') {
    session_start();
    extract($_POST);
    $username = mysqli_real_escape_string($koneksi,$_POST['username']);
    $pass_encrypt=mysqli_real_escape_string($koneksi,$_POST['password']);
    $query = "SELECT * FROM user_login WHERE Username='$username' and Password = '$pass_encrypt'";
    $results = mysqli_query($koneksi,$query) or die(mysqli_error());
    $count = mysqli_num_rows($results);
    if($count!="") {
		$row = $results->fetch_assoc();

		$_SESSION['login_username'] = $row['Username'];
        $_SESSION['login_position'] = $row['Posisi'];
		echo json_encode(array(
			'status' => 'Success',
            'login_position' => $row['Posisi'],
			'message'=> 'Login was a success! Transfering you to the system now, hold tight!'
		));
    } else {
    	echo json_encode(array(
	    	'status' => 'Error',
	    	//'message'=> 'There has been an error, please try again.'
	    	'message' => 'Login incorrect, does not exist or simply a problem! Try again!'
	    ));
    }
}
?>
