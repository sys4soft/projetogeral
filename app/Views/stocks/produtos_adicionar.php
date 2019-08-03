<?php 
    $this->extend('layouts/layout_stocks');    
?>
<?php $this->section('conteudo') ?>


<?php 
// echo 'resultados:';
// echo '<pre>';
// print_r($familias);
// echo '<hr>';
// print_r($taxas);
// echo '</pre>';
?>


<div class="row mt-2">
	<div class="col-12">
		<h4>Produtos > Adicionar</h4>
        <hr>        
    </div>

    <div class="col-12 mt-3">
        <form action="<?php echo site_url('stocks/produtos_adicionar')?>" method="post">

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

            <!-- familia -->
            <div class="form-group">
                <label>Família do produto:</label>
                <select name="combo_familia" class="form-control">
                    <option value="0">Nenhuma</option>
                    <?php foreach ($familias as $familia): ?>
                        <option value="<?php echo $familia['id_familia']?>"><?php echo $familia['designacao'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- designacao -->
            <div class="form-group">
                <input type="text" type="text_designacao" class="form-control" placeholder="Designação do produto">
            </div>

            <!-- descricao -->
            <div class="form-group">
                <textarea name="text_descricao" class="form-control" placeholder="Descrição"></textarea>
            </div>

            <!-- imagem -->
            <div class="form-group">
                <label>Imagem do produto:</label>
                <input type="file" name="" id="" class="form-control">
            </div>

            <!-- preco -->
            <div class="form-inline mb-4">
                <label>Preço/Unidade (€):</label>
                <input type="number" name="text_preco" min="0" max="100000" step="0.05" class="form-control">
            </div>

            <!-- taxa -->
            <div class="form-group">
                <label>Taxa / imposto:</label>
                <select name="combo_taxa" class="form-control">
                    <option value="0">Nenhuma (0 %)</option>
                    <?php foreach ($taxas as $taxa): ?>
                        <option value="<?php echo $taxa['id_taxa']?>"><?php echo $taxa['designacao'] . ' (' . $taxa['percentagem'] . ' %)' ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- quantidade -->
            <div class="form-inline mb-4">
                <label>Quantidade:</label>
                <input type="number" name="text_quantidade" min="0" max="100000" class="form-control">
            </div>

            <!-- detalhes -->
            <div class="form-group">
                <textarea name="text_detalhes" class="form-control" placeholder="Detalhes"></textarea>
            </div>
            

            <div class="form-group">
                <a href="<?php echo site_url('stocks/produtos')?>" class="btn btn-secondary btn-150">Cancelar</a>
                <button class="btn btn-primary btn-150">Guardar</button>
            </div>

        </form>

    </div>
    
</div>

<?php $this->endSection() ?>