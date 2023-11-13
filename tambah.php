<?php
require_once('koneksi.php');

if(!empty($_POST['Nama'])) {

    // Mengambil data dari formulir
    $nama = $_POST['Nama'];
    $alamat = $_POST['Alamat'];
    $nohp = $_POST['NoHP'];
    $tanggal = $_POST['Tanggal'];

    // Mengambil data file yang diunggah
    $namaFile = $_FILES['fileFoto']['name'];
    $ukuranFile = $_FILES['fileFoto']['size'];
    $tmpFile = $_FILES['fileFoto']['tmp_name'];
    $errorFile = $_FILES['fileFoto']['error'];

    // Mendefinisikan folder penyimpanan gambar
    $folderTujuan = 'uploads/';

    // Validasi file gambar
    $allowedExtensions = array('jpg', 'jpeg', 'png');
    $fileExtension = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));

    if(in_array($fileExtension, $allowedExtensions)) {
        // Membuat nama file unik
        $namaFileBaru = uniqid() . '_' . $namaFile;
        // Pindahkan file yang diunggah ke folder penyimpanan
        $fileTujuan = $namaFileBaru;
        move_uploaded_file($tmpFile, $fileTujuan);

        // Simpan nama file unik ke dalam database
        $sql = 'INSERT INTO datapengunjung (Nama, Alamat, NoHP, Tanggal, Foto) VALUES (?, ?, ?, ?, ?)';
        $data = [$nama, $alamat, $nohp, $tanggal, $namaFileBaru];
        $row = $koneksi->prepare($sql);
        $row->execute($data);

        // Display the uploaded image
        echo '<img src="' . $folderTujuan . $namaFileBaru . '" alt="Foto Pengunjung">';

        // Tambahkan ini untuk debugging
        echo "Path File: " . $folderTujuan . $namaFileBaru;

        // Redirect
        echo '<script>alert("Berhasil Tambah Data");window.location="index.php"</script>';
    } else {
        echo '<script>alert("Format file tidak valid. Hanya file JPG, JPEG, dan PNG yang diizinkan.");</script>';
    }
}
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>Tambah Daftar Pengunjung</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="container">
        <br/>
        <h3>Tambah Daftar Pengunjung</h3>
        <br/>
        <div class="row">
            <div class="col-lg-6">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="Nama" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control" name="Alamat" required>
                    </div>
                    <div class="form-group">
                        <label>No HP</label>
                        <input type="text" class="form-control" name="NoHP" required>
                    </div>
                    <div class="form-group">
                        <label>Terakhir Berkunjung</label>
                        <input type="date" class="form-control" name="Tanggal" required>
                    </div>
                    <div class="form-group">
                        <label>Foto</label>
                        <input type="file" class="form-control-file" name="fileFoto" required>
                    </div>
                    <button class="btn btn-primary btn-md" type="submit" name="create"><i class="fa fa-plus"></i> Create</button>
                </form>
            </div>
        </div>
    </div>
</body>
