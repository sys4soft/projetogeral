<?php 
	$this->extend('layouts/layout_stocks');
?>
<?php $this->section('conteudo') ?>

<div class="row mt-2">
	<div class="col-12">
		<h4>Taxas</h4>
		<hr>

		<div class="row mb-3">
		<div class="col-6 align-self-end"><h5>Taxas/impostos:</h5></div>
		<div class="col-6 text-right"><a href="<?php echo site_url('stocks/taxas_adicionar') ?>" class="btn btn-primary">Adicionar taxa...</a></div>
	</div>

	<table class="table table-striped" id="tabela_taxas">
		<thead class="thead-dark">
			<th>ID</th>
			<th>Taxa</th>
			<th>Percentual</th>
			<th class="text-right">Ações</th>			
		</thead>
		<tbody>
			<?php foreach($taxas as $taxa):?>
				<tr>
					<td><?php echo $familia['id_taxa']?></td>
					<td><?php echo $familia['designacao']?></td>
					<td><?php echo $familia['percentagem'] ?></td>
					<td class="text-right">
						<a href="<?php echo site_url('stocks/taxa_editar/'.$taxa['id_taxa'])?>" class="btn btn-primary btn-sm btn-100">
							<i class="fa fa-pencil mr-2"></i>Editar
						</a>											
						<a href="<?php echo site_url('stocks/taxa_eliminar/'.$taxa['id_taxa'])?>" class="btn btn-danger btn-sm btn-100">
							<i class="fa fa-trash mr-2"></i>Eliminar
						</a>
					</td>
				</tr>
			<?php endforeach;?>
		</tbody>
	</table>

	</div>
</div>

<script>
$(document).ready( function () {
    $('#tabela_taxas').DataTable();
});
</script>

<?php $this->endSection() ?>