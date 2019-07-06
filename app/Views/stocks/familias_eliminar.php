<?php 
	$this->extend('layouts/layout_stocks');
?>
<?php $this->section('conteudo') ?>

<div class="row mt-2">
	<div class="col-12">
		<h4>Família > Eliminar</h4>
        <hr>        
    </div>

    <div class="col-12 mt-3">

    <div class="card p-4 text-center bg-warning">
        <h5>Tem a certeza que pretende eliminar a família</h5>    
        <h3><b><?php echo $familia['designacao'] ?></b></h3>
        <div class="mt-3">
            <a href="<?php echo site_url('stocks/familias')?>" class="btn btn-secondary btn-100">Não</a>
            <a href="<?php echo site_url('stocks/familia_eliminar/'.$familia['id_familia'].'/sim')?>" class="btn btn-primary btn-100">Sim</a>
        </div>

    </div>    

    </div>
    
</div>

<?php $this->endSection() ?>