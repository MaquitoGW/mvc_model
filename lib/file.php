<?php

namespace lib;

use Exception;
use lib\Response;

class File
{
    private static $directory;
    private static $response;

    /**
     * Função para criar diretório.
     * 
     * @param string $path Caminho relativo ao diretório base.
     * @param int $permission Permissões para o diretório.
     * @param int $action Define se vai ter uma acão.
     * @return string|bool|self Retorna o caminho do diretório criado ou existente, ou false em caso de erro, ou um encadeamento caso seja action seja verdadeiro.
     */
    public static function IsDir($path, $action = false, $permission = 0777)
    {
        self::$directory = self::storage() . trim($path, '/') . '/';

        if (file_exists(self::$directory)) {
            // Caso action seja verdadeiro cria diretório se não passa caminho
            if ($action) {
                // Verificar se o diretório já existe
                if (!is_dir(self::$directory)) {
                    if (!mkdir(self::$directory, $permission, true)) self::$response = [false, "Falha ao criar o diretório.", "dir"];
                    else  self::$response = [true, self::$directory, "dir"];
                } else self::$response = [false, "O diretório já existe.", "dir"];
            } else self::$response = [true, self::$directory, "dir"];
        } else self::$response = [false, "O diretório não existe", "dir"];

        return new Self();
    }

    public static function get($value = false)
    {
        return $value ? self::$response[1] : self::$response[0];
    }

    /**
     * Verifica se o arquivo existe no caminho fornecido
     * 
     * @param string $path Caminho do arquivo
     * @return self Retorna true se o arquivo existir, caso contrário, false.
     */
    public static function isFile($value)
    {
        $file = self::storage() . trim($value, '/');

        if (file_exists($value)) self::$response = [true, $value, "file"];
        elseif (file_exists($file)) self::$response = [true, $file, "file"];
        else self::$response = [false, "O arquivo não existe", "file"];

        return new Self();
    }

    // /**
    //  * Renomeia um arquivo ou diretório.
    //  * 
    //  * @param string $oldName Nome antigo do arquivo ou diretório.
    //  * @param string $newName Novo nome do arquivo ou diretório.
    //  * @return bool Retorna true em caso de sucesso, false em caso de erro.
    //  */
    public static function rename($newName)
    {
        $newName = trim($newName, "/");

        if (self::$response[0]) {
            $oldName = explode("/", self::$response[1]);
            $end = end($oldName);
            $newNamePath = str_replace($end, $newName, self::$response[1]);

            rename(self::$response[1], $newNamePath);
            self::$response = [true, $newNamePath];
        } else self::$response = [false, self::$response[1]];

        return new Self();
    }

    /**
     * Deleta um arquivo ou diretório.
     * 
     * @param string $path Caminho do arquivo ou diretório.
     * @return self Retorna true em caso de sucesso, false em caso de erro.
     */
    public static function delete()
    {
        if (self::$response[0]) {
            if (self::$response[2] == "dir") {
                if (!file_exists(self::$directory)) self::$response = [false, "O diretório não existe"];
                else {
                    self::delTree(self::$directory);
                    self::$response = [true, "O diretório foi apagado com sucesso"];
                }
            } elseif (self::$response[2] == "file") {
                unlink(self::$response[1]);
                self::$response = [true, "O seu arquivo foi apagado com sucesso"];
            }
        } else self::$response = [false, self::$response[1]];

        return new Self();
    }

    private static function delTree($dir)
    {
        $files = array_diff(scandir($dir), array('.', '..'));
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? self::delTree("$dir/$file") : unlink("$dir/$file");
        }
        return rmdir($dir);
    }

    /**
     * Altera as permissões de um arquivo ou diretório.
     * 
     * @param string $path Caminho do arquivo ou diretório.
     * @param int $permission Permissão a ser atribuída.
     * @return bool Retorna true em caso de sucesso, false em caso de erro.
     */
    public static function permissions($path, $permission)
    {
        $target = self::storage() . trim($path, '/');

        if (!file_exists($target)) {
            http_response_code(404);
            echo "Erro: Arquivo ou diretório não encontrado.";
            return false;
        }

        return chmod($target, $permission);
    }

    /**
     * Função para obter o caminho base de storage.
     * 
     * @return string Retorna o caminho base da pasta de armazenamento.
     */
    private static function storage()
    {
        $dir = str_replace("lib", "", __DIR__) . "storage";
        return rtrim($dir, '/') . '/';
    }
}
