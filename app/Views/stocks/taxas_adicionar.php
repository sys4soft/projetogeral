<?php 
	$this->extend('layouts/layout_stocks');
?>
<?php $this->section('conteudo') ?>

<div class="row mt-2">
	<div class="col-12">
		<h4>Taxas > Adicionar</h4>
        <hr>        
    </div>

    <div class="col-12 mt-3">
        <form action="<?php echo site_url('stocks/taxas_adicionar')?>" method="post">

            <?php if(isset($error)): ?>
                <div class="alert alert-danger p-3 text-center">
                    <?php echo $error ?>
                </div>
            <?php endif; ?>

            <?php if(isset($success)): ?>
                <div class="alert alert-success p-3 text-center">
                    <?php echo $success ?>
                </div>
            <?php endif; ?>          

            <div class="form-group">
                <label>Designação:</label>
                <input type="text" class="form-control" name="text_designacao" required>
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
                       required>
            </div>

            <div class="form-group">
                <a href="<?php echo site_url('stocks/taxas')?>" class="btn btn-secondary btn-150">Cancelar</a>
                <button class="btn btn-primary btn-150">Guardar</button>
            </div>

        </form>

    </div>
    
</div>

<?php $this->endSection() ?>