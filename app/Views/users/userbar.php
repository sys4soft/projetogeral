<?php 
    $s = session();
?>
<div class="text-right">
    <?php if($s->has('id_user')):?>

        <div>
            <i class="fa fa-user mr-2"></i>
            <strong class=" mr-2"><?php echo $s->name ?></strong>
            <a href="<?php echo site_url('users/logout') ?>"><i class="fa fa-sign-out"></i></a>
        </div>

    <?php else: ?>

        <span class="text-muted">Nenhum user logado.</span>

    <?php endif; ?>
</div>