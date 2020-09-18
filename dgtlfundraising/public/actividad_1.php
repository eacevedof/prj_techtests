<?php
//http://actividades.dgtlfundraising.com/eduardoacevedo/actividad_1.php
include("src/libs/bootstrap.php");
$error = [];
$ok = "";
if(!empty($_POST)) {
   if(trim(get_post_v("titulo"))) {
        $actividad1 = new \Libs\Actions\Actividad1($_POST);
        $r = $actividad1->save();
        $ok = "Los datos se han guardado correctamente.";
        $_POST = [];
   }
   else{
     $error[] = "Datos incompletos. Falta el título";
   }
}
?>
<?php
include("src/layout/layout-top.php");
?>
<main class="container">
<h2> Actividad 1 </h2>
<form method="post" class="row" onsubmit="on_submit(event)">
    <?php
    if($error){
    ?>
    <div class="alert alert-danger" role="alert">
        Errores: <?= implode(";",$error); ?>
    </div>
    <?php
    }

    if($ok){
    ?>
    <div class="alert alert-success" role="alert">
        <?= $ok; ?>
    </div>
    <?php
    }
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
        foreach ($paises as $code =>$pais){
        ?>
        <option value="<?= $code?>" <?= ($code==$selected? "selected": "") ?> ><?= $pais ?></option>
        <?php
        }
        ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<script>
function number_only(id){
    // Get element by id which passed as parameter within HTML element event
    var element = document.getElementById(id);
    // Use numbers only pattern, from 0 to 9
    var regex = /[^0-9]/gi;
    // This removes any other character but numbers as entered by user
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
