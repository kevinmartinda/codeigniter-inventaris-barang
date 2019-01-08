<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Peminjaman Barang di Tata Usaha
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Barang di Lab Komputer</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-6">
              <form action="<?=base_url()?>index.php/home/setPinjam" method="POST">
                <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Masukkan NIS" name="id_siswa">
                </div>
                <div class="form-group">
                  <label>Pilih Barang</label>
                    
                  <select class="form-control" name="id_barang">
                  <?php foreach ($konten as $item): ?>
                    <option value="<?=$item['id']?>"><?=$item['nama']?></option>
                  <?php endforeach ?>
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