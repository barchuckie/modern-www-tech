<section class="my-block">
<h1>Komentarze i pytania</h1>
<?php
require_once "DBUtil.php";
$article = preg_replace('(\.php|/)', '', $_SERVER['REQUEST_URI']);
$db = new DBUtil();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_SESSION['login'])) {
        echo 'Tylko zarejestrowany użytkownik może dodawać komentarze.';
    }

    $result = $db->add_comment($_POST['content'], $article);
}

$comments = $db->get_comments($article);

foreach ($comments as $comment) {?>
    <div style="padding: 1%">
        <b><?php echo $comment['username'] ?></b><br>
        <b><?php echo $comment['add_time'] ?></b><br>
        <p><?php echo $comment['content'] ?></p>
    </div>
<?php }
?>
</section>
<?php
if(isset($_SESSION['login'])) { ?>
    <section class="my-block">
        <h1>Dodaj komentarz lub pytanie</h1>
        <form action="<?php echo $_SERVER['REQUEST_URI']?>" method="post">
            <label for="content">Zawartość:</label><br>
            <textarea name="content" id="content" cols="100" rows="10"></textarea><br>
            <input type="submit" value="Wyślij">
        </form>
    </section>
<?php }
