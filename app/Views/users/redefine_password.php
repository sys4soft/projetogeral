<?php 
	$this->extend('layouts/layout_users');
?>
<?php $this->section('conteudo') ?>

<?php echo view('users/userbar') ?>
    
<div class="row mt-3 mb-3">
    <div class="col-4 offset-4 card bg-light">  
        
        <h4>Redefinir a password</h4>

        <form action="<?php echo site_url('users/redefine_password_submit')?>" method="post">
            
            <input type="hidden" name="text_id_user" value="<?php echo $user['id_user'] ?>">

            <div class="form-group mt-2">
                <input type="text" name="text_nova_password" class="form-control" placeholder="Nova password" required>
            </div>

            <div class="form-group">
                <input type="text" name="text_repetir_password" class="form-control" placeholder="Repetir password" required>
            </div> 
            
            <div class="form-group col-12 text-center">
                <input type="submit" value="Redefinir" class="btn btn-primary">
            </div>                        
        </form>

        <?php if(isset($error)): ?>
            <div class="alert alert-danger text-center mt-2" id="error-message">
                <?php echo $error ?>
            </div>
        <?php endif; ?>

    </div>
</div>

<?php $this->endSection() ?>