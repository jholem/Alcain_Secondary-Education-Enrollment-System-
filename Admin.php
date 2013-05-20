<?php
      session_start();
      if(!isset($_SESSION['admin'])){
            header('Location: log_in_school_preview.php');
      }
      else{
            $admin= $_SESSION['admin'];
      }

?>

<!DOCTYPE html>
<html>
	<head>
	
	<link rel = "stylesheet" href = "css/jquery-ui-1.10.1.custom.min.css"/>
	
	<link rel="stylesheet" href="css/Admin.css">
	<link rel="stylesheet" href="css/bootstrap-responsive.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<meta charset= 'utf-8'>
	<title>SEES ADMIN</title>
	</head>
	<body>
	<p id="user">
         <?php
	 
	   
	    echo"<br/>Date and Time: &nbsp";
	        date_default_timezone_set('Asia/Manila');echo date('m-d-Y h:i a', time());
	    ?>
	  </p>



		<div id="cssmenu">
			<ul >
				<li id="home"><a href="#mission_vission">Home</a></li>
				<li id="add_student_link"><a href="#add_student" >List</a></li>
				<li id ='teacher_li'>
					<a href="#teacher_div" id ="teacher_link">Teacher</a>
				</li>
				<li><a><i class="icon-user icon-white"></i>User</a>
					<ul>
						<li id="register_li"><a href="#register">Register</a></li>
						<li><a href="#logout_modal" role="button" class="btn" data-toggle="modal">Log-out</a></li>
					</ul>
				</li>
				
			</ul>
			<div id="school_preview_link">
			    <img src="">
			</div><!--school_preview_link-->
		</div><!--cssmenu-->
		<div id="body_container" class='container'>
			
			<div id="mission_vission">
					<div id="vission_div">
					 		<p class="title">Vision</p>
							<br/>
							<p>&nbsp <b>Mayorga National High School</b> is committed to educate the youth of Mayorga for the new millennium,<br/>
						     	 to exercise dynamic, proactive and innovative leadership.
								It shall be a school wherein leaders are developed to become competent andresponsible members of the Filipino society;
								 equipped with maximum potentials so that they shall be valued and respected in the global community;
								responsive to the demands of a technologically advancing society; and who are above all, humane and morally upright.
								It shall continuously serve by its philosophy of <b>“Quality Education for All”</b>
								 and shall always be guided by its goal of “living up to a national culture of excellence”.</p>
				     </div><!--vission_div-->
				     <div id="mission_div">
				        <p class="title">Mission</p>
				        <br/>
				        <p>&nbsp <b>Mayorga Central School</b> is committed to provide knowledge and values 
							necessary for the attainment of higher academic performance.
							It will provide youth and adults with habits and skills needed for life-long learning and 
							deliver effective services for the common good.</p>
				  	</div><!--div#mission_div-->
			</div><!-- mission_vission-->	
			
			<!------------------------ student section---------------------------------------->
			
			<div id="add_student">
				<div id ="add_panel" class="alert alert-success" >
					<form id="students_form" method="POST" action ="student_add.php">
							<p id="student_status"></p>
							<fieldset>
								<legend>Student Profile</legend>
								<label for='firstname'>Name</label>
								<input type="text" name="firstname">
								<label for="middlename">Middlename</label>
								<input type="text" name="middlename" ><br/>	
								<label for="lastname">Lastname</label>
								<input type="text"  name="lastname" <br/>
								<label for="birthday">Birthday</label>
								<input type="text" name = "birthday" class= 'bday' ><br/>
								<label for="age">Age</label>
								<input type="text" name="age" ><br/>
								<label for="gender">Gender</label>
								<select name="gender" >
									<option value ="Female">Female</option>
									<option value ="Male">Male</option>
								</select><br/>
								<label for="address">Address</label>
								<input type="text" name="address" ><br/>
								<label for="religion">Religion</label>
								<input type="text" name="religion" ><br/>
								<label for="contact">Contact </label>
								<input type="text" name="contact"><br/>
								<label for="teacher">Teacher</label>
								<p id ="teacher_list">
								</p>
								<input type="hidden" name="id"/>
								</fieldset>
						</form><!--form_add_student-->
						<button  id="add_panel_btn" class="btn btn-success">ADD STUDENT</button>
				</div><!---add_panel--->
				<br/>
				<br/>
					
				<table id='view_students_table' class="table table-striped dataTable">
					<tr><th class='thead' colspan='6'>Student List 
					</th>
					
					</tr>
					
					<th>Firstname</th>
					<th>Middlename</th>
					<th>Lastname</th>
					
				</table><!--view_students_table-->
				<div class="pagination">
					<ul>
						<li><a href="#">Prev</a></li>
						<li><a href="#">1</a></li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#">4</a></li>
						<li><a href="#">5</a></li>
						<li><a href="#">Next</a></li>
					</ul>
				</div><!---pagination--->
				
			</div><!--add_student-->
			
			<div id="student_profile_modal" class="modal hide fade" tabindex="-1" data-focus-on="input:first" data-backdrop="static">
			  <div class="modal-header">
				 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				 <h3 id="myModalLabel">Student Profile</h3>
			</div>
			<div class="modal-body">
				    <ul class="nav nav-tabs" id='student_tabs'>
						 <li id='student_info_li' class='active'><a href="#student_info" data-toggle="tab">Student Info</a></li>
						 <li id='parent_info_li'><a href="#parent_info" data-toggle="tab">Guardian Info</a></li>
						 <li id='student_sched_li'><a href="#student_schedule" data-toggle="tab">Schedule</a></li>
						 <li id='student_progress_li'><a href="#student_progress" data-toggle="tab">Progress</a></li>
					 </ul>
					 <div class='tab-content'>
						 <div id='student_info' class="active tab-pane">
						 	
						 </div><!---STUDENT_INFO--->
						 <div id='parent_info' class="tab-pane">
						 	
						 	
						 </div><!---PARENT_INFO---->
						 <div id='student_schedule' class="tab-pane">
						 	
						 	<table class="table table-bordered table-hoover">
						 		<tr>
						 			<th>Subject</th>
						 			<th>Subject Teacher</th>
						 			<th>Day</th>
						 			<th>Time</th>
						 		</tr>
						 	</table>
							<button class="btn btn-primary" data-toggle="modal" href="#add_student_subject_modal">Add Subject</button>
						 	
						 </div><!---STUDENT SCHEDULE--->
						 <div id='student_progress' class="tab-pane">
						 	
						 </div><!---STUDENT_pROGRESS--->
						 <input type="hidden" name ="student_id_for_view"/>
					</div><!--tab-content-->
				<input type='hidden' name ='student_id2'>
			</div>
			  <div class="modal-footer">
			  		<button class="btn btn-warning" data-toggle="modal" href="#drop_student_modal">Drop</button>
				 	<button type="button" data-dismiss="modal" class="btn btn-info" >Close</button>
				</div>
			</div><!---student_profile_modal-->
			
			
				<div id="edit_student_modal" class="modal hide fade" tabindex="-1" data-focus-on="input:first" data-backdrop="static">
					  <div class="modal-header">
						 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						 <h3>Edit Here!!</h3>
					  </div>
					  <div class="modal-body">
							<form id ="edit_student_form" method = "POST" action = "student_save.php" class="">
								<fiedlset>
									<label for='edit_firstname'>Name</label>
									<input type="text" name="edit_firstname" title="Must be letter A-Z.">
									<label for="edit_middlename">Middlename</label>
									<input type="text" name="edit_middlename" title="Must be letter A-Z."><br/>	
									<label for="edit_lastname">Lastname</label>
									<input type="text"  name="edit_lastname" title="Must be letter A-Z."><br/>
									<label for="edit_birthday">Birthday</label>
									<input type="text"  class="datepicker"><br/>
									<label for="edit_age">Age</label>
									<input type="text" name="edit_age"  title="Must be number."><br/>
									<label for="edit_gender">Gender</label>
									<input type="text" name="edit_gender" title="Must be letter."><br/>
									<label for="edit_address">Address</label>
									<input type="text" name="edit_address" title="Can be letter and number."><br/>
									<label for="edit_religion">Religion</label>
									<input type="text" name="edit_religion" title="Must be letter A-Z."><br/>
									<label for="edit_contact">Contact </label>
									<input type="text" name="edit_contact" title="Must be number 0-9."><br/>
								
									<input type="hidden" name="edit_id" ><br/>
								</fieldset>
							</form><!--edit_student_form--->
					  </div>
					  <div class="modal-footer">
						 <button type="button" data-dismiss="modal" class="btn btn-primary">Cancel</button>
						 <button type="button" class="btn btn-primary" id="save_student_btn" onclick='student_save()'>Save</button>
					  </div>
				</div><!--edit student_modal--->
				
				<div id="guardian_modal" class="modal hide fade" tabindex="-1" data-focus-on="input:first" data-backdrop="static">
				  <div class="modal-header">
					 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					 <h3>Add Guardian Information</h3>
				  </div>
				  <div class="modal-body">
						<form id="add_guardian_form" metho="POST" action = "guardian_add.php">
								<fieldset>
									<p><span>Guardian</span></p>
									<div id="input">
										<label for="guardian">Name</label>
										<input type="text" name="guardian" title="Must be letter A-Z."><br/>
										<label for="guardian_bday">Birthday</label>
										<input type="text" name = "guardian_bday" ><br/>
										<label for="guardian_age">Age</label>
										<input type="text" name="guardian_age" title="Must be number"><br/>
						
										<label for="guardian_work">Occupation</label>
										<input type="text" name="guardian_work" title="Must be letter A-Z."><br/>
										<label for="guardian_contact">Contact</label>
										<input type="text" name="guardian_contact" title="Must be number."><br/>
										<label for="guardian_address">Address</label>
										<input type="text" name="guardian_address" title="Must be letter A-Z."><br/>
										<label for="guardian_religion">Religion</label>
										<input type="text" name="guardian_religion" title="Must be letter A-Z."><br/>
										<label for="guardian_rship">Relationship to the Student</label>
										<input type="text" name="guardian_rship" title="Must be letter A-Z."><br/>
										<input type="hidden" name="guardian_id"><br/>
									</div>
							</fieldset>
						</form><!--guardian_form-->
				  </div>
				  <div class="modal-footer">
					 <button type="button" data-dismiss="modal" class="btn">Cancel</button>
					 <button type="button" class="btn btn-primary" id="add_guardian_btn" onclick='guardian_add()'>Add</button>
				  </div>
			</div><!--guardian_modal--->
			
			<div id="edit_guardian_modal" class="modal hide fade" tabindex="-1" data-focus-on="input:first" data-backdrop="static">
					  <div class="modal-header">
						 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						 <h3>Edit Guardian</h3>
					  </div>
					  <div class="modal-body">
				
						<form id="edit_guardian" metho="POST" action = "guardian_save.php" >
								<fieldset>
									<p><span>Guardian</span></p>
										<div id="input">
											<label for="edit_guardian">Name</label>
											<input type="text" name="edit_guardian" title="Must be letter A-Z."><br/>
											<label for="edit_guardian_bday">Birthday</label>
											<input type="text"  class = 'bday' name="edit_guardian_bday"><br/>
											<label for="edit_guardian_age">Age</label>
											<input type="text" name="edit_guardian_age" title="Must be number"><br/>
							
											<label for="edit_guardian_work">Occupation</label>
											<input type="text" name="edit_guardian_work" title="Must be letter A-Z."><br/>
											<label for="edit_guardian_contact">Contact</label>
											<input type="text" name="edit_guardian_contact" title="Must be number."><br/>
											<label for="edit_guardian_address">Address</label>
											<input type="text" name="edit_guardian_address" title="Must be letter A-Z."><br/>
											<label for="edit_guardian_religion">Religion</label>
											<input type="text" name="edit_guardian_religion" title="Must be letter A-Z."><br/>
											<label for="edit_guardian_rship">Relationship to the Student</label>
											<input type="text" name="edit_guardian_rship" title="Must be letter A-Z."><br/>
											<input type="hidden" name="edit_guardian_id"><br/>
											<input type="hidden" name="edit_student_id" ><br/>
										</div>
							</fieldset>
						</form><!--edit_guardian_form-->
			
					  </div>
					  <div class="modal-footer">
						 <button type="button" data-dismiss="modal" class="btn btn-primary">Cancel</button>
						 <button type="button" class="btn " id="edit_guardian_btn" onclick='guardian_save()'>Save</button>
					  </div>
					</div><!--edit_guardian_modal--->
					
					<!------------------------------------teacher side----------------------------------------------------------------->
					<div id="teacher_div">
						<div id ="add_panel2" class="alert alert-success" >
							<form id="add_teacher_form" method="POST">
									<p id="student_status"></p>
									<fieldset>
										<legend>Teacher Information</legend>
										<label for='teacher_name'>Name</label>
										<input type="text" name="teacher_name">
										<label for="teacher_bday">Birthday</label>
										<input type="text" name = "teacher_bday" class= 'bday' ><br/>
										<label for="teacher_age">Age</label>
										<input type="text" name="teacher_age" ><br/>
										<label for="teacher_address">Address</label>
										<input type="text" name="teacher_address" ><br/>
										<label for="teacher_gender">Gender</label>
										<select name="teacher_gender" >
											<option value ="Female">Female</option>
											<option value ="Male">Male</option>
										</select><br/>
										<label for="teacher_room">Room </label>
										<p id="for_teacher_room"></p><br/>
										<label for="teacher_position">Position</label>
										<p id ="for_teacher_position">
										</p>
										<input type="hidden" name="id"/>
										</fieldset>
								</form><!--form_add_student-->
								<button  id="add_teacher_btn" class="btn btn-success">ADD TEACHER</button>
						</div><!---add_panel2--->
					
							<table id="teachers_table" class="table table-bordered">
								<tr>
									<th colspan='7' id='tr' class="alert alert-success">Teacher's Table</th>
								</tr>
								<th>Name</th>
								<th>Position</th>
								<th>Room</th>
							
							</table>
							<div id= "teacher_pagination" class="pagination">
									<ul>
									<li><a href="#">Prev</a></li>
									<li><a href="#">1</a></li>
									<li><a href="#">2</a></li>
									<li><a href="#">3</a></li>
									<li><a href="#">4</a></li>
									<li><a href="#">5</a></li>
									<li><a href="#">Next</a></li>
									</ul>
							</div><!---pagination--->
						
							<div id="teacher_info_modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								<h3 id="myModalLabel">Teacher's Info</h3>
							</div>
							<div class="modal-body">
								<ul class="nav nav-tabs" id='teacher_tabs'>
								 
								 <li ><a href="#teacher_basic_info" data-toggle="tab">Basic Information</a></li>
								 <li id="teacher_sched_li" ><a href="#teacher_sched" data-toggle="tab">Class Schedule</a></li>
							 </ul>
							 <div class='tab-content'>
							 	<div id="teacher_basic_info" class="active tab-pane">
							 		
							 	</div><!--teacher_basic_info-->
							 	<div id="teacher_sched" class="tab-pane">
							 		
							 		<table class="table table-hoover" id ="teacher_sched_table">
							 			<tr>
							 				<th>Room</th>
							 				<th>Subject</th>
							 				<th>Day</th>
							 				<th>Time</th>
							 			</tr>
							 		</table>
							 		<button class="btn btn-primary" data-toggle="modal" href="#add_teacher_sched_modal">Add Schedule</button>
							 		
							 	</div><!---teacher_sched--->
							 	<input type ="hidden" name ="teacher_id" />
							 </div><!-----tab-content------>
							</div>
							<div class="modal-footer">
								<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
							
							</div>
						</div><!---teacher-info -modal-->
					
						<div id="edit_teacher_modal" class="modal hide fade" tabindex="-1" data-focus-on="input:first" data-backdrop="static">
						  <div class="modal-header">
							 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							 <h3>Edit Teacher </h3>
						  </div>
						  <div class="modal-body">
				
							<form id="edit_teacher" metho="POST" action = "teacher_save.php" >
									<fieldset>
										<p><span>Teacher</span></p>
											<div id="input">
												<label for="edit_teacher">Name</label>
												<input type="text" name="edit_teacher" title="Must be letter A-Z."><br/>
												<label for="edit_teacher_bday">Birthday</label>
												<input type="text"  class = 'bday' name="edit_teacher_bday"><br/>
												<label for="edit_teacher_age">Age</label>
												<input type="text" name="edit_teacher_age" title="Must be number"><br/>
												<label for="edit_teacher_address">Address</label>
												<input type="text" name="edit_teacher_address" title="Can be letter or number."><br/>
												<label for="edit_teacher_gender">Gender</label>
												<select name="edit_teacher_gender" >
													<option value = "Female">Female</option>
													<option value = "Male">Male</option>
												</select><br/>
												<label for="room">Room</label>
												<p id ="for_teacher_room2"></p>
												<label for= "position">Position</label>
												<p id="for_teacher_position2"></p>
											
												<input type="hidden" name="edit_teacher_id" ><br/>
											</div>
								</fieldset>
							</form><!--edit_teacher_form-->
			
						  </div>
						  <div class="modal-footer">
						  	 <button type="button" class="btn btn-primary" id="save_teacher_btn" onclick='teacher_save()'>Save</button>
							 <button type="button" data-dismiss="modal" class="btn ">Cancel</button>
							</div>
						</div><!--edit_teacher_modal--->	
					
						<div id="add_teacher_sched_modal" class="modal hide fade" tabindex="-1" data-focus-on="input:first" data-backdrop="static">

						  <div class="modal-body">
								<form id = "add_teacher_sched_form" action ="teacher_add_sched.php" method="POST">
									<p>
										<label for ="room_to_teach">Room:</label>
									
										<p id ="room_to_teach">
										</p>
									</p>
									<p>
										<label for ="subject_to_teach">Subject</label>
									
										<p id ="subject_to_teach">
										</p>
									</p>
									<p>
										<label for="day_to_teach">Day</label>
										<input type = "text" name ="day_to_teach"/>
									</p>
									<p>
										<label for ="time_to_teach">Time</label>
										<input type = "text" name = "time_to_teach"/>
									</p>
								</form>							
					
						  </div>
						  <div class="modal-footer">
							 <button type="button"  class="btn btn-primary" id ="add_teacher_sched_btn">Add</button>
							 <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
						  </div>
						</div><!--add_teacher_sched_modal--->
						
			</div><!---teacher_div---------->
	</div><!--body_container-->
		
		 <div id="logout_modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
				  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h3 id="myModalLabel">Leave the app??</h3>
				  </div><!---modal-header--->
				  <div class="modal-footer">
						<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
						<button class="btn btn-warning" ><a href="log_out.php">Leave</a></button>
				  </div><!---modal-footer-->
		</div><!--myModal--->
				
		<div id ="delete_dialog">
			<p>
			<img src="images/trash-icon.png">	Delete?
			</p>
		</div>
		
		
		
		<script>	
		//this following js code is for the reload..?
		//yung function nya po sir, is after magreload ... babalik  siya sa last na visited page 
	
			window.onload=function(){
				url=window.location.href;
				if(url.indexOf('#')>=0){
						url1=url.split('#');
						url1=url1[1];
						locations= Array();
						locations=['mission_vission','add_student','student_parent','teacher_div', 'register'];
						for(var x in locations){
								if(url1==locations[x]){
									$('#'+url1).show();
								}else{
									$('#'+locations[x]).hide();
								}

						}
				}else{
					window.location.href="http://localhost/SEES/home_index.php#mission_vission";

				}

			}
		</script>
		
		
		
		
		
		<script src="js/jquery-1.8.2.min.js"></script>
		<script src="js/jquery-1.9.1.min.js"></script>
		<script src = "js/jquery-ui-1.10.1.custom.min.js"></script>
		<script src = "js/bootstrap.min.js"></script>
		<script src="js/log_in_preview.js"></script>
		<script src="js/Teacher(Admin).js"></script>
		<script src="js/Menu(Admin).js"></script>
		<script src="js/Subject.js"></script>
		<script src="js/Admin.js"></script>
	</body>
</html>
