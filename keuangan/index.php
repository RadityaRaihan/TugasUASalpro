<?php

include "header.php";

if(isset($_GET['page']))
{
    $page = $_GET['page'];

    switch($page){
        case "home";
        include "home.php";
        break;
        case "kategori";
        include "kategori.php";
        break;
        case "edit_kategori";
        include "edit_kategori.php";
        break;
        case "edit_transaksi";
        include "edit_transaksi.php";
        break;
        default:        
        echo "halaman tidak ditemukan";
        break;
    }
    }else {
    include "home.php";
}
include "footer.php";