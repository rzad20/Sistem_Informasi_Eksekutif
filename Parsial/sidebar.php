<aside id="sidebar">
            <div class="sidebar-menu d-flex flex-column mb-2 flex-shrink-0 p-2">
                <div class="d-flex mt-3 mx-auto logo-image">
                    <img src="img/logo.png">
                    <i id="toggle_sidebar" class="fa-solid fa-bars"></i>
                </div>      
                <ul class="navbar d-flex flex-column align-items-start list-unstyled px-3 fw-semibold text-white">
                <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded"
                        aria-expanded="false">
                        <div class="menu-div d-flex align-items-center fw-semibold text-white">
                        <i class="fa-solid fa-gauge"></i>
                        <a href="index.php" class="text-decoration-none text-white">
                        Dashboard
                        </a>
                        </div>
                        </button>
                    </li>    
                <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded collapsed"
                        data-bs-toggle="collapse" data-bs-target="#pelanggan-collapse"
                        aria-expanded="false">
                        <div class="menu-div d-flex align-items-center fw-semibold text-white">
                        <i class="fa-solid fa-users"></i>
                        Pelanggan
                        </div>
                        </button>
                        <div class="collapse" id="pelanggan-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small px-1 my-1 flex-nowrap">
                                <li class="my-2"><a href="tambahpelanggan.php" class="d-flex sidebar-menu-list text-decoration-none rounded"><i class="fa-solid fa-plus"></i>Tambah Data Pelanggan</a></li>
                                <li class="my-2"><a href="listpelanggan.php" class="sidebar-menu-list text-decoration-none rounded"><i class="fa-solid fa-eye"></i>Lihat Data Pelanggan</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded collapsed"
                        data-bs-toggle="collapse" data-bs-target="#barang-collapse"
                        aria-expanded="false">
                        <div class="menu-div d-flex align-items-center fw-semibold text-white">
                        <i class="fa-solid fa-tag"></i>
                        Barang
                        </div>
                        </button>
                        <div class="collapse" id="barang-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small px-1 my-1 flex-nowrap">
                                <li class="my-2"><a href="tambahbarang.php" class="sidebar-menu-list text-decoration-none rounded"><i class="fa-solid fa-plus"></i>Tambah Data Barang</a></li>
                                <li class="my-2"><a href="listbarang.php" class="sidebar-menu-list text-decoration-none rounded"><i class="fa-solid fa-eye"></i>Lihat Data Barang</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded collapsed"
                        data-bs-toggle="collapse" data-bs-target="#penjualan-collapse"
                        aria-expanded="false">
                        <div class="menu-div d-flex align-items-center fw-semibold text-white">
                        <i class="fa-solid fa-book"></i>
                        Penjualan
                        </div>
                        </button>
                        <div class="collapse" id="penjualan-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small px-1 my-1 flex-nowrap">
                                <li class="my-2"><a href="invoice.php" class="sidebar-menu-list text-decoration-none rounded"><i class="fa-solid fa-plus"></i>Tambah Data Penjualan</a></li>
                                <li class="my-2"><a href="listpenjualan.php" class="sidebar-menu-list text-decoration-none rounded"><i class="fa-solid fa-eye"></i>Lihat Data Penjualan</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded collapsed"
                        data-bs-toggle="collapse" data-bs-target="#laporan-collapse"
                        aria-expanded="false">
                        <div class="menu-div d-flex align-items-center fw-semibold text-white">
                        <i class="fa-solid fa-chart-simple"></i>
                        Laporan Penjualan
                        </div>
                        </button>
                        <div class="collapse" id="laporan-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small px-1 my-1 flex-nowrap">
                                <li class="my-2"><a href="drilldown.php" class="sidebar-menu-list text-decoration-none rounded"><i class="fa-solid fa-plus"></i>Penjualan berdasarkan Item</a></li>
                                <li class="my-2"><a href="omset.php" class="sidebar-menu-list text-decoration-none rounded"><i class="fa-solid fa-eye"></i>Penjualan berdasarkan omset</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded collapsed"
                        data-bs-toggle="collapse" data-bs-target="#userlist-collapse"
                        aria-expanded="false">
                        <div class="menu-div d-flex align-items-center fw-semibold text-white">
                        <i class="fa-solid fa-user"></i>
                        User
                        </div>
                        </button>
                        <div class="collapse" id="userlist-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small px-1 my-1 flex-nowrap">
                                <li class="my-2"><a href="adduser.php" class="sidebar-menu-list text-decoration-none rounded"><i class="fa-solid fa-plus"></i>Tambah User</a></li>
                                <li class="my-2"><a href="listuser.php" class="sidebar-menu-list text-decoration-none rounded"><i class="fa-solid fa-eye"></i>List User</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>     
            </div>
        </aside>
