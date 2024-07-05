<?php
include "koneksi.php";
if (isset($_POST['simpan'])) {
    $idtrans = $_POST['idtr'];
    $tgl = $_POST["tanggal"];
    $deskripsi = $_POST["deskripsi"];
    $jumlah = $_POST["jumlah"];
    $id_kategori = $_POST["id_kategori"];
    $tipe_transaksi = $_POST["tipe_transaksi"];
   
    $sql = "UPDATE tb_transaksi SET tgl = '$tgl',deskripsi='$deskripsi',jumlah='$jumlah',id_kategori='$id_kategori',tipe_transaksi='$tipe_transaksi' where id_transaksi = $idtrans";
   
    $query = mysqli_query($con,$sql);
    header('Location: index.php?page=home');

}
?>
    <div class="container-fluid">
        <h4 class="mt-3">Update Transaksi</h4>
        <div class="row">
            <div class="col-md-4">  
                <?php
                        $idget = $_GET['id'];
                        $querye = mysqli_query($con,"SELECT a.id_transaksi,a.tgl,a.deskripsi,a.id_kategori,a.jumlah,a.tipe_transaksi,b.nama_kategori FROM tb_transaksi a
                          left join tb_kategori b on a.id_kategori=b.id_kategori
                          where a.id_transaksi = $idget");
                        $rowe = mysqli_fetch_array($querye);

                    ?>  
                <form method="POST">
                    <div class="card">
                        <div class="card-body">                        
                            <div class="form-floating mb-2">
                              <input type="date" class="form-control" value="<?= $rowe['tgl']; ?>" name="tanggal" id="floatingInput" autocomplete="off" required placeholder="Tanggal">
                              <label for="floatingInput">Tanggal</label>
                            </div>
                            <div class="form-floating mb-2">
                              <textarea class="form-control" name="deskripsi"  placeholder="Deskripsi" id="floatingTextarea"><?= $rowe['deskripsi'];?></textarea>
                              <label for="floatingTextarea">Deskripsi</label>
                            </div> 
                             <div class="form-floating mb-2">
                              <input type="number" class="form-control" name="jumlah" value="<?= $rowe['jumlah'] ?>" id="floatingInput" autocomplete="off" required placeholder="Jumlah">
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
                                    if($rowe['id_kategori']==$row['id_kategori'])
                                    {?>
                                      <option value="<?= $row['id_kategori'];?>" selected><?= $row['nama_kategori'];?>                                       
                                      </option>

                                      <?php
                                    }
                                    else{?>

                                      <option value="<?= $row['id_kategori'];?>"><?= $row['nama_kategori'];?></option>
                                      <?php
                                    }
                                        
                                  }                                  
                                
                                ?>                               
                              </select>
                              <label for="floatingSelect">Pilih Kategori</label>
                            </div>
                            <div class="form-floating mb-2">
                              <select class="form-select" name="tipe_transaksi" id="floatingSelect" aria-label="Floating label select example">
                                <option selected disabled="">Pilih tipe transaksi</option>
                                <?php
                                  if($rowe['tipe_transaksi']=="Pemasukan")
                                  {
                                    ?>
                                      <option value="Pemasukan" selected>Pemasukan</option>
                                    <?php
                                  }
                                  else{
                                    ?>
                                       <option value="Pemasukan">Pemasukan</option>
                                    <?php
                                  }
                                 
                                  if($rowe['tipe_transaksi']=="Pengeluaran")
                                  {
                                    ?>
                                      <option value="Pengeluaran" selected>Pengeluaran</option>
                                    <?php
                                  }
                                  else{
                                    ?>
                                       <option value="Pengeluaran">Pengeluaran</option>
                                    <?php
                                  }
                                ?>
                                
                                                            
                              </select>
                              <label for="floatingSelect">Tipe Transaksi</label>
                            </div>
                            <input type="hidden" name="idtr" value="<?= $rowe['id_transaksi'];?>">
                            <input type="submit" name="simpan" class="btn btn-success text-white mt-3 w-100 py-2" value="Simpan">
                            <a href="?page=home" class="btn btn-danger w-100 mt-2 py-2" >Kembali</a>

                        </div>
                    </div>
                </form>
            </div>         
    </div>
</div>
    