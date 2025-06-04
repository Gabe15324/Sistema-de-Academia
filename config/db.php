<?php
class Database {
    private static $host = 'localhost';
<<<<<<< HEAD
    private static $port = '3306'; // <-Caso de erro, altere a porta para a sua porta professor, e suba o código do banco para o funcionamento
=======
    private static $port = '3307'; // <-Caso de erro, altere a porta para a sua porta professor e suba o código do banco para o funcionamento
>>>>>>> 961ea868c5e8e59748e860a2f9cfb00e8bb1b41f
    private static $dbname = 'academia';
    private static $user = 'root';
    private static $pass = '';

    public static function conectar() {
        try {
            $dsn = "mysql:host=" . self::$host . ";port=" . self::$port . ";dbname=" . self::$dbname . ";charset=utf8mb4";
            $pdo = new PDO($dsn, self::$user, self::$pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Erro ao conectar no banco de dados: " . $e->getMessage());
        }
    }
}