<?php
$servername = "localhost";  // Ganti dengan nama server Anda
$username = "root";     // Ganti dengan username database Anda
$password = "";     // Ganti dengan password database Anda
$dbname = "db_keuangan";  // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_kategori = $_POST["nama_kategori"];
    $sql = "INSERT INTO tb_kategori (nama_kategori) VALUES ('$nama_kategori')";
    if ($conn->query($sql) === TRUE) {
        header('Loation: kategori.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}?>
    <div class="container-fluid">
        <h4 class="mt-3">Tambah Kategori</h4>
        <div class="row">
            <div class="col-md-4">                
                <div class="card">
                    <div class="card-body">                        
                        <form method="POST" action="">
                            <div class="form-floating mb-3">
                              <input type="text" class="form-control" name="nama_kategori" id="floatingInput" autocomplete="off" required placeholder="Nama Kategori">
                              <label for="floatingInput">Nama Kategori</label>
                            </div>
                             <input type="submit" class="btn btn-success" value="Simpan">
                        </form>
                    </div>
                </div>  
            </div>
            <div class="col-md-8 bawah">
                <div class="card">
                    <div class="card-body">
                        <?php
                            include "koneksi.php";

                            $query = mysqli_query($con,"SELECT * from tb_kategori order by id_kategori desc");
                            ?>
                            <table class="table" id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kategori</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                           
                                <tbody>
                            <?php
                            $no=1;
                            while($row = mysqli_fetch_array($query))
                            {
                                ?>  
                                <tr>
                                        <td><?= $no;?></td>
                                        <td><?= $row['nama_kategori'];?></td>
                                        <td><a href="?page=edit_kategori&id=<?=$row['id_kategori'];?>"><i class="bi bi-pencil-square" style="color:blue;font-size: 18px"></i></a><a href="deletekat.php?id=<?=$row['id_kategori']; ?>"><i class="bi bi-trash" style="color:red;font-size: 18px"></i></a></td>
                                </tr>
                                <?php
                                $no++;
                            }
                            ?>
                            </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    