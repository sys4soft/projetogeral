<?php 
    $this->extend('layouts/layout_users');
    $s = session();
?>
<?php $this->section('conteudo') ?>

    <?php echo view('users/userbar') ?>

    <div>Olá, <?php echo $s->name . '.' ?></div>

    <div>O meu perfil é de: <?php echo $s->profile ?></div>

    <div class="row">
        <div class="col-4 text-center"><a href="<?php echo site_url('users/op1') ?>" class="btn btn-primary">Operação 1</a></div>
        <div class="col-4 text-center"><a href="<?php echo site_url('users/op2') ?>" class="btn btn-primary">Operação 2</a></div>
        
        <?php if(isset($admin)): ?>
        <div class="col-4 text-center"><a href="<?php echo site_url('users/admin_users') ?>" class="btn btn-primary">Gestão de Utilizadores</a></div>
        <?php endif; ?>
    </div>

    <a href="<?php echo site_url('users/logout') ?>">Logout</a>

<?php $this->endSection() ?>