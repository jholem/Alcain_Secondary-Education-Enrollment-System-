<?php

	session_start();
	
	include 'dao/TeacherDAO.php';
    
	 $teacher_id = $_POST['teacher_id']
    $room= $_POST['room'];
    $subject= $_POST['subject'];
    $day_to_teach= $_POST['day_to_teach'];
    $time_to_teach= $_POST['time_to_teach'];

  
  
    
      
    $action = new StudentDAO();
    $action -> add_student($teacher_id, $room, $subject, $day_to_teach, $time_to_teach);

        
