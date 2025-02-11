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
        <h1>Harjutus 04</h1>
        <div class="row">
            <div class="col-md-4">
                <form>
                    <div class="mb-3">
                        <label for="arv1" class="form-label">Arv1</label>
                        <input type="number" class="form-control" name="arv1">
                    </div>
                    <div class="mb-3">
                        <label for="arv2" class="form-label">Arv2</label>
                        <input type="number" class="form-control" name="arv2">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <?php
                    if(isset($_GET["arv1"])&&isset($_GET["arv2"])){
                        $arv1 = $_GET["arv1"];
                        $arv2 = $_GET["arv2"];
                        if($arv2==0){
                            echo '<div class="alert alert-danger" role="alert">
                            Nulliga ei saa jagada
                            </div>';
                        }else{
                            $jaga = $arv1 / $arv2;
                            printf('<div class="alert alert-success" role="alert">
                            Tubli!
                            </div>%d / %d = %0.2f', $arv1, $arv2, $jaga);
                        }
                        if($arv1>$arv2){
                            echo '<div class="alert alert-danger" role="alert">
                            Arv1 on suurem!
                            </div>';

                        }else if($arv1<$arv2){
                            echo '<div class="alert alert-danger" role="alert">
                            Arv1 on väiksem!
                            </div>';
                        }else{
                            echo '<div class="alert alert-danger" role="alert">
                            Arvud on võrsed!
                            </div>';
                        }   
                        if($arv1==$arv2){
                            echo '<div class="alert alert-danger" role="alert">
                            Tegemist on ruuduga!
                            <img width="50" src="https://d1nhio0ox7pgb.cloudfront.net/_img/o_collection_png/green_dark_grey/64x64/plain/shape_square.png" alt="">
                            </div>';
                        }else{
                            echo '<div class="alert alert-danger" role="alert">
                            Tegemist on ristkülikuga!
                            <img width="50" src="https://cdn-icons-png.flaticon.com/512/5895/5895916.png" alt="">
                            </div>';
                        }
                        if($arv1%5==0){
                            echo '<div class="alert alert-danger" role="alert">
                            JUUBEL!
                            </div>';
                        }else{
                            echo '<div class="alert alert-danger" role="alert">
                            Ei ole juubel!
                            </div>';
                        }
                        switch($arv1){
                            case ($arv1 >= 10): echo 'SUPER';
                            break;
                            case ($arv1 >= 5 and $arv1<10): echo 'TEHTUD!';
                            break;
                            case ($arv1 < 5): echo 'Kasin!';
                            break;

                            default: echo 'SISETA POMA PUNKTID!';

                        }
                  
                    }

                    
                ?>
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>