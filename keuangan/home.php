<?php
include "koneksi.php";
if (isset($_POST['simpan'])) {
    $tgl = $_POST["tanggal"];
    $deskripsi = $_POST["deskripsi"];
    $jumlah = $_POST["jumlah"];
    $id_kategori = $_POST["id_kategori"];
    $tipe_transaksiq = $_POST["tipe_transaksi"];

    $sql = "INSERT INTO tb_transaksi (tgl, deskripsi, jumlah, id_kategori, tipe_transaksi)
            VALUES ('$tgl', '$deskripsi', $jumlah, $id_kategori, '$tipe_transaksiq')";

    if ($con->query($sql) === TRUE) {
       header('Location: ?page=home');
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Transaksi Keuangan</title>
</head>
<body>
    <div class="container-fluid">
        <h4 class="mt-3">Tambah Transaksi</h4>

        <?php
            $sqlpem = mysqli_query($con,"SELECT sum(jumlah) as jumlah_baru from tb_transaksi where tipe_transaksi = 'Pemasukan'");
            $rowpem = mysqli_fetch_array($sqlpem);
            $jumpem = $rowpem['jumlah_baru'];

            $sqlpeng = mysqli_query($con,"SELECT sum(jumlah) as jumlah_baru from tb_transaksi where tipe_transaksi = 'Pengeluaran'");
            $rowpeng = mysqli_fetch_array($sqlpeng);
            $jumpeng = $rowpeng['jumlah_baru'];
            $sisa = ($jumpem - $jumpeng);
            
        ?>

        <div class="font-size:weight;"><b><h5 style="text-align:right;">Sisa Saldo: <?php $rupiah_format = ($sisa < 0 ? "- " : "") . "Rp " . number_format(abs($sisa), 0, ',', '.');
echo $rupiah_format;  ?></h5></b></div>
        <div class="row">
            <div class="col-md-4">  
                <form method="POST">
                    <div class="card">
                        <div class="card-body">                        
                            <div class="form-floating mb-2">
                              <input type="date" class="form-control" name="tanggal" id="floatingInput" autocomplete="off" required placeholder="Tanggal">
                              <label for="floatingInput">Tanggal</label>
                            </div>
                            <div class="form-floating mb-2">
                              <textarea class="form-control" name="deskripsi" placeholder="Deskripsi" id="floatingTextarea"></textarea>
                              <label for="floatingTextarea">Deskripsi</label>
                            </div> 
                             <div class="form-floating mb-2">
                              <input type="number" class="form-control" name="jumlah" id="floatingInput" autocomplete="off" required placeholder="Jumlah">
                              <label for="floatingInput">Jumlah</label>
                            </div>                            
                            <?php
                                $sqlk = mysqli_query($con,"SELECT * FROM tb_kategori");
                                ?>
                            <div class="form-floating mb-2">
                              <select class="form-select" name="id_kategori" id="floatingSelect" aria-label="Floating label select example">
                                <option selected disabled>Pilih Kategori</option>
                                <?php
                                while($row = mysqli_fetch_array($sqlk))
                                {
                                    ?>
                                        <option value="<?= $row['id_kategori']?>"><?= $row['nama_kategori'];?></option>
                                    <?php
                                }
                                ?>                               
                              </select>
                              <label for="floatingSelect">Pilih Kategori</label>
                            </div>
                            <div class="form-floating mb-2">
                              <select class="form-select" name="tipe_transaksi" id="floatingSelect" aria-label="Floating label select example">
                                <option selected disabled="">Pilih tipe transaksi</option>
                                <option value="Pemasukan">Pemasukan</option>
                                <option value="Pengeluaran">Pengeluaran</option>                                
                              </select>
                              <label for="floatingSelect">Tipe Transaksi</label>
                            </div>
                           
                            <input type="submit" name="simpan" class="btn btn-success text-white mt-3 w-100 py-2" value="Simpan">

                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <?php
                            $queryt = mysqli_query($con,"SELECT * FROM tb_transaksi a,tb_kategori b where a.id_kategori = b.id_kategori order by id_transaksi desc");
                        ?>
                        <table class="table" id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Deskripsi</th>
                                        <th>Jumlah</th>
                                        <th>Kategori</th>
                                        <th>Tipe</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                           
                                <tbody>
                            <?php
                            $no=1;

                            while($row = mysqli_fetch_array($queryt))
                            {
                                ?>  
                                <tr>
                                        <td><?= $no;?></td>
                                        <td><?php $date = $row['tgl'];
                                        $datetime = DateTime::createFromFormat('Y-m-d', $date);
                                        echo $datetime->format('d-m-Y');
                                         ?></td>
                                        <td><?= $row['deskripsi'];?></td>
                                        <td><?php
                                        $rupiah_format = "Rp " . number_format($row['jumlah'], 0, ',', '.');
                                        echo $rupiah_format;?></td>
                                        <td><?= $row['nama_kategori'];?></td>
                                        <td><?= $row['tipe_transaksi'];?></td>
                                        <td><a href="?page=edit_transaksi&id=<?=$row['id_transaksi'];?>"><i class="bi bi-pencil-square" style="color:blue;font-size: 18px"></i></a>
                                        <a href="delete_transaksi.php?id=<?=$row['id_transaksi'];?>"><i class="bi bi-trash" style="color:red;font-size: 18px"></i></i></a></td>
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
</body>
</html>
