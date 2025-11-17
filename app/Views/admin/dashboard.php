<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard PPDB</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
            <!-- Box 1: Total Pendaftar -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Pendaftar</span>
                        <span class="info-box-number">
                            <?= esc($totalPendaftar ?? 0) ?>
                        </span>
                    </div>
                </div>
            </div>
            <!-- /.col -->

            <!-- Box 2: Menunggu Konfirmasi -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-clock"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Menunggu Konfirmasi</span>
                        <span class="info-box-number"><?= esc($totalMenunggu ?? 0) ?></span>
                    </div>
                </div>
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <!-- Box 3: Diterima -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-check"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Diterima</span>
                        <span class="info-box-number"><?= esc($totalDiterima ?? 0) ?></span>
                    </div>
                </div>
            </div>
            <!-- /.col -->

            <!-- Box 4: Ditolak -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-times"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Ditolak</span>
                        <span class="info-box-number"><?= esc($totalDitolak ?? 0) ?></span>
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Chart dan tabel bawaan template bisa Anda gunakan nanti -->
        <!-- Saya biarkan dulu agar layout tetap utuh -->
        
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Statistik Pendaftaran 7 Hari Terakhir</h5>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <p class="text-center">
                                    <strong>Statistik Pendaftaran</strong>
                                </p>
                                <div class="chart">
                                    <canvas id="salesChart" height="180" style="height: 180px;"></canvas>
                                </div>
                            </div>
                            <div class="col-md-4">
                            <p class="text-center">
                                <strong>Total Pendaftar L/P</strong>
                            </p>

                            <div class="progress-group">
                                Pendaftar Laki-laki
                                <span class="float-right"><b><?= esc($totalLaki ?? 0) ?></b></span> 
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-primary" style="width: 100%"></div>
                                </div>
                            </div>

                            <div class="progress-group">
                                Pendaftar Perempuan
                                <span class="float-right"><b><?= esc($totalPerempuan ?? 0) ?></b></span>
                                <div class="progress progress-sm">
                                     <div class="progress-bar bg-danger" style="width: 100%"></div>
                                </div>
                            </div>

                            </div>
                        </div>
                    </div>
                    <!-- ./card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->
        <div class="row">
            <div class="col-md-12">
                <!-- Nanti kita akan isi ini dengan data dinamis juga -->
                <div class="card">
                    <div class="card-header border-transparent">
                        <h3 class="card-title">Pendaftar Terbaru</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                        <th>Nama Siswa</th>
                                        <th>Status</th>
                                        <th>Asal Sekolah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($pendaftarTerbaru) && !empty($pendaftarTerbaru)) : ?>
                                        <?php foreach ($pendaftarTerbaru as $siswa) : ?>
                                            <?php
                                            // Logic badge status (copy dari Pendaftar.php)
                                            $statusBadge = '';
                                            $statusClass = 'badge-secondary'; // Default
                                            if ($siswa['status'] == 'Diterima') { $statusClass = 'badge-success'; }
                                            elseif ($siswa['status'] == 'Ditolak') { $statusClass = 'badge-danger'; }
                                            elseif ($siswa['status'] == 'Menunggu Konfirmasi') { $statusClass = 'badge-warning'; }
                                            $statusBadge = '<span class="badge ' . $statusClass . '">' . esc($siswa['status']) . '</span>';
                                            ?>
                                            <tr>
                                                <td><?= esc($siswa['nama_lengkap']) ?></td>
                                                <td><?= $statusBadge ?></td>
                                                <td><?= esc($siswa['asal_sekolah']) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="3" class="text-center">Belum ada pendaftar baru.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer clearfix">
                        <a href="<?= base_url('/admin/pendaftar') ?>" class="btn btn-sm btn-secondary float-right">Lihat Semua Pendaftar</a>
                    </div>
                </div> 
                <!-- /.card-body -->

                <!-- /.card-footer -->
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->

    </div><!--/. container-fluid -->
</section>
<!-- /.content -->

<?= $this->endSection() ?>


<?= $this->section('pageScripts') ?>
<script src="<?= base_url('assets/adminlte/plugins/chart.js/Chart.min.js') ?>"></script>
<script>
    /* global Chart:false */
$(function () {
  'use strict'

  var salesChartCanvas = $('#salesChart').get(0).getContext('2d')

  var salesChartData = {
    // Ambil data Labels dari Controller
    labels: <?= $chartLabels ?? '[]' ?>, 
    datasets: [
      {
        label: 'Laki-laki', // Ganti label
        backgroundColor: 'rgba(60,141,188,0.9)',
        borderColor: 'rgba(60,141,188,0.8)',
        pointRadius: false,
        pointColor: '#3b8bba',
        pointStrokeColor: 'rgba(60,141,188,1)',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        // Ambil data Laki-laki dari Controller
        data: <?= $chartDataLaki ?? '[]' ?> 
      },
      {
        label: 'Perempuan', // Ganti label
        backgroundColor: 'rgba(40, 167, 69, 1)', // Tetap hijau
        borderColor: 'rgba(40, 167, 69, 1)',
        pointRadius: false,
        pointColor: 'rgba(40, 167, 69, 1)',
        pointStrokeColor: '#c1c7d1',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(220,220,220,1)',
        // Ambil data Perempuan dari Controller
        data: <?= $chartDataPerempuan ?? '[]' ?>
      }
    ]
  }

  var salesChartOptions = {
    maintainAspectRatio: false,
    responsive: true,
    legend: {
      display: true // Tampilkan legend biar jelas
    },
    scales: {
      xAxes: [{
        // Opsi: buat chart tumpuk (stacked)
        // stacked: true, 
        gridLines: {
          display: false
        }
      }],
      yAxes: [{
        // stacked: true, 
        gridLines: {
          display: false
        },
        ticks: {
            // Pastikan y-axis mulai dari 0 dan hanya angka bulat
            beginAtZero: true, 
            callback: function(value) {if (value % 1 === 0) {return value;}}
        }
      }]
    }
  }

  var salesChart = new Chart(salesChartCanvas, {
    type: 'bar', // Tipe chart bar
    data: salesChartData,
    options: salesChartOptions
  })
})
</script>
<?= $this->endSection() ?>

