<?php
declare(strict_types=1);

namespace App\Core;

use mysqli;
use mysqli_sql_exception;

class Database
{
    private static ?mysqli $conn = null;

    private function __construct() {}

    public static function getConnection(): mysqli
    {
        if (self::$conn === null) {
            // Lanzar excepciones en errores MySQLi
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

            $conn = new mysqli(\DB_HOST, \DB_USER, \DB_PASS, \DB_NAME);
            $conn->set_charset(\DB_CHARSET);

            self::$conn = $conn;
        }
        return self::$conn;
    }
}