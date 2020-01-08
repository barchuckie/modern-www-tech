<?php include 'header.php' ?>
<main id="main-content" class="row content">
    <article id="nie-reszta-kwadratowa" class="my-block">
        <h1>Reszta/niereszta kwadratowa</h1>
        <b> Definicja.</b> Niech $a \in \mathbb{Z}_n$. Mówimy, że $a$ jest
        <i>resztą kwadratową modulo</i> $n$ <i>(kwadratem modulo</i> $n$ <i>)</i>, jeżeli istnieje $x \in \mathbb{Z}^*_n$ takie,
        że $x^2 \equiv a \pmod p$. Jeżeli takie $x$ nie istnieje, to wówczas $a$ nazywamy
        <i>nieresztą kwadratową modulo</i> $n$. Zbiór wszystkich reszt kwadratowych modulo $n$
        oznaczamy $Q_n$, zaś zbiór wszystkich niereszt kwadratowych modulo $n$ oznaczamy
        $\overline{Q}_n$
    </article>
</main>
<?php
include 'comments.php';
include 'footer.php'; ?>
