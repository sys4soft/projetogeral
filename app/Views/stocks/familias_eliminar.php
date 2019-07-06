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

    <p>Tem a certeza que pretende eliminar a família</p>
    <h4><?php echo $familia['designacao'] ?></h4>

    <div>
        <a href="<?php echo site_url('stocks/familias')?>">Não</a>
        <a href="<?php echo site_url('stocks/familia_eliminar/'.$familia['id_familia'].'/sim')?>">Sim</a>
    </div>

    </div>
    
</div>

<?php $this->endSection() ?>