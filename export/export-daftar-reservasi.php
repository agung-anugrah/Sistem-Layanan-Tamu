<?php
include "../service/koneksi.php";

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=daftar_rencana_kunjungan_tamu.xls");

$sql = "SELECT * FROM reservasi_tamu";
$result = $db->query($sql);
?>

<table border="1">
<tr>
<?php
$fields = $result->fetch_fields();
foreach ($fields as $field) {
    if($field->name != 'id'){
        echo "<th>".ucwords(str_replace("_"," ",$field->name))."</th>";
    }
}
?>
</tr>

<?php
while($row = $result->fetch_assoc()){
    echo "<tr>";
    foreach($row as $key => $data){
        if($key != 'id'){
            echo "<td>".$data."</td>";
        }
    }
    echo "</tr>";
}
?>

</table>