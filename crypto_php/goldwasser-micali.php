<?php include 'header.php' ?>
<main id="main-content" class="row content">
    <article id="goldwasser-micali" class="my-block">
        <h1>Schemat Goldwasser-Micali szyfrowania probabilistycznego</h1>
        <h3>Algorytm generowania kluczy</h3>
        <ol>
            <li>
                Wybierz losowo dwie duże liczby pierwsze $p$ oraz $q$ (podobnego rozmiaru)
            </li>
            <li>
                Policz $n = pq$
            </li>
            <li>
                Wybierz $y \in \mathbb{Z}_n$, takie, że $y$ jest nieresztą kwadratową modulo $n$ i symbol
                Jacobiego $ \frac{y}{n} = 1 $ (czyli $y$ jest pseudokwadratem modulo $n$),
            </li>
            <li>
                Klucz publiczny stanowi para $(n, y)$, zaś odpowiadający mu klucz prywatny
                to para $(p, q)$.
            </li>
        </ol>
        <h3>Algorytm szyfrowania</h3>
        Chcąc zaszyfrować wiadomość $m$ przy użyciu klucza publicznego $(n, y)$ wykonaj kroki:
        <ol>
            <li>
                Przedstaw $m$ w postacie łańcucha binarnego $m = m_1 m_2 ... m_t$ długości $t$
            </li>
            <li>
                <pre>
For $i$ from 1 to $t$ do
    wybierz losowe $x \in \mathbb{Z}^*_n$
    If $m_i = 1$ then set $c_i \leftarrow yx^2 \mod n$
    Otherwise set $c_i \leftarrow x^2 \mod n$</pre>
            </li>
            <li>
                Kryptogram wiadomości $m$ stanowi $c = (c_1, c_2, ..., c_t)$
            </li>
        </ol>
        <h3>Algorytm deszyfrowania</h3>
        Chcąc odzyskać wiadomość z kryptogramu $c$ przy użyciu klucza prywatnego $(p, q)$ wykonaj kroki:
        <ol>
            <li>
                <pre>
For $i$ from 1 to $t$ do
    policz symbol Legendre'a $e_i = \left(\frac{c_i}{p}\right)$ (algorytm poniżej)
    If $e_i = 1$ then set $m_i \leftarrow 0$
    Otherwise set $m_i \leftarrow 1$</pre>
            </li>
            <li>
                Zdeszyfrowana wiadomość to $m = m_1 m_2 ... m_t$
            </li>
        </ol>
    </article>
</main>
<?php
include 'comments.php';
include 'footer.php'; ?>