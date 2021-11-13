<?php
    session_start();

    if (!isset($_SESSION['username']) && $_SESSION['username'] == NULL) {
        header('Location: ../login/');
    } else {
        if (isset($_SESSION['isTeacher']) && $_SESSION['isTeacher'] == true){
            header('Location: ../login/');
        }
    }
    include 'getStudentInfo.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <title>Student Modules</title>

  <link rel="stylesheet" href="css/maicons.css">

  <link rel="stylesheet" href="css/bootstrap.css">

  <link rel="stylesheet" href="vendor/animate/animate.css">

  <link rel="stylesheet" href="css/theme.css">

</head>
<body>

  <!-- Back to top button -->
  <div class="back-to-top"></div>

  <header>
    <?php include_once "components/header.php"?>
    <div class="container">
      <div class="home-banner student-banner">
        <div class="row align-items-center">
          <div class="col-md-6 wow fadeInLeft">
            <div class="img-fluid text-center">
              <img src="images/student.png" alt="">
            </div>
            
          </div>
          <div class="col-md-6 wow zoomIn">
            <h4 class="mb-4"><?php echo getStudent($_SESSION['username'])->name; ?></h4>
            <p class="text-lg text-primary mb-5"><?php echo getStudent($_SESSION['username'])->studentID; ?></p>
          </div>
        </div>
      </div>
    </div>
  </header>

  <div class="page-section">
    <div class="container">
      <?php
        include '../connect.php';

        $post = $db->quiz;

        $result = $post->find();

        if (empty($result)) {
          echo "There is currently no quiz";
        } else {
          foreach ($result as $row){
            echo '<div class="row">
            <div class="col-10">
              <div class="card-service wow fadeInUp">
                <div class="body">
                  <h5 class="text-secondary">'.$row->name.'</h5>
                  <p>Course: '.getCourse($row->courseID)->name.' ('.$row->courseID.')</p>
                  <p>Created by: '.getTeacher($row->teacherID)->name.'</p>
                </div>
              </div>
            </div>
    
            <div class="col-2">
              <a href="./game.php?id='.$row->quizID.'">
              <div class="card-color wow fadeInUp">
                <div class="body">
                  <span class="mai-arrow-forward"></span>
                </div>
              </div>
              </a>
            </div>
          </div>';
          }
        }

      ?>

      <div class="col-12 mt-4 text-center wow fadeInUp">
        <a href="selection.php" class="btn btn-secondary">Find another quizzes!</a>
      </div>

    </div> <!-- .container -->
  </div> <!-- .page-section -->

  <?php include_once "components/footer.php"?>


<script src="js/jquery-3.5.1.min.js"></script>

<script src="js/bootstrap.bundle.min.js"></script>

<script src="js/google-maps.js"></script>

<script src="vendor/wow/wow.min.js"></script>

<script src="js/theme.js"></script>
  
</body>
</html>