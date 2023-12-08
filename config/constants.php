<?php
require_once 'config.php';

class AppConfig
{

    public string $rootPath = '';
    public string $serverPath = '';
    public array $configPath = [];
    public array $includesPath = [];
    public array $templatesPath = [];
    public array $cssPath = [];
    public array $jsPath = [];
    public array $imagesPath = [];
    public array $nodePaths = [];
    public PDO $connection;
    private static AppConfig $instance;

    private function getFileConnections(string $filepath, &$result): array
    {
        $rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($this->rootPath.$filepath));

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
            $this->rootPath = realpath('../');//realpath(dirname(__FILE__)."/.."); //$_SERVER['DOCUMENT_ROOT'];
            $this->serverPath = '\\\\'.$_SERVER['HTTP_HOST'].'\\Questionnaire';
            /*$this->configPath = $this->rootPath . "\\config\\";
            $this->includesPath = $this->rootPath . "\\includes\\";
            $this->templatesPath = $this->rootPath . "\\templates\\";
            $this->cssPath = $this->rootPath . "\\assets\\css\\";
            $this->jsPath = $this->rootPath . "\\assets\\js\\";
            $this->imagesPath = $this->rootPath . "\\assets\\images\\";*/
            //TODO: update modify, просто присваивать
            self::getFileConnections("\\config\\",$this->configPath);
            self::getFileConnections("\\includes\\",$this->includesPath);
            self::getFileConnections("\\templates\\",$this->templatesPath);
            self::getFileConnections("\\assets\\css\\", $this->cssPath);
            self::getFileConnections("\\assets\\js\\", $this->jsPath);
            self::getFileConnections("\\assets\\images\\",$this->imagesPath);

            $this->nodePaths = [ //TODO: add autodetect modules
                'bootstrap.js' => "\\\\".$this->rootPath.'\\node_modules\\bootstrap\\dist\\js\\bootstrap.min.js',
                'bootstrap.css' =>  "\\\\".$this->rootPath.'\\node_modules\\bootstrap\\dist\\css\\bootstrap.min.css',
                'jquery.js' =>  "\\\\".$this->rootPath.'\\node_modules\\jquery\\dist\\jquery.min.js',
            ];

            $this->connection = DB::getDBInstance();
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
