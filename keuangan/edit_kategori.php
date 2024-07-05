<?php
include "koneksi.php";
if (isset($_POST['simpan'])) {
    $idkat = $_POST['idh'];
    $nama_kategori = $_POST["nama_kategori"];
    $sql = "UPDATE tb_kategori SET nama_kategori = '$nama_kategori' where id_kategori = $idkat ";
    $query = mysqli_query($con,$sql);
    header('Location: index.php?page=kategori');
}?>
    <div class="container-fluid">
        <h4 class="mt-3">Update Kategori</h4>
        <div class="row">
            <div class="col-md-4">                
                <div class="card">
                    <div class="card-body">
                    <?php
                        $idget = $_GET['id'];
                        $querye = mysqli_query($con,"SELECT * FROM tb_kategori where id_kategori = $idget");
                        $rowe = mysqli_fetch_array($querye);
                    ?>                        
                        <form method="POST" action="">
                            <div class="form-floating mb-3">
                              <input type="text" class="form-control" name="nama_kategori" id="floatingInput" autocomplete="off" value="<?= $rowe['nama_kategori']?>" required placeholder="Nama Kategori">
                              <label for="floatingInput">Nama Kategori</label>
                            </div>
                            <input type="hidden" name="idh" value=<?= $rowe['id_kategori']; ?>>
                            <input type="submit" name="simpan" class="btn btn-success" value="Simpan">
                             <a href="?page=kategori" class="btn btn-danger">Kembali</a>
                        </form>
                    </div>
                </div>  
            </div>            
    </div>
    