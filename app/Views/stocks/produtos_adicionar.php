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

            <!-- preco -->
            <div class="form-group">
                <input type="text" name="text_preco" class="form-control" placeholder="Preço por unidade">
            </div>

            

            <div class="form-group">
                <a href="<?php echo site_url('stocks/produtos')?>" class="btn btn-secondary btn-150">Cancelar</a>
                <button class="btn btn-primary btn-150">Guardar</button>
            </div>

        </form>

    </div>
    
</div>

<?php $this->endSection() ?>