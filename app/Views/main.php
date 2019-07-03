<?php 
	$this->extend('layouts/layout_main');
?>
<?php $this->section('conteudo') ?>

	<a href="<?php echo site_url('users') ?>" class="btn btn-primary btn-200">Users</a>		
	<a href="<?php echo site_url('cripto') ?>" class="btn btn-primary btn-200">Criptografia</a>		
	<a href="<?php echo site_url('stocks') ?>" class="btn btn-primary btn-200">Stocks</a>		

<?php $this->endSection() ?>