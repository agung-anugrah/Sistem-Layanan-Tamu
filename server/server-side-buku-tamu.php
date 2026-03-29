<?php
include "../service/koneksi.php";

$limit = $_GET['length'];
$start = $_GET['start'];
$search = $_GET['search']['value'];

// Query total data
$totalQuery = "SELECT COUNT(*) as total FROM buku_tamu";
$totalResult = $db->query($totalQuery);
$totalData = $totalResult->fetch_assoc()['total'];

// Query utama
$sql = "SELECT * FROM buku_tamu";


if(!empty($search)){
    $where = " WHERE nama_tamu LIKE '%$search%' 
        OR nohp_tamu LIKE '%$search%' 
        OR email_tamu LIKE '%$search%' 
        OR alamat_tamu LIKE '%$search%'";  
    $sql .= $where;

    $countFilter = "SELECT COUNT(*) as total FROM buku_tamu " . $where;
    $resultFilter = $db->query($countFilter);
    $totalFiltered = $resultFilter->fetch_assoc()['total'];
} else {
    $totalFiltered = $totalData;
}

$sql .= " LIMIT $start, $limit";

$result = $db->query($sql);

$data = [];
$no = $start + 1;

while($row = $result->fetch_assoc()){
    $sub = [];
    $sub[] = $no++;
    
    foreach($row as $key => $val){
        if($key != 'id'){
            $sub[] = ucwords($val);
        }
    }

    $sub[] = "
        <form action='../crud/delete/delete-buku-tamu.php' method='POST' onsubmit=\"return confirm('hapus?')\">
            <input type='hidden' name='id' value='".$row['id']."'>
            <button class='btn btn-danger btn-sm' name='hapus'>Hapus</button>
        </form>
    ";

    $data[] = $sub;
}

// Response ke DataTables
$response = [
    "draw" => intval($_GET['draw']),
    "recordsTotal" => $totalData,
    "recordsFiltered" => $totalFiltered,
    "data" => $data
];

echo json_encode($response);
?>