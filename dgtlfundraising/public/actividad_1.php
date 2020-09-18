<?php
include("../src/libs/bootstrap.php");
var_dump($_POST);
$error = "";
if(!empty($_POST)) {
   if (isset($_POST["titulo"])) {
        $actividad1 = new \Libs\Actions\Actividad1($_POST);
        $actividad1->save();
    }
}
?>
<?php
include("../src/layout/layout-top.php");
?>
<main class="container">
<h2> Actividad 1 </h2>
<form method="post" action="/actividad_1.php" class="row" onsubmit="on_submit(event)">
    <div class="mb-3">
        <label for="titulo" class="form-label">Titulo</label>
        <input type="text" class="form-control" id="titulo" name="titulo" maxlength="255">
    </div>
    <div class="mb-3">
        <label for="director" class="form-label">Director</label>
        <input type="text" class="form-control" id="director" name="director" maxlength="255">
    </div>
    <div class="mb-3">
        <label for="anio" class="form-label">Año</label>
        <input type="number" class="form-control" id="anio" name="anio" max="9999">
    </div>
    <div class="mb-3">
        <label for="pais" class="form-label">Pais</label>
        <select class="form-control" id="pais" name="pais">
            <option value="">Select one</option>
        <?php
        foreach ($paises as $code =>$pais){
        ?>
        <option value="<?= $code?>"><?= $pais ?></option>
        <?php
        }
        ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<script>
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
include("../src/layout/layout-bottom.php");
