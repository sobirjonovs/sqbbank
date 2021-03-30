<?php

namespace Database;

use Exception;
use PDO;
use PDOException;

abstract class Database extends PDO implements DatabaseInterface
{
    public function __construct($credentials = "credentials.ini")
    {
        try {
            parent::__construct(...$this->connectionData($credentials));
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $PDOException) {
            echo $PDOException->getMessage();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function connectionData($credentials): array
    {
        if (!$credentials = parse_ini_file($credentials)) throw new Exception("File not found");

        return [
            // DSN
            $credentials['driver'] . ':host=' .
            $credentials['host'] . ';dbname=' . $credentials['database'],
            // Username
            $credentials['username'],
            // Password
            $credentials['password']
        ];
    }
}