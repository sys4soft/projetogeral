<?php 
	$this->extend('layouts/layout_stocks');
?>
<?php $this->section('conteudo') ?>

<div class="row mt-2">
	<div class="col-12">
		<h4>Famílias</h4>
		<hr>
	<!--
		apresentação da tabela com as famílias registadas | botão para adicionar nova família
		total de famílias
		em cada row de família, botão para editar e eliminar
	-->

	<div class="row mb-3">
		<div class="col-6 align-self-end"><h5>Famílias de produtos:</h5></div>
		<div class="col-6 text-right"><a href="<?php echo site_url('stocks/familia_adicionar') ?>" class="btn btn-primary">Adicionar família...</a></div>
	</div>

	<table class="table table-striped" id="tabela_familias">
		<thead class="thead-dark">
			<th>ID</th>
			<th>Família</th>
			<th>Parent</th>
			<th class="text-right">Ações</th>
		</thead>
		<tbody>
			<?php foreach($familias as $familia):?>
				<tr>
					<td><?php echo $familia['id_familia']?></td>
					<td><?php echo $familia['designacao']?></td>
					<td><?php echo $familia['parent'] != ''? $familia['parent'] : '-' ?></td>
					<td class="text-right">
						<a href="<?php echo site_url('stocks/familia_editar/'.$familia['id_familia'])?>" class="btn btn-primary btn-sm btn-100">
							<i class="fa fa-pencil mr-2"></i>Editar
						</a>											
						<a href="<?php echo site_url('stocks/familia_eliminar/'.$familia['id_familia'])?>" class="btn btn-danger btn-sm btn-100">
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
    $('#tabela_familias').DataTable({
		"language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"			
        }
	});
});
</script>

<?php $this->endSection() ?>