<!DOCTYPE html>
<html lang="id" data-theme=''>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css" media="all" rel="stylsheet" type="text/css">
    <script src="https://kit.fontawesome.com/a2c3b56892.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Work+Sans&display=swap">
    <link rel="preload" href="https://fonts.gstatic.com/s/worksans/v5/QGYsz_wNahGAdqQ43Rh_fKDptfpA4Q.woff2" as="font">
    <link rel="preload" href="https://fonts.gstatic.com/s/worksans/v5/QGYpz_wNahGAdqQ43Rh3x4X8mNhNy_r-Kw.woff2" as="font">
    <!-- END CSS -->
    <title>GoPromote</title>
</head>

<body>
    <?php include 'navbar.php' ?>
    <main>
        <div class="container">
            <div class="register2">
                <div class="wellcome frame-color cube-shadow">
                    <p class="color-text-black">Selamat Datang,
                        <?php if (session()->get('level') == 2) : ?>
                            Admin!
                        <?php else : ?>
                            <?= session()->get('username'); echo "!";?>
                        <?php endif; ?>
                    </p>
                </div>
                <div class="cube-group margin-dashboard frame-color cube-shadow">
                    <li class="bukti">
                        <?php if (session()->get('level') === "1") : ?>
                            <h5 class="riwayat-pembelian color-text-black">Riwayat Pembelian</h5>
                            <?php if (session()->get('succes')) : ?>
                                <div class="manual-alert-foto succes">
                                    <?= session()->get('succes') ?>
                                </div>
                            <?php endif; ?>
                            <table class="jadwall">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Id Payment</th>
                                        <th>Paket</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Selesai</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($transaksi as $row) : ?>
                                        <tr class="color-text-black">
                                            <td><?= $no; ?></td>
                                            <td><?= $row['id_transaksi']; ?></td>
                                            <td><?= $row['paket']; ?></td>
                                            <td><?= $row['tgl_pp']; ?></td>
                                            <td><?= $row['tgl_selesai']; ?></td>
                                            <td><?= $row['status']; ?></td>
                                        </tr>
                                        <?php $no++ ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                    </li>
                    <li class="beli-paket">
                        <div class="beli-paket-in">
                            <a href="beli">
                                <h5>Beli Paket</h5>
                            </a>
                        </div>
                    </li>
                <?php else :  ?>
                    <h5 class="riwayat-pembelian color-text-black">Daftar User</h5>
                    <table class="jadwall">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Nama</th>
                                <th>Jumlah Pemesanan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($rows->getResult() as $row) : ?>
                                <tr class="color-text-black">
                                    <td><?= $no; ?></td>
                                    <td><?= $row->username; ?></td>
                                    <td><?= $row->nama; ?></td>
                                    <td>
                                        <p style="text-align: center;"><?= $row->jumlah; ?></p>
                                    </td>
                                </tr>
                                <?php $no++ ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    </li>
                <?php endif ?> </ul>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <?php include 'footer.php' ?>

        <!-- Script -->
        <script type="text/javascript" src="../JS/main.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</body>

</html>