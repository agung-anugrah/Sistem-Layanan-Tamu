<?php
include "../../../service/koneksi.php";

session_start();

if(!isset($_SESSION['username'])){
    header("Location: login-admin.php");
    exit();
}
if(isset($_POST['edit'])){
    $id = $_POST['id'];
    $sql = "SELECT * from reservasi_tamu where id='$id'";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();

    $tanggal = '';

    if (!empty($row['tanggal_kunjungan'])) {
        $tanggal = date('Y-m-d\TH:i', strtotime($row['tanggal_kunjungan']));
    }

    ?>

    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Buku Tamu</title>
        <!-- Bootstrap 5 CSS -->
        <link href="../../../script/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../../../css/style-edit-reservasi-tamu.css">
        
    </head>
    <body>
        <main class="content">
            <div class="container my-4">
                <div class="">
                    <form action="../../../crud/edit/edit-reservasi-tamu.php" method="POST" onsubmit="return confirm('simpan perubahan?')">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
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
                                                    <img src="../../../icon/telephone.png" alt="" class="icon">
                                                </span>
                                                
                                                <input type="text" class="form-control" placeholder="08xxxxxxxxxx" name="noHp" required value='<?php echo $row['nohp_tamu'] ?>'>
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
                                                    <img src="../../../icon/mail.png" alt="" class="icon">
                                                </span>
                                                <input type="email" class="form-control" placeholder="nama@email.com" name="email" required value='<?php echo $row['email_tamu'] ?>'>
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
                                            <img src="../../../icon/user.png" alt="" class="icon">
                                        </span>
                                        <input type="text" class="form-control" placeholder="Masukan Nama Lengkap" name="nama" required value='<?php echo $row['nama_tamu'] ?>'>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <img src="../../../icon/pin.png" alt="" class="icon">
                                        </span>
                                        <input type="text" class="form-control" placeholder="Masukan Alamat Lengkap" name="alamat" required value='<?php echo $row['alamat_tamu'] ?>'>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="instansi" class="form-label">Instansi / Lembaga / Masyarakat</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <img src="../../../icon/agency.png" alt="" class="icon">
                                        </span>
                                        <input type="text" class="form-control" placeholder="Masukan Nama Instasi" name="instansi" required value='<?php echo $row['instasi_tamu'] ?>'>
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
                                            <img src="../../../icon/calendar.png" alt="" class="icon">
                                        </span>
                                        <input type="datetime-local" class="form-control" id="rencana" name="tanggal" value="<?= $tanggal ?>">
                                    </div>
                                    <small class="text-muted">mm/dd/yyyy, --:--</small>
                                </div>
                                <div class="mb-3">
                                    <label for="tujuan" class="form-label">Tujuan Kunjungan</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <img src="../../../icon/messenger.png" alt="" class="icon">
                                        </span>
                                        <select class="form-select" id="tujuan" name="tujuan" required>
                                            <option selected disabled>-- Pilih --</option>
                                            <option value="Ketua, Divisi Keuangan, Umum, Rumah Tangga dan Logistik" <?php if($row['tujuan_kunjungan'] == 'Ketua, Divisi Keuangan, Umum, Rumah Tangga dan Logistik') echo 'selected'; ?>>Ketua, Divisi Keuangan, Umum, Rumah Tangga dan Logistik</option>
                                            <option value="Divisi Teknis Penyelenggara"<?php if($row['tujuan_kunjungan'] == 'Divisi Teknis Penyelenggara') echo 'selected'; ?>>Divisi Teknis Penyelenggara</option>
                                            <option value="Divisi Sosialisasi, Pendidikan Pemilih, Partisipasi Masyarakat, dan Sumber Daya Manusia" <?php if($row['tujuan_kunjungan'] == 'Divisi Sosialisasi, Pendidikan Pemilih, Partisipasi Masyarakat, dan Sumber Daya Manusia') echo 'selected'; ?>>Divisi Sosialisasi, Pendidikan Pemilih, Partisipasi Masyarakat dan Sumber Daya Manusia</option>
                                            <option value="Divisi Perencanaan, Data, Dan Informasi" <?php if($row['tujuan_kunjungan'] == 'Divisi Perencanaan, Data, Dan Informasi') echo 'selected'; ?>>Divisi Perencanaan, Data dan Informasi</option>
                                            <option value="Divisi Hukum dan Pengawasan" <?php if($row['tujuan_kunjungan'] == 'Divisi Hukum dan Pengawasan') echo 'selected'; ?>>Divisi Hukum dan Pengawasan</option>
                                            <option value="Sekretaris" <?php if($row['tujuan_kunjungan'] == 'Sekretaris') echo 'selected'; ?>>Sekretaris</option>
                                            <option value="Subbagian Keuangan, Umum dan Logistik" <?php if($row['tujuan_kunjungan'] == 'Subbagian Keuangan, Umum dan Logistik') echo 'selected'; ?>>Subbagian Keuangan, Umum dan Logistik</option>
                                            <option value="Subbagian Teknis Penyelenggaraan Pemilu dan Hukum" <?php if($row['tujuan_kunjungan'] == 'Subbagian Teknis Penyelenggaraan Pemilu dan Hukum') echo 'selected'; ?>>Subbagian Teknis Penyelenggaraan Pemilu dan Hukum</option>
                                            <option value="Subbagian Perencanaan, Data dan Informasi" <?php if($row['tujuan_kunjungan'] == 'Subbagian Perencanaan, Data dan Informasi') echo 'selected'; ?>>Subbagian Perencanaan, Data dan Informasi</option>
                                            <option value="Subbagian Partisipasi, Hubungan Masyarakat, dan Sumber Daya Manusia" <?php if($row['tujuan_kunjungan'] == 'Subbagian Partisipasi, Hubungan Masyarakat, dan Sumber Daya Manusia') echo 'selected'; ?>>Subbagian Partisipasi, Hubungan Masyarakat dan Sumber Daya Manusia</option>
                                            <option value="PPID" <?php if($row['tujuan_kunjungan'] == 'PPID') echo 'selected'; ?>>PPID</option>
                                            <option value="Lainnya" <?php if($row['tujuan_kunjungan'] == 'Lainnya') echo 'selected'; ?>>Lainnya</option>
                                        </select>
                                    </div>
                                    
                                </div>
                                <div class="mb-3">
                                    <label for="maksud" class="form-label">Maksud Kunjungan</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <img src="../../../icon/people.png" alt="" class="icon">
                                        </span>
                                        <select class="form-select" id="Maksud" name="maksud" required value='<?php echo $row['maksud_kunjungan'] ?>'>
                                            <option selected disabled>-- Pilih --</option>
                                            <option value="Permohonan Informasi" <?php if($row['maksud_kunjungan'] == 'Permohonan Informasi') echo 'selected'; ?>>Permohonan Informasi</option>
                                            <option value="Koordinasi Kelembagaan" <?php if($row['maksud_kunjungan'] == 'Koordinasi Kelembagaan') echo 'selected'; ?>>Koordinasi Kelembagaan</option>
                                            <option value="Konsultasi Proses Pemilu" <?php if($row['maksud_kunjungan'] == 'Konsultasi Proses Pemilu') echo 'selected'; ?>>Konsultasi Proses Pemilu</option>
                                            <option value="Pengajuan Permohonan Tertulis" <?php if($row['maksud_kunjungan'] == 'Pengajuan Permohonan Tertulis') echo 'selected'; ?>>Pengajuan Permohonan Tertulis</option>
                                            <option value="Penyampaian Surat Resmi" <?php if($row['maksud_kunjungan'] == 'Penyampaian Surat Resmi') echo 'selected'; ?>>Penyampaian Surat Resmi</option>
                                            <option value="Penyerahan Dokumen" <?php if($row['maksud_kunjungan'] == 'Penyerahan Dokumen') echo 'selected'; ?>>Penyerahan Dokumen</option>
                                            <option value="Pengambilan Dokumen" <?php if($row['maksud_kunjungan'] == 'Pengambilan Dokumen') echo 'selected'; ?>>Pengambilan Dokumen</option>
                                            <option value="Permintaan Data" <?php if($row['maksud_kunjungan'] == 'Permintaan Data') echo 'selected'; ?>>Permintaan Data</option>
                                            <option value="Pertemuan Audiensi" <?php if($row['maksud_kunjungan'] == 'Pertemuan Audiensi') echo 'selected'; ?>>Pertemuan Audiensi</option>
                                            <option value="Silaturahmi Audiensi" <?php if($row['maksud_kunjungan'] == 'Silaturahmi Audiensi') echo 'selected'; ?>>Silaturahmi Audiensi</option>
                                            <option value="Lainnya" <?php if($row['maksud_kunjungan'] == 'Lainnya') echo 'selected'; ?>>Lainnya</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="topik" class="form-label">Topik Kunjungan</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <img src="../../../icon/information.png" alt="" class="icon">
                                        </span>
                                        <textarea class="form-control" id="topik" rows="3" placeholder="Ringkas topik yang akan dibahas" name="topik" value='<?php echo $row['topik_kunjungan'] ?>'><?php echo $row['topik_kunjungan'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input class="btn btn-simpan mb-3 " type="submit" name="simpan" value="Simpan" ></input>
                    </form>
                    <a class="btn btn-kembali" href="../daftar-reservasi.php">Kembali</a>
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
        <!-- Bootstrap JS (untuk komponen interaktif jika diperlukan, tidak wajib untuk layout) -->
        <script src="../../../script/bootstrap.bundle.min.js"></script>
    </body>
    </html>

<?php
}else{
    echo 'test';
}
?>