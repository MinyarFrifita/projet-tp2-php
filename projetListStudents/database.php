class Database {

    private static $host = 'localhost';
    private static $dbname = 'school';
    private static $username = 'root';
    private static $password = "";
    private static $port = '3306';
    private static $pdo = null;

    public static function connect() {
        if (self::$pdo == null) {
            try {
                self::$pdo = new PDO(
                    "mysql:host=" . self::$host . ";port=" . self::$port . ";dbname=" . self::$dbname,
                    self::$username,
                    self::$password
                );
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}
