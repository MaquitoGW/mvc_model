<?php

namespace lib;

use Exception;
use PDO;
use PDOException;
use lib\IsConfig;

class sql
{
    protected $db;
    protected $db_host;
    protected $db_name;
    protected $user;
    protected $password;

    protected $PDO;
    protected $query;

    public function __construct()
    {
        // Obtendo configurações do .env
        $this->db = IsConfig::env("DB");
        $this->db_host = IsConfig::env("DB_HOST");
        $this->db_name = IsConfig::env("DB_NAME");
        $this->user = IsConfig::env("DB_USER");
        $this->password = IsConfig::env("DB_PASS");

        // Instanciando nova coneção
        try {
            $this->PDO = new PDO(
                $this->db . ":dbname=" . $this->db_name . ";host=" . $this->db_host,
                $this->user,
                $this->password
            );

            //Retorna coneção
            return $this->PDO;
        } catch (PDOException $e) {
            return "Erro com o Banco de Dados: " . IsConfig::env("DB");
        } catch (Exception $e) {
            return "Ocorreu um erro: " . $e->getMessage();
        }
    }

    public static function INSERT($tb)
    {
        $i = new self();
        $i->query = "INSERT INTO $tb ";
        return $i;
    }

    public static function SELECT($tb)
    {
        $i = new self();
        $i->query = "SELECT * FROM $tb ";
        return $i;
    }

    // Metodos do Insert
    public function add($array)
    {
        $keys = implode(", ", array_keys($array));
        $values = implode(", ", array_map(function ($value) {
            return "'$value'";
        }, array_values($array)));

        $this->query .= "($keys) VALUES ($values) ";
        return $this;
    }


    // Metodos Global
    public function where($registro, $value = null)
    {
        if (empty($value)) $a = "";
        else $a = "= $value";

        $this->query .= "WHERE $registro $a";
        return $this;
    }

    public function whereLike($registro, $value = null)
    {
        if (empty($value)) $a = "";
        else $a = "LIKE '%$value%'";

        $this->query .= "WHERE $registro $a";
        return $this;
    }

    // Metodos do select
    public function OrderBy($column, $order)
    {
        $this->query .= " ORDER BY $column $order";
        return $this;
    }

    public function get()
    {
        $sql = $this->PDO->prepare($this->query);
        $sql->execute();

        return $sql->fetch();
    }

    public function all()
    {
        $sql = $this->PDO->prepare($this->query);
        $sql->execute();

        return $sql->fetchAll();
    }

    public static function UPDATE($tb)
    {
        $i = new self();
        $i->query = "UPDATE $tb SET ";
        return $i;
    }

    public function set($array)
    {
        $sets = "";
        $total = count($array);
        $i = 1;
        foreach ($array as $key => $value) {
            $sets .= $i == $total ? "$key = '$value'" : "$key = '$value', ";
            $i++;
        }

        $this->query .= $sets . " ";
        return $this;
    }

    public static function DELETE($tb)
    {
        $i = new self();
        $i->query = "DELETE FROM $tb ";
        return $i;
    }

    public function execute()
    {
        $sql = $this->PDO->prepare($this->query);
        return $sql->execute();
    }
}
