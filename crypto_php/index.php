<?php include 'header.php';
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    require_once "DBUtil.php";
    $username = $_POST['username'];
    $password = $_POST['password'];

    $db = new DBUtil();
    $result = $db->check_login($username, $password);

    if (isset($result)) {
        $_SESSION['login'] = $result['id'];
        $_SESSION['username'] = $result['username'];
        setcookie('active', 'true', time() + TIME_TO_LOGOUT);
        header('Location: /');
    } else {
        echo "Dane niepoprawne.";
    }
}

if (!isset($_SESSION['login'])) {?>
    <section class="my-block">
        <form method="post" action="/">
            <label>
                Username:
                <input name="username" type="text" required pattern="^[A-Za-z_0-9]+$" maxlength="60">
            </label>
            <label>
                Password:
                <input name="password" type="password" required>
            </label>
            <button type="submit" class="btn-primary">Zaloguj</button>
        </form>
        <a href="register.php"><button class="btn-primary">Zarejestruj się</button></a>
    </section>
<?php    }
include 'footer.php'; ?>