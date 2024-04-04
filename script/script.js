$(document).ready(function () {
    //load DataTables
    $("#customer-table").dataTable(
       { responsive: true}
    );
    $("#mobile-table").dataTable(
        { responsive: true,
        scrollX: true,
        scrollY: true
        }
     );
    //remove row product
    $('#add-product-body').on('click', "#product-delete", function(e) {
        e.preventDefault();
        $(this).closest('tr').remove();
        calculateTotal();
        });
        
    
    //add row product
    var cloned = $('#product-row:last').clone();
    $("#product-add").click(function(e) {
        e.preventDefault();
        var newIndex = $('.product-row').length + 1; // Menghitung jumlah baris produk
        var clonedRow = cloned.clone(); // Klone baris produk
        var gambar_produk = clonedRow.find('.gambar-produk').data('gambar-produk');
        clonedRow.appendTo('#add-product-body'); // Tambahkan baris ke dalam tabel
    });
    calculateTotal();
    
    $('#add-product-table').on('input','.calculate', function () {
        updateTotals(this);
        calculateTotal();
    });
    
    $('#invoice_totals').on('input', '.calculate', function (){
        calculateTotal();
    })
    
    $(document).on('click', '#btn_login', function (e) {
        e.preventDefault();
        actionLogin();
    });
    
    function actionLogin() {
        var $btn = $("#btn_login").button("loading");
        jQuery.ajax({
            url: 'query.php',
            type: "POST",
            data: $("#login-form").serialize(), // serializes the form's elements.
            dataType: 'json',
            success: function(data){
                $("#response .message").html("<strong>" + data.status + "</strong>: " + data.message);
                $("#response").removeClass("alert-warning").addClass("alert-success").fadeIn();
                $("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
                $btn.button("reset");
    
                if (data.status === 'Success') {
                    // Pengguna berhasil login
                    if (data.login_position === 'Admin') {
                        // Jika posisi adalah "Admin", arahkan ke 'index.php'
                        window.location.href = "index.php";
                    } else if (data.login_position === 'Executive') {
                        // Jika posisi adalah "Executive", arahkan ke 'execindex.php'
                        window.location.href = "excindex.php";
                    }
                }
            },
            error: function(data){
                $("#response .message").html("<strong>" + data.status + "</strong>: " + data.message);
                $("#response").removeClass("alert-success").addClass("alert-warning").fadeIn();
                $("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
                $btn.button("reset");
                console.log(data);
            }
    
        });
    }
    function updateTotals(elem) {
        var tr = $(elem).closest('tr'),
        quantity = $('[name="jumlah_barang[]"]', tr).val(),
        price = $('[name="harga_produk[]"',tr).val() || 0,
        isPercent = $('[name="diskon_barang[]"]', tr).val().indexOf('%') > -1,
        percent = $.trim($('[name="diskon_barang[]"]', tr).val().replace('%','')),
        productsubtotal = parseInt(quantity) * parseFloat(price);
        if(percent && $.isNumeric(percent) && percent !== 0) {
            if(isPercent) {
                productsubtotal = productsubtotal - ((parseFloat(percent)/100) * productsubtotal);
            }
            else {
                productsubtotal = productsubtotal - parseFloat(percent);
            }
        }
        else {
            $('[name="diskon_barang[]"', tr).val('');
        }
        $('#invoice_sub_total', tr).val(productsubtotal.toFixed(2));
    }
    
    function calculateTotal(){
        var GrandTotal = 0;
        var discount = 0;
        var customer_ship = parseInt($('.calculate.ongkir').val()) || 0;
    
        $('#add-product-table tbody tr').each(function () {
            var customer_sub_total = $('#invoice_sub_total', this).val(),
            quantity = $('[name="jumlah_barang[]"]', this).val(),
            price = $('[name="harga_produk[]"]',this).val() || 0,
            productsubtotal = parseInt(quantity) * parseFloat(price);
        GrandTotal += parseFloat(customer_sub_total);
        console.log(GrandTotal);
        console.log(customer_sub_total);
        discount += productsubtotal - parseFloat(customer_sub_total);
        });
        var subtotal = parseFloat(GrandTotal),
        finalTotal = parseFloat(GrandTotal + customer_ship);
        $('.final_sub_total').text("Rp. " + subtotal.toFixed(2));
        $('#final_subtotal').val(subtotal.toFixed(2));
        $('.final_disc').text("Rp. " + discount.toFixed(2));
        $('#final_discount').val(discount.toFixed(2));
        $('.final_tot').text("Rp. " + (finalTotal).toFixed(2));
        $('#final_total').val((finalTotal).toFixed(2));
        
    }
    
    
    $(document).on('click', ".customer-select" ,function(e) {
        var customer_id = $(this).attr('customer_ID');
        var customer_name = $(this).attr('customer_name');
        var customer_address = $(this).attr('customer_address');
        var customer_city = $(this).attr('customer_city');
        var customer_kel = $(this).attr('customer_kel');
        var customer_prov = $(this).attr('customer_prov');
    
        $('#id_pelanggan').val(customer_id);
        $('#nama_pelanggan').val(customer_name);
        $('#alamat_pelanggan').val(customer_address);
        $('#nama_kelurahan').val(customer_kel);
        $('#nama_kota').val(customer_city);
        $('#nama_provinsi').val(customer_prov);
        $('#insert_customer').modal('hide');
        
    
    });
    function getGambarProdukPath(idBarang) {
        // Kode untuk mengambil path gambar berdasarkan ID barang
        // Misalnya, jika gambar berada di folder 'img' dan bernama 'produk_ID.jpg'
        return 'img/' + idBarang + '.jpg';
    }
    $(document).on('click', ".barang-select" ,function(e) {
        e.preventDefault();
        var product = $(this);
        $('#choose_barang').modal({backdrop:'static', keyboard: false}).one('click','.selected',function(e) {
        var ID_Barang = $(this).attr('barang_ID');
        var nama_barang = $(this).attr('nama_barang');
        var harga_barang = $(this).attr('harga_barang');
        var gambar_produk = $(this).attr('gambar_produk');
        $(product).closest('tr').find('input[name="ID_Barang[]"]').val(ID_Barang);
        $(product).closest('tr').find('input[name="nama_barang[]"').val(nama_barang);
        $(product).closest('tr').find('input[name="harga_produk[]"').val(harga_barang);
        $(product).closest('tr').find('img[name="gambar_produk[]"').attr('src', getGambarProdukPath(ID_Barang));
        $('#choose_barang').modal('hide');
    });
    return false
    
    });
    
    //HAPUS CUSTOMER
    $(document).on('click',".delete-customer", function(e){
        e.preventDefault();
        var userId = 'action=delete_customer&delete='+ $(this).attr('data-customer-id');
        var user = $(this);
        $('#delete_customer').modal({backdrop: 'static', keyboard: false}).one('click','#delete', function(){
            deleteCustomer(userId);
            $(user).closest('tr').remove();
        });
    });
    
    //HAPUS INVOICE
    $(document).on('click',".delete-invoice", function(e){
        e.preventDefault();
        var invoiceId = 'action=delete_invoice&delete='+ $(this).attr('data-invoice-id');
        var invoice = $(this);
        $('#deleteinvoice').modal({backdrop: 'static', keyboard: false}).one('click','#delete', function(){
            deleteInvoice(invoiceId);
            $(invoice).closest('tr').remove();
        });
    });
    
    //HAPUS BARANG
    $(document).on('click',".delete-barang", function(e){
        e.preventDefault();
        var productId = 'action=delete_barang&delete='+ $(this).attr('data-barang-id');
        var product = $(this);
        $('#delete_barang').modal({backdrop: 'static', keyboard: false}).one('click','#delete', function(){
            deleteBarang(productId);
            $(product).closest('tr').remove();
        });
    });
    
    $("#create_new_invoice").click(function(e) {
        e.preventDefault();
        actionCreateInvoice();
    });
    $("#action_customer_baru").click(function(e) {
        e.preventDefault();
        actionCustomerBaru();
    });
    
    $("#action_edit_customer").click(function(e) {
        e.preventDefault();
        updateCustomer();
    });
    
    $("#action_edit_barang").click(function(e) {
        e.preventDefault();
        updateBarang();
    });
    
    $("#action_edit_user").click(function(e) {
        e.preventDefault();
        updateUser();
    });
    
    $("#action_add_user").click(function(e) {
        e.preventDefault();
        addUserBaru();
    });
    
    $("#toggle_sidebar").click(function(e) {
        e.preventDefault();
        $("#sidebar").toggleClass('displaynone');
        $("#sidebar-hidden").removeClass('displaynone');
        $("main article").css({"margin-left": "20px"});
    });
    
    $("#on_sidebar").click(function(e) {
        e.preventDefault();
        $("#sidebar").removeClass('displaynone');
        $("#sidebar-hidden").toggleClass('displaynone');
        $("main article").css({"margin-left": "300px"});
    });
    
    $("#toggle_sidebar_mobile").click(function(e) {
        e.preventDefault();
        $("#sidebar").removeClass('displaynone');
        $("#sidebar-hidden").toggleClass('displaynone');
    });
    function updateMarginLeft() {
        if (!$("#sidebar").hasClass('displaynone')) {
            $("main article").css({"margin-left": "300px"});
        } else if (!$("#sidebar-hidden").hasClass('displaynone')) {
            $("main article").css({"margin-left": "20px"});
        } else {
            // Mode responsif, kedua sidebar disembunyikan
            $("main article").css({"margin-left": "100px"});
        }
    }
    
    $(document).ready(function() {
        updateMarginLeft();
    });
    
    $(window).resize(function() {
        updateMarginLeft();
    });
    
    $(document).on('click', "#action_edit_invoice", function(e){
        e.preventDefault();
        updateInvoice();
    });
    function actionCreateInvoice() {
        $.ajax({
            method: 'POST',
            url: 'query.php',
            data: $("#invoice_baru").serialize(),
            dataType: 'json',
            success: function (data) {
                $('#response .message').html("<strong>" + data.message + "</strong>");
                $("#response").removeClass("alert-warning").addClass("alert-success").fadeIn();
                $("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
                $("#invoice_baru").before("<a href='invoice.php' class='btn btn-primary'>Tambah Data Penjualan Baru</a>");
                $("#invoice_baru").remove();
                //check if any product has zero or negative 
                var zeroStockProduct = false;
                $(".jumlah_barang").each(function() {
                    var qty = parseInt($(this).val());
                    if (qty<=0) {
                        zeroStockProduct = true;
                        return false;
                    }
                });
                if (zeroStockProduct) {
                    $('#response .message').html("<strong>Ada produk dengan stok yang habis!</strong>");
                    $("#response").removeClass("alert-success").addClass("alert-warning").fadeIn();
                    $("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
                } else {
                    // Continue with the success flow
                    $('#response .message').html("<strong>" + data.message + "</strong>");
                    $("#response").removeClass("alert-warning").addClass("alert-success").fadeIn();
                    $("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
                    $("#invoice_baru").before("<a href='invoice.php' class='btn btn-primary'>Tambah Data Penjualan Baru</a>");
                    $("#invoice_baru").remove();
                }
            },
            error: function (data) {
                $('#response .message').html("<strong> Gagal Tambah Data </strong>");
            }
        });
    }
    
    
    function addUserBaru(){
        $.ajax ({
            method: 'POST',
            url:'query.php',
            data: $("#user_baru").serialize(),
            dataType: 'json',
            success : function(data){
                $('#response .message').html("<strong>"  + data.message + "</strong>");
                $("#response").removeClass("alert-warning").addClass("alert-success").fadeIn();
                $("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
                $("#user_baru").before().html("<a href='invoice.php' class='btn btn-primary'>Tambah Data Penjualan Baru</a>");
                $("#user_baru").remove();
                
            },
                error:function(data) {
                $('#response .message').html("<strong> Gagal Tambah Data </strong>");
                
            }
        })
    }
    function actionCustomerBaru(){
        var $btn = $('#action_customer_baru').button("loading");
        $.ajax({
            method:'POST',
            url:'query.php',
            data: $("#customer_baru").serialize(),
            dataType: 'json',
            success: function(data) {
                $('#response .message').html("<strong>"  + data.message + "</strong>");
                $("#response").removeClass("alert-warning").addClass("alert-success").fadeIn();
                $("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
                $("#customer_baru").append("<a href='tambahpelanggan.php' class='btn btn-primary'>Tambah Data Pelanggan Baru</a>");
                $("#customer_baru").remove();
                $btn.button("reset");
            },
            error: function(data){
                    $('#response .message').html("<strong> Gagal Tambah Data </strong>");
            }
        });
    }
    
    function updateCustomer(){
        $.ajax({
            method:'POST',
            url:'query.php',
            data: $("#update_customer").serialize(),
            dataType: 'json',
            success: function(data) {
                $('#response .message').html("<strong>"  + data.message + "</strong>");
                $("#response").removeClass("alert-warning").addClass("alert-success").fadeIn();
                $("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
                $("#update_customer").append("<a href='listpelanggan.php' class='btn btn-primary'>Lihat Data Pelanggan</a>");
                $("#update_customer").remove();
            },
            error: function(data){
                    $('#response .message').html("<strong> Gagal Tambah Data </strong>");
            }
        });
    }
    
    function updateBarang(){
        $.ajax({
            method:'POST',
            url:'query.php',
            data: $("#update_barang").serialize(),
            dataType: 'json',
            success: function(data) {
                $('#response .message').html("<strong>"  + data.message + "</strong>");
                $("#response").removeClass("alert-warning").addClass("alert-success").fadeIn();
                $("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
                $("#update_barang").append("<a href='listbarang.php' class='btn btn-primary'>Lihat Data Barang</a>");
                $("#update_barang").remove();
            },
            error: function(data){
                    $('#response .message').html("<strong> Gagal Tambah Data </strong>");
                    console.log(data);
            }
        });
    }
    
    function updateInvoice() {
        $.ajax({
            method:'POST',
            url:'query.php',
            data: $("#edit_invoice").serialize(),
            dataType: 'json', 
            success: function(data){
                $("#response .message").html("<strong>" + data.status + "</strong>: " + data.message);
                $("#response").removeClass("alert-warning").addClass("alert-success").fadeIn();
                $("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
                $("#edit_invoice").before().html("<a href='invoice.php' class='btn btn-primary'>lihat data penjualan</a>");
                $("#edit_invoice").remove();
                console.log(data);
            },
            error: function(data){
                $("#response .message").html("<strong>" + data.status + "</strong>: " + data.message);
                console.log(data);
            } 
        });
    
    }
    
    function updateUser() {
        $.ajax({
            method:'POST',
            url:'query.php',
            data: $("#edit_user").serialize(),
            dataType: 'json', 
            success: function(data){
                $("#response .message").html("<strong>" + data.status + "</strong>: " + data.message);
                $("#response").removeClass("alert-warning").addClass("alert-success").fadeIn();
                $("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
                $("#edit_user").before().html("<a href='listuser.php' class='btn btn-primary'>lihat data user</a>");
                $("#edit_user").remove();
                console.log(data);
            },
            error: function(data){
                $("#response .message").html("<strong>" + data.status + "</strong>: " + data.message);
                console.log(data);
            } 
        });
    
    }
    function deleteCustomer(userId) {
    
        jQuery.ajax({
    
            url: 'query.php',
            type: 'POST', 
            data: userId,
            dataType: 'json', 
            success: function(data){
                $("#response .message").html("<strong>" + data.status + "</strong>: " + data.message);
                $("#response").removeClass("alert-warning").addClass("alert-success").fadeIn();
                $("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
            },
            error: function(data){
                $("#response .message").html("<strong>" + data.status + "</strong>: " + data.message);
                $("#response").removeClass("alert-success").addClass("alert-warning").fadeIn();
                $("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
            } 
        });
    }
    
    function deleteInvoice(invoiceId) {
    
        jQuery.ajax({
    
            url: 'query.php',
            type: 'POST', 
            data: invoiceId,
            dataType: 'json', 
            success: function(data){
                $("#response .message").html("<strong>" + data.status + "</strong>: " + data.message);
                $("#response").removeClass("alert-warning").addClass("alert-success").fadeIn();
                console.log(data);
            },
            error: function(data){
                $("#response .message").html("<strong>" + data.status + "</strong>: " + data.message);
                $("#response").removeClass("alert-success").addClass("alert-warning").fadeIn();
                console.log(data);
            } 
        });
    }
    
    function deleteBarang(productId) {
    
        jQuery.ajax({
    
            url: 'query.php',
            type: 'POST', 
            data: productId,
            dataType: 'json', 
            success: function(data){
                $("#response .message").html("<strong>" + data.status + "</strong>: " + data.message);
                $("#response").removeClass("alert-warning").addClass("alert-success").fadeIn();
                $("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
            },
            error: function(data){
                $("#response .message").html("<strong>" + data.status + "</strong>: " + data.message);
                $("#response").removeClass("alert-success").addClass("alert-warning").fadeIn();
                $("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
            } 
        });
    }
    var terjual_chart;
    function fetch_data(start_date='', end_date='') {
        var dataTable = $("#report_table").DataTable({
            "processing" : true,
            "serverSide" : true,
            "order" : [],
            "ajax" : {
                url: "query.php",
                type: "POST",
                data: {action:'fetch_report', start_date:start_date, end_date:end_date }
            },
            "drawCallback" : function(settings) {
                var namaBarang = [];
                var totalTerjual = [];
                for(var count = 0; count < settings.aoData.length; count++)
                {
                    namaBarang.push(settings.aoData[count]._aData[1]);
                    totalTerjual.push(parseFloat(settings.aoData[count]._aData[2]));
                }
                var colors = [];
                for (var i = 0; i < namaBarang.length; i++) {
                    var hue = (i * 137.508) % 360; // Menghasilkan nilai hue yang berbeda
                    var color = "hsl(" + hue + ", 75%, 50%)"; // Konversi ke format hsl
                    colors.push(color);
                }
                var chart_data = {
                    labels: namaBarang,
                    datasets : [
                        {
                            label: 'Total Terjual',
                            backgroundColor : colors,
                            color: '#fff',
                            data: totalTerjual
                        }
                    ]
                };

                var chartTypeElement = document.getElementById('chartType');
                if (chartTypeElement) {
                    var selectedChartType = chartTypeElement.value; // Ambil tipe grafik dari combobox
                }
                
                var group_chart = $('#myChart');
                if(terjual_chart) {
                    terjual_chart.destroy();
                }
                terjual_chart = new Chart(group_chart, {
                    type: selectedChartType, // Menggunakan jenis grafik sesuai nilai terpilih
                    data: chart_data
                });
            }
        });
    }
    
    
    function fetch_data2(start_date='', end_date='') {
        var dataTable = $("#omset_table").DataTable({
            "processing" : true,
            "serverSide" : true,
            "order" : [],
            "ajax" : {
                url: "query.php",
                type: "POST",
                data: {action:'fetch_omset', start_date:start_date, end_date:end_date }
            },
            "drawCallback" : function(settings) {
                var namaBarang = [];
                var totalTerjual = [];
                for(var count = 0; count < settings.aoData.length; count++)
                {
                    namaBarang.push(settings.aoData[count]._aData[1]);
                    totalTerjual.push(parseFloat(settings.aoData[count]._aData[2]));
                }
                var colors = [];
                for (var i = 0; i < namaBarang.length; i++) {
                    var hue = (i * 137.508) % 360; // Menghasilkan nilai hue yang berbeda
                    var color = "hsl(" + hue + ", 75%, 50%)"; // Konversi ke format hsl
                    colors.push(color);
                }
                var chart_data = {
                    labels: namaBarang,
                    datasets : [
                        {
                            label: 'Total Terjual',
                            backgroundColor : colors,
                            color: '#fff',
                            data: totalTerjual
                        }
                    ]
                };

                var chartTypeElement = document.getElementById('chartType');
                if (chartTypeElement) {
                    var selectedChartType = chartTypeElement.value; // Ambil tipe grafik dari combobox
                }
                
                var group_chart = $('#omsetChart');
                if(terjual_chart) {
                    terjual_chart.destroy();
                }
                terjual_chart = new Chart(group_chart, {
                    type: selectedChartType,
                    data: chart_data
                });
            }
        });
    }
    $('#filter_tanggal').daterangepicker({
        ranges:{
            'Today' : [moment(), moment()],
            'Yesterday' : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
            'Last 30 Days' : [moment().subtract(29, 'days'), moment()],
            'This Month' : [moment().startOf('month'), moment().endOf('month')],
            'Last Month' : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        format : 'YYYY-MM-DD'
    }, function(start, end){
        $('#report_table').DataTable().destroy();
        fetch_data(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
    });
    
    $('#filter_tanggal2').daterangepicker({
        ranges:{
            'Today' : [moment(), moment()],
            'Yesterday' : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
            'Last 30 Days' : [moment().subtract(29, 'days'), moment()],
            'This Month' : [moment().startOf('month'), moment().endOf('month')],
            'Last Month' : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        format : 'YYYY-MM-DD'
    }, function(start, end){
        $('#omset_table').DataTable().destroy();
        fetch_data2(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
    });
    $('#printButton').click(function() {
        window.jsPDF = window.jspdf.jsPDF;
        var filterTanggal = $('#filter_tanggal').val();
        var chartCanvas = document.getElementById('myChart');
        var table = document.getElementById('report_table');
        
        var pdf = new jsPDF();
        pdf.setFontSize(16);
        var pageTitle = "Laporan Penjualan";
        var pageWidth = pdf.internal.pageSize.width;
        
        // Mengukur lebar judul dan mengatur posisi rata tengah
        var titleWidth = pdf.getStringUnitWidth(pageTitle) * pdf.internal.getFontSize() / pdf.internal.scaleFactor;
        var titleX = (pageWidth - titleWidth) / 2;
        pdf.text(titleX, 15, pageTitle);
        
        pdf.setFontSize(12);
        var periodText = "Periode " + filterTanggal;
        var periodWidth = pdf.getStringUnitWidth(periodText) * pdf.internal.getFontSize() / pdf.internal.scaleFactor;
        var periodX = (pageWidth - periodWidth) / 2;
        pdf.text(periodX, 25, periodText);
        
        // Cetak grafik dalam PDF menggunakan data URL
        var canvasDataURL = chartCanvas.toDataURL('image/png', 1.0);
        pdf.addImage(canvasDataURL, 'PNG', 15, 35, 180, 100);
        
        // Cetak tabel dalam PDF menggunakan AutoTable
        var tableRows = [];
        
        $('#report_table tbody tr').each(function() {
            var rowData = [];
            $(this).find('td').each(function() {
                rowData.push($(this).text());
            });
            tableRows.push(rowData);
        });
        
        var columns = [
            { title: "ID Barang" },
            { title: "Nama Barang" },
            { title: "Total Terjual" }
        ];
        
        pdf.autoTable({
            head: [columns],
            body: tableRows,
            startY: 150,
            theme: 'grid',
            didDrawCell: function(data) {
                if (data.row.index === 0) {
                    data.cell.styles.fillColor = [0, 123, 255];
                    data.cell.styles.textColor = 255;
                }
            }
        });
        
        // Simpan atau tampilkan PDF
        pdf.save('laporan_penjualan.pdf');
    });
    $('#printButton2').click(function() {
        window.jsPDF = window.jspdf.jsPDF;
        var filterTanggal = $('#filter_tanggal2').val();
        var chartCanvas = document.getElementById('omsetChart');
        var table = document.getElementById('omset_table');
        
        var pdf = new jsPDF();
        pdf.setFontSize(16);
        var pageTitle = "Laporan Penjualan";
        var pageWidth = pdf.internal.pageSize.width;
        
        // Mengukur lebar judul dan mengatur posisi rata tengah
        var titleWidth = pdf.getStringUnitWidth(pageTitle) * pdf.internal.getFontSize() / pdf.internal.scaleFactor;
        var titleX = (pageWidth - titleWidth) / 2;
        pdf.text(titleX, 15, pageTitle);
        
        pdf.setFontSize(12);
        var periodText = "Periode " + filterTanggal;
        var periodWidth = pdf.getStringUnitWidth(periodText) * pdf.internal.getFontSize() / pdf.internal.scaleFactor;
        var periodX = (pageWidth - periodWidth) / 2;
        pdf.text(periodX, 25, periodText);
        
        // Cetak grafik dalam PDF menggunakan data URL
        var canvasDataURL = chartCanvas.toDataURL('image/png', 1.0);
        pdf.addImage(canvasDataURL, 'PNG', 15, 35, 180, 100);
        
        // Cetak tabel dalam PDF menggunakan AutoTable
        var tableRows = [];
        
        $('#omset_table tbody tr').each(function() {
            var rowData = [];
            $(this).find('td').each(function() {
                rowData.push($(this).text());
            });
            tableRows.push(rowData);
        });
        
        var columns = [
            { title: "ID Barang" },
            { title: "Nama Barang" },
            { title: "Total Terjual" }
        ];
        
        pdf.autoTable({
            head: [columns],
            body: tableRows,
            startY: 150,
            theme: 'grid',
            didDrawCell: function(data) {
                if (data.row.index === 0) {
                    data.cell.styles.fillColor = [0, 123, 255];
                    data.cell.styles.textColor = 255;
                }
            }
        });
        
        // Simpan atau tampilkan PDF
        pdf.save('laporan_penjualan.pdf');
    });
    
    
    });