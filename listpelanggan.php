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
                    <h2>List Data Pelanggan</h2>
                    <hr>
                </div>
                <div class="row">
                <?php getCustomers(); ?>
                <?php getCustomersMobile(); ?>
                </div>
            </div>
            <div id="delete_customer" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h4 class="modal-title">Hapus Customer</h4>
                        </div>
                        <div class="modal-body">
                        <p>Yakin Ingin Hapus Pelanggan ini?</p>
                        </div>
                        <div class="modal-footer">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-primary" id="delete">Delete</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </main>
    <?php include 'Parsial/footer.php';?>