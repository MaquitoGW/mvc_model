<?php

namespace lib;

use Exception;
use lib\Response;

class File
{
    private static $directory;
    private static $response;

    public static function IsDir($path, $action = false, $permission = 0777)
    {
        self::$directory = self::storage() . trim($path, '/') . '/';

        // Caso action seja verdadeiro cria diretório se não passa caminho
        if ($action) {
            // Verificar se o diretório já existe
            if (!is_dir(self::$directory)) {
                if (!mkdir(self::$directory, $permission, true)) self::$response = [false, "Falha ao criar o diretório.", "dir"];
                else  self::$response = [true, self::$directory, "dir"];
            } else self::$response = [false, "O diretório já existe.", "dir"];
        } else {
            if (file_exists(self::$directory)) {
                self::$response = [true, self::$directory, "dir"];
            } else self::$response = [false, "O diretório não existe", "dir"];
        }

        return new Self();
    }

    public static function isFile($value)
    {
        $file = self::storage() . trim($value, '/');

        if (file_exists($value)) self::$response = [true, $value, "file"];
        elseif (file_exists($file)) self::$response = [true, $file, "file"];
        else self::$response = [false, "O arquivo não existe", "file"];

        return new Self();
    }

    // ACTIONS

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

    public static function permissions($permission)
    {
        if (self::$response) {
            chmod(self::$response[1], $permission);
            self::$response = [true, "Permissões alteradas com sucesso"];
        } else self::$response = [false, self::$response[1]];
        return new Self();
    }

    public static function readfile()
    {
        if (self::$response[0]) {
            if (self::$response[2] == "file") {
                $filePath = self::$response[1];
                $mineType = mime_content_type($filePath);

                $fp = @fopen($filePath, 'rb');

                $size = filesize($filePath); // File size
                $length = $size; // Content length
                $start = 0; // Start byte
                $end = $size - 1; // End byte

                header("Content-Type: " . $mineType);
                header("Accept-Ranges: 0-$length");
                if (isset($_SERVER['HTTP_RANGE'])) {

                    $c_start = $start;
                    $c_end = $end;

                    list(, $range) = explode('=', $_SERVER['HTTP_RANGE'], 2);
                    if (strpos($range, ',') !== false) {
                        header('HTTP/1.1 416 Requested Range Not Satisfiable');
                        header("Content-Range: bytes $start-$end/$size");
                        exit;
                    }
                    if ($range == '-') {
                        $c_start = $size - substr($range, 1);
                    } else {
                        $range = explode('-', $range);
                        $c_start = $range[0];
                        $c_end = (isset($range[1]) && is_numeric($range[1])) ? $range[1] : $size;
                    }
                    $c_end = ($c_end > $end) ? $end : $c_end;
                    if ($c_start > $c_end || $c_start > $size - 1 || $c_end >= $size) {
                        header('HTTP/1.1 416 Requested Range Not Satisfiable');
                        header("Content-Range: bytes $start-$end/$size");
                        exit;
                    }
                    $start = $c_start;
                    $end = $c_end;
                    $length = $end - $start + 1;
                    fseek($fp, $start);
                    header('HTTP/1.1 206 Partial Content');
                }
                header("Content-Range: bytes $start-$end/$size");
                header("Content-Length: " . $length);

                $buffer = 1024 * 8;
                while (!feof($fp) && ($p = ftell($fp)) <= $end) {

                    if ($p + $buffer > $end) {
                        $buffer = $end - $p + 1;
                    }
                    set_time_limit(0);
                    echo fread($fp, $buffer);
                    flush();
                }

                fclose($fp);
                exit;
            } else self::$response = [false, "Isso não e um arquivo"];
        } else self::$response = [false, self::$response[1]];

        return new Self();
    }

    public static function save($filename, $path = null)
    {
        if (self::$response[0]) {
            if (self::$response[2] == "file") {
                $data = file_get_contents(self::$response[1]);
                if (!is_null($path)) {
                    $mountPath = self::storage() . ltrim($path, "/") . "/";
                    if (file_exists($path)) $pathValeu = $path . $filename;
                    elseif (file_exists($mountPath)) $pathValeu = $mountPath . $filename;
                    else {
                        $createDir = self::IsDir($path, true)->get(true);
                        $pathValeu = $createDir  . $filename;
                    }
                } else $pathValeu = self::storage() . $filename;

                file_put_contents($pathValeu, $data);
                self::$response = [true, "Arquivo salvo com sucesso"];
            } else self::$response = [false, "Isso não e um arquivo"];
        } else self::$response = [false, self::$response[1]];

        return new Self();
    }


    public static function get($value = false)
    {
        return $value ? self::$response[1] : self::$response[0];
    }

    private static function storage()
    {
        $dir = str_replace("lib", "", __DIR__) . "storage";
        return rtrim($dir, '/') . '/';
    }
}
