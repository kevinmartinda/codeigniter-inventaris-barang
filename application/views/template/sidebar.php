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
        <li class="treeview">
          <a href="#">
            <i class="fa fa-book"></i> <span> Master Lab.</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php foreach ($lab as $item_l): ?>
                <li><a href="<?=base_url("index.php/barang/list-barang/{$item_l['id']}")?>"><i class="fa fa-circle-o"></i> <?=$item_l['nama']?></a></li>
            <?php endforeach; ?>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-home"></i> <span> Master Kelas VII</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php foreach ($k_7 as $item_7): ?>
                <li><a href="<?=base_url("index.php/barang/list-barang/{$item_7['id']}")?>"><i class="fa fa-circle-o"></i> <?=$item_7['nama']?></a></li>
            <?php endforeach; ?>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-home"></i> <span> Master Kelas VIII</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php foreach ($k_8 as $item_8): ?>
                <li><a href="<?=base_url("index.php/barang/list-barang/{$item_8['id']}")?>"><i class="fa fa-circle-o"></i> <?=$item_8['nama']?></a></li>
            <?php endforeach; ?>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-home"></i> <span> Master Kelas IX</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php foreach ($k_9 as $item_9): ?>
                <li><a href="<?=base_url("index.php/barang/list-barang/{$item_9['id']}")?>"><i class="fa fa-circle-o"></i> <?=$item_9['nama']?></a></li>
            <?php endforeach; ?>
          </ul>
        </li>
        <li class="treeview">
              <a href="#"><i class="fa fa-dashboard"></i> <span>Master Transaksi</span>
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
        <li><a href="<?=base_url("index.php/pinjam")?>"><i class="fa fa-user"></i> <span> Peminjaman Barang</span></a></li>
        <li><a href="<?=base_url("index.php/home/logout")?>"><i class="fa fa-user"></i> <span> Sign Out</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <script type="text/javascript">
    $(document).ready(function () {
      function getPage() {
        let id = document.getElementsByTagName('')
        $.ajax({
          url: <?=base_url('<?=base_url()?>index.php/barang/list-barang/'+id)?>
        });    
      }
    })
    
  </script>

  <!-- =============================================== -->