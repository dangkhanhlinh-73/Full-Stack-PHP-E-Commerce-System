<?php
@session_start();

if (isset($_SESSION['checkout_error'])) {
    echo '<div class="alert alert-danger text-center">' . $_SESSION['checkout_error'] . '</div>';
    unset($_SESSION['checkout_error']);
}
?>
