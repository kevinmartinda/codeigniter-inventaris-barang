<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Aplikasi Inventaris
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Barang <?=$tipe?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="form-group">
                <div class="radio">
                  <label>
                    <input type="radio" name="lapPilih" id="lapRpilihMing" value="week" checked> Minggu
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="lapPilih" id="lapRpilihBul" value="month" > Bulan
                  </label>
                </div>
              </div>
              <div class="form-group" id="grupSelect">
                <input type="hidden" name="tipe" id="iLaphid" value="<?=$tipe?>">
                <div class="row">
                  <div class="col-md-4">
              <select id="sLap" class="form-control" name="sweek">
                <option value="" disabled selected>Pilih Rentan Waktu</option>
                <option value="1">1 Minggu Terakhir</option>
                <option value="2">2 Minggu Terakhir</option>
                <option value="3">3 Minggu Terakhir</option>
              </select>
                  </div>
                  <div class="col-md-8">
              <span id="anim" hidden>Tunggu sebentar...</span>
                  </div>
                </div>
              </div>
              <table id="tb-laporan" class="table table-bordered table-striped">
                <thead>
                <tr> 
                  <th>No</th>
                  <th>Nama Barang</th>
                  <th>Merk</th>
                  <th>Penginput</th>
                  <th>Warna</th>
                  <th>Tahun</th>
                  <th>Tempat</th>
                  <th>Jumlah</th>
                  <th>Terakhir diubah</th>
                </tr>
                </thead>
                <tbody>
                <?php $no = 1; ?>
                <?php foreach ($konten as $barang): ?>
                  <tr>
                    <td><?=$no?></td>
                    <td><?=$barang['nama_barang']?></td>
                    <td><?=$barang['merk']?></td>
                    <td><?=$barang['nama_user']?></td>
                    <td><?=$barang['warna']?></td>
                    <td><?=$barang['tahun']?></td>
                    <td><?=$barang['nama_tempat']?></td>
                    <td><?=$barang['jumlah']?></td>
                    <td><?=$barang['tgl_edit'] == null ? $barang['tgl_masuk'] : $barang['tgl_edit'] ?></td>
                  </tr>
                <?php $no++; ?>
                <?php endforeach ?>
                </tbody>
              </table>
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


