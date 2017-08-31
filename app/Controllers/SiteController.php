<?php

namespace app\Controllers;

use app\Models\Tasks;
use app\Models\Project;


class SiteController extends \vendor\core\Base\Controller {

    public function actionIndex() 
    {
        $project_model = new Project();
        $task_model = new Tasks();
       
        $per_page = 5;    //Число проэктов на 1-й странице
        $num_page = 3;     //Число ссылок в навигации от активной ссылки
        $start_row = (!empty($_GET['p']))? intval($_GET['p']): 0;
        $total =$project_model->CountRows();
        $projects = $project_model->findAll();
        $tasks = $task_model->findAll();
        $this->Set(compact('projects','tasks'));
        
    }
    public function actionForm()
    {
    
    }
    
    /*
     * Дествие с помощью которого добавляються в БД новые проэкты и задания
     */
    public function actionInsert()
    {
        $modelTask = new Tasks();
        $modelProject =new Project();
        
        if(isset($_POST)){
            if($_POST['type'] === 'project' && $_POST['project_name']!=='') {
            $modelProject->insertProject($_POST['project_name']);
            $tasks = $modelTask->findAll();
            $projects = $modelProject->findAll();
            $this->Set(compact('tasks','projects'));
            }
            else if($_POST['type']==='task' && $_POST['name'] !=='')
            {
                $name = $_POST['name'];
                $status ='performed';
                $project_id = $_POST['project_id'];
                $modelTask->insertTasks($name,$status,$project_id);
                $tasks = $modelTask->findAll();
                $projects = $modelProject->findAll();
                $this->Set(compact('tasks','projects'));
            }

        }
    }
    
    /*
     * Действие с помощью которого удаляються с БД проэкты и задания
     */
    public function actionDelete()
    {
        $modelTask = new Tasks();
        $modelProject =new Project();
        $id=$_POST['id'];
        if(isset($_POST)){
            if($_POST['type'] === 'project') {
                $modelTask->deleteAllTasksInProject($id);
                $modelProject->deleteProject($id);
            } else if($_POST['type']==='task')
            {
                $id_task = $_POST['id_task'];
                $id_project = $_POST['id_project'];
                $modelTask->deleteTask($id_task, $id_project);
            }
        }
    }
    
    /*
     * Подключение формы изменени имени проэкта
     */
        public function actionProject()
    {
    
    }
   
    /*
     * Действие которое помечает задание как 'done'
     */
    public function actionUpdateOnDone()
    {
           $modelTask = new Tasks();
           $modelTask->UpdateOnDone($_POST['id'] ,'done');
    }
   
}
