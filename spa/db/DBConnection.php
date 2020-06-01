<?php


class DBConnection
{
    private static $host = 'localhost';
    private static $dataBase_name   = 'slackbot';
    private static $userDB = 'root';
    private static $passDB = 'QWErty123456;';
    private static $charset = 'utf8';
    private static $post = 3306;

    public static function connect() {
        $dsn = "mysql:host=" . DBConnection::$host . ";dbname=" . DBConnection::$dataBase_name . ";charset=" . DBConnection::$charset;
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try {
            return new PDO($dsn, DBConnection::$userDB, DBConnection::$passDB, $opt);

        } catch (PDOException $e) {
            http_response_code( 500);
            die;
        }
    }
}