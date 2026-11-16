<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        @php
            $role = Auth::user()->role;

            // Untuk peminjam, "Peminjaman Saya" tidak ikut aktif saat di halaman ajukan
            $aktifPeminjaman = $role === 'peminjam'
                ? request()->is('peminjaman')
                : request()->is('peminjaman*');
        @endphp

        {{-- ===== DASHBOARD (semua role) ===== --}}
        <li class="nav-item">
            <a href="{{ route('dashboard.index') }}"
                class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                <i class="nav-icon fas fa-home"></i>
                <p>Dashboard</p>
            </a>
        </li>

        {{-- ===== MENU UTAMA (khusus admin) ===== --}}
        @if ($role === 'admin')
            <li class="nav-item {{ request()->is('kategori*', 'alat*', 'log-aktivitas*', 'user*') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-table"></i>
                    <p>Menu Utama <i class="fas fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('kategori.index') }}"
                            class="nav-link {{ request()->is('kategori*') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Kelola Data Kategori</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('alat.index') }}"
                            class="nav-link {{ request()->is('alat*') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Kelola Data Alat</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('log.index') }}"
                            class="nav-link {{ request()->is('log-aktivitas*') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Log Aktivitas</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.index') }}"
                            class="nav-link {{ request()->is('user*') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Kelola Data User</p>
                        </a>
                    </li>
                </ul>
            </li>
        @endif

        {{-- ===== DAFTAR ALAT (khusus peminjam) ===== --}}
        @if ($role === 'peminjam')
            <li class="nav-item">
                <a href="{{ route('alat.index') }}"
                    class="nav-link {{ request()->is('alat*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tools"></i>
                    <p>Daftar Alat</p>
                </a>
            </li>
        @endif

        {{-- ===== TRANSAKSI (semua role) ===== --}}
        <li class="nav-item {{ request()->is('peminjaman*', 'pengembalian*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-list"></i>
                <p>Transaksi <i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
                @if ($role === 'peminjam')
                    <li class="nav-item">
                        <a href="{{ route('peminjaman.create') }}"
                            class="nav-link {{ request()->is('peminjaman/ajukan') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Ajukan Peminjaman</p>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('peminjaman.index') }}"
                        class="nav-link {{ $aktifPeminjaman ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ $role === 'peminjam' ? 'Peminjaman Saya' : 'Data Peminjaman' }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pengembalian.index') }}"
                        class="nav-link {{ request()->is('pengembalian*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Data Pengembalian</p>
                    </a>
                </li>
            </ul>
        </li>

        {{-- ===== CETAK LAPORAN (khusus petugas) ===== --}}
        @if ($role === 'petugas')
            <li class="nav-item">
                <a href="{{ route('laporan.index') }}"
                    class="nav-link {{ request()->is('laporan*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-print"></i>
                    <p>Cetak Laporan</p>
                </a>
            </li>
        @endif

        {{-- ===== LOGOUT (semua role) ===== --}}
        <li class="nav-item">
            <a href="{{ route('actionLogout') }}" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>Logout</p>
            </a>
        </li>

    </ul>
</nav>
<!-- /.sidebar-menu -->
