<?php include "header.php" ?>
<section class="my-block">
    <form method="post" action="register.php">
        <label>
            Username:
            <input name="username" type="text" required pattern="[A-Za-z_0-9]+" maxlength="60">
        </label>
        <label>
            Password:
            <input name="password" type="password" required>
        </label>
        <button type="submit" class="btn-primary">Zarejestruj się</button>
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == 'POST') {
        require_once "utils/DBUtil.php";
        $username = $_POST['username'];
        $password = $_POST['password'];
        $db = new DBUtil();
        $result = $db->register($username, $password);

        if ($result == false) {
            echo "Nazwa użytkownika jest zajęta";
        }
    }
    ?>
</section>
<?php include 'footer.php'; ?>
