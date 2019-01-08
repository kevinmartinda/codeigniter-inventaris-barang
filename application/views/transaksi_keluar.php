<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Aplikasi Inventaris | Transaksi Keluar
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Keluarkan dari stok</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              
          <form action="<?=base_url('index.php/barang/remove-transaction')?>" method="POST">
            <div class="box-body">

            <div class="form-group">
              <label>Pilih Tempat</label>
                
              <select class="form-control" name="id_tempat" id="sTempatB">
                <option selected disabled>Pilih Tempat</option>
              <?php foreach ($tempat as $item): ?>
                <option value="<?=$item['id']?>"><?=$item['nama']?></option>
              <?php endforeach ?>
              </select>
            </div>
            <div class="form-group">
              <label>Pilih Barang</label>
                
              <select class="form-control" name="id_barang" id="sBarang">
                <option selected disabled>Pilih Barang</option>
              <?php foreach ($barang as $item): ?>
                <option value="<?=$item['id']?>"><?=$item['nama_barang']?></option>
              <?php endforeach ?>
              </select>
            </div>
            <div class="form-group">
              <label for="nama">Jumlah Dikeluarkan</label>  <span>(stok :</span> <span id="sStok"></span> <span> unit)</span>
              <input type="number" class="form-control" id="iKeluar" placeholder="Masukkan Jumlah Dikeluarkan" name="keluar" min="1">
            </div>
            <div class="checkbox">
              <label>
                <button type="submit" class="btn btn-primary">Keluar</button>
              </label>
            </div>
          </div>
          </form>
          </div>
            <!-- /.box-body -->
          </div>

        <!-- /.box-body -->

        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->