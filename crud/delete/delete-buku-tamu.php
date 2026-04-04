<?php
include "../../service/koneksi.php";

if(isset($_POST['hapus'])){
    $id = (int) $_POST['id'];

    $stmt = $db->prepare("DELETE FROM buku_tamu WHERE id = ?");
    $stmt->bind_param("i", $id);

    if($stmt->execute()){
        header("Location: ../../page/admin/daftar-hadir.php");
        exit;
    } else {
        echo "Gagal hapus: " . $stmt->error;
    }
}
?>