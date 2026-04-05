<?php
include "../../service/koneksi.php";

session_start();

if(!isset($_SESSION['username'])){
    header("Location: login-admin.php");
    exit();
}

$sql = "SELECT * From buku_tamu ";
$result = $db -> query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Hadir Tamu</title>
    <link href="../../script/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../script/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="../../css/style-daftar-hadir.css">
</head>
<body>
    <main class="content">
        <div class="container">
            <div class="card p-4 mt-4">
                <div class="d-flex justify-content-center">
                    <h4 class="main-title col-md-3 text-center">Daftar Hadir Tamu</h4>
                </div>
                <div class="d-flex justify-content-between mt-3 mb-3">
                    <a class="btn btn-kembali" href="dasboard.php">Kembali</a>
                    <a class="btn btn-unduh" href="../../export/export-daftar-hadir.php">Unduh Daftar</a>
                </div>
    
                <div class="table-container">
                    <table id="tabelTamu" class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    NO
                                </th>
                                <?php
                                $fields = $result->fetch_fields();
                                foreach ($fields as $field) {
                                     if($field->name != 'id' && $field->name != 'kirim_survei'){?>
                                        <th class='text-center'>
                                            <?php echo(ucwords(str_replace("_"," ",$field->name)))?>
                                        </th>
                                    <?php
                                    }
                                }
                                ?>
                                <th class="text-center">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <div class="container">
            <p class="mb-1">
                © <?php echo date("Y"); ?> Sistem Layanan Tamu KPU Kota Padang
            </p>
            <small>Developed by Agung Anugrah Illahi</small>
        </div>
    </footer> 

    <script src="../../script/bootstrap.bundle.min.js"></script>
    <script src="../../script/jquery-3.7.1.js"></script>
    <script src="../../script/jquery.dataTables.min.js"></script>
    <script src="../../script/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#tabelTamu').DataTable({
                processing: true,
                serverSide: true,
                ajax: '../../server/server-side-buku-tamu.php',
                pageLength: 10,
                scrollX: true,
                scrollCollapse: true,
                dom: '<"top"f>rt<"bottom"lip>',
            });
        });

    </script>
</body>
</html>

<?php
$db->close();
?>