<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Tasks</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS only -->

    <link rel="stylesheet" type="text/css" href="../css/style.css">
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.5.1/css/all.css">
    <!-- fancyBox3 CSS -->
    
   
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
                    <a class="nav-link active" aria-current="page" href="#">Active</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
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
            <div class="w-75 p-4 shadow-sm rounded-4 bg-white">
                <h3>Новая задача</h3>
            
            <form class="mb-3 mt-md-4" action="/task/save" method="POST">

                <div class="mb-3">
                  <label for="title" class="form-label">Title</label>
                  <input type="text" name="title" class="form-control" id="title" placeholder="Title">
                </div>
                <div class="mb-3">
                  <label for="description" class="form-label">Description</label>
                  <input type="text" name="description" class="form-control" id="description" placeholder="Description">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
            </div>
        </div>

        <div class="container d-flex justify-content-center align-items-top">
            <table class="table caption-top">
              <caption>Список задач</caption>
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Title</th>
                  <th scope="col">Description</th>
                  <th scope="col">Status</th>
                  <th scope="col">Created_at</th>
                  <th scope="col">Updated_at</th>
                </tr>
              </thead>
              <tbody>
                
<?php
                foreach ($tasks as $task)
                {
                    echo '<tr>
                  <th scope="row">' . $task->id . '</th>
                  <td>' . $task->title . '</td>
                  <td>' . $task->description . '</td>
                  <td>' . $task->status . '</td>
                  <td>' . $task->created_at . '</td>
                  <td>' . $task->updated_at . '</td>
                </tr>';
                }
                
?>                
              </tbody>
            </table>
        </div>


    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>