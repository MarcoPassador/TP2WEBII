<?php
function stringGuard($str) {
    return htmlspecialchars((string)$str, ENT_QUOTES, 'UTF-8');
}

function formatPrice($n) {
    return number_format((float)$n, 2, ',', '.');
}

function getImageOrPlaceholder($url) {
    if ($url === null || trim($url) === '') {
        return 'assets/notFound.png';
    }

    return $url;
}


?>
