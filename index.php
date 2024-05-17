<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="suhu.css">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="index3.css">
    <link rel="stylesheet" href="index4.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="images/Logo SIJA (2).PNG" rel="icon">
    <link href="images/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="vendor/aos/aos.css" rel="stylesheet">

    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    \
    <link href="vendor/boxicons/css/boxicons.min.css" rel="stylesheet">

    <link href="vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

    <link href="vendor/remixicon/remixicon.css" rel="stylesheet">

    <link href="vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style2.css" rel="stylesheet">

    <style>
        .navbar-bran {
            display: inline-block;
            padding-top: 0.3125rem;
            padding-bottom: 0.3125rem;
            margin-right: 1rem;
            font-size: 1.25rem;
            line-height: inherit;
            white-space: nowrap;
            font-weight: 700;
            line-height: 1;
            font-size: 20px;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.9);
        }

        .navbar-bran:hover {
            color: rgba(0, 0, 0, 0.9);
        }
    </style>

</head>

<body>

    <!-- Tabel -->
    <script type="text/javascript">
        setInterval(function() {
            $("#tabelll").load("refresh.php");
        }, 1000);
    </script>
    <div class="container" style="margin-top:5%;">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box clearfix">
                    <div class="table-responsive">
                        <table id="example" style="width:100%" class="table table-striped table-bordered">
                            <div>
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Hari</th>
                                        <th>Tanggal</th>
                                        <th>Waktu</th>
                                        <th>Suhu</th>
                                        <th>Kelembapan</th>
                                        <!-- <th>Asap</th> -->
                                    </tr>
                                </thead>
                                <tbody id="tabelll">
                                    <?php
                                    error_reporting(E_ALL);
                                    ini_set('display_errors', 1);
                                    require_once('koneksi.php');
                                    $query1 = "SELECT * FROM logs ORDER BY no DESC LIMIT 10"; // Mengurutkan berdasarkan tanggal dan waktu secara descending (terbalik) dan hanya mengambil 10 data teratas
                                    $result = mysqli_query($conn, $query1);

                                    $no = 1;
                                    while (($data = mysqli_fetch_array($result)) && ($no <= 10)) { // Memastikan perulangan berhenti setelah 10 data ditampilkan
                                    ?>
                                        <tr id="tabelll">
                                            <th scope="row"><?php echo $no; ?></th>
                                            <td><?php echo $data['hari']; ?></td>
                                            <td><?php echo $data['tanggal']; ?></td>
                                            <td><?php echo $data['waktu']; ?></td>
                                            <td><?php echo $data['suhu']; ?><span class="derajat"> °C</span></td>
                                            <td><?php echo $data['kelembapan']; ?></td>
                                            <!-- <td type="hidden"><?php echo $data['asap']; ?></td> -->
                                        <?php
                                        $no++;
                                    }

                                        ?>
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container" style="margin-top: 5%;">
        <div class="row" style="overflow-x:scroll">
            <div class="main-box clearfix">
                <table style="width:180%;">
                    <tr>
                        <th>Hari & Tanggal</th>
                        <?php
                        error_reporting(E_ALL);
                        ini_set('display_errors', 1);
                        require_once('koneksi.php');

                        $query6 = "SELECT DATE(tanggal) AS tanggal, AVG(kelembapan) AS avg_kelembapan, AVG(suhu) AS avg_suhu
                                   FROM logs
                                   GROUP BY DATE(tanggal)";

                        $result2 = $conn->query($query6);
                        if ($result2->num_rows > 0) {
                            while ($row = $result2->fetch_assoc()) {
                                $tanggal = $row['tanggal'];
                                $hari = date('l', strtotime($tanggal));  // Menggunakan PHP untuk mendapatkan nama hari
                                echo "<td>{$hari} <br> {$tanggal}</td>";
                            }
                        } else {
                            echo "<td colspan='3'>Tidak ada data</td>";
                        }
                        ?>
                    </tr>
            </div>
            <tr>
                <th>Suhu</th>
                <?php
                $result2 = $conn->query($query6);
                if ($result2->num_rows > 0) {
                    while ($row = $result2->fetch_assoc()) {
                        echo "<td>" . number_format($row['avg_suhu'], 2) . "</td>";
                    }
                } else {
                    echo "<td colspan='3'>Tidak ada data</td>";
                }
                ?>
            </tr>
            <tr>
                <th>Kelembapan</th>
                <?php
                $result2 = $conn->query($query6);
                if ($result2->num_rows > 0) {
                    while ($row = $result2->fetch_assoc()) {
                        echo "<td>" . number_format($row['avg_kelembapan'], 2) . "</td>";
                    }
                } else {
                    echo "<td colspan='3'>Tidak ada data</td>";
                }
                mysqli_close($conn);
                ?>
            </tr>
            </table>
        </div>
    </div>
    </div>
    </div>


    <!-- loader -->
    <footer style="margin-top: 5%; margin-bottom: 20%;">

    </footer>
</body>

</html>

</html>