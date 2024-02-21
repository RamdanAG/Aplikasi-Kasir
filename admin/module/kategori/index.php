<h3>Kategori Barang</h3>
<p>Menambahkan atau melihat kategori apa saja yang terdaftar pada sistem kasir <b><?php echo $toko['nama_toko']; ?></b></p>
<br />
<?php if (isset($_GET['success'])) { ?>
    <div class="alert alert-success">
        <p>Tambah Data Berhasil !</p>
    </div>
<?php } ?>
<?php if (isset($_GET['success-edit'])) { ?>
    <div class="alert alert-success">
        <p>Update Data Berhasil !</p>
    </div>
<?php } ?>
<?php if (isset($_GET['remove'])) { ?>
    <div class="alert alert-danger">
        <p>Hapus Data Berhasil !</p>
    </div>
<?php } ?>
<?php
if (!empty($_GET['uid'])) {
    $sql = "SELECT * FROM kategori WHERE id_kategori = ?";
    $row = $config->prepare($sql);
    $row->execute(array($_GET['uid']));
    $edit = $row->fetch();
?>
    <form method="POST" action="fungsi/edit/edit.php?kategori=edit">
        <table>
            <tr>
                <td style="width:25pc;"><input type="text" class="form-control" value="<?= $edit['nama_kategori']; ?>" required name="kategori" placeholder="Masukan Kategori Barang Baru">
                    <input type="hidden" name="id" value="<?= $edit['id_kategori']; ?>">
                </td>
                <td style="padding-left:10px;"><button id="tombol-simpan" class="btn"><i class="fa fa-edit"></i>
                        Ubah Data</button></td>
            </tr>
        </table>
    </form>
<?php } else { ?>
    <form method="POST" action="fungsi/tambah/tambah.php?kategori=tambah">
        <table>
            <tr>
                <td style="width:25pc;"><input type="text" class="form-control" required name="kategori" placeholder="Masukan Kategori Barang Baru"></td>
                <td style="padding-left:10px;"><button id="tombol-simpan" class="btn" style="background:#0057e7; color:white;"><i class="fa fa-plus"></i>
                        Tambah Kategori</button></td>
            </tr>
        </table>
    </form>
<?php } ?>
<br />
<div class="card card-body" style="background: #242424;">
    <div class="table-responsive">
        <table class="table table-striped table-sm" id="example1">
            <thead>
                <tr style="background:white; color:black;">
                    <th>No.</th>
                    <th>Kategori</th>
                    <th>Tanggal Input</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $hasil = $lihat->kategori();
                $no = 1;
                foreach ($hasil as $isi) {
                ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $isi['nama_kategori']; ?></td>
                        <td><?php echo $isi['tgl_input']; ?></td>
                        <td>
                            <a href="index.php?page=kategori&uid=<?php echo $isi['id_kategori']; ?>"><button class="btn" style="background: #ffa700; color:white;">Edit</button></a>
                            <a href="fungsi/hapus/hapus.php?kategori=hapus&id=<?php echo $isi['id_kategori']; ?>" onclick="javascript:return confirm('Hapus Data Kategori ?');"><button class="btn" style="background: #d62d20; color:white;">Hapus</button></a>
                        </td>
                    </tr>
                <?php $no++;
                } ?>
            </tbody>
        </table>
    </div>
</div>