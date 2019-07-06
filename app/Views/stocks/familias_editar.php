<?php 
	$this->extend('layouts/layout_stocks');
?>
<?php $this->section('conteudo') ?>

<div class="row mt-2">
	<div class="col-12">
		<h4>Famílias > Editar</h4>
        <hr>        
    </div>

    <div class="col-12 mt-3">
        <form action="<?php echo site_url('stocks/familia_editar/' . $familia['id_familia'])?>" method="post">

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
                <label>Família a que pertence:</label>
                <select name="select_parent" class="form-control">

                    <?php 
                        $familia_nenhuma = '';
                        if($familia['id_parent'] == 0){
                            $familia_nenhuma = "selected";
                        }
                    ?>                
                    <option value="0" <?php echo $familia_nenhuma ?>>Nenhuma</option>
                    <?php foreach ($familias as $fTemp): ?>
                        <?php 
                            $familia_parent = '';
                            if($fTemp['id_familia'] == $familia['id_parent']) {
                                $familia_parent = 'selected';
                            }
                        ?>
                        <?php if($familia['id_familia'] != $fTemp['id_familia']): ?>
                            <option value="<?php echo $fTemp['id_familia']?>" <?php echo $familia_parent ?>><?php echo $fTemp['designacao']?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>            

            <div class="form-group">
                <label>Designação:</label>
                <input type="text" class="form-control" name="text_designacao" required value="<?php echo $familia['designacao']?>">
            </div>

            <div class="form-group">
                <a href="<?php echo site_url('stocks/familias')?>" class="btn btn-secondary btn-150">Cancelar</a>
                <button class="btn btn-primary btn-150">Guardar</button>
            </div>

        </form>

    </div>
    
</div>

<?php $this->endSection() ?>