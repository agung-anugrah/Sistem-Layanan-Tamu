<?php
include "../../service/koneksi.php";
if(isset($_POST['simpan'])){
    $id       = trim($_POST['id'] ?? '');
    $noHp     = trim($_POST['noHp'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $nama     = trim($_POST['nama'] ?? '');
    $alamat   = trim($_POST['alamat'] ?? '');
    $instansi = trim($_POST['instansi'] ?? '');
    $tanggal  = trim($_POST['tanggal'] ?? '');
    $tujuan   = trim($_POST['tujuan'] ?? '');
    $maksud   = trim($_POST['maksud'] ?? '');
    $topik    = trim($_POST['topik'] ?? '');

    // Validasi wajib isi
    $data = [
        'noHp' => $noHp,
        'email' => $email,
        'nama' => $nama,
        'alamat' => $alamat,
        'instansi' => $instansi,
        'tanggal' => $tanggal,
        'tujuan' => $tujuan,
        'maksud' => $maksud,
        'topik' => $topik
    ];

    foreach ($data as $key => $value) {
        if($key != 'tanggal'){
            $data[$key] = empty($value) ? "kosong" : $value;
        }
    }

    $stmt = $db->prepare("UPDATE reservasi_tamu SET nohp_tamu=?, email_tamu=?, nama_tamu=?, alamat_tamu=?, instasi_tamu=?,tanggal_kunjungan=?, tujuan_kunjungan=?, maksud_kunjungan=?, topik_kunjungan=? WHERE id=?");

    $stmt->bind_param(
        "sssssssssi",
        $data["noHp"],
        $data["email"],
        $data["nama"], 
        $data["alamat"],
        $data["instansi"],
        $data["tanggal"],
        $data["tujuan"],
        $data["maksud"],
        $data["topik"],
        $id
    );

    if($stmt->execute()){
        header("Location:../../page/admin/daftar-reservasi.php?status=sukses");
        exit;
    }else{
        echo "Gagal menyimpan data: ".$stmt->error;
    }
    $stmt->close();
}

?>