<?php
$pageTitle = 'Inicio - Chronos Time';
include './base/header.php';

require_once './logica/data.php';
require_once './logica/paginacion.php';
require_once './logica/utils.php';

$relojes = getAllItems();
$itemsPorPagina = 10;
$paginaActual = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$paginado = paginarArray($relojes, $itemsPorPagina, $paginaActual);
$relojesPagina = $paginado['items'];
$totalPaginas = $paginado['totalPaginas'];
$paginaActual = $paginado['paginaActual'];

?>

<div class="row">
    <div class="col-12">
        <h2 class="mb-2">Nuestros relojes</h2>
        <p>Descubrí nuestra exclusiva colección de relojes que combinan <b>precisión, estilo y durabilidad</b>.</p>
        <p>Desde diseños clásicos hasta modelos modernos e inteligentes.</p>
    </div>

    <div class="col-12">
        <h3 class="h4 mt-3 mb-3">Nuestro catálogo</h3>
        <div class="row g-3">
            <?php foreach ($relojesPagina as $reloj): 
                $imagen = getImageOrPlaceholder($reloj['imagen_url']); ?>
                <div class="col-md-4 col-lg-3">
                    <button type="button" class="card h-100 text-start p-0 border border-2 border-primary bg-transparent rounded-4 shadow-sm"
                            data-bs-toggle="modal" data-bs-target="#modalReloj<?= stringGuard($reloj['id']) ?>">
                        <img src="<?= stringGuard($imagen) ?>"
                             class="card-img-top rounded-top-4"
                             alt="<?= stringGuard($reloj['nombre']) ?>"
                             loading="lazy">
                        <div class="card-body">
                            <h5 class="card-title mb-1"><?= stringGuard($reloj['nombre']) ?></h5>
                            <p class="card-text small mb-2">
                                <span class="badge rounded-pill bg-primary me-1">Marca: <?= stringGuard($reloj['marca']) ?></span>
                                <span class="badge rounded-pill bg-secondary">Modelo: <?= stringGuard($reloj['modelo']) ?></span>
                            </p>
                            <strong>Precio:</strong> $<?= formatPrice($reloj['precio']) ?>
                        </div>
                    </button>
                </div>

                <div class="modal fade" id="modalReloj<?= stringGuard($reloj['id']) ?>" tabindex="-1"
                     aria-labelledby="modalRelojLabel<?= stringGuard($reloj['id']) ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content border-0 shadow-lg rounded-4">
                            <div class="modal-header border-0 bg-dark text-white rounded-top-4">
                                <h5 class="modal-title" id="modalRelojLabel<?= stringGuard($reloj['id']) ?>">
                                    <?= stringGuard($reloj['nombre']) ?>
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-3 align-items-start">
                                    <div class="col-md-5">
                                        <img src="<?= stringGuard($imagen) ?>"
                                             class="img-fluid rounded-3 shadow-sm"
                                             alt="<?= stringGuard($reloj['nombre']) ?>">
                                    </div>
                                    <div class="col-md-7">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item px-0"><strong>Marca:</strong> <?= stringGuard($reloj['marca']) ?></li>
                                            <li class="list-group-item px-0"><strong>Modelo:</strong> <?= stringGuard($reloj['modelo']) ?></li>
                                            <li class="list-group-item px-0"><strong>Precio:</strong> $<?= formatPrice($reloj['precio']) ?></li>
                                            <li class="list-group-item px-0"><strong>Descripción:</strong> <?= stringGuard($reloj['descripcion'] ?? '') ?></li>
                                            <li class="list-group-item px-0"><strong>ID:</strong> <?= stringGuard($reloj['id']) ?></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer border-0">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <nav class="mt-4" aria-label="Paginación de relojes">
            <ul class="pagination justify-content-center">
                <?php if ($paginaActual > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $paginaActual - 1 ?>" aria-label="Anterior">
                            <span aria-hidden="true"><</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                    <li class="page-item<?= $i == $paginaActual ? ' active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($paginaActual < $totalPaginas): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $paginaActual + 1 ?>" aria-label="Siguiente">
                            <span aria-hidden="true">></span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</div>

<?php include './base/footer.php'; ?>
