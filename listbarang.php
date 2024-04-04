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
                    <h2>List Data Barang</h2>
                    <hr>
                </div>
                <div class="row">
                <?php getBarang(); ?>
                </div>
                <div id="delete_barang" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content" style="width:720px;">
                        <div class="modal-header">
                        <h4 class="modal-title">Hapus Barang</h4>
                        <div class="modal-body">
                        </div>
                        <p>Yakin Ingin Hapus Barang?</p>
                        </div>
                        <div class="modal-footer">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-primary" id="delete">Delete</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </article>
    </main>
    <?php include 'Parsial/footer.php';?>