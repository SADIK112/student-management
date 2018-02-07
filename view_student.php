<?php

session_start();
    $message= '';
    require_once "./Student.php";

    $student = new Student();


    if(isset($_GET['delete'])){
        
        $id = $_GET['delete'];
        $message = $student -> delete_student_info($id);
    }

    
    if(isset($_SESSION['message'])){
        
        $message = $_SESSION['message'];
        unset($_SESSION['message']);
    }

    $query_result = $student -> select_all_student_info();
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Student</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        
        .well{
            width: 100%;
            height: auto;
            margin: 0 auto;
        }
        .delete{
            background: #e33434;
            transition: all .3s ease-in-out;
        }
        .delete:hover{
            background: #801b1b;
        }
    </style>
  
  </head>
  <body>
    
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Brand</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li><a href="StudentBootstrap.php">Add Student</span></a></li>
            <li><a href="view_student.php">View Student</a></li>
          </ul>
          <form class="navbar-form navbar-right">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
          </form>
        </div>
      </div>
</nav>
  
<div class="container">
    <div class="row">
        <div class="col-md-12 col-ms-12">
            <h1><?php echo $message; ?></h1>
        </div>
    </div>
</div>
   
<div class="container">
    <div class="row">
        <div class="col-md-12 col-ms-12">
            <div class="well">      
                <table class="table table-borderd table-hover">
                    <thead>
                      <tr>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Phone Number</th>
                        <th>Email Address</th>
                        <th>Address</th>
                          <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                       <?php $i = 1; while($student_info = mysqli_fetch_assoc($query_result)) {?>
                        <tr>
                            <td><?php echo $i++ ?></td>
                            <td><?php echo $student_info['student_name']; ?></td>
                            <td><?php echo $student_info['phone_number']; ?></td>
                            <td><?php echo $student_info['email_address']; ?></td>
                            <td><?php echo $student_info['address']; ?></td>
                        
                            <td>
                                <a href="edit_student.php?id=<?php echo $student_info['student_id']; ?>" class="btn btn-info btn-lg">
                                    <span class="glyphicon glyphicon-edit"></span>
                                </a>
                                <a href="?delete=<?php echo $student_info['student_id']; ?>" class="btn btn-info btn-lg delete" title="Delete" onclick="return confirm('Are you sure to delete this?'); ">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                            </td>
                        </tr>
                       
                       <?php } ?>
                    </tbody>
                </table>
                
                </div>
                
            </div>
        </div>
    </div>
</div>


    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>