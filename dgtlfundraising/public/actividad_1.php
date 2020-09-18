<?php
include("../src/libs/bootstrap.php");
?>
<?php
include("../src/layout/layout-top.php");
?>
<main class="container">
<h2> Actividad 1 </h2>
<form method="post" action="/actividad_1.php">
    <div class="mb-3">
        <label for="titulo" class="form-label">Titulo</label>
        <input type="text" class="form-control" id="titulo" name="titulo">
    </div>
    <div class="mb-3">
        <label for="director" class="form-label">Director</label>
        <input type="text" class="form-control" id="director" name="director">
    </div>
    <div class="mb-3">
        <label for="anio" class="form-label">Año</label>
        <input type="text" class="form-control" id="anio" name="anio">
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
</main>
<?php
include("../src/layout/layout-bottom.php");
