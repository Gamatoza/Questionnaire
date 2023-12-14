<?php
declare(strict_types=1);
require_once 'DBConfig.php';
class AppConfig
{
    public string $rootPath = '';
    public string $serverPath = '';
    public array $templatesPath;

    //
    public PDO $connection;
    private static AppConfig $instance;

    private function getFileConnections(string $filepath): array
    {
        $rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($this->rootPath.$filepath));
        $result = array();
        $paths = array();
        foreach ($rii as $file)
        if (!$file->isDir()) {
                //$filename = explode($this->rootPath, $file->getPathname());
                $paths[] = $file->getPathname();//'Questionnaire'.end($filename);
            }//TODO: может быть можно сократить до $file->getFilename, хз, надо почитать про rii
        foreach ($paths as $path) {
            $file = pathinfo($path, PATHINFO_FILENAME) . '.' . pathinfo($path, PATHINFO_EXTENSION);
            $result[$file] = $path;//$this->serverPath.$filepath.$file;
        }
        return $result;
    }

    private function __construct()
    {
        if (isset($this)) {
            $this->rootPath = realpath(__DIR__.'/../');;
            //__DIR__."../";
            //realpath(dirname(__FILE__)."/.."); //$_SERVER['DOCUMENT_ROOT'];
            $this->serverPath = '\\\\'.$_SERVER['HTTP_HOST'].'\\Questionnaire';
            //TODO: update modify, просто присваивать
            $this->templatesPath = self::getFileConnections("\\templates\\");

            $this->connection = DBConfig::getDBInstance();
        }

    }

    public static function getInstance(): static
    {
        if (!isset(self::$instance)) {
            self::$instance = new AppConfig();
        }
        return self::$instance;
    }

}
