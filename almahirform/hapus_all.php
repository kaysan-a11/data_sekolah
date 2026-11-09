<?php
    include 'koneksi.php';
        $no_induk = $_GET['no_induk'];
        $query = "DELETE FROM tb_santri WHERE no_induk = '$no_induk'";
        mysqli_query($conn, $query);
        header("Location: data_santri.php");

        $nip = $_GET['nip'];
        $query = "DELETE FROM tb_ustad WHERE nip = '$nip'";
        mysqli_query($conn, $query);
        header("Location: data_ustad.php");
?>