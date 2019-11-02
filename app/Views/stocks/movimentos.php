<?php 
	$this->extend('layouts/layout_stocks');
?>
<?php $this->section('conteudo') ?>

<div class="row mt-2">
	<div class="col-12">	

	<h5>Movimentos:</h5>
	<hr>

	<table class="table table-striped" id="tabela_movimentos">
		<thead class="thead-dark">
			<th>ID Produto</th>
			<th>Designação</th>
			<th>Quantidade</th>
			<th>Data Movimento</th>
			<th>Observações</th>
		</thead>
		<tbody>
			<?php foreach($movimentos as $movimento): ?>
				<tr>
					<td><?php echo $movimento['id_produto']?></td>
					<td><?php echo $movimento['designacao']?></td>
					<td><?php echo $movimento['quantidade']?></td>
					<td><?php echo $movimento['data_movimento']?></td>
					<td><?php echo $movimento['observacoes']?></td>
				</tr>
			<?php endforeach;?>
		</tbody>
	</table>


	</div>
</div>

<script>
$(document).ready( function () {
    $('#tabela_movimentos').DataTable({
		"language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"			
        }
	});
});
</script>

<?php $this->endSection() ?>