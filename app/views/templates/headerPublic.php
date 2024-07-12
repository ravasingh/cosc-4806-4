<?php include 'header.php'; ?>
<?php
session_start(); // Ensure session is started
if (isset($_SESSION['auth']) && $_SESSION['auth'] == 1) {
    header('Location: /home');
    exit;
}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link" href="/login">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/create">Register</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container mt-5">