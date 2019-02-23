<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
<?php foreach ($tempat as $key): ?>
<li class="treeview">
  <a href="#">
    <i class="fa fa-building"></i> <span>Master <?=$key['nama']?></span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu" id="tvlab">
    <?php foreach ($aitem as $item): ?>
      <?php if ($item['jenis'] == $key['id']): ?>
        <li><a href="<?=base_url("index.php/barang/list-barang/{$item['id']}")?>"><i class="fa fa-circle-o"></i> <?=$item['nama']?></a></li>
      <?php endif ?>
    <?php endforeach; ?>
  </ul>
</li>
<?php endforeach ?>
        <li><a href="<?=base_url("index.php/tata-usaha")?>"><i class="fa fa-home"></i> <span> Barang Tata Usaha</span></a></li>
        
        <li class="treeview">
              <a href="#"><i class="fa fa-database"></i> <span>Master Transaksi</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li>
                  <a href="<?=base_url("index.php/barang/tambah-barang")?>"><i class="fa fa-circle-o"></i> Barang Masuk
                    <span class="pull-right-container">
                    </span>
                  </a>
                </li>
                <li>
                  <a href="<?=base_url("index.php/barang/keluar-barang")?>"><i class="fa fa-circle-o"></i> Barang Keluar
                    <span class="pull-right-container">
                    </span>
                  </a>
                </li>
              </ul>
            </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-book"></i> <span> Dokumentasi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?=base_url("index.php/report/masuk")?>"><i class="fa fa-circle-o"></i> Laporan Barang Masuk</a></li>
            <li><a href="<?=base_url("index.php/report/keluar")?>"><i class="fa fa-circle-o"></i> Laporan Barang Keluar</a></li>
          </ul>
        </li>
        <li><a href="<?=base_url("index.php/tempat")?>"><i class="fa fa-home"></i> <span> Tambah Tempat</span></a></li>
        <li><a href="<?=base_url("index.php/pinjam")?>"><i class="fa fa-user"></i> <span> Peminjaman Barang</span></a></li>        <li><a href="<?=base_url("index.php/home/logout")?>"><i class="fa fa-sign-out"></i> <span> Sign Out</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->