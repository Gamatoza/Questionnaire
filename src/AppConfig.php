<?php
declare(strict_types=1);
require_once 'DBConfig.php';
class AppConfig
{
    public string $rootPath = '';
    public string $serverPath = '';
    public array $configPath;
    public array $includesPath;
    public array $templatesPath;
    public array $cssPath;
    public array $jsPath;
    public array $imagesPath;
    public array $nodePaths;

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
            /*$this->configPath = $this->rootPath . "\\constants\\";
            $this->includesPath = $this->rootPath . "\\includes\\";
            $this->templatesPath = $this->rootPath . "\\templates\\";
            $this->cssPath = $this->rootPath . "\\assets\\css\\";
            $this->jsPath = $this->rootPath . "\\assets\\js\\";
            $this->imagesPath = $this->rootPath . "\\assets\\images\\";*/
            //TODO: update modify, просто присваивать
            $this->configPath = self::getFileConnections("\\src\\");
            $this->includesPath = self::getFileConnections("\\includes\\");
            $this->templatesPath = self::getFileConnections("\\templates\\");
            $this->cssPath = self::getFileConnections("\\assets\\css\\");
            $this->jsPath = self::getFileConnections("\\assets\\js\\");
            $this->imagesPath = self::getFileConnections("\\assets\\images\\");

            $this->nodePaths = [ //TODO: add autodetect modules
                'bootstrap.js' => "\\\\".$this->rootPath.'\\node_modules\\bootstrap\\dist\\js\\bootstrap.min.js',
                'bootstrap.css' =>  "\\\\".$this->rootPath.'\\node_modules\\bootstrap\\dist\\css\\bootstrap.min.css',
                'jquery.js' =>  "\\\\".$this->rootPath.'\\node_modules\\jquery\\dist\\jquery.min.js',
            ];

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
