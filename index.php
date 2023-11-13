<?php
	require_once('koneksi.php');
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Website Data Pengunjung</title>
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body>
		<div class="container">
			<div class="row">
				 <div class="col-lg-12">
				 <h1>Website Data Pengunjung</h1>
				<hr>
				<a href="tambah.php" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Pengunjung</a>
				<br><br>
				<table class="table table-hover table-bordered">
					<thead class="thead-dark">
						<tr>
						<th width="50px">No</th>
						<th>Foto</th>
						<th>Nama</th>
						<th>Alamat</th>
						<th>No. HP</th>
						<th>Terakhir Berkunjung</th>
						<th style="text-align: center;">Actions</th>
					</tr>
					 <?php
						$sql = "SELECT * FROM datapengunjung";
						$row = $koneksi->prepare($sql);
						$row->execute();
						$hasil = $row->fetchAll();
						$a =1;
						foreach($hasil as $isi){
					 ?>
					<tr>
						<td><?php echo $a ?></td>
						<td><img src="<?php echo $isi['Foto']; ?>" style="max-width: 100px;"></td>
						<td><?php echo $isi['Nama'];?></td>
						<td><?php echo $isi['Alamat'];?></td>
						<td><?php echo $isi['NoHP'];?></td>
						<td><?php echo $isi['Tanggal'];?></td>
						<td style="text-align: center;">
							<a href="edit.php?id=<?php echo $isi['ID'];?>" class="btn btn-success btn-md">
							<span class="fa fa-edit"></span></a>
							<a onclick="return confirm('Apakah yakin data akan di hapus?')" href="hapus.php?id=<?php echo $isi['ID'];?>" 
							class="btn btn-danger btn-md"><span class="fa fa-trash"></span></a>
						</td>
					</tr>
					<?php
						$a++;
						}
					?>
				 </table>
			  </div>
			</div>
		</div>
	</body>
</html>
