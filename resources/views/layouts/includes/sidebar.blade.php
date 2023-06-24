 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-light-primary elevation-4">
     <!-- Brand Logo -->
     <a href="{{ route('dashboard') }}" class="brand-link">
         <img src="" alt="Ivan's Cloth" class="brand-image img-circle elevation-3" style="opacity: .8">
         <span class="brand-text font-weight-light">Ivan's Cloth</span>
     </a>

     <!-- Sidebar -->
     <div class="sidebar">
         <!-- Sidebar user panel (optional) -->
         <div class="user-panel mt-3 pb-3 mb-3 d-flex">
             <div class="image">
                 <img src="{{ Auth::user()->getImage() }}" class="img-circle elevation-2" alt="User Image">
             </div>
             <div class="info">
                 <a href="" class="d-block">{{ Auth::user()->username }}</a>
             </div>
         </div>

         <!-- Sidebar Menu -->
         @if (Auth::user()->role_id == 1)
             <nav class="mt-2">
                 <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                     data-accordion="false">
                     <li class="nav-item">
                         <a href="{{ route('dashboard') }}"
                             class="nav-link {{ request()->is('dashboard') ? ' active' : '' }}">
                             <i class="nav-icon fas fa-tachometer-alt"></i>
                             <p>
                                 Dashboard
                             </p>
                         </a>
                     </li>
                     <li class="nav-header">MASTER</li>
                     <li class="nav-item">
                         <a href="{{ route('ukuran') }}" class="nav-link {{ request()->is('ukuran') ? ' active' : '' }}">
                             <i class="nav-icon fas fa-box"></i>
                             <p>
                                 Ukuran
                             </p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="{{ route('gaji') }}" class="nav-link {{ request()->is('gaji') ? ' active' : '' }}">
                             <i class="nav-icon fas fa-box"></i>
                             <p>
                                 Gaji
                             </p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="{{ route('perlengkapan') }}"
                             class="nav-link {{ request()->is('perlengkapan') ? ' active' : '' }}">
                             <i class="nav-icon fas fa-pencil-ruler"></i>
                             <p>
                                 Perlengkapan
                             </p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="{{ route('karyawan') }}"
                             class="nav-link {{ request()->is('karyawan') ? ' active' : '' }}">
                             <i class="nav-icon fas fa-users"></i>
                             <p>
                                 Karyawan
                             </p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="{{ route('aset') }}" class="nav-link {{ request()->is('aset') ? ' active' : '' }}">
                             <i class="nav-icon fas fa-cubes"></i>
                             <p>
                                 Aset
                             </p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="{{ route('filmSablon') }}" class="nav-link {{ request()->is('Film-Sablon') ? ' active' : '' }}">
                             <i class="nav-icon fas fa-film"></i>
                             <p>
                                 Film Sablon
                             </p>
                         </a>
                     </li>
                     <li class="nav-header">Stok Barang</li>
                     <li class="nav-item">
                         <a href="{{ route('kain_roll') }}"
                             class="nav-link {{ request()->is('kain-roll') ? ' active' : '' }}">
                             <i class="nav-icon fas fa-scroll"></i>
                             <p>
                                 Kain Roll
                             </p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="{{ route('kain_potongan') }}" class="nav-link {{ request()->is('kain-potongan') ? ' active' : '' }}">
                             <i class="nav-icon fas fa-cut"></i>
                             <p>
                                 Kain Potongan
                             </p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="{{ route('barang_jadi') }}" class="nav-link {{ request()->is('barang-jadi') || request()->is('barang-jadi/*') ? ' active' : '' }}">
                             <i class="nav-icon fas fa-tshirt"></i>
                             <p>
                                 Barang Jadi
                             </p>
                         </a>
                     </li>
                     <!-- <li class="nav-item">
                         <a href="#" class="nav-link">
                             <i class="nav-icon fas fa-warehouse"></i>
                             <p>
                                 Stok
                             </p>
                         </a>
                     </li> -->
                     <li class="nav-header">Surat Perintah</li>
                     <li class="nav-item">
                         <a href="{{ route('spp') }}" class="nav-link {{ request()->is('surat-perintah-potong') || request()->is('surat-perintah-potong/*') ? ' active' : '' }}">
                             <i class="nav-icon fas fa-cut"></i>
                             <p>
                                 SPP (Potong)
                             </p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="{{ route('spk') }}" class="nav-link {{ request()->is('surat-perintah-kerja') || request()->is('surat-perintah-kerja/*') ? ' active' : '' }}">
                             <i class="nav-icon fas fa-palette"></i>
                             <p>
                                 SPK (Sablon)
                             </p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="{{ route('jahit') }}" class="nav-link {{ request()->is('jahit') || request()->is('jahit/*') ? ' active' : '' }}">
                             <i class="nav-icon fas fa-layer-group"></i>
                             <p>
                                 Jahit
                             </p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="{{ route('finishing') }}" class="nav-link {{ request()->is('finishing') || request()->is('finishing/*') ? ' active' : '' }}">
                             <i class="nav-icon fas fa-clipboard-list"></i>
                             <p>
                                 Finishing
                             </p>
                         </a>
                     </li>
                     <li class="nav-header">Keuangan</li>
                     <li class="nav-item">
                         <a href="{{ route('pemasukkan') }}" class="nav-link {{ request()->is('pemasukkan') || request()->is('pemasukkan/*') ? ' active' : '' }}">
                             <i class="nav-icon fas fa-chart-line"></i>
                             <p>
                                 Pemasukkan
                             </p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="{{ route('pengeluaran') }}" class="nav-link {{ request()->is('pengeluaran') || request()->is('pengeluaran/*') ? ' active' : '' }}">
                             <i class="nav-icon fas fa-receipt"></i>
                             <p>
                                 Pengeluaran
                             </p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="{{ route('tgaji') }}" class="nav-link {{ request()->is('pengeluaran-gaji') || request()->is('pengeluaran-gaji/*') ? ' active' : '' }}">
                             <i class="nav-icon fas fa-money-bill"></i>
                             <p>
                                 Pengeluaran Gaji
                             </p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="#" class="nav-link">
                             <i class="nav-icon fas fa-money-bill"></i>
                             <p>
                                 Laba
                             </p>
                         </a>
                     </li>
                 </ul>
             </nav>
         @elseif(Auth::user()->role_id == 2)
             <nav class="mt-2">
                 <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                     data-accordion="false">
                     <li class="nav-item">
                         <a href="{{ route('dashboard') }}"
                             class="nav-link {{ request()->is('dashboard') ? ' active' : '' }}">
                             <i class="nav-icon fas fa-tachometer-alt"></i>
                             <p>
                                 Dashboard
                             </p>
                         </a>
                     </li>
                     <li class="nav-header">Surat Perintah</li>
                     <li class="nav-item">
                         <a href="{{ route('a.spp') }}" class="nav-link {{ request()->is('surat-perintah-potong') || request()->is('surat-perintah-potong/*') ? ' active' : '' }}">
                             <i class="nav-icon fas fa-cut"></i>
                             <p>
                                 SPP (Potong)
                             </p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="{{ route('a.spk') }}" class="nav-link {{ request()->is('surat-perintah-kerja') || request()->is('surat-perintah-kerja/*') ? ' active' : '' }}">
                             <i class="nav-icon fas fa-palette"></i>
                             <p>
                                 SPK (Sablon)
                             </p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="{{ route('a.jahit') }}" class="nav-link {{ request()->is('jahit') || request()->is('jahit/*') ? ' active' : '' }}">
                             <i class="nav-icon fas fa-layer-group"></i>
                             <p>
                                 Jahit
                             </p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="{{ route('a.finishing') }}" class="nav-link {{ request()->is('finishing') || request()->is('finishing/*') ? ' active' : '' }}">
                             <i class="nav-icon fas fa-clipboard-list"></i>
                             <p>
                                 Finishing
                             </p>
                         </a>
                     </li>
                     <li class="nav-header">Keuangan</li>
                     <li class="nav-item">
                         <a href="{{ route('a.pemasukkan') }}" class="nav-link {{ request()->is('pemasukkan') || request()->is('pemasukkan/*') ? ' active' : '' }}">
                             <i class="nav-icon fas fa-chart-line"></i>
                             <p>
                                 Pemasukkan
                             </p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="{{ route('a.pengeluaran') }}" class="nav-link {{ request()->is('pengeluaran') || request()->is('pengeluaran/*') ? ' active' : '' }}">
                             <i class="nav-icon fas fa-receipt"></i>
                             <p>
                                 Pengeluaran
                             </p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="{{ route('a.tgaji') }}" class="nav-link {{ request()->is('pengeluaran-gaji') || request()->is('pengeluaran-gaji/*') ? ' active' : '' }}">
                             <i class="nav-icon fas fa-money-bill"></i>
                             <p>
                                 Pengeluaran Gaji
                             </p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="#" class="nav-link">
                             <i class="nav-icon fas fa-money-bill"></i>
                             <p>
                                 Laba
                             </p>
                         </a>
                     </li>
                 </ul>
             </nav>
         @elseif(Auth::user()->role_id == 3)
             <nav class="mt-2">
                 <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                     data-accordion="false">
                     <li class="nav-item">
                         <a href="{{ route('dashboard') }}"
                             class="nav-link {{ request()->is('dashboard') ? ' active' : '' }}">
                             <i class="nav-icon fas fa-tachometer-alt"></i>
                             <p>
                                 Dashboard
                             </p>
                         </a>
                     </li>
                     <li class="nav-header">MASTER</li>
                     <!-- <li class="nav-item">
                         <a href="#" class="nav-link">
                             <i class="nav-icon fas fa-film"></i>
                             <p>
                                 Film Sablon
                             </p>
                         </a>
                     </li> -->
                     <li class="nav-header">Stok Barang</li>
                     <li class="nav-item">
                         <a href="{{ route('w.kain_roll') }}"
                             class="nav-link {{ request()->is('kain-roll') ? ' active' : '' }}">
                             <i class="nav-icon fas fa-scroll"></i>
                             <p>
                                 Kain Roll
                             </p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="{{ route('w.kain_potongan') }}" class="nav-link {{ request()->is('kain-potongan') ? ' active' : '' }}">
                             <i class="nav-icon fas fa-cut"></i>
                             <p>
                                 Kain Potongan
                             </p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="{{ route('w.barang_jadi') }}" class="nav-link {{ request()->is('barang-jadi') ? ' active' : '' }}">
                             <i class="nav-icon fas fa-tshirt"></i>
                             <p>
                                 Barang Jadi
                             </p>
                         </a>
                     </li>
                     <!-- <li class="nav-item">
                         <a href="#" class="nav-link">
                             <i class="nav-icon fas fa-warehouse"></i>
                             <p>
                                 Stok
                             </p>
                         </a>
                     </li> -->
                     <li class="nav-header">Surat Perintah</li>
                     <li class="nav-item">
                         <a href="{{ route('w.spp') }}" class="nav-link {{ request()->is('surat-perintah-potong') || request()->is('surat-perintah-potong/*') ? ' active' : '' }}">
                             <i class="nav-icon fas fa-cut"></i>
                             <p>
                                 SPP (Potong)
                             </p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="{{ route('w.spk') }}" class="nav-link {{ request()->is('surat-perintah-kerja') || request()->is('surat-perintah-kerja/*') ? ' active' : '' }}">
                             <i class="nav-icon fas fa-palette"></i>
                             <p>
                                 SPK (Sablon)
                             </p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="{{ route('w.jahit') }}" class="nav-link {{ request()->is('jahit') ? ' active' : '' }}">
                             <i class="nav-icon fas fa-layer-group"></i>
                             <p>
                                 Jahit
                             </p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="{{ route('w.finishing') }}" class="nav-link {{ request()->is('finishing') ? ' active' : '' }}">
                             <i class="nav-icon fas fa-clipboard-list"></i>
                             <p>
                                 Finishing
                             </p>
                         </a>
                     </li>
                 </ul>
             </nav>
         @endif
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>
