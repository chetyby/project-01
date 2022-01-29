<?php

namespace App\classes;

use PDO;
use App\classes\Auth;

class App
{
    public static $pdo;
    public static $auth;
    public static function getPdo(): PDO
    {
        if (!self::$pdo) {
            $pguser = "postgres";
            $pgpass = "12345678";
            self::$pdo = new PDO('pgsql:host=172.19.0.4;port=5432;dbname=mabase', $pguser, $pgpass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        }
        return self::$pdo;
    }
    public static function getAuth(): Auth
    {
        if (isset($_SESSION)) {
            $session = $_SESSION;
        } else {
            $session = [];
        }
        if (!self::$auth) {
            self::$auth = new Auth(self::getPDO(), 'login.php', $session);
        }
        return self::$auth;
    }
}
