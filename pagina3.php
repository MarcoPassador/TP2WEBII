<?php
$pageTitle = 'Contacto - Chronos Time';
include './base/header.php';
?>

<div class="row">
    <div class="col-12">
        <h2>Contacto</h2>
        <p>Este es el contenido de la tercera página.</p>
        <p>Aquí puedes agregar contenido específico para esta sección.</p>

        <div class="mb-4">
            <form>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    <div id="emailHelp" class="form-text">No compartiremos tu correo con nadie mas.</div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Nombre completo</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Descripción</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>
    </div>
</div>

<?php include './base/footer.php'; ?>