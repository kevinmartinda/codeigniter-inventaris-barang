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
              <button class="btn btn-primary" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah Data</button>
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr> 
                  <th>No</th>
                  <th>Nama Barang</th>
                  <th>Tahun</th>
                  <th>Merk</th>
                  <th>Kondisi</th>
               <!--    <th>Aksi</th> -->
                </tr>
                </thead>
                <tbody>
                <?php $no = 1; ?>
                <?php foreach ($barang as $barang): ?>
                  <tr>
                    <td><?=$no?></td>
                    <td><?=$barang['nama']?></td>
                    <td><?=$barang['tahun']?></td>
                    <td><?=$barang['merk']?></td>
                    <td><?=$barang['kondisi']?></td>
                    <!-- <td><a href="#" id="bTaEd" data-id="<?php //echo $barang['id']; ?>" class="btn btn-warning">Edit</a> | <a href="<?php//base_url("index.php/barang/hapus-tata/{$barang['id']}")?>" class="btn btn-danger">Hapus</a></td> -->
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
            <form action="<?=base_url("index.php/barang/add-tata")?>" method="POST">
        <div class="box-body">

        <div class="form-group">
          <label for="exampleInputEmail1">Nama Barang</label>
          <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Nama" name="nama_barang">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Tahun</label>
          <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Tahun" name="tahun">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Merk</label>
          <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Merk" name="merk">
        </div>

        <input type="hidden" name="id_tempat" value="69">

        <div class="form-group">
          <label>Pilih Barang</label>
            
          <select class="form-control" name="kondisi">
          <option value="baik">baik</option>
          <option value="sedang">sedang</option>
          <option value="buruk">buruk</option>
          </select>
        </div>
        <div class="checkbox">
          <label>
            <button type="submit" class="btn btn-primary">Tambah</button>
          </label>
        </div>
      </div>
      </form>
        </div>
      </div>
    </div>
    
  </div>

  <div class="modal fade" id="edit" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button class="close" data-dismiss="modal"> <span aria-hidden="true">&times;</span></button>
          <h3 class="modal-title">Tambah Pinjam</h3>
        </div>
        <div class="modal-body">
            <form action="<?=base_url("index.php/barang/add-tata")?>" method="POST">
        <div class="box-body">

        <div class="form-group">
          <label for="exampleInputEmail1">Nama Barang</label>
          <input type="text" class="form-control" id="edNam" placeholder="Masukkan Nama" name="nama_barang">
        </div>

        <input type="hidden" name="id_tempat" value="69">

        <div class="form-group">
          <label>Pilih Barang</label>
            
          <select class="form-control" name="kondisi">
          <option value="baik">baik</option>
          <option value="sedang">sedang</option>
          <option value="buruk">buruk</option>
          </select>
        </div>
        <div class="checkbox">
          <label>
            <button type="submit" class="btn btn-primary">Pinjam</button>
          </label>
        </div>
      </div>
      </form>
        </div>
      </div>
    </div>
    
  </div>

