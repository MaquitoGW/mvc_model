<?php

namespace lib\db;
// Coneção com Banco de Dados
use lib\db\conectPDO;

class sql extends conectPDO
{
    protected $PDO;
    protected $query;

    public function __construct()
    {
        // Chamar constructor da classe Pai
        $this->PDO = parent::__construct();
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
        $keys = "";
        $values = "";
        $total = count($array);
        $i = 0;
        foreach ($array as $key => $value) {
            $keys .= $total == $i ? "'$key'" : "'$key',";
            $values .= $total == $i ? "'$value'" : "'$value',";
            $i++;
        }

        $this->query .= "($keys) VALUES ($values) ";
        return $this->query;
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

    public function UPDATE() {}
    public function DELETE() {}
}
