<?php 

namespace App\Framework\Database\Traits;

trait DatabaseConnectionTrait
{
    private $db;
    
    /**
     * @param string $type, $servername, $username, $password, $dbname, $charset
     * @return \PDO
     * @throws \Exception
     */
    private function connect(string $type, string $servername, string $username, string $password, string $dbname, string $charset): \PDO
    {
        try {
            $dsn = $type .":host=".$servername.";dbname=" . $dbname . ";charset=". $charset;
			$pdo = new \PDO($dsn, $username, $password);
			$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			return $pdo;
		} catch (\PDOException $e) {
			echo "Connection failed: " . $e->getMessage();
		}
    }

    /**
     * @return \PDO
     */
    public function getConnection(): \PDO
    {
        return $this->db;
    }
}