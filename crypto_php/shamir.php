<?php include 'header.php' ?>
<main id="main-content" class="row content">
    <article id="sekret-shamira" class="my-block">
        <h1> Schemat progowy $(t, n)$ dzielenia sekretu Shamira </h1>
        <b>Cel: </b> Zaufana Trzecia Strona $T$ ma sekret $S \geqslant 0$, który chce podzielić pomiędzy $n$
        uczestników tak, aby dowolnych $t$ spośród nich mogło sekret odtworzyć.<br>
        <b>Faza inicjalizacji: </b>
        <ul>
            <li>
                $T$ wybiera liczbę pierwszą $p > max(s, n)$ i definiuje $a_0 = S$,
            </li>
            <li>
                $T$ wybiera losowo i niezależnie $t-1$ współczynników $a_1, \dots, a_t-1 \in \mathbb{Z}_p$,
            </li>
            <li>
                $T$ definiuje wielomian nad $\mathbb{Z}_p$:
                $$
                f(x) = a_0 + \sum_{j=1}^{t-1} a_jx^j
                $$
            </li>
            <li>
                Dla $1 \leq i \leq n$ Zaufana Trzecia Strona $T$ wybiera losowo $x_i \in \mathbb{Z}_p$,
                oblicza: $S_i = f_i(x_i) \mod p$ i bezpiecznie przekazuje parę $(x_i, S_i)$ użytkownikowi $P_i$.
            </li>
        </ul>
        <b>Faza łączenia udziałów w sekret:</b> Dowolna grupa $t$ lub więcej użytkowników łączy swoje udziały
        - $t$ różnych punktów $(x_i, S_i)$ wielomianu $f$
        i dzięki interpolacji Lagrange'a odzyskuje sekret $S=a_0=f(0)$.
    </article>
</main>
<?php
include 'comments.php';
include 'footer.php'; ?>
