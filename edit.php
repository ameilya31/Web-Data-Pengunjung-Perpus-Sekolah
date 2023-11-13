<?php
require_once('koneksi.php');

if (isset($_POST['create'])) {
    $id = $_POST['ID'];
    $nama = $_POST['Nama'];
    $alamat = $_POST['Alamat'];
    $noHP = $_POST['NoHP'];
    $tanggal = $_POST['Tanggal'];

    // Check if a new photo has been uploaded
    $newPhoto = $_FILES['Foto']['name'];
    $newPhotoTmp = $_FILES['Foto']['tmp_name'];
    $newPhotoPath = 'uploads/' . $newPhoto;

    // Prepare SQL query with WHERE clause
    $sql = 'UPDATE datapengunjung SET Nama=?, Alamat=?, NoHP=?, Tanggal=?';
    $data = [$nama, $alamat, $noHP, $tanggal];

    // If a new photo has been uploaded, update the photo path as well
    if (!empty($newPhoto)) {
        move_uploaded_file($newPhotoTmp, $newPhotoPath);
        $sql .= ', Foto=?';
        $data[] = $newPhotoPath;
    }

    // Add WHERE clause to identify the specific row to update
    $sql .= ' WHERE ID=?';
    $data[] = $id;

    // Execute the prepared SQL query
    $row = $koneksi->prepare($sql);
    $row->execute($data);

    echo '<script>alert("Berhasil Edit Data");window.location="index.php"</script>';
}

$id = $_GET['id'];
$sql = "SELECT * FROM datapengunjung WHERE ID=?";
$row = $koneksi->prepare($sql);
$row->execute([$id]);
$hasil = $row->fetch();

?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>Edit Daftar Pengunjung</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="container">
         <br/>
         <h3>Edit Daftar Pengunjung - <?php echo $hasil['Nama'];?></h3>
         <br/>
        <div class="row">
             <div class="col-lg-6">
                 <form action="" method="POST" enctype="multipart/form-data">
                     <div class="form-group">
                         <label>Nama</label>
                         <input type="text" value="<?php echo $hasil['Nama'];?>" class="form-control" name="Nama">
                     </div>
                     <div class="form-group">
                         <label>Alamat</label>
                         <input type="text" value="<?php echo $hasil['Alamat'];?>" class="form-control" name="Alamat">
                     </div>
                     <div class="form-group">
                         <label>No HP</label>
                         <input type="text" value="<?php echo $hasil['NoHP'];?>" class="form-control" name="NoHP">
                     </div>
                     <div class="form-group">
                         <label>Tanggal Berkunjung</label>
                         <input type="date" value="<?php echo $hasil['Tanggal'];?>" class="form-control" name="Tanggal">
                     </div>
                     <!-- Tambahkan input untuk mengunggah foto -->
                     <div class="form-group">
                         <label>Foto</label>
                         <input type="file" class="form-control-file" name="Foto">
                     </div>
                     <input type="hidden" value="<?php echo $hasil['ID'];?>" name="ID">
                     <button class="btn btn-primary btn-md" name="create"><i class="fa fa-edit"> </i> Update</button>
                 </form>
              </div>
        </div>
    </div>
</body>
</html>
