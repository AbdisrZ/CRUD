<?php
require_once 'config/database.php';
require_once 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $conn->real_escape_string($_POST['nama']);
    $alamat = $conn->real_escape_string($_POST['alamat']);
    $jenis_kelamin = $conn->real_escape_string($_POST['jenis_kelamin']);
    $umur = $conn->real_escape_string($_POST['umur']);
    $no_telepon = $conn->real_escape_string($_POST['no_telepon']);
    $riwayat_penyakit = $conn->real_escape_string($_POST['riwayat_penyakit']);
    $tanggal_daftar = $conn->real_escape_string($_POST['tanggal_daftar']);
    $status = $conn->real_escape_string($_POST['status']);

    $query = "INSERT INTO pasien (nama, alamat, jenis_kelamin, umur, no_telepon, riwayat_penyakit, tanggal_daftar, status) 
              VALUES ('$nama', '$alamat', '$jenis_kelamin', '$umur', '$no_telepon', '$riwayat_penyakit', '$tanggal_daftar', '$status')";

    if ($conn->query($query)) {
        header("Location: index.php?success=Pasien berhasil ditambahkan");
        exit();
    } else {
        $error = "Error: " . $conn->error;
    }
}
?>

<h2 class="mb-4">Tambah Data Pasien Baru</h2>

<?php if (isset($error)): ?>
    <div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

<form action="add_pasien.php" method="POST">
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <div class="col-md-6">
            <label for="no_telepon" class="form-label">Nomor Telepon</label>
            <input type="tel" class="form-control" id="no_telepon" name="no_telepon" required>
        </div>
    </div>
    
    <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
    </div>
    
    <div class="row mb-3">
        <div class="col-md-3">
            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="">Pilih...</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>
        <div class="col-md-3">
            <label for="umur" class="form-label">Umur</label>
            <input type="number" class="form-control" id="umur" name="umur" min="0" max="120" required>
        </div>
        <div class="col-md-3">
            <label for="tanggal_daftar" class="form-label">Tanggal Daftar</label>
            <input type="date" class="form-control" id="tanggal_daftar" name="tanggal_daftar" required>
        </div>
        <div class="col-md-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status" required>
                <option value="Aktif">Aktif</option>
                <option value="Non-Aktif">Non-Aktif</option>
            </select>
        </div>
    </div>
    
    <div class="mb-3">
        <label for="riwayat_penyakit" class="form-label">Riwayat Penyakit (Opsional)</label>
        <textarea class="form-control" id="riwayat_penyakit" name="riwayat_penyakit" rows="2"></textarea>
    </div>
    
    <button type="submit" class="btn btn-primary">Simpan Data</button>
    <a href="index.php" class="btn btn-secondary">Kembali</a>
</form>

<?php require_once 'includes/footer.php'; ?>