<?php
// PRESENTATION LAYER
// Menampilkan data produk dalam bentuk tabel HTML.

require_once "products.php";
require_once "functions.php";

$totalSemuaNilai  = 0;
$jumlahStokRendah = 0;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Information System</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: Arial, Helvetica, sans-serif; background: #f4f6f8; color: #22303c; }
        .container { max-width: 1100px; margin: 0 auto; padding: 32px 16px; }
        h1 { margin: 0 0 4px; font-size: 28px; }
        .subjudul { margin: 0 0 20px; color: #5b6b79; }
        .tabel-wrapper { overflow-x: auto; background: #fff; border: 1px solid #d5dde4; border-radius: 6px; }
        table { width: 100%; border-collapse: collapse; font-size: 14px; }
        th, td { padding: 10px 12px; text-align: left; vertical-align: top; border-bottom: 1px solid #e3e9ee; }
        thead th { background: #1f4e5f; color: #fff; white-space: nowrap; }
        .baris-rendah { background: #fff4f4; }
        .angka { text-align: right; white-space: nowrap; }
        .status { display: inline-block; padding: 3px 10px; border-radius: 12px; font-size: 12px; font-weight: bold; white-space: nowrap; }
        .status-rendah { background: #fde2e2; color: #b42318; }
        .status-aman { background: #dcf5e4; color: #196c3a; }
        tfoot td { font-weight: bold; background: #eef3f6; border-bottom: none; }
        .ringkasan { margin-top: 16px; color: #5b6b79; }
    </style>
</head>
<body>
    <main class="container">
        <h1>Product Information System</h1>
        <p class="subjudul">Daftar produk beserta status stok dan total nilai stok.</p>

        <div class="tabel-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Status Stok</th>
                        <th>Deskripsi</th>
                        <th>Total Nilai Stok</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $produk) : ?>
                        <?php
                        $totalNilai = hitungTotalNilaiStok($produk["harga"], $produk["stok"]);
                        $status     = cekStatusStok($produk["stok"]);

                        if ($status == "Stok Rendah") {
                            $kelasBaris  = "baris-rendah";
                            $kelasStatus = "status-rendah";
                            $jumlahStokRendah++;
                        } else {
                            $kelasBaris  = "";
                            $kelasStatus = "status-aman";
                        }

                        $totalSemuaNilai += $totalNilai;
                        ?>
                        <tr class="<?= $kelasBaris ?>">
                            <td><?= $produk["id"] ?></td>
                            <td><?= htmlspecialchars($produk["nama"]) ?></td>
                            <td><?= htmlspecialchars($produk["kategori"]) ?></td>
                            <td class="angka"><?= formatRupiah($produk["harga"]) ?></td>
                            <td class="angka"><?= $produk["stok"] ?></td>
                            <td><span class="status <?= $kelasStatus ?>"><?= $status ?></span></td>
                            <td><?= htmlspecialchars($produk["deskripsi"]) ?></td>
                            <td class="angka"><?= formatRupiah($totalNilai) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="7">Total nilai seluruh stok</td>
                        <td class="angka"><?= formatRupiah($totalSemuaNilai) ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <p class="ringkasan">
            Jumlah produk: <strong><?= count($products) ?></strong> |
            Produk dengan stok rendah: <strong><?= $jumlahStokRendah ?></strong>
        </p>
    </main>
</body>
</html>
