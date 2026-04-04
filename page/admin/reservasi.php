<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location: login-admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservasi Tamu</title>
    <!-- Bootstrap 5 CSS -->
    <link href="../../script/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/style-reservasi.css">
</head>
<body>
    <main class="content">
        <div class="container-fluid my-4">
            <!-- Baris utama: sidebar kiri dan konten kanan -->
            <div class="row g-4">
                <!-- Kolom kiri (sidebar) - pada layar kecil jadi satu kolom penuh -->
                <div class="col-md-5">
                    <!-- Card Data Kontak -->
                    <div class="main-card">
                        <!-- logo -->
                        <img src="../../img/logo_kpu.png" width="40" class="mb-4">
    
                        <!-- header -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="title">
                                <i class="bi bi-calendar-check-fill me-2"></i>
                                Registrasi Kunjungan
                            </div>
                            <a href="dasboard.php" class="btn btn-kembali">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                        </div>
    
                        <!-- icon -->
                        <div class="icon-box mb-3">
                            <img src="../../icon/calendar.png" alt="" class="icon">
                        </div>
    
                        <!-- text -->
                        <h4 class="heading">Selamat Datang</h4>
    
                        <p class="desc">
                            Silakan lengkapi formulir berikut untuk melakukan reservasi kunjungan ke
                            <b>KPU Kota Padang</b>. Data yang benar membantu proses
                            verifikasi dan penjadwalan lebih cepat.
                        </p>
    
                        <!-- info -->
                        <div class="info-box mt-4">
                            Pastikan tanggal dan tujuan kunjungan sudah sesuai kebutuhan Anda.
                        </div>
    
                    </div>
                </div>
    
                <!-- Kolom kanan (konten utama) -->
                <div class="col-md-7">
                    
                    <form action="../../crud/add/add-reservasi.php" method="POST">
                        <!-- Card contact Pemohon -->
                        <div class="card">
                            <div class="card-header">
                                Contact Pemohon
                            </div>
                            <div class="card-body">
                                <div class="row">
                                        <!-- No HP -->
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">No HP (WhatsApp)</label>
                                            
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <img src="../../icon/telephone.png" alt="" class="icon">
                                                </span>
                                                
                                                <input type="text" class="form-control" placeholder="08xxxxxxxxxx" name="noHp" required>
                                            </div>
                                            
                                            <small class="text-muted">
                                                Gunakan nomor aktif untuk notifikasi jadwal.
                                            </small>
                                        </div>
                                        
                                        <!-- Email -->
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Email</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <img src="../../icon/mail.png" alt="" class="icon">
                                                </span>
                                                <input type="email" class="form-control" placeholder="nama@email.com" name="email" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Card Identitas Pemohon -->
                            <div class="card">
                                <div class="card-header">
                                    Identitas Pemohon
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama Lengkap</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <img src="../../icon/user.png" alt="" class="icon">
                                            </span>
                                            <input type="text" class="form-control" placeholder="Masukan Nama Lengkap" name="nama" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <img src="../../icon/pin.png" alt="" class="icon">
                                            </span>
                                            <input type="text" class="form-control" placeholder="Masukan Alamat Lengkap" name="alamat" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="instansi" class="form-label">Instansi / Lembaga / Masyarakat</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <img src="../../icon/agency.png" alt="" class="icon">
                                            </span>
                                            <input type="text" class="form-control" placeholder="Masukan Nama Instasi" name="instansi" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Card Rencana dan Tujuan -->
                            <div class="card">
                                <div class="card-header">
                                    Rencana dan Tujuan
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="rencana" class="form-label">Rencana Kunjungan</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <img src="../../icon/calendar.png" alt="" class="icon">
                                            </span>
                                            <input type="datetime-local" class="form-control" id="rencana" name="tanggal">
                                        </div>
                                        <small class="text-muted">mm/dd/yyyy, --:--</small>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tujuan" class="form-label">Tujuan Kunjungan</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <img src="../../icon/messenger.png" alt="" class="icon">
                                            </span>
                                            <select class="form-select" id="tujuan" name="tujuan" required>
                                                <option selected disabled>-- Pilih --</option>
                                                <option value="Ketua, Divisi Keuangan, Umum, Rumah Tangga dan Logistik)">Ketua, Divisi Keuangan, Umum, Rumah Tangga dan Logistik</option>
                                                <option value="Divisi Teknis Penyelenggara">Divisi Teknis Penyelenggara</option>
                                                <option value="Divisi Sosialisasi, Pendidikan Pemilih, Partisipasi Masyarakat, dan Sumber Daya Manusia">Divisi Sosialisasi, Pendidikan Pemilih, Partisipasi Masyarakat dan Sumber Daya Manusia</option>
                                                <option value="Divisi Perencanaan, Data, Dan Informasi">Divisi Perencanaan, Data dan Informasi</option>
                                                <option value="Divisi Hukum dan Pengawasan">Divisi Hukum dan Pengawasan</option>
                                                <option value="Sekretaris">Sekretaris</option>
                                                <option value="Subbagian Keuangan, Umum dan Logistik">Subbagian Keuangan, Umum dan Logistik</option>
                                                <option value="Subbagian Teknis Penyelenggaraan Pemilu dan Hukum">Subbagian Teknis Penyelenggaraan Pemilu dan Hukum</option>
                                                <option value="Subbagian Perencanaan, Data dan Informasi">Subbagian Perencanaan, Data dan Informasi</option>
                                                <option value="Subbagian Partisipasi, Hubungan Masyarakat, dan Sumber Daya Manusia">Subbagian Partisipasi, Hubungan Masyarakat dan Sumber Daya Manusia</option>
                                                <option value="PPID">PPID</option>
                                                <option value="Lainnya">Lainnya</option>
                                            </select>
                                        </div>
                                        
                                    </div>
                                    <div class="mb-3">
                                        <label for="maksud" class="form-label">Maksud Kunjungan</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <img src="../../icon/people.png" alt="" class="icon">
                                            </span>
                                            <select class="form-select" id="Maksud" name="maksud" required>
                                                <option selected disabled>-- Pilih --</option>
                                                <option value="Permohonan Informasi">Permohonan Informasi</option>
                                                <option value="Koordinasi Kelembagaan">Koordinasi Kelembagaan</option>
                                                <option value="Konsultasi Proses Pemilu">Konsultasi Proses Pemilu</option>
                                                <option value="Pengajuan Permohonan Tertulis">Pengajuan Permohonan Tertulis</option>
                                                <option value="Penyampaian Surat Resmi">Penyampaian Surat Resmi</option>
                                                <option value="Penyerahan Dokumen">Penyerahan Dokumen</option>
                                                <option value="Pengambilan Dokumen">Pengambilan Dokumen</option>
                                                <option value="Permintaan Data">Permintaan Data</option>
                                                <option value="Pertemuan Audiensi">Pertemuan Audiensi</option>
                                                <option value="Silaturahmi Audiensi">Silaturahmi Audiensi</option>
                                                <option value="Lainnya">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="topik" class="form-label">Topik Kunjungan</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <img src="../../icon/information.png" alt="" class="icon">
                                            </span>
                                            <textarea class="form-control" id="topik" rows="3" placeholder="Ringkas topik yang akan dibahas" name="topik" ></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Tombol Buat Reservasi -->
                            <input class="btn btn-reservasi" type="submit" name="simpan" value="Buat Reservasi Kunjungan"></input>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <footer class="bg-dark text-white text-center py-3">
        <div class="container">
            <p class="mb-1">
                © <?php echo date("Y"); ?> Sistem Layanan Tamu KPU Kota Padang
            </p>
            <small>Developed by Agung Anugrah Illahi</small>
        </div>
    </footer> 
    <!-- Bootstrap JS (untuk komponen interaktif jika diperlukan, tidak wajib untuk layout) -->
    <script src="../../script/bootstrap.bundle.min.js"></script>
</body>
</html>