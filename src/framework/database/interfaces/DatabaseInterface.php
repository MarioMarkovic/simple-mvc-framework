<?php 

namespace App\Framework\Database\Interfaces;

interface DatabaseInterface 
{
    /**
     * @return \PDO
     */
    public function getConnection(): \PDO;
}