<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Aplikasi Inventaris | Transaksi Masuk
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tambah Data Barang Masuk</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              
          <form action="<?=base_url('index.php/barang/add-transaction')?>" method="POST">
            <div class="box-body">

            <div class="form-group">
              <label>Pilih Jenis Tempat</label>
              <select class="form-control" name="id_pilih" id="sPilih">
                <option selected disabled>Pilih Jenis Tempat</option>
              <?php foreach ($pilih as $item): ?>
                <option value="<?=$item['id']?>"><?=$item['nama']?></option>
              <?php endforeach ?>
              </select>
            </div>
            
            <div class="form-group">
              <label>Pilih Tempat</label>
              <select class="form-control" name="id_tempat" id="sTempat">
                <option selected disabled>Pilih Tempat</option>
              </select>
            </div>
            
              <div class="form-group" id="fGambar">
                <label for="gambar">Gambar</label>
                <input type="file" class="form-control" name="gambar">
              </div>
            <div class="form-group">
              <label for="nama">Nama Barang</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Nama Barang" name="nama">
            </div>
            <div class="form-group">
              <label for="merk">Merk Barang</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Merk Barang" name="merk">
            </div>
            <div class="form-group">
              <label for="warna">Warna Barang</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Warna Barang" name="warna">
            </div>
            <div class="form-group">
              <label for="tahun">Tahun</label>
              <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Tahun" name="tahun">
            </div>
            <div class="form-group">
              <label for="jumlah">Jumlah</label>
              <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Jumlah" name="jumlah">
            </div>
            <div class="checkbox">
              <label>
                <button type="submit" class="btn btn-primary">Tambah</button>
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
<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function() {
  // code
    let gam = getElementById('fGambar');
    gam.style.display = 'none';
  });

  function uploadFile() {
    let isi = getElementById('sTempat').value;
    let gam = getElementById('fGambar');
    if (isi == 11 || isi == 22 || isi == 33) {
      gam.style.display = 'block';
    }
  }
</script>
