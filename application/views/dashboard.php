<input type="hidden" name="" id="hid-id" value="<?=$page['id']?>">
  
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
              <h3 class="box-title">Data Barang di <?=$page['nama']?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <?php if ($page['id'] == 99): ?>
              <div class="row">
                <div class="col-md-5">
                  Cari: <input type="text" name="" id="slab">
                </div><br><br>
              </div>
              <div class="row">
                <div class="col-md-5" id="dSearch">
                  <?php foreach ($konten as $barang): ?>
                    <div class="info-box bg-yellow">
                      <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text"><?=$barang['nama_user']?></span>
                        <span class="info-box-number"><?=$barang['nama_barang']?> <i class="fa fa-pull-right"><?=$barang['jumlah']?> unit</i></span>

                        <div class="progress">
                          <div class="progress-bar" style="width: 50%"></div>
                        </div>
                        <span class="progress-description">
                              <?=$barang['merk']?> | <?=$barang['warna']?> | <span><i class="fa fa-pull-right">tgl : <?=$barang['tgl_edit'] == null ? $barang['tgl_masuk'] : $barang['tgl_edit']?></i></span>
                        </span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
              
                  <?php endforeach ?>
                </div>
              </div>
            <?php else: ?>
              <table id="example2" class="table table-bordered table-striped">
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
              <a href='<?=base_url("index.php/barang/export_excel/v_stok/{$page['id']}")?>' class='btn btn-primary'><i class="fa fa-download"> Download Excel</i></a>
            <?php endif ?>
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



