<?php

namespace vendor\Core\Base;

use vendor\Core\Db;

abstract class Model 
{

    /**
     * Указатель на одкрытое подключение к базе данных
     * @var Array 
     */
    protected $pdo;

    /**
     * Название таблици к которой нужно обратиться за данными
     * @var string
     */
    protected $table;

    protected $pk = 'id';
    
    /**
     * Конструктор, который присваивает обьект класса Db переменнной $pdo
     */
    public function __construct() 
    {
        $this->pdo = Db::Instanse();
    }

    /*
     * Проверяет на выполнение запрос к БД
     * @return boolean
     */

    public function query($sql) 
    {
        return $this->pdo->execute($sql);
    }

    /**
     * Создаёт запрос, обращаеться к таблице и возвращает все данные хранящиеся в соответствующей таблице
     * @return Array
     */
    public function findAll() 
    {
        $sql = "SELECT * FROM {$this->table}";
        return $this->pdo->query($sql);
    }

    /**
     * Создаёт запрос, обращаеться к таблице и возвращает все задания
     *  идентификаторы проэктов которых равны указаному
     * @param type $project_id нужный идентификатор проэкта
     * @return type
     */
    public function FindTasksByProjectId($project_id)
    {
       $sql = "SELECT * FROM `".$this->table."` WHERE project_id = ".$project_id.";";
       return $this->pdo->query($sql);
    }
    
    /**
     * Создаёт запрос, обращаеться к таблице и возвращает все данныке проэкта по заданому id
     * @param type $project_id нужный идентификатор проэкта
     * @return type
     */
    public function FindProjectById($project_id) 
    {
       $sql = "SELECT * FROM `".$this->table."` WHERE id = ".$project_id.";";
       return $this->pdo->query($sql); 
    }
    
    /**
     * Создаёт запрос, обращаеться к таблице и возвращает все проэкты имя которого соответствует указанному
     * @param type $name
     * @return type
     */
    public function FindProjectByName($name) 
    {
        $sql = "SELECT * FROM `".$this->table."` WHERE name = '".$name."';";
       return $this->pdo->query($sql); 
    }
    
    /**
     * Создаёт запрос, обращаеться к таблице и добавляет задание в соответствующюю таблицу
     * @param type $par1 имя задания
     * @param type $par2 статус
     * @param type $par3 идентификатор проэкта
     * @return type
     */
    public function insertTasks($par1, $par2, $par3) 
    {
        $sql = "INSERT INTO `".$this->table."` (`name`, `status`, `project_id`) VALUES ('".$par1."','".$par2."',".$par3.");";
        return $this->pdo->queryInsert($sql);
    }
    
    /**
     * Создаёт запрос, обращаеться к таблице и добавляет проэкт в соответствующюю таблицу
     * @param type $name имя проэкта
     * @return type
     */
    public function insertProject($name)
    {
        $sql = "INSERT INTO `".$this->table."` (`name`) VALUES ('".$name."');";
        return $this->pdo->queryInsert($sql);
    }
    
    /**
     * Создаёт запрос, обращаеться к таблице и удаляет все задания имеющие данные project_id равны указаному id
     * @param type $id идентификатор проэкта
     * @return type
     */
    public function deleteAllTasksInProject($id) 
    {
        $sql = "DELETE FROM `".$this->table."` WHERE project_id=".$id.";";
        return $this->pdo->queryDelete($sql);
    }
    
    /**
     * Создаёт запрос, обращаеться к таблице и удаляет проект id которого равен указаному id
     * @param type $id
     * @return type
     */
    public function deleteProject($id)
    {
        $sql = "DELETE FROM `".$this->table."` WHERE id = ".$id.";";
        return $this->pdo->queryDelete($sql);
    }
    
    /**
     * Создаёт запрос, обращаеться к таблице и удаляет задания по указаному id
     * @param type $id_task
     * @param type $id_project
     * @return type
     */
    public function deleteTask($id_task, $id_project)
    {
        $sql = "DELETE FROM `".$this->table."` WHERE id = ".$id_task." AND project_id = ".$id_project.";";
        return $this->pdo->queryDelete($sql);
    }
    
    /**
     * Создаёт запрос, обращаеться к таблице 
     * и измняет статус указанного зания на переданный параметр $status
     * @param type $id идентификатор задания
     * @param type $status новый статус
     * @return type
     */
    public function UpdateOnDone($id, $status)
    {
        $sql = "UPDATE `".$this->table."` SET status = '".$status."' WHERE id = ".$id.";";
        return $this->pdo->queryUpdate($sql);
    }
    
    
    
    /*
     * Возвращает количество строк в таблице
     */
    public function CountRows() 
    {
        $sql = "SELECT COUNT(*) FROM ".$this->table;
        return $this->pdo->query($sql)[0]["COUNT(*)"];
    }
    
}
