<?php 
	$this->extend('layouts/layout_users');
?>
<?php $this->section('conteudo') ?>

<?php echo view('users/userbar') ?>

<div class="container">
    <div class="row">
        <div class="col-6 offset-3">

            <form action="<?php echo site_url('users/reset_password')?>" method="post">
                <div class="form-group">
                    <input type="email" name="text_email" placeholder="Email" required class="form-control">
                </div>                
                <div class="form-group text-center">
                    <a href="<?php echo site_url('users') ?>" class="btn btn-secondary mr-3">Cancelar</a><input type="submit" value="Reset" class="btn btn-primary">
                </div>                
            </form>

        </div>
    </div>
</div>

<?php $this->endSection() ?>