<?php
function get_url($dest) {
    global $BASE_PATH;
    return $BASE_PATH . $dest;
}
function redirect($path) {
    if (!headers_sent()) {
        // redirect w php
        die(header("Location: " . get_url($path)));
    }
    // redirect
    echo "<script>window.location.href='" . get_url($path) . "';</script>";
    echo "<noscript><meta http-equiv=\"refresh\" content=\"0;url=" . get_url($path) . "\"/></noscript>";
    die();
}
?>