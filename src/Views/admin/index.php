<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Tasks</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- CSS only -->

   <!-- <link rel="stylesheet" type="text/css" href="../css/style.css">
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.5.1/css/all.css">
     fancyBox3 CSS -->
    
   
</head>

<body class="bg-light">

<?php
// dd($tasks);
//var_dump(ROOT);die;

// include __DIR__ . '/../layouts/header.php';

?>

        <div>
            <ul class="nav justify-content-end">

                <li class="nav-item">
                    <a class="nav-link" href="#"><?=$email ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/user/<?php
                    if($email)
                        echo 'logout';
                    else
                        echo 'login';
?>">
                    <?php
                    if($email)
                        echo 'Выйти';
                    else
                        echo 'Войти';
?>
                    </a>
                </li>   
            </ul>
        </div>

<div class="container d-flex justify-content-center align-items-top">
                    <table class="table caption-top">
                      <caption><h4>Список задач</h4></caption>
                      <thead class="table-dark">
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">User</th>
                          <th scope="col">Title</th>
                          <th scope="col">Description</th>
                          <th scope="col">Status</th>
                          <th scope="col">Created_at</th>
                          <th scope="col">Updated_at</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                
<?php
                    foreach ($tasks as $task)
                    {
                        echo '<tr class="taskId" data-taskId="' . $task->id .'">
                      <th scope="row">' . $task->id . '</th>
                      <td>' . $task->user . '</td>
                      <td>' . $task->title . '</td>
                      <td>' . $task->description . '</td>
                      <td id="task-status">' . $task->status . '</td>
                      <td>' . $task->created_at . '</tad>
                      <td class="task-updated">' . $task->updated_at . '</td>
                      <td>

                <button id="editTask" type="button" class="btn btn-primary btn-sm editTask" data-toggle="modal" data-bs-target="#editTaskModal" data-id="'. $task->id . '">Edit</button>
                      </td>
                    </tr>';
                    }                
?> 
                      </tbody>
                    </table>
                </div>

                <!-- Client Edit Modal content-->
                <div id="editTaskModal" class="modal fade bs-editTask" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                     <h4 class="modal-title" id="ModalLabel"><b>Редактирование записи</b></h4>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="hide" id="response"></div>
                            <form method="POST" action="/task/update/" 
                            id="editTaskForm" name="editTaskForm">                    
                            <input type="hidden" name="task_id" id="task_id" value="">
                              <div class="form-group">
                                <label for="labelEmail">Клиент</label>
                                <input type="text" class="form-control" name="email" id="email" placeholder="Email" required>
                              </div>
                              <div class="form-group">
                                <label for="labelPhone">Title</label>
                                <input type="text" class="form-control" name="title" id="title" placeholder="Title" required>
                              </div>
                              <div class="form-group">
                                <label for="labelText">Description</label>
                                <input type="text" class="form-control" name="description" id="description" placeholder="Description" required>
                              </div>
                                <div class="form-group">
                                <label for="labelText">Status</label>
                                <select id="select-status" name="status" class="form-control">  
                                  <option value="ToDo">ToDo</option>
                                  <option value="InProgress">InProgress</option>
                                  <option value="Ready For Review">Ready For Review</option>
                                  <option value="Done">Done</option>
                                </select>
                              </div>
                                <div class="modal-footer">
                                <button id="saveBtn" type="submit" class="btn btn-success">Сохранить</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              </div>
                            </form>
                        </div>

                    </div>
                    </div>
                </div>
              </div>
            </div>

<script
  src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js">

  </script>

  <script>    
    // Когда нажимаешь редактировать запись
    $('.editTask').on('click', function () {
        const id = $(this).attr('data-id');
        const select = document.querySelector('#select-status').getElementsByTagName('option');        
        $.ajax({
            url: "/task/edit/" + id,
            method: "get",
            dataType: "json",
            async: true,
            data: {"id": id},
            success:function(response) {
                if(!response)
                {
                    alert('Ошибка!');
                }
                $('#editTaskModal').modal('show');
                $('#editTaskForm #task_id').val(response.id);              
                $('#editTaskForm #email').val(response.user);
                $('#editTaskForm #title').val(response.title);
                $('#editTaskForm #description').val(response.description);
                for (let i = 0; i < select.length; i++) {
                    if (select[i].value === response.status)
                    {
                        select[i].selected = true;
                    }
                }
            }
        });        
    });   

    // Сохранение записи
    $('#saveBtn').click(function(event) {
        event.preventDefault();
        const task_id = $('#task_id').val();
        const status = $('#select-status').val();
            $.ajax({
                url: "/task/update",
                type: "post",
                dataType: "json",
                data: {"task_id": task_id, "status": status},
                async: true,
                success: function(response) {
                    if(!response)
                    {
                        alert('Ошибка!');
                    }

                    $('#editTaskModal').hide();
                    location.reload();
                }
            });
    });


</script>

</body>

</html>