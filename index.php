<?php
require_once 'config/database.php';
require_once 'includes/header.php';

// Query untuk mendapatkan data pasien
$query = "SELECT * FROM pasien ORDER BY tanggal_daftar DESC";
$result = $conn->query($query);
?>

<h2 class="mb-4">Daftar Pasien</h2>

<?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= htmlspecialchars($_GET['success']) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Jenis Kelamin</th>
                <th>Umur</th>
                <th>Telepon</th>
                <th>Tanggal Daftar</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']) ?></td>
                        <td><?= htmlspecialchars($row['nama']) ?></td>
                        <td><?= htmlspecialchars(substr($row['alamat'], 0, 30)) ?>...</td>
                        <td><?= htmlspecialchars($row['jenis_kelamin']) ?></td>
                        <td><?= htmlspecialchars($row['umur']) ?></td>
                        <td><?= htmlspecialchars($row['no_telepon']) ?></td>
                        <td><?= date('d/m/Y', strtotime($row['tanggal_daftar'])) ?></td>
                        <td>
                            <span class="badge bg-<?= $row['status'] == 'Aktif' ? 'success' : 'danger' ?>">
                                <?= htmlspecialchars($row['status']) ?>
                            </span>
                        </td>
                        <td>
                            <a href="edit_pasien.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <button class="btn btn-sm btn-danger delete-btn" data-id="<?= $row['id'] ?>">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9" class="text-center">Tidak ada data pasien</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once 'includes/footer.php'; ?>