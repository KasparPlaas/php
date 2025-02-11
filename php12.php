<!doctype html>
<html lang="et">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PHP Harjutused</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>
<body>
    <div class="container">
        <h1>Harjutus 12</h1>
        <div class="row">
            <div class="col-md-4">

                <h2>Pildi üleslaadimine</h2>
                <?php
                if(!empty($_FILES['minu_fail']['name'])){
                    $sinu_faili_nimi = $_FILES['minu_fail']['name'];
                    $ajutine_fail= $_FILES['minu_fail']['tmp_name'];
                        
                    $kataloog = 'php12_pildid';
                    if(move_uploaded_file($ajutine_fail, $kataloog.'/'.$sinu_faili_nimi)){
                        echo 'Faili üleslaadimine oli edukas';	
                    } else {
                        echo 'Faili üleslaadimine ebaõnnestus';
                    }
                }
                

                    
                
                ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="file" name="minu_fail" accept="image/jpeg, image/jpg"><br>
                    <input type="submit" value="Lae üles!">
                </form>

                <h2>Üleslaetud pildid</h2>




            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>