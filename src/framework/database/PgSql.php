<?php 

namespace App\Framework\Database;

use App\Framework\Database\Interfaces\DatabaseInterface;
use App\Framework\Database\Traits\DatabaseConnectionTrait;

class PgSql implements DatabaseInterface 
{
    use DatabaseConnectionTrait;
    
	public function __construct()
	{
        $this->db = $this->connect("pgsql", "127.0.0.1", "root", "", "app", "utf8");  
    }
}