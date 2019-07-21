<?php 
	$this->extend('layouts/layout_stocks');
?>
<?php $this->section('conteudo') ?>

<div class="row mt-2">
	<div class="col-12">
		<h4>Produtos</h4>
		<hr>

	<div class="row mb-3">
		<div class="col-6 align-self-end"><h5>Produtos:</h5></div>
		<div class="col-6 text-right"><a href="<?php echo site_url('stocks/familia_adicionar') ?>" class="btn btn-primary">Adicionar família...</a></div>
	</div>

	<table class="table table-striped" id="tabela_produtos">
		<thead class="thead-dark">
			<th>ID</th>
			<th>Produto</th>
			<th>Família</th>
			<th>Preço/unidade</th>
			<th class="text-center">Taxa</th>
			<th class="text-center">Quantidade</th>
			<th class="text-right">Ações</th>
		</thead>
		<tbody>
			<?php foreach($produtos as $produto):?>

			<?php endforeach;?>
		</tbody>
	</table>


	</div>
</div>

<script>
$(document).ready( function () {
    $('#tabela_produtos').DataTable({
		"language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"			
        }
	});
});
</script>

<?php $this->endSection() ?>