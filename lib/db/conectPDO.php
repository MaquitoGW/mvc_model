<?php

namespace lib\db;

use Exception;
use PDO;
use PDOException;
use lib\IsConfig;

class conectPDO
{
    protected $PDO;
    protected $db;
    protected $db_host;
    protected $db_name;
    protected $user;
    protected $password;

    protected function __construct()
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
}
