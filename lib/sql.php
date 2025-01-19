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

    /**
     * Construtor
     *
     * Inicializa a conexão com o banco de dados utilizando configurações do arquivo .env.
     */
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

    /**
     * Cria uma query de INSERT na tabela especificada.
     *
     * @param string $tb Nome da tabela.
     * @return sql Instância da classe para encadeamento de métodos.
     */
    public static function INSERT($tb)
    {
        $i = new self();
        $i->query = "INSERT INTO $tb ";
        return $i;
    }

    /**
     * Cria uma query de SELECT na tabela especificada.
     *
     * @param string $tb Nome da tabela.
     * @return sql Instância da classe para encadeamento de métodos.
     */
    public static function SELECT($tb)
    {
        $i = new self();
        $i->query = "SELECT * FROM $tb ";
        return $i;
    }

    /**
     * Adiciona os valores para o INSERT.
     *
     * @param array $array Array associativo com as colunas e valores a serem inseridos.
     * @return sql Instância da classe para encadeamento de métodos.
     */
    public function add($array)
    {
        $keys = implode(", ", array_keys($array));
        $values = implode(", ", array_map(function ($value) {
            return "'$value'";
        }, array_values($array)));

        $this->query .= "($keys) VALUES ($values) ";
        return $this;
    }


    /**
     * Adiciona uma cláusula WHERE à query.
     *
     * @param string $registro Nome da coluna.
     * @param string|null $value Valor para a condição. Se não fornecido, será utilizado apenas o campo.
     * @return sql Instância da classe para encadeamento de métodos.
     */
    public function where($registro, $value = null)
    {
        if (empty($value)) $a = "";
        else $a = "= $value";

        $this->query .= "WHERE $registro $a";
        return $this;
    }

    /**
     * Adiciona uma cláusula WHERE com LIKE à query.
     *
     * @param string $registro Nome da coluna.
     * @param string|null $value Valor para a condição. Se não fornecido, será utilizado apenas o campo.
     * @return sql Instância da classe para encadeamento de métodos.
     */
    public function whereLike($registro, $value = null)
    {
        if (empty($value)) $a = "";
        else $a = "LIKE '%$value%'";

        $this->query .= "WHERE $registro $a";
        return $this;
    }

    /**
     * Adiciona uma cláusula ORDER BY à query.
     *
     * @param string $column Nome da coluna.
     * @param string $order Ordem (ASC ou DESC).
     * @return sql Instância da classe para encadeamento de métodos.
     */
    public function OrderBy($column, $order)
    {
        $this->query .= " ORDER BY $column $order";
        return $this;
    }

    /**
     * Executa a query e retorna um único resultado.
     *
     * @return mixed Retorna o resultado da consulta.
     */
    public function get()
    {
        $sql = $this->PDO->prepare($this->query);
        $sql->execute();

        return $sql->fetch();
    }

    /**
     * Executa a query e retorna todos os resultados.
     *
     * @return array Retorna um array com todos os resultados da consulta.
     */
    public function all()
    {
        $sql = $this->PDO->prepare($this->query);
        $sql->execute();

        return $sql->fetchAll();
    }

    /**
     * Cria uma query de UPDATE na tabela especificada.
     *
     * @param string $tb Nome da tabela.
     * @return sql Instância da classe para encadeamento de métodos.
     */
    public static function UPDATE($tb)
    {
        $i = new self();
        $i->query = "UPDATE $tb SET ";
        return $i;
    }

    /**
     * Adiciona os valores para o UPDATE.
     *
     * @param array $array Array associativo com as colunas e valores a serem atualizados.
     * @return sql Instância da classe para encadeamento de métodos.
     */
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

    /**
     * Cria uma query de DELETE na tabela especificada.
     *
     * @param string $tb Nome da tabela.
     * @return sql Instância da classe para encadeamento de métodos.
     */
    public static function DELETE($tb)
    {
        $i = new self();
        $i->query = "DELETE FROM $tb ";
        return $i;
    }

    /**
     * Executa a query montada (INSERT, UPDATE, DELETE).
     *
     * @return bool Retorna true se a execução for bem-sucedida, caso contrário, false.
     */
    public function execute()
    {
        $sql = $this->PDO->prepare($this->query);
        return $sql->execute();
    }
}
