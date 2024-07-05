<?php
include "koneksi.php";

$id = $_GET['id'];

if ($result = mysqli_query($con, "DELETE FROM tb_kategori WHERE id_kategori=$id")) {
  // $_SESSION['status'] = "Data berhasil hapus";
  // $_SESSION['status_code'] = "success";
  header('Location: index.php?page=kategori');
}


?>