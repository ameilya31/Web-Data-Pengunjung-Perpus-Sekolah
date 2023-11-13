<?php
require_once('koneksi.php');
	// untuk Hapus data barang berdasarkan id barang
	$id = $_GET['id'];
	$sql = "DELETE FROM datapengunjung WHERE ID= ?";
	$row = $koneksi->prepare($sql);
	$row->execute(array($id));
	
	echo '<script>alert("Berhasil Hapus Data");window.location="index.php"</script>';
?> 
