<?php
header('Content-Type: application/json');
include "../service/koneksi.php";



$response = [];



/* =========================
   CHART 1 : Kunjungan Harian
   ========================= */


$tanggal_mulai = $_POST['tanggal_mulai'] ?? null;
$tanggal_akhir = $_POST['tanggal_akhir'] ?? null;

if($tanggal_mulai && $tanggal_akhir){
    $sql = "SELECT 
            DATE(tanggal_kunjungan) AS tanggal,
            COUNT(*) AS jumlah
            FROM buku_tamu
            WHERE DATE(tanggal_kunjungan) 
            BETWEEN '$tanggal_mulai' AND '$tanggal_akhir'
            GROUP BY DATE(tanggal_kunjungan)
            ORDER BY tanggal";
}else{
    $sql = "SELECT 
            DATE(tanggal_kunjungan) AS tanggal,
            COUNT(*) AS jumlah
            FROM buku_tamu
            GROUP BY DATE(tanggal_kunjungan)
            ORDER BY tanggal";
}

$result = $db->query($sql);

$labels = [];
$data = [];

while($row = $result->fetch_assoc()){
    $labels[] = $row['tanggal'];
    $data[] = $row['jumlah'];
}

$response['harian'] = [
    "labels" => $labels,
    "data" => $data
];


/* =========================
   CHART 2 : Maksud Kunjungan
   ========================= */

if(isset($_POST["simpan"])){

    $tanggal_mulai = $_POST['tanggal_mulai'];
    $tanggal_akhir = $_POST['tanggal_akhir'];

    $sql2 = "SELECT 
            maksud_kunjungan,
            COUNT(*) AS jumlah
            FROM buku_tamu
            WHERE DATE(tanggal_kunjungan) 
            BETWEEN '$tanggal_mulai' AND '$tanggal_akhir'
            GROUP BY maksud_kunjungan
            ORDER BY jumlah DESC";

}else{

    $sql2 = "SELECT 
            maksud_kunjungan,
            COUNT(*) AS jumlah
            FROM buku_tamu
            GROUP BY maksud_kunjungan
            ORDER BY jumlah DESC";
}

$result2 = $db->query($sql2);

$labels2 = [];
$data2 = [];

while($row = $result2->fetch_assoc()){
    $labels2[] = $row['maksud_kunjungan'];
    $data2[] = $row['jumlah'];
}

$response['maksud'] = [
    "labels" => $labels2,
    "data" => $data2
];

/* ========================= */

//  respon 
if(isset($_POST["simpan"])){

    $tanggal_mulai = $_POST['tanggal_mulai'];
    $tanggal_akhir = $_POST['tanggal_akhir'];

    $sql3 = "SELECT 
            tujuan_kunjungan,
            COUNT(*) AS jumlah
            FROM buku_tamu
            WHERE DATE(tanggal_kunjungan) 
            BETWEEN '$tanggal_mulai' AND '$tanggal_akhir'
            GROUP BY tujuan_kunjungan
            ORDER BY jumlah DESC";

}else{

    $sql3 = "SELECT 
            tujuan_kunjungan,
            COUNT(*) AS jumlah
            FROM buku_tamu
            GROUP BY tujuan_kunjungan
            ORDER BY jumlah DESC";
}
$result3 = $db->query($sql3);

$labels3 = [];
$data3 = [];

while($row = $result3->fetch_assoc()){
    $labels3[] = $row['tujuan_kunjungan'];
    $data3[] = $row['jumlah'];
}

$response['tujuan'] = [
    "labels" => $labels3,
    "data" => $data3
];


if(isset($_POST["simpan"])){

    $tanggal_mulai = $_POST['tanggal_mulai'];
    $tanggal_akhir = $_POST['tanggal_akhir'];

    $sql4 = "SELECT 
            HOUR(tanggal_kunjungan) AS jam,
            COUNT(*) AS jumlah
            FROM buku_tamu
            WHERE DATE(tanggal_kunjungan) 
            BETWEEN '$tanggal_mulai' AND '$tanggal_akhir'
            GROUP BY HOUR(tanggal_kunjungan)
            ORDER BY jam";

}else{

    $sql4 = "SELECT 
            HOUR(tanggal_kunjungan) AS jam,
            COUNT(*) AS jumlah
            FROM buku_tamu
            GROUP BY HOUR(tanggal_kunjungan)
            ORDER BY jam";

}

$result4 = $db->query($sql4);

$labels4 = [];
$data4 = [];

while($row = $result4->fetch_assoc()){
    $labels4[] = $row['jam'].":00";
    $data4[] = $row['jumlah'];
}

$response['jam'] = [
    "labels" => $labels4,
    "data" => $data4
];

if(isset($_POST["simpan"])){

    $tanggal_mulai = $_POST['tanggal_mulai'];
    $tanggal_akhir = $_POST['tanggal_akhir'];

    $sql5 = "SELECT 
            CASE DAYOFWEEK(tanggal_kunjungan)
                WHEN 2 THEN 'Senin'
                WHEN 3 THEN 'Selasa'
                WHEN 4 THEN 'Rabu'
                WHEN 5 THEN 'Kamis'
                WHEN 6 THEN 'Jumat'
            END AS hari,
            COUNT(*) AS jumlah
            FROM buku_tamu
            WHERE DAYOFWEEK(tanggal_kunjungan) BETWEEN 2 AND 6
            AND DATE(tanggal_kunjungan) 
            BETWEEN '$tanggal_mulai' AND '$tanggal_akhir'
            GROUP BY DAYOFWEEK(tanggal_kunjungan)
            ORDER BY DAYOFWEEK(tanggal_kunjungan)";

}else{

    $sql5 = "SELECT 
            CASE DAYOFWEEK(tanggal_kunjungan)
                WHEN 2 THEN 'Senin'
                WHEN 3 THEN 'Selasa'
                WHEN 4 THEN 'Rabu'
                WHEN 5 THEN 'Kamis'
                WHEN 6 THEN 'Jumat'
            END AS hari,
            COUNT(*) AS jumlah
            FROM buku_tamu
            WHERE DAYOFWEEK(tanggal_kunjungan) BETWEEN 2 AND 6
            GROUP BY DAYOFWEEK(tanggal_kunjungan)
            ORDER BY DAYOFWEEK(tanggal_kunjungan)";
}

$result5 = $db->query($sql5);

$labels5 = [];
$data5 = [];

while($row = $result5->fetch_assoc()){
    $labels5[] = $row['hari'];
    $data5[] = $row['jumlah'];
}

$response['hari'] = [
    "labels" => $labels5,
    "data" => $data5
];

echo json_encode($response);


// tutup semua result
$result->free();
$result2->free();
$result3->free();
$result4->free();
$result5->free();

// tutup koneksi
$db->close();