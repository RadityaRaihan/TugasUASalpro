<?php

$con = mysqli_connect('localhost','root','','db_keuangan');

if(!$con)
{
	echo "tidak terkoneksi ke database";
}

