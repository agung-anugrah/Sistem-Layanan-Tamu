<?php
session_start();
include "../../service/koneksi.php";
include "../../response/resPhone-daftar-hadir-tamu.php";


if(isset($_POST["simpan"])){

    // Ambil dan bersihkan data
    $noHp     = trim($_POST['noHp'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $nama     = trim($_POST['nama'] ?? '');
    $alamat   = trim($_POST['alamat'] ?? '');
    $instansi = trim($_POST['instansi'] ?? '');
    $tujuan   = trim($_POST['tujuan'] ?? '');
    $maksud   = trim($_POST['maksud'] ?? '');
    $topik    = trim($_POST['topik'] ?? '');

    date_default_timezone_set('Asia/Jakarta');
    $tanggal = date("Y-m-d H:i:s");

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



    // Prepared Statement (lebih aman dari SQL Injection)
    $stmt = $db->prepare("INSERT INTO buku_tamu 
        (nohp_tamu,email_tamu,nama_tamu,alamat_tamu,instasi_tamu,tanggal_kunjungan,tujuan_kunjungan,maksud_kunjungan,topik_kunjungan) 
        VALUES (?,?,?,?,?,?,?,?,?)");

    $stmt->bind_param(
        "sssssssss",
        $data["noHp"],
        $data["email"],
        $data["nama"], 
        $data["alamat"],
        $data["instansi"],
        $data["tanggal"],
        $data["tujuan"],
        $data["maksud"],
        $data["topik"]
    );


    if($stmt->execute()){

        // format no wa
        $data['noHp'] = formatNomor($data['noHp']);

        // format pesan WA
        $pesan = formatPesan($data['nama'],$data['tujuan'],$data['maksud'],$data['tanggal']);

        // trigger kirim WA
        kirimWA($data['noHp'], $pesan);

       if ($_SESSION['role'] == 'user') {
            $redirect = "../../page/user/dasboard.php?status=sukses";
        } else if($_SESSION['role'] == 'admin') {
            $redirect = "../../page/admin/dasboard.php?status=sukses";
        }
        else{
            $redirect = "../../";
        }

        header("Location: " . $redirect);
        exit;
    }else{
        echo "Gagal menyimpan data: ".$stmt->error;
    }
    $stmt->close();
}



?>