<aside id="sidebar-hidden" class="displaynone">
<div class="sidebar-menu-hidden d-flex flex-column mb-2 flex-shrink-0 p-2">
                <div class="d-flex mt-3 mx-auto logo-image">
                    <img src="img/logo.png">
                    <i id="on_sidebar" class="fa-solid fa-bars"></i>
                </div>      
                <ul class="navbar d-flex flex-column align-items-start list-unstyled px-3 fw-semibold text-white">
                <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded"
                        aria-expanded="false">
                        <div class="menu-div d-flex align-items-center fw-semibold text-white">
                        <i class="fa-solid fa-gauge"></i>
                        <a href="index.php" class="text-decoration-none text-white">
                        </a>
                        </div>
                        </button>
                    </li>    
                <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded collapsed"
                        data-bs-toggle="collapse" data-bs-target="#pelanggan-collapse"
                        aria-expanded="false">
                        <div class="menu-div d-flex align-items-center fw-semibold text-white">
                        <i class="fa-solid fa-users"></i>
                        </div>
                        </button>
                        <div class="collapse" id="pelanggan-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small px-1 my-1 flex-nowrap">
                                <li class="my-2"><a href="tambahpelanggan.php" class="d-flex sidebar-menu-list text-decoration-none rounded"><i class="fa-solid fa-plus"></i></a></li>
                                <li class="my-2"><a href="listpelanggan.php" class="sidebar-menu-list text-decoration-none rounded"><i class="fa-solid fa-eye"></i></a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded collapsed"
                        data-bs-toggle="collapse" data-bs-target="#barang-collapse"
                        aria-expanded="false">
                        <div class="menu-div d-flex align-items-center fw-semibold text-white">
                        <i class="fa-solid fa-tag"></i>
                        </div>
                        </button>
                        <div class="collapse" id="barang-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small px-1 my-1 flex-nowrap">
                                <li class="my-2"><a href="tambahbarang.php" class="sidebar-menu-list text-decoration-none rounded"><i class="fa-solid fa-plus"></i></a></li>
                                <li class="my-2"><a href="listbarang.php" class="sidebar-menu-list text-decoration-none rounded"><i class="fa-solid fa-eye"></i></a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded collapsed"
                        data-bs-toggle="collapse" data-bs-target="#penjualan-collapse"
                        aria-expanded="false">
                        <div class="menu-div d-flex align-items-center fw-semibold text-white">
                        <i class="fa-solid fa-book"></i>
                        </div>
                        </button>
                        <div class="collapse" id="penjualan-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small px-1 my-1 flex-nowrap">
                                <li class="my-2"><a href="invoice.php" class="sidebar-menu-list text-decoration-none rounded"><i class="fa-solid fa-plus"></i></a></li>
                                <li class="my-2"><a href="listpenjualan.php" class="sidebar-menu-list text-decoration-none rounded"><i class="fa-solid fa-eye"></i></a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded collapsed"
                        data-bs-toggle="collapse" data-bs-target="#laporan-collapse"
                        aria-expanded="false">
                        <div class="menu-div d-flex align-items-center fw-semibold text-white">
                        <i class="fa-solid fa-chart-simple"></i>
                        </div>
                        </button>
                        <div class="collapse" id="laporan-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small px-1 my-1 flex-nowrap">
                                <li class="my-2"><a href="drilldown.php" class="sidebar-menu-list text-decoration-none rounded"><i class="fa-solid fa-plus"></i></a></li>
                                <li class="my-2"><a href="omset.php" class="sidebar-menu-list text-decoration-none rounded"><i class="fa-solid fa-eye"></i></a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded collapsed"
                        data-bs-toggle="collapse" data-bs-target="#userlist-collapse"
                        aria-expanded="false">
                        <div class="menu-div d-flex align-items-center fw-semibold text-white">
                        <i class="fa-solid fa-user"></i>
                        </div>
                        </button>
                        <div class="collapse" id="userlist-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small px-1 my-1 flex-nowrap">
                                <li class="my-2"><a href="adduser.php" class="sidebar-menu-list text-decoration-none rounded"><i class="fa-solid fa-plus"></i></a></li>
                                <li class="my-2"><a href="listuser.php" class="sidebar-menu-list text-decoration-none rounded"><i class="fa-solid fa-eye"></i></a></li>
                            </ul>
                        </div>
                    </li>
                </ul>     
            </div>
</aside>