<?php
if($error){
?>
    <div class="alert alert-danger" role="alert">
        Errores: <?= implode(";",$error); ?>
    </div>
<?php
}

if($success){
?>
    <div class="alert alert-success" role="alert">
        <?= $success; ?>
    </div>
<?php
}
