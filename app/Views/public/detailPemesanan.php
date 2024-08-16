 <!-- Header Start -->
 <div class="container-fluid bg-breadcrumb">
     <div class="container text-center py-5" style="max-width: 900px;">
         <h3 class="text-white display-3 mb-4">Modifikasi Pesanan</h1>
             <ol class="breadcrumb justify-content-center mb-0">
                 <li class="breadcrumb-item"><a href="/">Home</a></li>
                 <li class="breadcrumb-item"><a>Pages</a></li>
                 <li class="breadcrumb-item active text-white">Modifikasi Pesanan</li>
             </ol>
     </div>
 </div>
 <!-- Header End -->

 <div class="container mt-5 pt-5">
     <h2 class="mb-4">Detail Pemesanan</h2>
     <div class="table-responsive">
         <table class="table table-bordered">
             <thead>
                 <tr>
                     <th>ID</th>
                     <th>Nama</th>
                     <th>No. HP</th>
                     <th>Tanggal</th>
                     <th>Durasi</th>
                     <th>Penginapan</th>
                     <th>Transportasi</th>
                     <th>Makan</th>
                     <th>Jumlah Peserta</th>
                     <th>Harga Paket</th>
                     <th>Total Harga</th>
                     <th>Aksi</th>
                 </tr>
             </thead>
             <tbody>
                 <?php foreach ($pemesanan as $p) : ?>
                     <tr>
                         <td><?= $p['id_pemesanan'] ?></td>
                         <td><?= $p['nama'] ?></td>
                         <td><?= $p['nohp'] ?></td>
                         <td><?= $p['tgl'] ?></td>
                         <td><?= $p['durasi'] ?> hari</td>
                         <td><?= $p['lay_penginapan'] ? 'Y' : 'N' ?></td>
                         <td><?= $p['lay_transportasi'] ? 'Y' : 'N' ?></td>
                         <td><?= $p['lay_makan'] ? 'Y' : 'N' ?></td>
                         <td><?= $p['jmlh_peserta'] ?></td>
                         <td>Rp <?= number_format($p['harga'], 0, ',', '.') ?></td>
                         <td>Rp <?= number_format($p['jmlh_harga'], 0, ',', '.') ?></td>
                         <td>
                             <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal<?= $p['id_pemesanan'] ?>">
                                 Edit
                             </button>
                             <a href="<?= base_url('pesanan/hapus/' . $p['id_pemesanan']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pemesanan ini?')">Hapus</a>
                         </td>
                     </tr>

                     <!-- Edit Modal -->
                     <div class="modal fade" id="editModal<?= $p['id_pemesanan'] ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $p['id_pemesanan'] ?>" aria-hidden="true">
                         <div class="modal-dialog modal-lg">
                             <div class="modal-content">
                                 <div class="modal-header">
                                     <h5 class="modal-title" id="editModalLabel<?= $p['id_pemesanan'] ?>">Edit Pemesanan</h5>
                                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                 </div>
                                 <div class="modal-body">
                                     <form action="<?= base_url('pesanan/edit/' . $p['id_pemesanan']) ?>" method="post">
                                         <?= csrf_field() ?>
                                         <div class="mb-3 row">
                                             <label for="nama" class="col-sm-3 col-form-label">Nama Pemesan</label>
                                             <div class="col-sm-9">
                                                 <input type="text" class="form-control" id="nama" name="nama" value="<?= $p['nama'] ?>" required>
                                             </div>
                                         </div>
                                         <div class="mb-3 row">
                                             <label for="nohp" class="col-sm-3 col-form-label">Nomor Telp/HP</label>
                                             <div class="col-sm-9">
                                                 <input type="tel" class="form-control" id="nohp" name="nohp" value="<?= $p['nohp'] ?>" required>
                                             </div>
                                         </div>
                                         <div class="mb-3 row">
                                             <label for="tgl" class="col-sm-3 col-form-label">Tanggal Pesan</label>
                                             <div class="col-sm-9">
                                                 <input type="date" class="form-control" id="tgl" name="tgl" value="<?= $p['tgl'] ?>" required>
                                             </div>
                                         </div>
                                         <div class="mb-3 row">
                                             <label for="durasi" class="col-sm-3 col-form-label">Waktu Pelaksanaan Perjalanan</label>
                                             <div class="col-sm-9">
                                                 <input type="number" class="form-control" id="durasi" name="durasi" value="<?= $p['durasi'] ?>" min="1" required>
                                             </div>
                                         </div>
                                         <div class="mb-3 row">
                                             <label for="jmlh_peserta" class="col-sm-3 col-form-label">Jumlah Peserta</label>
                                             <div class="col-sm-9">
                                                 <input type="number" class="form-control" id="jmlh_peserta" name="jmlh_peserta" value="<?= $p['jmlh_peserta'] ?>" min="1" required>
                                             </div>
                                         </div>
                                         <div class="mb-3 row">
                                             <label class="col-sm-3 col-form-label">Pelayanan Paket Perjalanan</label>
                                             <div class="col-sm-9">
                                                 <div class="form-check">
                                                     <input class="form-check-input" type="checkbox" id="lay_penginapan" name="lay_penginapan" value="1" <?= $p['lay_penginapan'] ? 'checked' : '' ?>>
                                                     <label class="form-check-label" for="lay_penginapan">Penginapan (Rp 1.000.000)</label>
                                                 </div>
                                                 <div class="form-check">
                                                     <input class="form-check-input" type="checkbox" id="lay_transportasi" name="lay_transportasi" value="1" <?= $p['lay_transportasi'] ? 'checked' : '' ?>>
                                                     <label class="form-check-label" for="lay_transportasi">Transportasi (Rp 1.200.000)</label>
                                                 </div>
                                                 <div class="form-check">
                                                     <input class="form-check-input" type="checkbox" id="lay_makan" name="lay_makan" value="1" <?= $p['lay_makan'] ? 'checked' : '' ?>>
                                                     <label class="form-check-label" for="lay_makan">Makanan (Rp 500.000)</label>
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="row">
                                             <div class="col-sm-12 text-end">
                                                 <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                 <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                             </div>
                                         </div>
                                     </form>
                                 </div>
                             </div>
                         </div>
                     </div>
                 <?php endforeach; ?>
             </tbody>
         </table>
     </div>
 </div>