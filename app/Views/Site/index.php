<div class='main-block'>
    <div>
            <div class="title-doc">
            <h2>SIMPLE TODO LISTS</h2>
            <p>FROM RUBY GARAGE</p>
            </div>
        <div id="project">
    <?php
    if($projects) {
    foreach ($projects as $project) {
    ?>
            <div class="all-project<?=$project['id']?>"><!--Блок проэкта-->
                <div class="project-name" name="pr<?=$project['id']?>" onmouseout="HideProjectOption(<?=$project['id']?>);" onmouseover="ShowProjectOption(<?=$project['id']?>);">  <!--Блок имени проэкта-->
                    <div>
                    <img class='image' src='/web/image/note.gif' alt='Блокнот'/>
                    </div>
                    <div class="project-title">
                    <?=$project['name']?>
                    </div>
                    <div class = "option<?=$project['id']?>">
                        <a href="update/project" class="ajax"><img class="pan"  src="/web/image/pan.png" alt="pan"/></a>
                        <a href="#"  onclick="DeleteProject(<?=$project['id']?>);"><img class="trash" src="/web/image/trash.png" alt="trash"/></a>
                    </div>
                </div>
                <div class="add-task"> <!--Блок добавления задания-->
                    <div>
                        <img class='image-plus' src='/web/image/cross.png' alt='Plus'/>
                    </div>
                    <div class="div-with-form" >
                        <form>
                            <input class="project_id" type="hidden" name="project_id" value="<?=$project['id']?>"/> 
                            <input class="text-add-task" name="name_task<?=$project['id']?>" type="text" required placeholder="Start typing here for create a task..." />
                            <input class="button-add-task" name="sub<?=$project['id']?>" onclick="insertTask('<?=$project['id']?>');" type="button" value="Add Task" />
                        </form>
                    </div>
                </div>
               
                <?php 
                if($tasks) {
                    foreach ($tasks as $task) {
                        if($task['project_id'] == $project['id']) {
                ?>
                <div class="tasks<?=$task['id']?>" onmouseover="ShowTaskOptions(<?=$task['id']?>);" onmouseout="HideTaskOptions(<?=$task['id']?>);"> <!--Блок списка заданий-->
                    <div class="part-task"> <!--Блок задания-->
                        <div class="marks"> <!--Блок метки-->
                            <input  type="checkbox" onclick ="Down(<?=$task['id']?>);" name="mark" value="<?=$task['status']?>"/>
                        </div>
                        <div class="task-name"> <!--Блок имени-->
                            <?=$task['name']?>
                        </div>
                       
                        <div class="task-option task<?=$task['id']?>"> <!--Панель управления-->
                            <a href="#"><img src="/web/image/opt.png" alt="option"/></a>
                            <a href="#"><img src="/web/image/pan.png" alt="pan"/></a>
                            <a href="#"><img src ="/web/image/trash.png" alt="trash" onclick="DeleteTask(<?=$task['id']?>,<?=$task['project_id']?>)"/></a>

                        </div>
                    </div>
                </div>
            
                        <?php }}}?>
            </div>
        <?php
    }}
        ?>
            
    </div> 
    </div>
        
    <div class="form-add-todo-list"><a class="ajax" href="enter/form"><img src="/web/image/button.png" alt="button"/> </a></div>
    
    <div class="copy">&copy; Ruby Garage</div>
   

</div>