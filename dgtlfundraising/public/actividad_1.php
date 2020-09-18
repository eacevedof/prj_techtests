<?php
//http://actividades.dgtlfundraising.com/eduardoacevedo/actividad_1.php
include("src/libs/bootstrap.php");

//se usa en alerts.php
$error = [];
$success = "";

$actividad1 = new \Libs\Actions\Actividad1($_POST);

$actividad1->save();
if($actividad1->is_error()){
    $error = $actividad1->get_errors();
}
elseif ($actividad1->is_post())
{
    $success = "Los datos se han guardado correctamente.";
}
?>
<?php
include("src/layout/layout-top.php");
?>
<main class="container">
<h2> Actividad 1 </h2>
<form method="post" class="row" onsubmit="on_submit(event)">
<?php
include_once("src/layout/alerts.php");
?>
    <div class="mb-3">
        <label for="titulo" class="form-label">Titulo</label>
        <input type="text" class="form-control" autofocus id="titulo" name="titulo" maxlength="255" value="<?= get_post_v("titulo"); ?>" />
    </div>
    <div class="mb-3">
        <label for="director" class="form-label">Director</label>
        <input type="text" class="form-control" id="director" name="director" maxlength="255" value="<?= get_post_v("director"); ?>" />
    </div>
    <div class="mb-3">
        <label for="anio" class="form-label">Año</label>
        <input type="text" oninput="number_only(this.id)" class="form-control" id="anio" name="anio" maxlength="4" value="<?= get_post_v("anio"); ?>" />
    </div>
    <div class="mb-3">
        <label for="pais" class="form-label">Pais</label>
        <select class="form-control" id="pais" name="pais">
            <option value="">Select one</option>
        <?php
        $selected = get_post_v("pais");
        foreach ($paises as $code =>$pais):
        ?>
            <option value="<?= $code?>" <?= ($code==$selected? "selected": "") ?> ><?= $pais ?></option>
        <?php
        endforeach;
        ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<script>
function number_only(id){
    const element = document.getElementById(id);
    const regex = /[^0-9]/gi;
    element.value = element.value.replace(regex, "");
}

const on_submit = (e)=>{
    //alert("on submit")
    const titulo = document.getElementById("titulo")
    if(titulo.value.toString().trim()==="") {
        e.preventDefault()
        alert("Debe proporcionar el titulo")
        titulo.focus()
    }
}
</script>
</main>
<?php
include("src/layout/layout-bottom.php");
