<?php
session_start();
include "activity.php";
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <title> Zakamarki kryptografii </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script>
        MathJax = {
            tex: {
                inlineMath: [['$', '$'], ['\\(', '\\)']]
            },
            options: {
                skipHtmlTags: ["script", "style", "textarea"]
            }
        };
    </script>
    <script type="text/javascript" id="MathJax-script" async
            src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js">
    </script>
</head>
<body>
<header>
    <a href="/"><h1 id="page-header"> Zakamarki kryptografii </h1></a>
</header>
<nav id="main-nav" class="topnavbar">
    <a href="/goldwasser-micali.php"> Goldwasser-Micali </a>
    <a href="/reszta.php"> Reszta/niereszta kwadratowa </a>
    <a href="/legendre-jacobi.php"> Symbol Legendre'a i Jacobiego </a>
    <a href="/shamir.php"> Sekret Shamira </a>
    <a href="/interpolacja-lagrange.php"> Interpolacja Lagrange'a </a>
    <?php
    if (isset($_SESSION['login'])) { ?>
        <a href="/logout.php">
            Wyloguj <br> (<?php echo $_SESSION['username'] ?>)
        </a>
    <?php } else { ?>
        <a href="/"> Zaloguj </a>
    <?php }
    ?>
</nav>