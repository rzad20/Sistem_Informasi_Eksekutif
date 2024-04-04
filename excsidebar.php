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
                        <a href="excindex.php" class="text-decoration-none text-white">
                        Dashboard
                        </a>
                        </div>
                        </button>
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
                                <li class="my-2"><a href="excdrilldown.php" class="sidebar-menu-list text-decoration-none rounded"><i class="fa-solid fa-plus"></i>Penjualan berdasarkan Item</a></li>
                                <li class="my-2"><a href="excomset.php" class="sidebar-menu-list text-decoration-none rounded"><i class="fa-solid fa-eye"></i>Penjualan berdasarkan omset</a></li>
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
                </ul>     
            </div>
</aside>