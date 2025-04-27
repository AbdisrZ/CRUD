<?php
require_once 'config/database.php';
require_once 'includes/header.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $conn->real_escape_string($_GET['id']);

// Ambil data pasien yang akan diedit
$query = "SELECT * FROM pasien WHERE id = '$id'";
$result = $conn->query($query);

if ($result->num_rows === 0) {
    header("Location: index.php");
    exit();
}

$pasien = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $conn->real_escape_string($_POST['nama']);
    $alamat = $conn->real_escape_string($_POST['alamat']);
    $jenis_kelamin = $conn->real_escape_string($_POST['jenis_kelamin']);
    $umur = $conn->real_escape_string($_POST['umur']);
    $no_telepon = $conn->real_escape_string($_POST['no_telepon']);
    $riwayat_penyakit = $conn->real_escape_string($_POST['riwayat_penyakit']);
    $status = $conn->real_escape_string($_POST['status']);

    $query = "UPDATE pasien SET 
              nama = '$nama',
              alamat = '$alamat',
              jenis_kelamin = '$jenis_kelamin',
              umur = '$umur',
              no_telepon = '$no_telepon',
              riwayat_penyakit = '$riwayat_penyakit',
              status = '$status'
              WHERE id = '$id'";

    if ($conn->query($query)) {
        header("Location: index.php?success=Data pasien berhasil diperbarui");
        exit();
    } else {
        $error = "Error: " . $conn->error;
    }
}
?>

<h2 class="mb-4">Edit Data Pasien</h2>

<?php if (isset($error)): ?>
    <div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

<form action="edit_pasien.php?id=<?= $pasien['id'] ?>" method="POST">
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= htmlspecialchars($pasien['nama']) ?>" required>
        </div>
        <div class="col-md-6">
            <label for="no_telepon" class="form-label">Nomor Telepon</label>
            <input type="tel" class="form-control" id="no_telepon" name="no_telepon" value="<?= htmlspecialchars($pasien['no_telepon']) ?>" required>
        </div>
    </div>
    
    <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?= htmlspecialchars($pasien['alamat']) ?></textarea>
    </div>
    
    <div class="row mb-3">
        <div class="col-md-3">
            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="Laki-laki" <?= $pasien['jenis_kelamin'] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                <option value="Perempuan" <?= $pasien['jenis_kelamin'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
            </select>
        </div>
        <div class="col-md-3">
            <label for="umur" class="form-label">Umur</label>
            <input type="number" class="form-control" id="umur" name="umur" min="0" max="120" value="<?= htmlspecialchars($pasien['umur']) ?>" required>
        </div>
        <div class="col-md-3">
            <label for="tanggal_daftar" class="form-label">Tanggal Daftar</label>
            <input type="date" class="form-control" id="tanggal_daftar" name="tanggal_daftar" value="<?= htmlspecialchars($pasien['tanggal_daftar']) ?>" readonly>
        </div>
        <div class="col-md-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status" required>
                <option value="Aktif" <?= $pasien['status'] == 'Aktif' ? 'selected' : '' ?>>Aktif</option>
                <option value="Non-Aktif" <?= $pasien['status'] == 'Non-Aktif' ? 'selected' : '' ?>>Non-Aktif</option>
            </select>
        </div>
    </div>
    
    <div class="mb-3">
        <label for="riwayat_penyakit" class="form-label">Riwayat Penyakit (Opsional)</label>
        <textarea class="form-control" id="riwayat_penyakit" name="riwayat_penyakit" rows="2"><?= htmlspecialchars($pasien['riwayat_penyakit']) ?></textarea>
    </div>
    
    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    <a href="index.php" class="btn btn-secondary">Kembali</a>
</form>

<?php require_once 'includes/footer.php'; ?>