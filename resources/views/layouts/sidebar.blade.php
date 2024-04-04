<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset(auth()->user()->profile_photo_path) }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li>
                <a href="">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>

            {{-- Master --}}
            <li class="header">MASTER</li>
            <li>
                <a href="">
                    <i class="fa fa-cube"></i> <span>Kategori</span>
                </a>
            </li>
            <li>
                <a href="">
                    <i class="fa fa-cubes"></i> <span>Produk</span>
                </a>
            </li>

            {{-- Transaksi --}}
            <li class="header">TRANSAKSI</li>
            <li>
                <a href="">
                    <i class="fa fa-cart-arrow-down"></i> <span>Transaksi</span>
                </a>
            </li>

            {{-- Report --}}
            <li class="header">REPORT</li>
            <li>
                <a href="">
                    <i class="fa fa-file-pdf-o"></i> <span>Laporan</span>
                </a>
            </li>

            {{-- System --}}
            <li class="header">SYSTEM</li>
            <li>
                <a href="#">
                    <i class="fa fa-users"></i> <span>User</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-cogs"></i> <span>Setting</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
