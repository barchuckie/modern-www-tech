<?php include 'header.php' ?>
<main id="main-content" class="row content">
    <article id="legendre-jacobi" class="my-block">
        <h1>Symbol Legendre’a i Jacobiego</h1>
        <b> Definicja.</b> Niech $p$ będzie nieparzystą liczbą pierwszą, a $a$ liczbą całkowitą.
        <i>Symbol Legendre'a</i> $\left (\frac{a}{p}\right)$ jest zdefiniowany jako:
        $$
        \left (\frac{a}{p}\right) = \left\{
        \begin{array}{ll}
        0 & \textrm{ jeżeli }  p|a\\
        1 & \textrm{ jeżeli }  a \in Q_p\\
        -1 & \textrm{ jeżeli }  a \notin \overline{Q}_p
        \end{array}
        \right.
        $$
        <b>Własności symbolu Legendre'a.</b> Niech $a,b \in \mathbb{Z}$,
        zaś $p$ to nieparzysta liczba pierwsza. Wówczas:
        <ul>
            <li>$\left (\frac{a}{p}\right) \equiv a^\frac{\left (p-1\right)}{2} \pmod p$</li>
            <li>$\left (\frac{ab}{p}\right) = \left (\frac{a}{p}\right)\left (\frac{b}{p}\right)$</li>
            <li>$a \equiv b \pmod p \Longrightarrow \left (\frac{a}{p}\right) = \left (\frac{b}{p}\right)$</li>
            <li>$\left (\frac{2}{p}\right) = \left (-1\right)^\frac{(p^2-1)}{8}$</li>
            <li>
                Jeżeli $q$ jest nieparzystą liczbą pierwsza inną od $p$ to:
                $$
                \left (\frac{p}{q}\right) = \left (\frac{q}{p}\right)
                \left (-1\right)^\frac{\left (p-1\right)\left (q-1\right)}{4}
                $$
            </li>
        </ul>
        <br><br>
        <b> Definicja.</b> Niech $n \geqslant 3$ będzie liczbę nieparzystą, a jej rozkład na
        czynniki pierwsze to $n = p_{1}^{e_1}p_{2}^{e_2}\dots p_{k}^{e_k}$. <i>Symbol Jacobiego</i> $\left (\frac{a}{n}\right)$ jest zdefiniowany jako:
        $$
        \left (\frac{a}{n}\right) =
        {\left (\frac{a}{p_1}\right)}^{e_1} {\left (\frac{a}{p_2}\right)}^{e_2} \dots
        {\left (\frac{a}{p_k}\right)}^{e_k}.
        $$
        Jeżeli $n$ jest liczbą pierwszą, to symbol Jacobiego jest symbolem Legendre'a.<br>
        <b>Własności symbolu Jacobiego.</b> Niech $a,b \in \mathbb{Z}$,
        zaś $m, n \geqslant 3$ to nieparzyste liczby całkowite. Wówczas:
        <ul>
            <li>$\left (\frac{a}{n}\right) = 0, 1,$ albo $-1$. Ponadto
                $\left(\frac{a}{n}\right) = 0 \iff gcd(a, n) \neq 1$</li>
            <li>$\left (\frac{ab}{n}\right) = \left (\frac{a}{n}\right)\left (\frac{b}{n}\right)$</li>
            <li>$\left (\frac{a}{mn}\right) = \left (\frac{a}{m}\right)\left (\frac{a}{n}\right)$</li>
            <li>$a \equiv b \pmod n \Longrightarrow
                \left (\frac{a}{n}\right) = \left (\frac{b}{n}\right)$</li>
            <li>$\left (\frac{1}{n}\right) = 1$</li>
            <li>$\left (\frac{-1}{n}\right) = \left (-1\right)^\frac{(n-1)}{2}$</li>
            <li>$\left (\frac{2}{n}\right) = \left (-1\right)^\frac{(n^2-1)}{8}$</li>
            <li>$\left (\frac{m}{n}\right) = \left (\frac{n}{m}\right) \left (-1\right)^\frac{\left (m-1\right)\left (n-1\right)}{4} $</li>
        </ul>
        Z własności symbolu Jacobiego wynika, że jeżeli $n$ nieparzyste oraz $a$ nieparzyste i w postaci $a=2^e a_1$,
        gdzie $a_1$ też nieparzyste to:
        $$
        \left (\frac{a}{n}\right) =
        \left (\frac{2^e}{n}\right) \left (\frac{a_1}{n}\right) =
        {\left (\frac{2}{n}\right)}^{e}\left (\frac{n \mod a_1}{a_1}\right) \left (-1\right)^\frac{\left (a_1-1\right)\left (n-1\right)}{4}
        $$
        <b>Algorytm obliczania symbolu Jacobiego $\left(\frac{a}{n}\right)$ (i Legendre'a)</b>
        dla nieparzystej liczby całkowitej $n \geqslant 3$
        oraz całkowitego $0 \leqslant a < n$
        <pre>JACOBI(a, n)</pre>
        <ol>
            <li><pre>If $a = 0$ then return $0$</pre></li>
            <li><pre>If $a = 1$ then return $1$</pre></li>
            <li><pre>Write $a = 2^e a_1$, gdzie $a_1$ nieparzyste</pre></li>
            <li><pre>If $e$ parzyste then set $s \leftarrow 1$
Otherwise set $s \leftarrow 1$ if $n \equiv 1 \, or \, 7 \pmod 8$, or
set $s \leftarrow -1$ if $n \equiv 3 \, or \, 5 \pmod 8$</pre></li>
            <li><pre>If $n \equiv 3 \pmod 4$ and $a_1 \equiv 3 \pmod 4$ then set $s \leftarrow -s$</pre></li>
            <li><pre>Set $n_1 \leftarrow n \mod a_1$</pre></li>
            <li><pre>If $a_1 = 1$ then return $s$
Otherwise return $s\cdot$JACOBI($n_1$, $a_1$)</pre></li>
        </ol>
    </article>
</main>
<?php
include 'comments.php';
include 'footer.php'; ?>