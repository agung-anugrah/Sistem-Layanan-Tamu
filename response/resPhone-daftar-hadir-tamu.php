<?php

function kirimWA($target, $pesan) {
    $token = "PWaeo39ATAU11BjfetPs";
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api.fonnte.com/send',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_POST => true,
      CURLOPT_POSTFIELDS => array(
        'target' => $target,
        'message' => $pesan,
      ),
      CURLOPT_HTTPHEADER => array(
        'Authorization: ' . $token
      ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    return $response;
}


// format no hp
function formatNomor($noHp){
    // hapus spasi & karakter aneh
    $noHp = preg_replace('/[^0-9]/', '', $noHp);

    if(substr($noHp, 0, 2) == "62"){
        return $noHp; // sudah benar
    } elseif(substr($noHp, 0, 1) == "0"){
        return "62" . substr($noHp, 1);
    } else {
        return "62" . $noHp;
    }
}


// format pesan
function formatPesan($nama,$tujuan,$maksud,$tanggal){
    return "Halo {$nama},

Terima kasih telah mengisi Daftar Hadir Tamu pada *Sistem Layanan Tamu KPU Kota Padang*.

Kehadiran Anda sangat kami apresiasi. Data yang Anda berikan akan digunakan untuk meningkatkan kualitas pelayanan serta memastikan proses administrasi yang tertib, transparan, dan akuntabel.

──────────────────

📌 *Detail Kunjungan*
Tujuan : *{$tujuan}*
Maksud : *{$maksud}*

──────────────────

📞 *Kontak Resmi KPU Kota Padang*
Telp : -
WhatsApp : 000
Email : -
Fax : -

──────────────────

Salam hormat,
*KPU Kota Padang*

🕒 {$tanggal}";
}