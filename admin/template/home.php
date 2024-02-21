<?php
$sql = " select * from barang where stok <= 3";
$row = $config->prepare($sql);
$row->execute();
$r = $row->rowCount();
if ($r > 0) {
?>
<?php
    echo "
		<div class='alert alert-warning'>
			<span class='glyphicon glyphicon-info-sign'></span> Ada <span style='color:red'>$r</span> barang yang Stok tersisa sudah kurang dari 3 items. silahkan pesan lagi !!
		</div>
		";
}
?>
<?php $hasil_barang = $lihat->barang_row(); ?>
<?php $hasil_kategori = $lihat->kategori_row(); ?>
<?php $stok = $lihat->barang_stok_row(); ?>
<?php $jual = $lihat->jual_row(); ?>

<div class="card card-body" style="background: #242424;">
    <div class="card-header" style="background: #242424;">
        <div>
            <h1 class="card-title" style="color: white;"><b>Laporan Dashboard</b> - Selamat Datang, <?php echo $hasil_profil['nm_member']; ?></h1><br>
        </div>
    </div>

    <div class="row text-white" style="top: 10px; position:relative;">
        <!-- STATUS cardS -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box rounded-3" style="background: #008744;">
                <div class="inner">
                    <h3><?php echo number_format($hasil_barang); ?></h3>
                    <p>Nama Barang</p>
                </div>
                <div class="icon">
                    <i class="fas fa-fw fa-tasks" style="color:white;"></i>
                </div>
                <a href="index.php?page=barang" class="small-box-footer">Info Selengkapnya<i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- STATUS cardS -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box rounded-3" style="background:#0057e7;">
                <div class="inner">
                    <h3><?php echo number_format($stok['jml']); ?></h3>
                    <p style="color:white;">Stok Barang</p>
                </div>
                <div class="icon">
                    <i class="fa fa-clipboard" style="color:white;"></i>
                </div>
                <a href="index.php?page=barang" class="small-box-footer">Info Selengkapnya<i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- STATUS cardS -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box rounded-3" style="background: #d62d20;">
                <div class="inner">
                    <h3><?php echo number_format($jual['stok']); ?></h3>
                    <p>Telah Terjual</p>
                </div>
                <div class="icon">
                    <i class="fa fa-list-alt" style="color:white;"></i>
                </div>
                <a href="index.php?page=laporan" class="small-box-footer">Info Selengkapnya<i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box rounded-3" style="background: #ffa700;">
                <div class="inner">
                    <h3><?php echo number_format($hasil_kategori); ?></h3>
                    <p>Kategori Barang</p>
                </div>
                <div class="icon">
                    <i class="fa fa-cube" style="color:white;"></i>
                </div>
                <a href="index.php?page=kategori" class="small-box-footer">Info Selengkapnya<i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

    </div>
</div>

<div class="card card-body">
    <div class="card-header">
        <h1 class="card-title">Laporan Dashboard</h1>
    </div>
    <div class="row">
        <div class="col-md-6">
            <canvas id="categoryStockChart" width="400" height="200"></canvas>
        </div>
        <div class="col-md-6">
            <canvas id="categoryStockPieChart" width="400" height="200"></canvas>
        </div>
    </div>
</div>

<div class="card card-body">
    <div class="card-header">
        <h2 class="card-title">Table Data</h2>
    </div>
    <div class="table-responsive">
        <table class="table table-striped" id="example1">
            <thead>
                <tr style="background:#242424; color:white;">
                    <th>No.</th>
                    <th>ID Barang</th>
                    <th>Kategori</th>
                    <th>Nama Barang</th>
                    <th>Merk</th>
                    <th>Stok</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $totalBeli = 0;
                $totalJual = 0;
                $totalStok = 0;
                if ($_GET['stok'] == 'yes') {
                    $hasil = $lihat->barang_stok();
                } else {
                    $hasil = $lihat->barang();
                }
                $no = 1;
                foreach ($hasil as $isi) {
                ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $isi['id_barang']; ?></td>
                        <td><?php echo $isi['nama_kategori']; ?></td>
                        <td><?php echo $isi['nama_barang']; ?></td>
                        <td><?php echo $isi['merk']; ?></td>
                        <td>
                            <?php if ($isi['stok'] == '0') { ?>
                                <button class="btn btn-danger"> Habis</button>
                            <?php } else { ?>
                                <?php echo $isi['stok']; ?>
                            <?php } ?>
                        </td>
                    </tr>
                <?php
                    $no++;
                    $totalBeli += $isi['harga_beli'] * $isi['stok'];
                    $totalJual += $isi['harga_jual'] * $isi['stok'];
                    $totalStok += $isi['stok'];
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php $categoryData = [];
foreach ($hasil as $isi) {
    $category = $isi['nama_kategori'];
    if (!isset($categoryData[$category])) {
        $categoryData[$category] = 0;
    }
    $categoryData[$category] += $isi['stok'];
} ?>

<script>
    var categoryData = <?php echo json_encode($categoryData); ?>;

    var categories = Object.keys(categoryData);
    var stockData = Object.values(categoryData);

    var pieCategories = categories;
    var pieStockData = stockData;

    var ctx = document.getElementById('categoryStockChart').getContext('2d');
    var stockChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: categories,
            datasets: [{
                label: 'Total Stock',
                data: stockData,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            aspectRatio: 1,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    var pieCtx = document.getElementById('categoryStockPieChart').getContext('2d');
    var pieChart = new Chart(pieCtx, {
        type: 'pie',
        data: {
            labels: pieCategories,
            datasets: [{
                label: 'Total Stock',
                data: pieStockData,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            aspectRatio: 1,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });


    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>