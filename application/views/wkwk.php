<table id="example1" class="table table-bordered table-striped">
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
                    <td><?=$barang['id_user']?></td>
                    <td><?=$barang['warna']?></td>
                    <td><?=$barang['tahun']?></td>
                    <td><?=$barang['id_tempat']?></td>
                    <td><?=$barang['jumlah']?></td>
                    <td><?=$barang['tgl_edit'] == null ? $barang['tgl_masuk'] : $barang['tgl_edit'] ?></td>
                  </tr>
                <?php $no++; ?>
                <?php endforeach ?>
                </tbody>
              </table>