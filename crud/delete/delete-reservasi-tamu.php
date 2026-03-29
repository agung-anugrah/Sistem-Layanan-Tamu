<?php
include "../../service/koneksi.php";

if(isset($_POST['hapus'])){
    $id = (int) $_POST['id'];

    $stmt = $db->prepare("DELETE FROM reservasi_tamu WHERE id = ?");
    $stmt->bind_param("i", $id);

    if($stmt->execute()){
        header("Location: ../../page/daftar-reservasi.php");
        exit;
    } else {
        echo "Gagal hapus: " . $stmt->error;
    }
}
?>