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

    public function INSERT()
    {
        // echo $this->PDO;
    }



    public static function SELECT($tb)
    {
        $i = new self();
        $i->query = "SELECT * FROM $tb ";
        return $i;
    }

    // Metodos do select

    public function where($registro, $value = null)
    {
        if(empty($value)) $a = "";
        else $a = "= $value";

        $this->query .= "WHERE $registro $a";
        return $this;
    }

    public function whereLike($registro, $value = null)
    {
        if(empty($value)) $a = "";
        else $a = "LIKE '%$value%'";

        $this->query .= "WHERE $registro $a";
        return $this;
    }

    public function OrderBy($column,$order) {
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
