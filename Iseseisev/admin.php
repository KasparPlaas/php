<?php
if (isset($_POST['lisa'])) {
    $pilt = $_POST['pilt'];
    $toode = $_POST['toode'];
    $hind = $_POST['hind'];
    
    $csv = fopen("tooted.csv", "a");
    fputcsv($csv, [$pilt, $toode, $hind]);
    fclose($csv);
    header("Location: admin.php");
    exit();
}

if (isset($_GET['kustuta'])) {
    $toode_kustuta = $_GET['kustuta'];
    $rows = array_map('str_getcsv', file('tooted.csv'));
    $header = array_shift($rows);
    
    $filtered_rows = array_filter($rows, function ($row) use ($toode_kustuta) {
        return $row[1] !== $toode_kustuta;
    });
    
    $csv = fopen("tooted.csv", "w");
    fputcsv($csv, $header);
    foreach ($filtered_rows as $row) {
        fputcsv($csv, $row);
    }
    fclose($csv);
    header("Location: admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Tooted</h2>
        <div class="row">
            <?php
            if ($csv = fopen("tooted.csv", "r")) {
                fgetcsv($csv);
                while ($andmed = fgetcsv($csv)) {
                    $pilt = $andmed[0];
                    $toode = $andmed[1];
                    $hind = $andmed[2];
                    echo "
                    <div class='col-md-4 mb-4'>
                        <div class='card'>
                            <img src='{$pilt}' class='card-img-top' alt='{$toode}'>
                            <div class='card-body'>
                                <h5 class='card-title'>{$toode}</h5>
                                <p class='card-text'>{$hind}€</p>
                                <a href='admin.php?kustuta={$toode}' class='btn btn-danger'>Kustuta</a>
                            </div>
                        </div>
                    </div>";
                }
                fclose($csv);
            }
            ?>
        </div>

        <h2>Lisa uus toode</h2>
        <form method="post" class="mt-3">
            <div class="mb-3">
                <label class="form-label">Pildi tee</label>
                <input type="text" name="pilt" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Toote nimi</label>
                <input type="text" name="toode" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Hind (€)</label>
                <input type="number" name="hind" class="form-control" required>
            </div>
            <button type="submit" name="lisa" class="btn btn-primary">Lisa toode</button>
        </form>
    </div>
</body>
</html>
