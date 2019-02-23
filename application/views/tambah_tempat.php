<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Aplikasi Inventaris | Penambahan Lokasi
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Penambahan Tempat</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form method="POST" action="<?=base_url('index.php/home/tambah_tempat')?>">
                <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label>Nama Kategori</label>
                    <select name="jenis" id="sTemKat" class="form-control">
                      <?php foreach ($kategori as $kat): ?>
                        <?php if ($kat['id'] == 2 || $kat['id'] == 3 || $kat['id'] == 4): ?>
                        <?php else: ?>
                          <option value="<?=$kat['id']?>"><?=$kat['nama']?></option>
                        <?php endif ?>
                      <?php endforeach ?>
                      <option value="lain">[+] Tambah Kategori</option>
                    </select>
                  </div>
                </div>
              </div>
                <div class="row">
                  <div class="col-md-5">
                    
                  <div class="form-group">
                    <label for="nama">Nama Tempat</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukkan nama tempat" name="nama">
                  </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <button class="btn btn-primary" type="submit" id="bKirTem">Tambah</button>
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

  <div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button class="close" data-dismiss="modal"> <span aria-hidden="true">&times;</span></button>
          <h3 class="modal-title">Tambah Kategori</h3>
        </div>
        <div class="modal-body">
          <form id="fTamKat">
            <div class="box-body">
            <div class="form-group">
              <label for="nis">Nama Master</label>
              <input type="text" class="form-control" id="iTexCat" placeholder="(contoh: Gudang)" name="nama">
            </div>
            <button class="btn btn-primary" type="button" id="bTamKat">Tambah</button>
          </form>
        </div>
      </div>
    </div>
    </div>
  </div>

