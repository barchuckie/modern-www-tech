<?php include 'header.php' ?>
<main id="main-content" class="row content">
    <article id="interpolacja-lagrange" class="my-block">
        <h1>Interpolacja Lagrange'a</h1>
        Mając dane $t$ różnych punktów $(x_i, y_i)$ nieznanego wielomianu $f$ stopnia mniejszego od $t$
        możemy policzyć jego współczynniki korzystając ze wzoru:
        $$
        f(x) =
        \sum_{i=1}^{t}
        \left( y_i \prod_{1 \leqslant j \leqslant t, j \neq i} \frac{x - x_j}{x_i - x_j} \right)\mod p
        $$
        <b>Wskazówka:</b> w schemacie Shamira, aby odzyskać sekret $S$,
        użytkownicy nie muszą znać całego wielomianu $f$. Wstawiając do wzoru na interpolację Lagrange'a $x=0$,
        dostajemy wersję uproszczoną, ale wystarczającą aby policzyc sekret $S = f(0)$:
        $$
        f(x) =
        \sum_{i=1}^{t}
        \left( y_i \prod_{1 \leqslant j \leqslant t, j \neq i} \frac{x_j}{x_j - x_i} \right)\mod p
        $$
    </article>
</main>
<?php
include 'comments.php';
include 'footer.php'; ?>