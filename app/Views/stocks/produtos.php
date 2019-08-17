<?php 
	$this->extend('layouts/layout_stocks');
	helper('funcoes');
?>
<?php $this->section('conteudo') ?>

<div class="row mt-2">
	<div class="col-12">
		<h4>Produtos</h4>
		<hr>

	<div class="row mb-3">
		<div class="col-6 align-self-end"><h5>Produtos:</h5></div>
		<div class="col-6 text-right"><a href="<?php echo site_url('stocks/produtos_adicionar') ?>" class="btn btn-primary">Adicionar produto...</a></div>
	</div>

	<table class="table table-striped" id="tabela_produtos">
		<thead class="thead-dark">
			<th>Produto</th>
			<th>Família</th>
			<th>Preço/unidade</th>
			<th class="text-center">Quantidade</th>
			<th class="text-center">Taxa</th>			
			<th class="text-right">Ações</th>
		</thead>
		<tbody>
			<?php foreach($produtos as $produto):?>
				<tr>
					<td class="align-middle"><?php echo $produto['nome_produto']?></td>
					<td class="align-middle"><?php echo $produto['familia']?></td>
					<td class="text-right align-middle"><?php echo $produto['preco'] . ' €'?></td>
					<td class="text-center align-middle"><?php echo $produto['quantidade']?></td>
					<td class="text-center align-middle"><?php echo $produto['taxa'] . ' (' .$produto['percentagem']. '%)'?></td>
					<td class="text-right">
						<a href="<?php echo site_url('stocks/produtos_editar/'.aesEncrypt($produto['id_produto']))?>" class="btn btn-primary btn-sm btn-100 m-1">
							<i class="fa fa-pencil mr-2"></i>Editar
						</a>											
						<a href="<?php echo site_url('stocks/produtos_eliminar/'.aesEncrypt($produto['id_produto']))?>" class="btn btn-danger btn-sm btn-100 m-1">
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
    $('#tabela_produtos').DataTable({
		"language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"			
        }
	});
});
</script>

<?php $this->endSection() ?>