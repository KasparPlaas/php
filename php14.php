<?php
$kataloog = 'php14_pildid';
$pildid = []; 
if (is_dir($kataloog)) {
    $asukoht = opendir($kataloog);
    while ($rida = readdir($asukoht)) {
        if ($rida != '.' && $rida != '..') {
            $pildid[] = $rida;
        }
    }
    closedir($asukoht);
}

$veergudeArv = 16;
$suvalinePilt = $pildid[array_rand($pildid)]; 

if (!empty($_POST)) {
    $randomPildid = array_rand(array_flip($pildid), $veergudeArv);
}
?>

<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suvaline Pilt</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">
    <h2 class="text-center">Suvaline pilt</h2>
    <div class="text-center">
        <img src="<?= "$kataloog/$suvalinePilt" ?>" class="img-fluid" alt="Suvaline Pilt" style="max-width: 500px; max-height: 400px;">
    </div>

    <h3 class="mt-4">Pisipildid</h3>
    <form method="post">
        <button type="submit" class="btn btn-primary">Lisa juhuslikud pildid</button>
    </form>

    <div class="row flex-row mt-3">
        <?php
        if (!empty($_POST) && isset($randomPildid)) {
            foreach ($randomPildid as $pilt) {
                echo '
                <div class="col-md text-center">
                    <a href="' . "$kataloog/$pilt" . '" target="_blank">
                        <img src="' . "$kataloog/$pilt" . '" class="img-thumbnail" style="max-width: 120px; max-height: 90px;">
                    </a>
                </div>';
            }
        }
        ?>
    </div>
</body>
</html>