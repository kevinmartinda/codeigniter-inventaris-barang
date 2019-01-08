<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Aplikasi Inventaris | Peminjaman Barang Tata Usaha
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Peminjaman Barang <?=date("d F Y")?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <button class="btn btn-primary" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Pinjam</button>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr> 
                  <th>No</th>
                  <th>Nama Barang</th>
                  <th>Peminjam</th>
                  <th>Kelas</th>
                  <th>Waktu Pinjam</th>
                  <th>Waktu Kembali</th>
                </tr>
                </thead>
                <tbody>
                <?php $no = 1; ?>
                <?php foreach ($konten as $barang): ?>
                  <tr>
                    <td><?=$no?></td>
                    <td><?=$barang['nama']?></td>
                    <td><?=$barang['peminjam']?></td>
                    <td><?=$barang['kelas']?></td>
                    <td><?=$barang['waktu_pinjam']?></td>
                    <?php 
                      if ($barang['waktu_kembali'] == null) {
                        echo "<td><a href='". base_url() ."index.php/barang/update-pinjam/".$barang['id']."' class='btn btn-warning'>Kembali</a></td>";
                      } else {
                        echo "<td>{$barang['waktu_kembali']}</td>";
                      }
                     ?>
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

  <div class="modal fade" id="tambah" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button class="close" data-dismiss="modal"> <span aria-hidden="true">&times;</span></button>
          <h3 class="modal-title">Tambah Pinjam</h3>
        </div>
        <div class="modal-body">
          <form action="<?=base_url("index.php/barang/pinjam")?>" method="POST">
            <div class="box-body">
            <div class="form-group">
              <label for="nis">NIS Siswa</label>
              <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Masukkan NIS" name="id_siswa">
            </div>

            <!-- <div class="form-group">
              <label for="exampleInputEmail1">Nama Siswa</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Nama" name="nama_siswa">
            </div>

            <div class="form-group">
              <label>Pilih Jenis Tempat</label>
              <select class="form-control" name="id_tempat" id="sPilih">
                <option selected disabled>Pilih Tempat</option>
              <?php// foreach ($pilih as $item): ?>
                <?php// if ($item['id'] != 1): ?>
                  <option value="<?php//echo $item['id']?>"><?php//echo$item['nama']?></option>
                <?php //endif ?>
              <?php //endforeach ?>
              </select>
            </div>
            
            <div class="form-group">
              <label>Pilih Tempat</label>
              <select class="form-control" name="id_tempat" id="sTempat">
                <option selected disabled>Pilih Tempat</option>
              </select>
            </div> -->

            <div class="form-group">
              <label>Pilih Barang</label>
                
              <select class="form-control" name="id_barang">
              <?php foreach ($bangsat as $item): ?>
                <option value="<?=$item['id']?>"><?=$item['nama']?></option>
              <?php endforeach ?>
              </select>
            </div>
            <div class="checkbox">
              <label>
                <button type="submit" class="btn btn-primary" onclick="add_pinjam()">Pinjam</button>
              </label>
            </div>
          </div>
          </form>
        </div>
      </div>
    </div>
    
  </div>

