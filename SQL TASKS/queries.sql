/**
 * Author:  Александр
 * Created: 19.08.2017
 * Completed: 20.08.2017
 */
/*Create table Project (id,name)*/
CREATE TABLE PROJECT (
id INT AUTO_INCREMENT NOT NULL,
name VARCHAR(100),
PRIMARY KEY(id)
) ENGINE=InnoDB CHARACTER SET=UTF8;

/*Ceate table TASKS (i, name, status, project_id*/
CREATE TABLE TASKS (
id INT AUTO_INCREMENT NOT NULL,
name VARCHAR(100),
status VARCHAR(20),
project_id INT NOT NULL,
PRIMARY KEY(id),
FOREIGN KEY fk_id_project (project_id) REFERENCES project(id)
) ENGINE=InnoDB CHARACTER SET=UTF8;

/*1_get all statuses, not repeating, alphabetically ordered*/
SELECT DISTINCT status FROM tasks ORDER BY status ASC;

/*2_get the count of all tasks in each project, order by tasks count descending*/
SELECT p.name, COUNT(*) "Amount tasks" FROM TASKS t, PROJECT p 
WHERE t.project_id = p.id 
GROUP by t.project_id 
ORDER by COUNT(*) desc;

/*3_get the count of all tasks in each project, order by project names*/
SELECT p.name, COUNT(*) "Amount tasks" FROM TASKS t, PROJECT p 
WHERE t.project_id = p.id 
GROUP by t.project_id 
ORDER by p.name;

/*4_get the tasks for all projects having the name beginning with "N" letter*/
SELECT * FROM TASKS t 
WHERE UPPER(t.name) LIKE 'N%';

/*5_get the list of all projects containing the 'a' letter in the middle of the name, and show the tasks
 count near each project. Mention that there can exist projects without tasks and tasks with  project_id = NULL*/
SELECT p.id, p.name, COUNT(t.id) "Amount tasks" FROM PROJECT p, TASKS t 
WHERE p.id = t.project_id 
AND p.name LIKE '_%a%_' 
GROUP by p.id;

/*6_get the list of tasks with duplicate names. Order alphabetically*/
SELECT id, name, status, project_id, count(*) "Amount duplicate names" FROM TASKS 
GROUP By name HAVING count(*) > 1 
ORDER by name ASC;

/*7_get the list of tasks having several exact matches of both name and status, from the project 'Garage'. Order by matches count*/
SELECT id, name, status, project_id, count(*) "Amount duplicate names" FROM TASKS
WHERE project_id = (SELECT id from PROJECT WHERE LOWER(name) = 'garage')
GROUP By name, status HAVING count(*) > 1
ORDER by count(*);

/*8_get the list of project names having more than 10 tasks in status 'completed'. Order by project_id*/
SELECT p.name FROM PROJECT p, TASKS t 
WHERE LOWER(t.status) = 'completed' and p.id = t.project_id
GROUP by t.status, t.project_id HAVING count(*) > 10
ORDER by t.project_id;
