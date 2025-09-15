<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My App</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { padding: 10px; text-align: left; border: 1px solid #ddd; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <header><h1>List User</h1></header>

    <main>
        <?= $content // isi dari view yang telah di-buffer ?>
    </main>
    <a href="/?route=customers/create">
    <button type="button">Tambah User</button>
    </a>

    <footer>
        <p>Footer &copy; <?= date('Y') ?></p>
    </footer>
</body>
</html>
