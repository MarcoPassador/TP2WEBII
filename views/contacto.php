<?php
$pageTitle = 'Contacto - Chronos Time';
?>

<div class="row">
  <div class="col-12">
    <h2 class="mb-2">Contacto</h2>
    <p class="mb-2">Este es el contenido de la tercera página.</p>
    <p class="mb-4">Aquí puedes agregar contenido específico para esta sección.</p>

    <div class="mb-4">
      <form method="POST" action="index.php?view=resultado">
        <div class="mb-3">
          <label for="inputEmail" class="form-label">Email</label>
          <input type="email" class="form-control" id="inputEmail" name="email" aria-describedby="emailHelp" required>
          <div id="emailHelp" class="form-text">No compartiremos tu correo con nadie más.</div>
        </div>
        <div class="mb-3">
          <label for="inputNombre" class="form-label">Nombre completo</label>
          <input type="text" class="form-control" id="inputNombre" name="nombre" required>
        </div>
        <div class="mb-3">
          <label for="inputDescripcion" class="form-label">Descripción</label>
          <textarea class="form-control" id="inputDescripcion" name="descripcion" rows="3"></textarea>
        </div>
        <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" id="inputCheck" name="check" value="1" required>
          <label class="form-check-label" for="inputCheck">Términos y Condiciones</label>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
      </form>
    </div>
  </div>
</div>
