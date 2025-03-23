<?php
class Connection
{
    public static function Connect()
    {
        $contenu_env = file(__DIR__ . "/.env");

        $server = trim(explode(":", $contenu_env[0])[1]);
        $user = trim(explode(":", $contenu_env[1])[1]);
        $password = trim(explode(":", $contenu_env[2])[1]);
        $db_name = trim(explode(":", $contenu_env[3])[1]);

        try {
            $pdo = new PDO('mysql:host=' . $server . ';dbname=' . $db_name, $user, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }
}
?>
