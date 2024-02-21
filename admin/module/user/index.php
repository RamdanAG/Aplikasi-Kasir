<!--main content start-->
<?php
$id = $_SESSION['admin']['id_member'];
$hasil = $lihat->member_edit($id);
?>
<div class="container mt-4">
  <h4 class="mb-4">Profil Pengguna Aplikasi</h4>

  <?php if (isset($_GET['success'])) { ?>
    <div class="alert alert-success">
      <p>Edit Data Berhasil !</p>
    </div>
  <?php } ?>
  <?php if (isset($_GET['remove'])) { ?>
    <div class="alert alert-danger">
      <p>Hapus Data Berhasil !</p>
    </div>
  <?php } ?>

  <div class="row">
    <div class="col-sm-3">
      <div class="">
        <div class="card-header">
          <h5 class="mt-2"><i class="fa fa-user"></i> Foto Pengguna </h5>
        </div>
        <div class="card-body">
          <img src="assets/img/user/<?php echo $hasil['gambar']; ?>" alt="#" class="img-fluid w-100" />
        </div>
        <div class="card-footer">
          <form method="POST" action="fungsi/edit/edit.php?gambar=user" enctype="multipart/form-data">
            <input type="file" accept="image/*" name="foto" class="form-control-file">
            <input type="hidden" value="<?php echo $hasil['gambar']; ?>" name="foto2">
            <input type="hidden" name="id" value="<?php echo $hasil['id_member']; ?>">
            <br><br>
            <button type="submit" class="btn btn-block" style="background:#0057e7; color:white">
              <i class="fas fa-edit mr-1"></i> Ganti Foto
            </button>
          </form>
        </div>
      </div>
    </div>

    <!-- Add Bootstrap classes to improve the layout -->
    <div class="col-sm-5">
      <div class="">
        <div class="card-header">
          <h5 class="mt-2"><i class="fa fa-user"></i> Kelola Pengguna </h5>
        </div>
        <div class="card-body">
          <div class="box-content">
            <form class="form-horizontal" method="POST" action="fungsi/edit/edit.php?profil=edit" enctype="multipart/form-data">
              <fieldset>
                <div class="form-group">
                  <label for="nama">Nama</label>
                  <input type="text" class="form-control" name="nama" value="<?php echo $hasil['nm_member']; ?>" required="required" />
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" name="email" value="<?php echo $hasil['email']; ?>" required="required" />
                </div>
                <div class="form-group">
                  <label for="level">Level</label>
                  <input type="text" disabled class="form-control" name="level" value="<?php
                                                                                        if ($hasil['status'] == 1) {
                                                                                          echo "Admin";
                                                                                        } elseif ($hasil['status'] == 2) {
                                                                                          echo "Petugas";
                                                                                        }; ?>" required="required" />
                </div>
                <div class="form-group">
                  <label for="tlp">Telepon</label>
                  <input type="text" class="form-control" name="tlp" value="<?php echo $hasil['telepon']; ?>" required="required" />
                </div>
                <div class="form-group">
                  <label for="nik">NIK (KTP)</label>
                  <input type="text" class="form-control" name="nik" value="<?php echo $hasil['NIK']; ?>" required="required" />
                </div>
                <div class="form-group">
                  <label for="alamat">Alamat</label>
                  <textarea name="alamat" rows="3" class="form-control" required="required"><?php echo $hasil['alamat_member']; ?></textarea>
                </div>
                <input type="hidden" name="id" value="<?php echo $hasil['id_member']; ?>">
                <button class="btn btn-block" style="background:#0057e7; color:white" name="btn" value="Tambah">
                  <i class="fas fa-edit"></i> Ubah Profil
                </button>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Add Bootstrap classes to improve the layout -->
    <div class="col-sm-4">
      <div class="">
        <div class="card-header">
          <h5 class="mt-2"><i class="fa fa-lock"></i> Ganti Password</h5>
        </div>
        <div class="card-body">
          <div class="box-content">
            <form class="form-horizontal" method="POST" action="fungsi/edit/edit.php?pass=ganti-pas">
              <fieldset>
                <div class="form-group">
                  <label for="user">Username</label>
                  <input type="text" class="form-control" name="user" value="<?php echo $hasil['user']; ?>" />
                </div>
                <div class="form-group">
                  <label for="pass">Password Baru</label>
                  <input type="password" class="form-control" placeholder="Enter Your New Password" id="pass" name="pass" required="required" />
                </div>
                <input type="hidden" class="form-control" name="id" value="<?php echo $hasil['id_member']; ?>" required="required" />
                <button type="submit" class="btn btn-block" style="background: #0057e7; color:white" value="Tambah" name="proses">
                  <i class="fas fa-edit"></i> Ubah Password
                </button>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>