<?php

namespace vendor\Core;

/**
 * Description of Db
 * Используеться для работы с базами данных:
 * подключение, 
 */
class Db {
    
    /**
     * Указатель на одкрытое подключение к базе данных
     * @var Array 
     */
    protected  $pdo;
    
    /**
     * Содержит обьект класса Db
     * @var object
     */
    protected  static $instance;
    
    /*
     * Количество выполненных SQL запросов (счётчик)
     */
    public static $countSql = 0;
    
    /*
     * Все запросы к БД
     */
    public static $querys = [];


    protected function __construct() 
    {
        $db = require ROOT.'/config/db.php';
        $option = [
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
        ];
        $this->pdo = new \PDO($db['dsn'], $db['user'], $db['pass'],$option);
    }
    
    /**
     * Создание обьекта данного класса и подключение к БД
     * @return object
     */
    public static function Instanse() 
    {
    if(self::$instance == null) 
    {
        self::$instance = new self;
    } 
        return self::$instance;
    }
    
    /**
     * Проверяет на то чи выполниться запрос к базе данных
     * @param string $sql
     * @return boolean
     */
    public function execute($sql, $params = []) 
    {
        self::$countSql++;
        self::$querys[] = $sql;
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }
    
    /**
     * Выполнение запросов к базе данных
     * @param string $sql
     */
    public function query($sql, $params = []) 
    {
        self::$countSql++;
        self::$querys[] = $sql;
        $stmt = $this->pdo->prepare($sql);
        $res = $stmt->execute($params);

        if($res !== false) 
        {
            return $stmt->fetchAll();
        } else 
            {
            return [];
            }
    }
    
    /**
     * Выполнение запросов на удаление к базе данных
     * @param type $sql Формат запроса
     * @return int Статистика: (1- запрос успешен, 0-запрос неудачен)
     */
    public function queryDelete($sql) 
    {
        $stmt = $this->pdo->prepare($sql);
        $res = $stmt->execute();
        if($res !== false) 
        {
            return 1;
        } else 
            {
            return 0;
            }
    }
    
    /**
     * Выполнение запросов на добавление данных к БД
     * @param type $sql строка запроса
     * @param type $params передаваемые парамтры в запрос
     * @return type полученный результат
     */
    public function queryInsert($sql, $params = []) 
    {
        self::$countSql++;
        self::$querys[] = $sql;
        $stmt = $this->pdo->prepare($sql);
        $res = $stmt->execute($params);
        if($res !== false) 
        {
            return $res;
        } else 
            {
            return $res;
            }
    }
    
    /**
     * Выполнение запроса к БД на оновление данных
     * @param type $sql строка запроса
     * @param type $params передаваемые парамтры в запрос
     * @return type полученный результат
     */
    public function queryUpdate($sql, $params = [])
    {
        self::$countSql++;
        self::$querys[] = $sql;
        $stmt = $this->pdo->prepare($sql);
        $res = $stmt->execute($params);
        if($res !== false) 
        {
            return $res;
        } else 
            {
            return $res;
            }
    }

}
