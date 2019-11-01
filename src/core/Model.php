<?php 

namespace App\Core;

use App\Framework\Database\Interfaces\DatabaseInterface;
use App\Framework\Database\MySql;

class Model 
{
    private $db;
    private $lastInsertId;
    private $result = [];
    private $results = [];
    private $success = false;

    public function __construct(DatabaseInterface $database = null)
    {
        if($database === null) {
            $database = new MySql(); // set default database connection if not specified
        }
        $this->db = ($database === null) ?  : $database->getConnection();
    }

    /**
     * @param string $sql
     * @param array $params(optional)
     * @return self
     */
    public function select(string $sql, array $params = []): self
	{
		if(empty($params)) {
			$stmt = $this->db->query($sql);
		} else {
			$stmt = $this->db->prepare($sql);
            $stmt->execute($params);
        }

        $res = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        if($res != false) {
            $this->results = $res;
            $this->success = true;
        }

		return $this;
    }

    /**
     * @param string $sql
     * @param array $params(optional)
     * @return self
     */
    public function selectOne(string $sql, array $params = []): self
	{
		if(empty($params)) {
			$stmt = $this->db->query($sql);
		} else {
			$stmt = $this->db->prepare($sql);
			$stmt->execute($params);
        }

        $res = $stmt->fetch(\PDO::FETCH_ASSOC);

        if($res != false) {
            $this->result = $res; 
            $this->success = true;
        }

		return $this;
    }
    
    /**
     * @param string $sql
     * @param array $params
     * @return self
     */
	public function insert(string $sql, array $params): self
	{
		$stmt = $this->db->prepare($sql);
		if($stmt->execute($params)) {
            $this->success = true;
            $this->lastInsertId = $this->db->lastInsertId();
        }
        return $this;
    }
    
    /**
     * Use for update or delete(where we want only true or false return)
     * @param string $sql
     * @param array $params
     * @return self
     */
	public function query(string $sql, array $params): self
	{
		$stmt = $this->db->prepare($sql);
		if($stmt->execute($params)) {
            $this->success = true; 
        }
		return $this;
    }
    
    /**
     * Return array of results
     * @return array
     */
    public function getResults(): array
    {
        return $this->results;
    }

    /**
     * Return array of single result
     * @return array
     */
    public function getResult(): array
    {
        return $this->result;
    }

    /**
     * Return last inserted id
     * @return int
     */
    public function getLastInsertId(): ?int
    {
        return $this->lastInsertId;
    }

    /**
     * @return bool
     */
    public function getSuccess(): bool
    {
        return $this->success;
    }
}