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

	<table class="table table-striped">
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
						<a href="<?php echo site_url('stocks/familia_editar/'.$familia['id_familia'])?>">Editar</a>
						<span class="ml-2 mr-2">|</span>
						<a href="<?php echo site_url('stocks/familia_eliminar/'.$familia['id_familia'])?>">Eliminar</a>
					</td>
				</tr>
			<?php endforeach;?>
		</tbody>
	</table>


	</div>
</div>

<?php $this->endSection() ?>