<?php

//echo '\'';
	include 'BaseDAO.php';
	class SubjectDAO extends BaseDAO{
	

			function get_subject(){
					$this->openConn();
						$stmt = $this->dbh->prepare("SELECT * FROM Subject");
						$stmt->execute();
						
						echo "<select name='subject'>";
						while($row= $stmt->fetch()){
							echo "<option value = ".$row[1].">".$row[1]."</option>";
						}
						echo "</select>";
					$this->closeConn();
			}
			
			function get_room_to_teach(){
				$this->openConn();
						$stmt = $this->dbh->prepare("SELECT * FROM Room_Table");
						$stmt->execute();
						
						echo "<select>";
							while ($row = $stmt->fetch()){
								echo "<option value = ".$row[1].">".$row[1]."</option>";
							}
						echo "<select>";
				$this->closeConn();
			}
	 
		   /* function subject_add($subject_teacher,$subject, $day,$time, $section){
		     	$this->openConn();
		     	        
		     	        //setting the first letter of the word to uppercase and the kasunod na letter to lower case
						//if meada space the next letter will be uppercase :) gehap.... and then lower gihap again..
						
						$subject = ucwords(strtolower($subject));
						$day = ucwords(strtolower($day));
						$section = ucwords(strtolower($section));
							
							$stmt = $this->dbh->prepare("INSERT INTO Subject (teacher_id, Subject_Name, Day, Time, Section) VALUES (?,?,?,?,?)");
							$stmt->bindParam(1, $subject_teacher);
							$stmt->bindParam(2, $subject);
							$stmt->bindParam(3, $day);
							$stmt->bindParam(4, $time);
							$stmt->bindParam(5, $section);
							$stmt->execute();
							$subject_id = $this->dbh->lastInsertId();
							echo "<tr id=".$subject_id.">";
							echo "".$subject_teacher."";
							echo "".$subject."";
							echo "".$day."";
							echo "".$time."";
							echo "".$section."";
							echo"</tr>";
						
						
						$this->closeConn();

		    }
		     function subject_view(){

			        $this->openConn();
			        $stmt = $this->dbh->prepare("SELECT  s.subject_id , tt.Teacher_Name, s.Subject_Name, s.Day, s.Time, s.Section
			        	FROM Subject AS s, Teachers_Table AS tt
			        	WHERE tt.teacher_id = s.teacher_id
			        	Order By s.Section");
					$stmt->execute();
			        
			        while($row = $stmt->fetch()){
				        echo "<tr id=".$row[0].">";
				        echo "<td>".$row[1]."</td>";
				        echo "<td>".$row[2]."</td>";
				        echo "<td>".$row[3]."</td>";
				        echo "<td>".$row[4]."</td>";
				        echo "<td>".$row[5]."</td>";
				   		echo "<td><a href='#edit_subject_modal' role='button' data-toggle='modal'>
				   		<button class='btn btn-success' onclick='subject_edit(".$row[0].")'>
						<i class='icon-pencil icon-white'></i>
				   		</button></a></td>";
                  		//echo "<td><button class='btn btn-success' onclick='teacher_delete(".$row[0].")'><i class='icon-trash icon-white'></i></button></td>";
				        echo "</tr>";
				      }
				     
		        
		        
           		$this->closeConn();
		 
	        }
	        function subject_retrieve($subject_id){
				$this->openConn();
				            
		           $stmt = $this->dbh->prepare("SELECT s.subject_id, s.teacher_id, s.Subject_Name, s.Day, s.Time, s.Section
					FROM Subject as s
					WHERE s.subject_id =?");
		           $stmt->bindParam(1,$subject_id);
		           $stmt->execute();
		              
		           $record = $stmt->fetch();
			
			        $list = array("edit_subject_id"=>$record[0],
					       "edit_subject_teacher"=>$record[1], 
					       "edit_subject"=>$record[2],
			               "edit_day"=>$record[3],
			               "edit_time"=>$record[4],
			               "edit_section_to_subject"=>$record[5]
			              );
						 $json_string = json_encode($list);			
            			 echo $json_string;
			
			   $this->closeConn();
		   	}
		   	function subject_save($edit_subject_id, $edit_subject_teacher, $edit_subject, $edit_day, $edit_time, $edit_section){
		   	
				$this->openConn();
						
						//setting the first letter of the word to uppercase and the kasunod na letter to lower case
						//if meada space the next letter will be uppercase :) gehap.... and then lower gihap again..
						$edit_subject = ucwords(strtolower($edit_subject));
						$edit_day = ucwords(strtolower($edit_day));
						$edit_section = ucwords(strtolower($edit_section));
		       
		
		                $stmt = $this->dbh->prepare("UPDATE Subject as s
							                        SET s.teacher_id= ?, 
							                        s.Subject_Name=?, 
							                        s.Day=?, 
							                        s.Time=?, 
							                        s.Section=?
							                       WHERE s.subject_id = ?");
							                        
		             
		                $stmt->bindParam(1, $edit_subject_teacher);
		                $stmt->bindParam(2, $edit_subject);
		                $stmt->bindParam(3, $edit_day);
		                $stmt->bindParam(4, $edit_time);
		                $stmt->bindParam(5, $edit_section);
		                $stmt->bindParam(6, $edit_subject_id);
		                $stmt->execute();
		                
		                echo "Successfully Edited.."; 
		   	}
		   	
			function section_search($search_section){
		            $this->openConn();
		                 
		              	$stmt = $this->dbh->prepare("SELECT  s.subject_id , tt.Teacher_Name, s.Subject_Name, s.Day, s.Time, s.Section
			        	FROM Subject AS s, Teachers_Table AS tt
			        	WHERE tt.teacher_id = s.teacher_id
			        	AND s.Section =?");
		             //   $stmt = $this ->dbh->prepare("SELECT DISTINCT");
		                $stmt->bindParam(1, $search_section);
		              	$stmt->execute();
		              	
		              	$searched = false;
		              	echo "<tr><th colspan='7' class='alert alert-success'>Schedule of Subject</th>
									</tr>
									<th>Subject Teacher</th>
									<th>Subject</th>
									<th>Day</th>
									<th>Time</th>
									<th>Section</th>
									<th colspan='2'>Action</th>";
			         while($row=$stmt->fetch()){
				                $ctr=0;
				                while($ctr<2){
					                  if($row[$ctr] != "" || $row[$ctr] != ""){
						                  $searched = true;
					                  }
					                  $ctr++;
				                  }
				                  if($searched){
				                  	
							            echo "<tr id=".$row[0].">";
											echo "<td> ".$row[1]."</td>";
											echo "<td>".$row[2]."</td>";
											echo "<td>".$row[3]."</td>";
											echo "<td>".$row[4]."</td>";
											echo "<td>".$row[5]."</td>";
											echo "<td><a href='#edit_subject_modal' role='button' data-toggle='modal'>
													<button class='btn btn-success' onclick='subject_edit(".$row[0].")'>
												<i class='icon-pencil icon-white'></i>
													</button></a></td>";
											echo "</tr>"; 	
									
				                  }
				                  
			         }
			         if(!$searched){
			                     echo"No Matched Found";
			         }					
   					
		             $this->closeConn();
		            
		    }
		    
		    function subject_teacher_search($search_teacher){
		            $this->openConn();
		                 
		              	$stmt = $this->dbh->prepare("SELECT  s.subject_id , tt.Teacher_Name, s.Subject_Name, s.Day, s.Time, s.Section
			        	FROM Subject AS s, Teachers_Table AS tt
			        	WHERE tt.teacher_id = s.teacher_id
			        	AND tt.Teacher_Name  =?");
		             //   $stmt = $this ->dbh->prepare("SELECT DISTINCT");
		                $stmt->bindParam(1, $search_teacher);
		              	$stmt->execute();
		              	
		              	$searched = false;
		              	echo "<tr><th colspan='7' class='alert alert-success'>Schedule of Subject</th>
									</tr>
									<th>Subject Teacher</th>
									<th>Subject</th>
									<th>Day</th>
									<th>Time</th>
									<th>Section</th>
									<th colspan='2'>Action</th>";
			         while($row=$stmt->fetch()){
				                $ctr=0;
				                while($ctr<2){
					                  if($row[$ctr] != "" || $row[$ctr] != ""){
						                  $searched = true;
					                  }
					                  $ctr++;
				                  }
				                  if($searched){
				                  	
					                echo "<tr id=".$row[0].">";
									echo "<td> ".$row[1]."</td>";
									echo "<td>".$row[2]."</td>";
									echo "<td>".$row[3]."</td>";
									echo "<td>".$row[4]."</td>";
									echo "<td>".$row[5]."</td>";
									echo "<td><a href='#edit_subject_modal' role='button' data-toggle='modal'>
								   		<button class='btn btn-success' onclick='subject_edit(".$row[0].")'>
										<i class='icon-pencil icon-white'></i>
								   		</button></a></td>";
									echo "</tr>"; 	
									
				                  }
				                  
			         }
			         if(!$searched){
			                     echo"No Matched Found";
			         }					
   					
		             $this->closeConn();
		            
		    }
		    
		    function subject_search($search_subject){
		            $this->openConn();
		                 
		              	$stmt = $this->dbh->prepare("SELECT  s.subject_id , tt.Teacher_Name, s.Subject_Name, s.Day, s.Time, s.Section
			        	FROM Subject AS s, Teachers_Table AS tt
			        	WHERE tt.teacher_id = s.teacher_id
			        	AND s.Subject_Name  =?");
		             //   $stmt = $this ->dbh->prepare("SELECT DISTINCT");
		                $stmt->bindParam(1, $search_subject);
		              	$stmt->execute();
		              	
		              	$searched = false;
		              	echo "<tr><th colspan='7' class='alert alert-success'>Schedule of Subject</th>
									</tr>
									<th>Subject Teacher</th>
									<th>Subject</th>
									<th>Day</th>
									<th>Time</th>
									<th>Section</th>
									<th colspan='2'>Action</th>";
					     while($row=$stmt->fetch()){
						            $ctr=0;
						            while($ctr<2){
							              if($row[$ctr] != "" || $row[$ctr] != ""){
								              $searched = true;
							              }
							              $ctr++;
						              }
						              if($searched){
						              	
							            echo "<tr id=".$row[0].">";
										echo "<td> ".$row[1]."</td>";
										echo "<td>".$row[2]."</td>";
										echo "<td>".$row[3]."</td>";
										echo "<td>".$row[4]."</td>";
										echo "<td>".$row[5]."</td>";
										echo "<td><a href='#edit_subject_modal' role='button' data-toggle='modal'>
									   		<button class='btn btn-success' onclick='subject_edit(".$row[0].")'>
											<i class='icon-pencil icon-white'></i>
									   		</button></a></td>";
										echo "</tr>"; 	
									
						              }
						              
					     }
					     if(!$searched){
					                 echo"No Matched Found";
					     }					
   					
		             $this->closeConn();
		            
		    }*/
	        
	}

		    

