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
                    <h2>Tambah Data Penjualan Baru</h2>
                    <hr>
                </div>
                <div class="row">  
                    <div id="response" class="alert alert-success" style="display:none;">
                        <a href="#" class="close" data-bs-dismiss="alert"><i class="fa-solid fa-circle-xmark"></i></a>
                        <div class="message"></div>
                </div>
                <div class="row">
                        <form class="add-form" method="post" id="invoice_baru">
                        <input type="hidden" name="action" value="invoice_baru">
                        <div class="row gy-2 my-2 align-items-center">
                            <div class="col-lg-3 d-flex flex-row gap-2">
                            <label for="invoice_no" class="col-form-label">#INV.No</label>
                                <input type="text" id="invoice_no" name ="nomor_invoice" value="<?php echo getInvoiceId();?>" class="invoice-form-control" required readonly>
                            </div>
                            <div class="col-lg-3 d-flex flex-row gap-2">
                                <label for="input_tanggal" class="col-form-label">Tanggal</label>
                                <input type="date" id="input_tanggal" name ="tanggal_invoice" placeholder="Tanggal Invoice" class="invoice-form-control" required>
                            </div>
                            <div class="col-lg-3 d-flex flex-row gap-2">
                                <label for="id_pelanggan" class="col-form-label">ID_Pelanggan</label>
                                <input type="text" id="id_pelanggan" name ="id_pelanggan" placeholder="Masukkan ID" class="invoice-form-control" readonly>
                            </div>
                            <div class="col-lg-3">
                                <button type="button" class= "btn btn-primary select_customer" 
                                data-bs-toggle="modal" data-bs-target="#insert_customer">Pilih Pelanggan</h6>
                            </div>
                        </div>
                        <div class="row gy-2 my-2 align-items-center">
                            <div class="col-lg-6 d-flex flex-column gap-2 align-items-start">
                                <div class="d-flex flex-row">
                                    <label for="nama_pelanggan" class="col-form-label">Nama</label>
                                    <input type="text" id="nama_pelanggan" name ="nama_pelanggan" class="invoice-form-control" readonly>
                                </div>
                                <div class="d-flex flex-row">
                                    <label for="alamat_pelanggan" class="col-form-label">Alamat</label>
                                    <textarea id="alamat_pelanggan" name ="alamat_pelanggan" class="py-2 invoice-form-control"  readonly></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6 d-flex flex-column gap-2 align-items-start">
                            <div class="d-flex flex-row">
                                    <label for="nama_kelurahan" class="col-form-label">Kelurahan</label>
                                    <input type="text" id="nama_kelurahan" name ="nama_kelurahan" class="invoice-form-control" readonly>
                                </div>
                                <div class="d-flex flex-row">
                                    <label for="nama_kota" class="col-form-label">Kota</label>
                                    <input type="text" id="nama_kota" name ="nama_kota" class="invoice-form-control" readonly>
                                </div>
                                <div class="d-flex flex-row">
                                    <label for="nama_provinsi" class="col-form-label">Provinsi</label>
                                    <input type="text" id="nama_provinsi" name ="nama_provinsi" class="invoice-form-control"  readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row gy-2 my-2 align-items-center">
                            <table id="add-product-table">

                                <thead>
                                    <th>
                                    <i id="product-add" class="fa-solid fa-plus"></i>
                                        PRODUCT
                                    </th>
                                    <th>GAMBAR PRODUK</th>
                                    <th>QTY</th>
                                    <th>HARGA</th>
                                    <th>DISKON</th>
                                    <th>SUB TOTAL</th>
                                </thead>
                                <tbody id="add-product-body">
                                    <tr id="product-row">
                                        <td>
                                            <div class="d-flex flex-row align-items-center gap-2">
                                            <i id="product-delete" class="fa-solid fa-xmark"></i>
                                            <input type="text" id="nama_barang" name ="nama_barang[]" class="my-2 custom-form-control" 
                                            placeholder="Masukkan Nama Barang"required>
                                            <p class="barang-select"><a href="#" class="text-decoration-none"  data-bs-toggle="modal" data-bs-target="#choose_barang">Pilih Barang</a></p>
                                            </div>
                                        </td>
                                        <td>
                                        <img src="" class="gambar-produk" id="gambar-produk" name="gambar_produk[]" style="max-width: 85px; border-radius: 10px;">
                                        </td>
                                        <td>
                                        <input type="hidden" id="ID_Barang" name="ID_Barang[]"/>
                                        <input type="number" id="jumlah_barang" name ="jumlah_barang[]" class="my-2 calculate custom-form-control" 
                                            placeholder="qty" style="width:80px" required>
                                        </td>
                                        <td>
                                        <div class="d-flex flex-row align-items-center gap-1">
                                        <span class="logo-rp">Rp</span>
                                        <input type="number" id="harga_produk" name ="harga_produk[]" class="my-2 calculate custom-form-control" 
                                            placeholder="0.00" required>
                                        </div>
                                        </td>
                                        
                                        <td>
                                        <input type="text" id="diskon_barang" name ="diskon_barang[]" class="my-2 calculate custom-form-control" 
                                            placeholder="Masukkan % Diskon">
                                        </td>
                                        <td>
                                        <div class="d-flex flex-row align-items-center gap-1">
                                        <span class="logo-rp">Rp</span>
                                        <input type="number" id="invoice_sub_total" name ="sub_total[]" class="my-2 calculate custom-form-control" 
                                            placeholder="0.00" style="width:120px" readonly>
                                        </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                                   <div id="invoice_totals" colspan="4">
                                        <div class="d-flex justify-content-end">
                                        <h6 style="width: 120px">Sub Total : </h6>
                                        <span style= "width: 160px" class="sub-total final_sub_total">Rp.0</span>
                                        <input type="hidden" name="final_subtotal" id="final_subtotal">
                                        </div>
                                        <div class="d-flex justify-content-end">
                                        <h6 style="width: 120px">Diskon : </h6>
                                        <span style= "width: 160px" class="sub-total final_disc">Rp.0</span>
                                        <input type="hidden" name="final_discount" id="final_discount">
                                        </div>
                                        <div class="d-flex justify-content-end">
                                        </div>
                                        <div class="d-flex align-items-center justify-content-end">
                                        <h6 style="width: 120px">Ongkir : </h6>
                                        <span style= "width: 160px" class="sub-total">Rp.
                                        <input type="text" class="custom-form-control calculate ongkir" style="width:100px; height:30px" value="0.00" name="shipping"/>
                                        </span>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                        <h6 style="width: 120px">Total : </h6>
                                        <span style= "width: 160px" class="sub-total final_tot">Rp.0</span>
                                        <input type="hidden" name="final_total" id="final_total">
                                        </div>
                                        <button type="submit" name="submit" class="custom-button" id="create_new_invoice"> Tambah Data </button>
                                    </div>
                        </div>
                            
</form>
                </div>
            </div>
        </article>
        <article>
            
        <div id="choose_barang" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content" style="width:720px;">
                    <div class="modal-header">
                        <h4 class="modal-title">Pilih Barang Yang Sudah Ada</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">    
                        <?php popBarang(); ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <div id="insert_customer" class="modal fade modal-sm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content" style="width:720px;">
                <div class="modal-header">
                    <h4 class="modal-title">Pilih Customer Yang Sudah Ada</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">    
                    <?php popCustomers(); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
        </article>
    </main>
    <?php include 'Parsial/footer.php';?>