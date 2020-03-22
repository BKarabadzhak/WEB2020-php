<?php
    define("MAX_LENGTH_SUBJECT", 150);
    define("MAX_LENGTH_LECTURER", 200);
    define("MIN_LENGTH_DESCRIPTION", 10);
    define("MAX_NUMBER_CREDITS", 10);
    define("MIN_NUMBER_CREDITS", 0);
    define("NUMBER_VALID_INPUTS", 5);

  function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
  }

   $valid = array();
   $errors = array();

   if ($_POST) {
     $course = $_POST['course'];
     if (!$course) {
       $errors['course'] = 'Името на предмета е задължително поле.';
     } elseif (strlen($course) > MAX_LENGTH_SUBJECT) {
       $errors['course'] = 'Името на предмета трябва да е по-малко от '.MAX_LENGTH_SUBJECT.' символа.';
     } else {
       $valid['course'] = $course;
     }

     $lecturer = $_POST['lecturer'];
     if (!$lecturer) {
       $errors['lecturer'] = 'Името на лектора е задължително поле.';
     } elseif (strlen($lecturer) > MAX_LENGTH_LECTURER) {
       $errors['lecturer'] = 'Името на лектора трябва да е по-малко от '.MAX_LENGTH_LECTURER.' символа.';
     } else {
       $valid['lecturer'] = $lecturer;
     }

     $description = $_POST['description'];
     if (!$description) {
       $errors['description'] = 'Описанието на предмета е задължително поле.';
     } elseif (strlen($description) < MIN_LENGTH_DESCRIPTION) {
       $errors['description'] = 'Описанието на предмета трябва да е по-голямо от '.MIN_LENGTH_DESCRIPTION.' символа.';
     } else {
       $valid['description'] = $description;
     }

     $group = $_POST['group'];
     if (!$group) {
       $errors['group'] = 'Трябва да изберете поне една група.';
     } else {
       $valid['group'] = $group;
     }

     $credits = $_POST['credits'];
     if (!$credits) {
       $errors['credits'] = 'Кредит е задължително поле.';
     } elseif (strlen($credits) < MIN_NUMBER_CREDITS) {
       $errors['credits'] = 'Кредита трябва да е положително число.';
     } elseif (strlen($credits) > MAX_NUMBER_CREDITS) {
       $errors['credits'] = 'Кредита може да бъде най-много '.MAX_NUMBER_CREDITS.'.';
     } else {
       $valid['credits'] = $credits;
     }

     $filename = 'logs.txt';
     if (count($valid) == NUMBER_VALID_INPUTS) {
      phpAlert("Successful creation!");
      file_put_contents($filename, "Име на предмет: ", FILE_APPEND | LOCK_EX);
      file_put_contents($filename, $course, FILE_APPEND | LOCK_EX);
      file_put_contents($filename, "\n", FILE_APPEND | LOCK_EX);
      file_put_contents($filename, "Име на преподавател: ", FILE_APPEND | LOCK_EX);
      file_put_contents($filename, $lecturer, FILE_APPEND | LOCK_EX);
      file_put_contents($filename, "\n", FILE_APPEND | LOCK_EX);
      file_put_contents($filename, "Описание на предмет: ", FILE_APPEND | LOCK_EX);
      file_put_contents($filename, $description, FILE_APPEND | LOCK_EX);
      file_put_contents($filename, "\n", FILE_APPEND | LOCK_EX);
      file_put_contents($filename, "Група: ", FILE_APPEND | LOCK_EX);
      file_put_contents($filename, $group, FILE_APPEND | LOCK_EX);
      file_put_contents($filename, "\n", FILE_APPEND | LOCK_EX);
      file_put_contents($filename, "Кредити: ", FILE_APPEND | LOCK_EX);
      file_put_contents($filename, $credits, FILE_APPEND | LOCK_EX);
      file_put_contents($filename, "\n", FILE_APPEND | LOCK_EX);
      file_put_contents($filename, "===================================================", FILE_APPEND | LOCK_EX);
      file_put_contents($filename, "\n", FILE_APPEND | LOCK_EX);
     } else {
      phpAlert("You have error! Look at the file logs.txt and submit again.");
      file_put_contents($filename, "Грешките: ", FILE_APPEND | LOCK_EX);
      file_put_contents($filename, "\n", FILE_APPEND | LOCK_EX);
	    foreach($errors as $err)
	    {
        file_put_contents($filename, $err, FILE_APPEND | LOCK_EX);
        file_put_contents($filename, "\n", FILE_APPEND | LOCK_EX);
      }
      file_put_contents($filename, "===================================================", FILE_APPEND | LOCK_EX);
      file_put_contents($filename, "\n", FILE_APPEND | LOCK_EX);
    }

   }
?>