<?php 
	$this->extend('layouts/layout_stocks');
?>
<?php $this->section('conteudo') ?>

<div class="row mt-2">
	<div class="col-12">
		<h4>Taxas > Editar</h4>
        <hr>        
    </div>

    <div class="col-12 mt-3">
        <form action="<?php echo site_url('stocks/taxas_editar/' . $taxa['id_taxa'])?>" method="post">

            <?php if(isset($error)): ?>
                <div class="alert alert-danger p-3 text-center">
                    <?php echo $error ?>
                </div>
            <?php endif; ?>                        

            <div class="form-group">
                <label>Designação:</label>
                <input type="text" class="form-control" name="text_designacao" required value="<?php echo $taxa['designacao']?>">
            </div>

            <div class="form-group">
                <label>Valor da taxa (%):</label>
                <input type="number"
                       class="form-control" 
                       name="text_valor" 
                       step="0.01"
                       min="0"
                       max="100"
                       placeholder="0.00"
                       value="<?php echo $taxa['percentagem'] ?>"
                       required>
            </div>

            <div class="form-group">
                <a href="<?php echo site_url('stocks/taxas')?>" class="btn btn-secondary btn-150">Cancelar</a>
                <button class="btn btn-primary btn-150">Atualizar</button>
            </div>

        </form>

    </div>
    
</div>

<?php $this->endSection() ?>