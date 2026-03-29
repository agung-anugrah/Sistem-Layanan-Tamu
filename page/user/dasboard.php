<?php
include "../../service/koneksi.php";
session_start();
$_SESSION['role'] = 'user';

$sql = "SELECT 
        DATE(MIN(tanggal_kunjungan)) AS tanggal_awal,
        DATE(MAX(tanggal_kunjungan)) AS tanggal_akhir
        FROM buku_tamu";

$result = $db->query($sql);
$data = $result->fetch_assoc();

$tanggal_awal = $data['tanggal_awal'];
$tanggal_akhir = $data['tanggal_akhir'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Layanan Tamu</title>
</head>
<link href="../../script/bootstrap.min.css" rel="stylesheet" >
<link rel="stylesheet" href="../../css/style-dasboard.css">
<body>
    <main class="content">
        <div class="container">
            <div class="mb-4 mt-2 row text-center">
                <a href="../../">
                    <img src="../../img/kpu.png" class="banner" >
                </a>
            </div>
        </div>
        <div class="container py-4 ">
    
            <!-- Judul -->
            <div class="text-center mb-5">
                <h1 class="main-title">Sistem Layanan Tamu</h1>
                <p class="lead">
                Selamat datang di <b>Sistem Layanan Tamu KPU Kota Padang.</b><br>
                Pilih layanan di bawah ini agar proses Anda lebih cepat, jelas,
                dan terdokumentasi dengan baik.
                </p>
            </div>
    
            <!-- Card Menu -->
            <div class="row justify-content-end align-items-start">
    
                <!-- rencana kunjungan -->
                <div class="col-md-6 ">
                    <div class="card card-menu shadow-sm p-4 mb-4">
                        <div class="icon-box mb-3">
                            <img src="../../icon/kelender.png" alt="" class='icon icon-kelender'>
                        </div>
                        <h4 class="fw-bold">Rencana Kunjungan</h4>
                        <p class="text-muted">
                            Silakan jadwalkan kunjungan terlebih dahulu.
                        </p>
                        <a class="btn btn-success btn-lg" href="reservasi.php">
                            Buat Rencana Kunjungan
                        </a>
                    </div>
                </div>
                
                <!-- Daftar hadir -->
                <div class="col-md-6">
                    <div class="card card-menu shadow-sm p-4 mb-4">
                        <div class="icon-box mb-3">
                            <img src="../../icon/memo.png" alt="" class='icon icon-memo'>
                        </div>
                        <h4 class="fw-bold">Daftar Hadir Tamu</h4>
                        <p class="text-muted">
                            Gunakan saat tamu sudah hadir di kantor untuk pencatatan kunjungan.
                        </p>
                        <a class="btn btn-danger btn-lg" href="buku-tamu.php">
                            Isi Daftar Hadir
                        </a>
                    </div>
                </div>
                
                
                <!-- tanggal -->
                <div class="container mt-4">
                    <div class="card card-menu shadow-sm p-4 mb-4">
                        <div class="row g-3 align-items-end">
    
                            <!-- Tanggal Mulai -->
                            <div class="col-md-4">
                                <label class="form-label">Tanggal Mulai</label>
                                <input type="date" class="form-control" value="<?php echo $tanggal_awal ?>" name="tanggal_mulai" id="tanggal_mulai">
                            </div>
                        
                            <!-- Tanggal Akhir -->
                            <div class="col-md-4">
                                <label class="form-label">Tanggal Akhir</label>
                                <input type="date" class="form-control" value="<?php echo $tanggal_akhir ?>" name="tanggal_akhir" id="tanggal_akhir">
                            </div>
                            
                            <!-- Tombol -->
                            <div class="col-md-4">
                                <button id="submit"  name="simpan" class="btn btn-success w-100 btn-lg d-flex justify-content-center align-items-center gap-2">
                                    <img src="../../icon/filter.png" alt="" class="icon icon-filter">
                                    Terapkan Filter
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- line chart -->
                <div class="container mt-4">
                    <div class="card card-menu shadow-sm p-4 mb-4">
                        <h5>Jumlah kunjungan Perhari</h5>
                        <div class="container-chart">
                            <canvas id="myChart1"></canvas>
                        </div>
                    </div>
                </div>

        
                <!-- doughnut chart -->
                <div class="col-md-6 ">
                    <div class="card card-menu shadow-sm p-4 mb-4">
                        <h5>Maksud kunjungan</h5>
                        <div class="container-chart d-flex justify-content-center align-items-center">
                            <canvas id="myChart2"></canvas>
                        </div>
                    </div>
                </div>
                <!--bar chart jumlah kunjungan  -->
                <div class="col-md-6 ">
                    <div class="card card-menu shadow-sm p-4 mb-4 chart3">
                        <h5>Jumlah Per Tujuan Kunjungan</h5>
                        <div class="container-chart chart3">
                            <canvas id="myChart3"></canvas>
                        </div>
                    </div>
                </div>

    
    
                <!--bar chart kunjungan per jam  -->
                <div class="col-md-6">
                    <div class="card card-menu shadow-sm p-4 mb-4">
                        <h5>Kunjungan per Jam</h5>
                        <div class="container-chart">
                            <canvas id="myChart4"></canvas>
                        </div>
                    </div>
                </div>
    
                <!--bar chart kunjungan per hari kerja  -->
                <div class="col-md-6">
                    <div class="card card-menu shadow-sm p-4 mb-4">
                        <h5>Kunjungan per Hari Kerja</h5>
                        <div class="container-chart">
                            <canvas id="myChart5"></canvas>
                        </div>
                    </div>
                </div>
                
            </div>
        </div> 
    </main>
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <div class="container container-footer">
            <p class="mb-1">
                © <?php echo date("Y"); ?> Sistem Layanan Tamu KPU Kota Padang
            </p>
            <small>Developed by Agung Anugrah Illahi</small>
        </div>
    </footer>
    <script src="../../js/chart.umd.min.js"></script>
    <script src="../../js/config.chart.js"></script> 
    <script src="../../script/bootstrap.bundle.min.js" ></script>
</body>
</html>
<?php
$db->close();
?>