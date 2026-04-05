<?php
include "../service/koneksi.php";
include "resPhone-daftar-reservasi-tamu.php";

// ambil yang sudah lewat 30 menit
$query = $db->query("
    SELECT * FROM reservasi_tamu
    WHERE tanggal_kunjungan <= NOW() - INTERVAL 1 SECOND
    AND kirim_survei = 0
");

while($row = $query->fetch_assoc()){

    $nama = $row['nama_tamu'];
    $tujuan_kunjungan = $row['tujuan_kunjungan'];
    $nohp = formatNomor($row['nohp_tamu']);
    $pesan = "Halo $nama \n\n"
           . "Terimakasi telah melakukan kunjungan pada $tujuan_kunjungan KPU Kota Padang\n"
           . "Berikut merupankan survei kepuasan yang di lakukan demi meningkatkan pelayanan kami:\n"
           . "https://link-survey.com";

    kirimWA($nohp, $pesan);

    // update status
    $db->query("UPDATE buku_tamu SET kirim_survei=1 WHERE id=".$row['id']);
}
?>