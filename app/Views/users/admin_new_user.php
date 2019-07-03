<?php 
    $this->extend('layouts/layout_users');
    $s = session();    
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

        <!-- formulário para novo user -->
        <h4 class="text-center">Adicionar novo user</h4>

        <form action="<?php site_url('users/admin_new_user') ?>" method="post">
            <div class="form-group">
                <input type="text" name="text_username" class="form-control" placeholder="Username" required>
            </div>
            

            <div class="row">
                <div class="col-6 form-group">
                    <input type="text" name="text_password" class="form-control" placeholder="Password" required>
                </div>
                <div class="col-6 form-group text-center">
                    <button type="button" class="btn btn-primary btn-150" id="btn-password">Gerar password</button>
                </div>
            </div>

            <div class="row">
                <div class="col-6 form-group">
                   <input type="text" name="text_password_repetir" class="form-control" placeholder="Repetir password" required> 
                </div>
                <div class="col-6 form-group text-center">
                    <button type="button" class="btn btn-secondary btn-150" id="btn-limpar">Limpar</button>
                </div>
            </div>

            <div class="form-group">
                <input type="text" name="text_name" class="form-control" placeholder="Nome" required>
            </div>

            <div class="form-group">
                <input type="email" name="text_email" class="form-control" placeholder="Email" required>
            </div>
            

            
            
            <!-- profile -->
            <h5>Profile:</h5>
            <div class="form-group">
                <label class="form-check-label ml-4"><input type="checkbox" name="check_admin"> Admin</label><br>
                <label class="form-check-label ml-4"><input type="checkbox" name="check_moderator"> Moderator</label><br>
                <label class="form-check-label ml-4"><input type="checkbox" name="check_user" checked> User</label><br>
            </div>


            
            <div class="text-center">
                <a href="<?php echo site_url('users/admin_users') ?>" class="btn btn-secondary btn-150">Cancelar</a>
                <button class="btn btn-primary btn-150">Adicionar</button>
            </div>
        </form>



        </div>
    </div>




    

    

<?php $this->endSection() ?>