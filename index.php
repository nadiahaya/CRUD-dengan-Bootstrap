<html>
    <head>
        <title>Pertemuan 12</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    </head>

    <body>

    <?php
        include 'koneksi.php';
        // tombol simpan
        if (isset($_POST['simpan'])) {
            // proses edit data
            if ($_GET['hal'] == 'edit') {
                // data yang akan diedit
                $edit = mysqli_query($db, "UPDATE tbanggota set idanggota = '$_POST[idanggota]', nama = '$_POST[nama]', jeniskelamin = '$_POST[jeniskelamin]', alamat = '$_POST[alamat]', status = '$_POST[status]' WHERE idanggota = '$_GET[id]'");
                if ($edit) {
                    echo "<script>
                    alert('Edit data sukses!');
                    document.location='index.php';
                    </script>";
                } else {
                    echo "<script>
                    alert('Edit data sukses!');
                    document.location='index.php';
                    </script>";
                }
            } else {
                //data disimpan baru
                $simpan = mysqli_query($db, "INSERT INTO tbanggota (idanggota, nama, jeniskelamin, alamat, status) VALUES ('$_POST[idanggota]', '$_POST[nama]', '$_POST[jeniskelamin]', '$_POST[alamat]', '$_POST[status]')");
                if ($simpan) {
                    echo "<script>
                    alert('Simpan data sukses!');
                    document.location='index.php';
                    </script>";
                } else {
                    echo "<script>
                    alert('Simpan data sukses!');
                    document.location='index.php';
                    </script>";
                }
            }


            
        }
        // tombol edit
        if (isset($_GET['hal'])) {
            if ($_GET['hal'] == 'edit') {
                $tampil = mysqli_query($db, "SELECT * FROM tbanggota WHERE idanggota = '$_GET[id]'");
                $data = mysqli_fetch_array($tampil);
                if ($data) {
                    $v_idanggota = $data['idanggota'];
                    $v_nama = $data['nama'];
                    $v_jeniskelamin = $data['jeniskelamin'];
                    $v_alamat = $data['alamat'];
                    $v_status = $data['status'];
                }
            }
            // tombol hapus
            else if ($_GET['hal'] == "hapus") {
                $hapus = mysqli_query ($db, "DELETE FROM tbanggota WHERE idanggota = '$_GET[id]'");
                if ($hapus) {
                    echo "<script>
                    alert('Hapus data sukses!');
                    document.location='index.php';
                    </script>";
                }
            }
        }
    ?>

    <div class="container">
        <h1 class="text-center">DTS Junior Web Developer</h1>
        <!-- tampil data -->
        <div class="card mt-3">
            <div class="card-header bg-secondary text-white">
                <strong>Daftar Data</strong>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th>No</th>
                        <th>Id Anggota</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>

                    <?php
                    include 'koneksi.php';
                    $no = 1;
                    $tampil = mysqli_query($db, "select * from tbanggota");
                    while($data = mysqli_fetch_array($tampil)) {
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $data['idanggota']; ?></td>
                        <td><?php echo $data['nama']; ?></td>
                        <td><?php echo $data['jeniskelamin']; ?></td>
                        <td><?php echo $data['alamat']; ?></td>
                        <td><?php echo $data['status']; ?></td>
                        <td>
                            <a href="index.php?hal=edit&id=<?=$data['idanggota']?>" class="btn btn-primary" >Edit</a>
                            <a href="index.php?hal=hapus&id=<?=$data['idanggota']?>" class="btn btn-danger" onclick="return confirm('Apakah Data Akan Dihapus ?')" >Hapus</a>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
        <!-- end tampil data -->
        
        <!-- form input -->
        <div class="card mt-3">
            <div class="card-header bg-success text-white">
                <strong>Formulir Data</strong>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label>ID Anggota</label>
                        <input type="text" name="idanggota"  value="<?=@$v_idanggota?>" class="form-control" placeholder="Masukkan ID Anggota" required>
                    </div>
                    <div class="form-group mt-3">
                        <label>Nama</label>
                        <input type="text" name="nama"  value="<?=@$v_nama?>" class="form-control" placeholder="Masukkan Nama" required>
                    </div>
                    <div class="form-group mt-3">
                        <label>Jenis Kelamin</label>
                        <select class="form-control" name="jeniskelamin">
                            <option value="<?=@$v_jeniskelamin?>"><?=@$v_jeniskelamin?></option>
                            <option value ="Laki-Laki">Laki - laki</option>
                            <option value ="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <label>Alamat</label>
                        <textarea type="text" name="alamat"  class="form-control" placeholder="Masukkan Alamat" required><?=@$v_alamat?></textarea>
                    </div>
                    <div class="form-group mt-3">
                        <label>Status</label>
                        <input type="text" name="status"  value="<?=@$v_status?>" class="form-control" placeholder="Masukkan Status" required>
                    </div>
                    <button type="submit" class="btn btn-success mt-3" name="simpan">Simpan</button>
                </form>
            </div>
        </div>
        <!-- end form input -->
    </div>
    </body>
</html>