<?php 
include '../Config.php';

$limit = 5;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Hitung total data
$total_result = mysqli_query($conn, "SELECT COUNT(*) as total FROM blog");
if (!$total_result) {
    die("Query Error: " . mysqli_error($conn));
}
$total_row = mysqli_fetch_assoc($total_result);
$total = $total_row['total'];
$total_pages = ceil($total / $limit);

// Ambil data blog
$data_result = mysqli_query($conn, "SELECT * FROM blog LIMIT $start, $limit");
if (!$data_result) {
    die("Query Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Blog</title>
</head>
<body>

<h2>DAFTAR BLOG</h2>
<a href="Form_create.php">+ Tambah</a>

<?php if (mysqli_num_rows($data_result) > 0): ?>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Judul</th>
            <th>Aksi</th>
        </tr>
        <?php while($b = mysqli_fetch_assoc($data_result)): ?>
        <tr>
            <td><?= htmlspecialchars($b['id']) ?></td>
            <td><?= htmlspecialchars($b['name']) ?></td>
            <td><?= htmlspecialchars($b['title']) ?></td>
            <td>
                <a href="form_edit.php?id=<?= $b['id'] ?>">Edit</a> |
                <a href="../proses/delete.php?id=<?= $b['id'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <p>Tidak ada data blog untuk ditampilkan.</p>
<?php endif; ?>

<!-- Navigasi Halaman -->
<div style="margin-top:20px;">
    <?php if ($page > 1): ?>
        <a href="?page=<?= $page - 1 ?>">Prev</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <a href="?page=<?= $i ?>" style="<?= $i == $page ? 'font-weight: bold;' : '' ?>">
            <?= $i ?>
        </a>
    <?php endfor; ?>

    <?php if ($page < $total_pages): ?>
        <a href="?page=<?= $page + 1 ?>">Next</a>
    <?php endif; ?>
</div>

</body>
</html>
