/* 
 *Добавление заданий
 */
function insertTask(id)
{
    var task1 = 'input[name=name_task'+id+']';
    var task = $(task1).val();
    if(task !== '') 
    {
    $('#project').load('enter/insert',{'name':task,'project_id':id,'type':'task'});
    $('.text-add-task').val('');
    ToggleAndRemove();
    }
};

/*Выполняет указаные внутри действия при полной загрузке страници*/
$(document).ready(function()
{
// Устанавливает параметры чекбоксов со статусом заданий равных 'done'
$('input[value=done]').each(function(){
   $(this).attr('disabled','disabled'); 
   $(this).attr('checked','checked');
   $(this).css('background', 'grey');
});

/*Вызывает colorBox при нажатии ЛКМ на кнопку имеющую клас ajax*/
$('.ajax').colorbox();

//Сделать обьекты опции невидимыми
$('div[class^=option], .task-option').toggle();
});

/*
 * Добавление проэктов
 */
//Введение имени проэкта
$('.button-add-project').click(function(){
    var name_project = $('.text-add-project').val();
    if(name_project !== '')
    {
        $('#project').load('enter/insert',{'project_name':name_project, 'type':'project'});  
        ToggleAndRemove();
    }
    $('.text-add-project').val('');
    ToggleAndRemove();
});

/*Убирает окно при нажатии на кнопку закрытия окно*/
$('#cboxClose').click(function(){
       ToggleAndRemove();
});
/*Убирает окно при нажатии на место вне формы*/
$('.main-block+#cboxOverlay').click(function(){
       ToggleAndRemove();
});


/*
 * Удаление задания
 */
function DeleteTask(id_task, id_project){
    $.post('enter/delete',{'id_task':id_task, 'id_project':id_project, 'type':'task'});
    $('.tasks'+id_task).remove();
}

/*
 * Удаление проэкта
 */
function DeleteProject(id) {
    $.post('enter/delete',{'id':id, 'type':'project'});
    $('.all-project'+id).remove();
}

/*
 * Изменение имени проэкта
 */
$('.button-update-project').click(function(){
    
    
    
    $('.text-update-project').val('');
    ToggleAndRemove();
});

/*
 * Показывать искрывать дополнительные эфекты блоков заданий и проэктов;
 */

function ShowProjectOption(id){
    ProjectToggle(id);
    $('div[name=pr'+id+']').css('background','#3b60a0');
    $('div[name=pr'+id+']').css('border-top', '2px solid #8faed5');
}
function HideProjectOption(id){
    ProjectToggle(id);
    $('div[name=pr'+id+']').css('background','#4979b7');
    $('div[name=pr'+id+']').css('border-top', '2px solid #8bb2d3');
}
function ProjectToggle(id){
    option = ".option"+id;
    $(option).toggle();
}
function ShowTaskOptions(id) 
{
    TaskToggle(id)
    $('.tasks'+id).css('background','#fcfed5');
}

function HideTaskOptions(id) {
    TaskToggle(id)
    $('.tasks'+id).css('background','white');
}
function TaskToggle(id){
    option = ".task"+id;
    $(option).toggle();
}

/*
 * Отметка задачи как сделанная
 */
function Down(id)
{
    $.post('load/update-on-done', {'id':id});
    $('div[class^=tasks] div.part-task div.marks input').attr('disabled','disabled');
    $('.main-block+#cboxOverlay, .main-block+#cboxOverlay+#colorbox').remove();
    $('div[class^=tasks'+id+'] div.part-task div.task-option').toggle();
}


/*
 * Функция для срытия функциональности новых проэктов и заданий
 * и при помощи метода .remove() возврат в предыдущее состояние
 */
function ToggleAndRemove(){
    $('.main-block+#cboxOverlay, .main-block+#cboxOverlay+#colorbox').remove();
    $('div[class^=option], .task-option').toggle();
}