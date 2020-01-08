<?php

class DBUtil
{
    private $host = '127.0.0.1';
    private $db = 'www';
    private $username = 'postgres';
    private $password = 'root';
    private $pdo;

    function __construct() {
        $this->pdo = new PDO("pgsql:host={$this->host};dbname={$this->db};port=5432;user=$this->username;password=$this->password");
    }

    function check_login($username, $password) {
        if (!preg_match('/^[A-Za-z_0-9]+$/', $username)) {
            return null;
        }
        $query = "SELECT * FROM crypt.users WHERE username = '$username'";
        $result = $this->pdo->query($query)->fetchAll();

        if (count($result) != 1) {
            return null;
        }

        $result = $result[0];

        if (!password_verify($password, $result['password'])) {
            return null;
        }

        return [
            'id' => $result['id'],
            'username' => $result['username']
        ];
    }

    function register($username, $password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO crypt.users (username, password) VALUES ('$username', '$hash')";
        $result = $this->pdo->query($query);

        return $result;
    }

    function get_comments($article) {
        $query = "SELECT username, content, add_time FROM crypt.comments c".
            " JOIN crypt.users u ON c.user_id = u.id WHERE article = '$article'";
        $result = $this->pdo->query($query)->fetchAll();

        return $result;
    }

    function add_comment($content, $article) {
        if (!isset($_SESSION['login'])) {
            return false;
        }
        $user = $_SESSION['login'];
        $query = "INSERT INTO crypt.comments (user_id, content, article, add_time)"
            ." VALUES ($user, '$content', '$article', now())";
        $result = $this->pdo->query($query);

        return $result;
    }
}