<!doctype html>
<html lang="en">
<?php
session_start();
include '../konfigurasi/konfig.php';
include 'cek.php';
?>

<head>
    <title>E-Nilai | Aplikasi Pengolahan Nilai</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/vendor/linearicons/style.css">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="../assets/css/main.css">
    <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
    <link rel="stylesheet" href="assets/css/demo.css">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <!-- ICONS -->
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="../assets/img/favicon.png">
</head>

<body>
    <!-- WRAPPER -->
    <div id="wrapper">
        <!-- NAVBAR -->
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="brand">
                <a href="index.php"><img src="../assets/img/logo.png" alt="Erdian-Books" class="img-responsive logo"></a>
            </div>
            <div class="container-fluid">
                <div class="navbar-btn">
                    <button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
                </div>

                <div id="navbar-menu">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="../assets/img/user.png" class="img-circle" alt="Avatar"> <span><?php echo $_SESSION['nama']  ?></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="#"><i class="lnr lnr-user"></i> <span>My Profile</span></a></li>
                                <li><a href="#"><i class="lnr lnr-envelope"></i> <span>Message</span></a></li>
                                <li><a href="#"><i class="lnr lnr-cog"></i> <span>Settings</span></a></li>
                                <li><a href="../konfigurasi/logout.php"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- END NAVBAR -->
        <!-- LEFT SIDEBAR -->
        <div id="sidebar-nav" class="sidebar">
            <div class="sidebar-scroll">
                <nav>
                    <ul class="nav">
                        <li><a href="index.php" class=""><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                        <li><a href="jurusan.php" class=""><i class="lnr lnr-file-empty"></i> <span>Jurusan</span></a></li>
                        <li><a href="mapel.php" class=""><i class="lnr lnr-book"></i> <span>Mata Pelajaran</span></a></li>
                        <li><a href="siswa.php" class=""><i class="lnr lnr-file-empty"></i> <span>Siswa</span></a></li>
                        <li><a href="semester.php" class="active"><i class="lnr lnr-file-empty"></i> <span>Semester</span></a></li>
                        <li><a href="pengguna.php" class=""><i class="lnr lnr-file-empty"></i> <span>Pengguna</span></a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- END LEFT SIDEBAR -->
        <!-- MAIN -->
        <div class="main">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">
                    <div class="panel panel-headline">
                        <div class="panel-heading">
                            <h3 class="panel-title">Siswa</h3>
                            <p class="panel-subtitle">Mengelola data Siswa</p>
                        </div>
                        <div class="panel-body">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Tambah Data</button>
                            <br />
                            <form method="GET" action="siswa.php" style="padding:10px 0px;">
                                <div class="input-group">
                                    <input class="form-control" type="text" name="cari" placeholder="Cari" value="<?php if (isset($_GET['cari'])) {
                                                                                                                        echo $_GET['cari'];
                                                                                                                    } ?>">
                                    <span class="input-group-btn"><button class="btn btn-primary" type="submit">Cari</button></span>
                                </div>
                            </form>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>NPM</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Alamat</th>
                                        <th>Jurusan</th>
                                        <th style="width: 200px; text-align:center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //jika kita klik cari, maka yang tampil query cari ini
                                    if (isset($_GET['cari'])) {

                                        // menjalankan query untuk menampilkan semua dataa diurutkan berdasarkan id
                                        $page = (isset($_GET['page'])) ? (int) $_GET['page'] : 1;

                                        // Jumlah data per halaman
                                        $limit = 5;

                                        $limitStart = ($page - 1) * $limit;

                                        //menampung variabel kata_cari dari form pencarian
                                        $cari = (isset($_GET['cari'])) ? $_GET['cari'] : "";

                                        //jika hanya ingin mencari berdasarkan kode_produk, silahkan hapus dari awal OR
                                        //jika ingin mencari 1 ketentuan saja query nya ini : SELECT * FROM produk WHERE kode_produk like '%".$kata_cari."%' 
                                        $result = mysqli_query($koneksi, "SELECT siswa.npm, siswa.ID_jurusan, siswa.nama, siswa.jk, siswa.alamat, jurusan.nama_jurusan from siswa inner join jurusan on siswa.ID_jurusan = jurusan.ID WHERE npm like '%" . $cari . "%' OR nama like '%" . $cari . "%' OR alamat like '%" . $cari . "%' OR nama_jurusan like '%" . $cari . "%' LIMIT " . $limitStart . "," . $limit);

                                        $no = $limitStart + 1;
                                    } else {

                                        // menjalankan query untuk menampilkan semua dataa diurutkan berdasarkan id
                                        $page = (isset($_GET['page'])) ? (int) $_GET['page'] : 1;

                                        // Jumlah data per halaman
                                        $limit = 5;

                                        $limitStart = ($page - 1) * $limit;

                                        $result = mysqli_query($koneksi, "SELECT siswa.npm, siswa.ID_jurusan, siswa.nama, siswa.jk, siswa.alamat, jurusan.nama_jurusan from siswa inner join jurusan on siswa.ID_jurusan = jurusan.ID LIMIT " . $limitStart . "," . $limit);

                                        $no = $limitStart + 1;
                                    }
                                    // hasil query disimpan dalam bentuk array
                                    // melakukan looping untuk mencetak data.
                                    while ($row = mysqli_fetch_array($result)) {

                                    ?>

                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $row['npm']; ?></td>
                                            <td><?php echo $row['nama']; ?></td>
                                            <td><?php echo $row['jk']; ?></td>
                                            <td><?php echo $row['alamat']; ?></td>
                                            <td><?php echo $row['nama_jurusan']; ?></td>
                                            <td style="width: 200px; text-align:center;">
                                                <button type="button" class="btn btn-warning" href="#" data-toggle="modal" data-target="#edit<?php echo $row['npm']; ?>" data-whatever="@getbootstrap"><i class="fa fa-edit"></i></button>
                                                <a class="btn btn-danger" href="aksisiswa.php?aksi=hapus&npm=<?php echo $row['npm']; ?>" onclick="return confirm('Anda yakin akan menghapus data?')"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="edit<?php echo $row['npm']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="aksisiswa.php?aksi=edit&npm=<?php echo $row['ID']; ?>" method="post" role="form">
                                                            <div class="form-group">
                                                                <label for="npm" class="col-form-label">NPM:</label>
                                                                <input type="text" class="form-control" id="npm" name="npm" value="<?php echo $row['npm'] ?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="id_jurusan" class="col-form-label">Jurusan:</label>
                                                                <select class="form-control" name="id_jurusan" onchange="changeValue(this.value)">
                                                                    <option value="0">-- Jurusan --</option>
                                                                    <?php
                                                                    //Perintah sql untuk menampilkan semua data pada tabel jurusan
                                                                    $queryJudul = "select * from jurusan ORDER BY nama_jurusan asc";

                                                                    $hasilJudul = mysqli_query($koneksi, $queryJudul);
                                                                    $jsArray = "var data = new Array();\n";
                                                                    // $nomorJudul = 0;
                                                                    while ($data = mysqli_fetch_array($hasilJudul)) {
                                                                        // $nomorJudul++;
                                                                        $jsArray .= "data['" . $data['ID'] . "'] = {nama_jurusan:'" . addslashes($data['nama_jurusan']) . "',ID:'" . addslashes($data['ID']) . "'};\n";
                                                                    ?>
                                                                        <option value="<?php echo $data['ID']; ?>" <?php if ($row['ID_jurusan'] == $data['ID']) {
                                                                                                                        echo "selected";
                                                                                                                    } ?>><?php echo $data['nama_jurusan']; ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nama" class="col-form-label">Nama:</label>
                                                                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row['nama'] ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="jk" class="col-form-label">Jenis Kelamin:</label>
                                                                <label class="fancy-radio">
                                                                    <input name="jk" value="laki-laki" type="radio" <?php if ($row['jk'] == 'laki-laki') echo 'checked' ?>>
                                                                    <span><i></i>Laki-laki</span>
                                                                </label>
                                                                <label class="fancy-radio">
                                                                    <input name="jk" value="perempuan" type="radio" <?php if ($row['jk'] == 'perempuan') echo 'checked' ?>>
                                                                    <span><i></i>Perempuan</span>
                                                                </label>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="alamat" class="col-form-label">Alamat:</label>
                                                                <textarea class="form-control" id="alamat" placeholder="Alamat" rows="4" name="alamat"><?php echo $row['alamat'] ?></textarea>
                                                            </div>
                                                            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Edit -->
                                    <?php

                                        $no++;
                                    }
                                    ?>
                                </tbody>
                            </table>

                            <!-- pagination -->
                            <div class="text-black">
                                <ul class="pagination">
                                    <?php
                                    // Jika page = 1, maka LinkPrev disable
                                    if ($page == 1) {
                                    ?>
                                        <!-- link Previous Page disable -->
                                        <li class="disabled"><a href="#">Previous</a></li>
                                        <?php
                                    } else {
                                        $LinkPrev = ($page > 1) ? $page - 1 : 1;
                                        $cari = (isset($_GET['cari'])) ? $_GET['cari'] : "";
                                        if ($cari == "") {
                                        ?>
                                            <li><a href="siswa.php?page=<?php echo $LinkPrev; ?>">Previous</a></li>
                                        <?php
                                        } else {
                                        ?>
                                            <li><a href="siswa.php?cari=<?php echo $cari; ?>&page=<?php echo $LinkPrev; ?>">Previous</a></li>
                                    <?php
                                        }
                                    }
                                    ?>

                                    <?php
                                    $cari = (isset($_GET['cari'])) ? $_GET['cari'] : "";
                                    //kondisi jika parameter pencarian kosong
                                    if ($cari == "") {
                                        $SqlQuery = mysqli_query($koneksi, "SELECT siswa.npm, siswa.ID_jurusan, siswa.nama, siswa.jk, siswa.alamat, jurusan.nama_jurusan from siswa inner join jurusan on siswa.ID_jurusan = jurusan.ID");
                                    } else {
                                        //kondisi jika parameter kolom pencarian diisi
                                        $SqlQuery = mysqli_query($koneksi, "SELECT siswa.npm, siswa.ID_jurusan, siswa.nama, siswa.jk, siswa.alamat, jurusan.nama_jurusan from siswa inner join jurusan on siswa.ID_jurusan = jurusan.ID WHERE npm like '%" . $cari . "%' OR nama like '%" . $cari . "%' OR alamat like '%" . $cari . "%' OR nama_jurusan like '%" . $cari . "%'");
                                    }

                                    //Hitung semua jumlah data yang berada pada tabel Sisawa
                                    $JumlahData = mysqli_num_rows($SqlQuery);

                                    // Hitung jumlah halaman yang tersedia
                                    $jumlahPage = ceil($JumlahData / $limit);

                                    // Jumlah link number 
                                    $jumlahNumber = 1;

                                    // Untuk awal link number
                                    $startNumber = ($page > $jumlahNumber) ? $page - $jumlahNumber : 1;

                                    // Untuk akhir link number
                                    $endNumber = ($page < ($jumlahPage - $jumlahNumber)) ? $page + $jumlahNumber : $jumlahPage;

                                    for ($i = $startNumber; $i <= $endNumber; $i++) {
                                        $linkActive = ($page == $i) ? ' class="active"' : '';

                                        if ($cari == "") {
                                    ?>
                                            <li<?php echo $linkActive; ?>><a href="siswa.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>

                                            <?php
                                        } else {
                                            ?>
                                                <li<?php echo $linkActive; ?>><a href="siswa.php?cari=<?php echo $cari; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                            <?php
                                        }
                                    }
                                            ?>

                                            <!-- link Next Page -->
                                            <?php
                                            if ($page == $jumlahPage) {
                                            ?>
                                                <li class="disabled"><a href="#">Next</a></li>
                                                <?php
                                            } else {
                                                $linkNext = ($page < $jumlahPage) ? $page + 1 : $jumlahPage;
                                                if ($cari == "") {
                                                ?>
                                                    <li><a href="siswa.php?page=<?php echo $linkNext; ?>">Next</a></li>
                                                <?php
                                                } else {
                                                ?>
                                                    <li><a href="siswa.php?cari=<?php echo $cari; ?>&page=<?php echo $linkNext; ?>">Next</a></li>
                                            <?php
                                                }
                                            }
                                            ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT -->
        </div>
        <!-- END MAIN -->

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="aksisiswa.php?aksi=tambah" method="post" role="form">

                            <div class="form-group">
                                <label for="npm" class="col-form-label">NPM:</label>
                                <input type="text" class="form-control" id="npm" name="npm">
                            </div>
                            <div class="form-group">
                                <label for="semester" class="col-form-label">Semester:</label>
                                <select class="form-control" name="id_jurusan" onchange="changeValue(this.value)">
                                    <option value="0">-- Jurusan --</option>
                                    <?php
                                    //Perintah sql untuk menampilkan semua data pada tabel jurusan
                                    $queryJudul = "select * from jurusan ORDER BY nama_jurusan asc";

                                    $hasilJudul = mysqli_query($koneksi, $queryJudul);
                                    $jsArray = "var data = new Array();\n";
                                    $nomorJudul = 0;
                                    while ($data = mysqli_fetch_array($hasilJudul)) {
                                        $nomorJudul++;
                                        $jsArray .= "data['" . $data['ID'] . "'] = {nama_jurusan:'" . addslashes($data['nama_jurusan']) . "',ID:'" . addslashes($data['ID']) . "'};\n";
                                    ?>
                                        <option value="<?php echo $data['ID']; ?>"><?php echo $data['nama_jurusan']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <!-- <script type="text/javascript">
                                <?php echo $jsArray; ?>

                                function changeValue(ID) {
                                    document.getElementById('nama_jurusan').value = data[ID].nama_jurusan;
                                };
                            </script>
                            <div class="form-group">
                                <label for="nama_jurusan" class="col-form-label">Nama Jurusan:</label>
                                <input type="text" class="form-control" id="nama_jurusan" name="nama_jurusan" readonly>
                            </div> -->
                            <div class="form-group">
                                <label for="nama" class="col-form-label">Nama:</label>
                                <input type="text" class="form-control" id="nama" name="nama">
                            </div>
                            <div class="form-group">
                                <label for="jk" class="col-form-label">Jenis Kelamin:</label>
                                <label class="fancy-radio">
                                    <input name="jk" value="laki-laki" type="radio">
                                    <span><i></i>Laki-laki</span>
                                </label>
                                <label class="fancy-radio">
                                    <input name="jk" value="perempuan" type="radio">
                                    <span><i></i>Perempuan</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="alamat" class="col-form-label">Alamat:</label>
                                <textarea class="form-control" id="alamat" placeholder="Alamat" rows="4" name="alamat"></textarea>
                            </div>
                            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>
        <footer>
            <div class="container-fluid">
                <p class="copyright">Shared by <i class="fa fa-love"></i><a href="https://bootstrapthemes.co">BootstrapThemes</a>
                </p>
            </div>
        </footer>
    </div>
    <!-- END WRAPPER -->
    <!-- Javascript -->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="../assets/scripts/klorofil-common.js"></script>
</body>

</html>