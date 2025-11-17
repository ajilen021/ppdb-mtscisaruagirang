<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title); ?> | PPDB MTs Cisarua Girang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f8f9fa;
        }
        .success-container {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="success-container">
        <h1 class="display-4">Pendaftaran Berhasil!</h1>
        <p class="lead">Silahkan hubungi Panitia PPDB dalam 1x24 jam untuk mengkonfirmasi pendaftaran Anda.</p>
        <hr>
        <p>
            <a href="/pendaftaran/bukti" class="btn btn-success btn-lg">Lihat Bukti Pendaftaran</a>
            <a href="/" class="btn btn-secondary btn-lg">Kembali ke Home</a>
        </p>
    </div>
</body>
</html>
