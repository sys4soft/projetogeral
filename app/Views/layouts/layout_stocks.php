<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ProjetoGeral - Users</title>

    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/app.css') ?>">

</head>
<body>

<div class="container-fluid" style="height:100%;">
    <div class="row">
        <div class="col-12 text-center bg-dark text-light p-3">
            <h3>PROJETO GERAL - Stocks</h3>
        </div>        
    </div>

    <div class="row mb-5">
        <div class="col-2">
            <div class="mt-3 mb-3">
                <div class="mb-1 mt-2">
                    <a href="<?php echo site_url('stocks/familias')?>">Famílias</a>
                </div>
                <div class="mb-1 mt-2">
                    <a href="<?php echo site_url('stocks/movimentos')?>">Movimentos</a>
                </div>
                <div class="mb-1 mt-2">
                    <a href="<?php echo site_url('stocks/produtos')?>">Produtos</a>
                </div>
                <div class="mb-1 mt-2">
                    <a href="<?php echo site_url('stocks/taxas')?>">Taxas</a>
                </div>
                
                
                
                
            </div>
        </div>
        <div class="col-10">
            <?php $this->renderSection('conteudo') ?>
        </div>
    </div>

</div>
   
    <!-- javascript -->
    <script src="<?php echo base_url('assets/js/jquery-3.4.0.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/popper.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/app.js') ?>"></script>
</body>
</html>