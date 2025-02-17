<?php
function andmed() {
    $tooted = [];
    $csv = fopen("tooted.csv", "r");
    fgetcsv($csv); // Esimene rida (pealkirjad) vahele jäetakse
    while ($rida = fgetcsv($csv)) {
        $tooted[] = $rida;
    }
    fclose($csv);
    return $tooted;
}

function salvesta($tooted) {
    $csv = fopen("tooted.csv", "w");
    fputcsv($csv, ["pilt", "toode", "hind"]); // Pealkirjad
    foreach ($tooted as $toode) {
        fputcsv($csv, $toode);
    }
    fclose($csv);
}

if (isset($_GET['delete'])) {
    $kustuta = $_GET['delete'];
    $tooted = andmed();
    if (isset($tooted[$kustuta])) {
        unset($tooted[$kustuta]);
        salvesta($tooted);
    }
}

if (isset($_POST['add'])) {
    $toote_nimi = $_POST['toote_nimi'];
    $toote_hind = $_POST['toote_hind'];
    $pilt = $_FILES['toote_pilt'];

    $asukoht = "pildid/";
    $pildi_nimi = $asukoht . basename($pilt['name']);
    move_uploaded_file($pilt['tmp_name'], $pildi_nimi); // Pildi üleslaadimine

    $tooted = andmed();
    $tooted[] = [$pildi_nimi, $toote_nimi, $toote_hind];
    salvesta($tooted);
}
?>
<!doctype html>
<html lang="et">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Admin leht</h1>

        <form method="POST" enctype="multipart/form-data" class="mb-5">
            <h2>Lisa uus toode</h2>
            <div class="mb-3">
                <label class="form-label">Toote nimi:</label>
                <input type="text" name="toote_nimi" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Toote hind:</label>
                <input type="number" name="toote_hind" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Toote pilt (PNG):</label>
                <input type="file" name="toote_pilt" class="form-control" accept=".png" required>
            </div>
            <button type="submit" class="btn btn-primary">Lisa toode</button>
        </form>

        <h2>Praegused tooted</h2>
        <div class="row">
            <?php
            $tooted = andmed();
            foreach ($tooted as $kustuta => $toode) {
                echo "
                <div class='col-md-4 mb-4'>
                    <div class='card'>
                        <img src='{$toode[0]}' class='card-img-top' alt='{$toode[1]}'>
                        <div class='card-body'>
                            <h5 class='card-title'>{$toode[1]}</h5>
                            <p class='card-text'>{$toode[2]}€</p>
                            <a href='?delete={$kustuta}' class='btn btn-danger'>Kustuta</a>
                        </div>
                    </div>
                </div>";
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>