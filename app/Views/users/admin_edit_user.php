<?php 
    $this->extend('layouts/layout_users');
    $s = session();

    // profile    
    $profile = explode(',',$user['profile']);
    $check_admin = '';
    $check_moderator = '';
    $check_user = '';

    if(in_array('admin', $profile)){ $check_admin = "checked"; }
    if(in_array('moderator', $profile)){ $check_moderator = "checked"; }
    if(in_array('user', $profile)){ $check_user = "checked"; }    
?>
<?php $this->section('conteudo') ?>

    <div class="row mt-3 mb-3">
        <div class="col-6 offset-3">

        <!-- erro -->
        <?php if(isset($error)):?>
        <div class="alert alert-danger text-center">
            <?php echo $error ?>
        </div>
        <?php endif; ?>


        <!-- formulário para editar user -->
        <h4 class="text-center">Editar user</h4>

        <form action="<?php site_url('users/admin_edit_user') ?>" method="post">
            <input type="hidden" name="id_user" value="<?php echo $user['id_user'] ?>">

            <div class="form-group">
                Username: <b><?php echo $user['username'] ?></b>
            </div>

            <div class="form-group">
                <input type="text" name="text_name" class="form-control" placeholder="Nome" required value="<?php echo $user['name'] ?>">
            </div>

            <div class="form-group">
                <input type="email" name="text_email" class="form-control" placeholder="Email" required value="<?php echo $user['email'] ?>">
            </div>
            
        
            

            
            
            
            <!-- profile -->
            <h5>Profile:</h5>
            <div class="form-group">                
                <label class="form-check-label ml-4"><input type="checkbox" name="check_admin" <?php echo $check_admin ?>> Admin</label><br>
                <label class="form-check-label ml-4"><input type="checkbox" name="check_moderator" <?php echo $check_moderator ?>> Moderator</label><br>
                <label class="form-check-label ml-4"><input type="checkbox" name="check_user" <?php echo $check_user ?>> User</label><br>        
            </div>
            
            <div class="text-center">
                <a href="<?php echo site_url('users/admin_users') ?>" class="btn btn-secondary btn-150">Cancelar</a>
                <button class="btn btn-primary btn-150">Atualizar</button>
            </div>
        </form>




        </div>
    </div>



    

    
<?php $this->endSection() ?>