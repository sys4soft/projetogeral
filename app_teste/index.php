<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>App Teste</title>
</head>
<body>
    <h3>App Teste</h3>
    <hr>

    <?php 

    require_once 'api.php';

    $post_vars = array(
        'app_key' => 'DGXhTjiGPjsBb96SrYkA8NXWhzQisLVF',
        'id_produto' => 10
    );
    $resultados = api('http://localhost/projetogeral/api/get_product/', $post_vars);

    echo '<pre>';
    print_r($resultados);
    echo '</pre>';
    ?>


</body>
</html>