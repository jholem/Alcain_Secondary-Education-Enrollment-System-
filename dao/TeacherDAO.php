<?php
	include 'BaseDAO.php';

	class TeacherDAO extends BaseDAO{
	
		function get_teacher(){
			$this->openConn();
			//when admin is adding student he/she should select a teacher first
			//and when user is  adding student subject..
			        $stmt = $this->dbh->prepare("SELECT * FROM Teachers_Table ORDER BY Teacher_Name");
			 
			        $stmt->execute();
			        
			       
			        			echo "<select name ='teacher' onchange = 'selectTeacher()'>";
			        			 while($row = $stmt->fetch()){
			        			echo "<option value ='".$row[1]."'>".$row[1]."</option>";
			        			}
			        			echo "</select>";
				      
				     
		        
		        
           		$this->closeConn();
		}
		
		function get_teacher_position(){
				$this->openConn();
			        $stmt = $this->dbh->prepare("SELECT * FROM Position_Table ORDER BY Position");
			 		  $stmt->execute();
			        
			       
			        			echo "<select name ='position' >";
			        			 while($row = $stmt->fetch()){
			        			echo "<option value ='".$row[1]."'>".$row[1]."</option>";
			        			}
			        			echo "</select>";
				      
				     
		        
		        
           $this->closeConn();
		}
		
		function get_rooms(){
		
				$this->openConn();
			        $stmt = $this->dbh->prepare("SELECT * FROM Room_Table ORDER BY Room");
			 		  $stmt->execute();
			        
			       
			        			echo "<select name ='room'>";
			        			 while($row = $stmt->fetch()){
			        			echo "<option value ='".$row[1]."'>".$row[1]."</option>";
			        			}
			        			echo "</select>";
				      
				     
		        
		        
           $this->closeConn();
		
		}
		
		function get_teacher_subject($teacher_name){
				$this->openConn();
				
					$stmt = $this ->dbh->prepare("SELECT * FROM  Teachers_Table WHERE Teacher_Name = ?");
					$stmt->bindParam(1, $teacher_name);
					$stmt->execute();
					$row= $stmt->fetch();
					
					$teacher_id = $row[0];
					
					$stmt2 = $this->dbh->prepare("SELECT s.Subject_Name FROM Subject AS s, Subject_of_Teachers AS st
						WHERE st.subject_id = s.subject
						AND st.teacher_id= ? ");
					$stmt2 ->bindParam(1, $teacher_id);
					$stmt2->execute();
					
				
					echo "<select name='select_subject'>";
							while($row= $stmt2->fetch()){
								echo "<option value = ".$row[0].">".$row[0]."</option>";
								
							}
							
					echo "</select>";
				$this->closeConn();
		}
		  
		    function teacher_view(){

			        $this->openConn();
			        $stmt = $this->dbh->prepare("SELECT DISTINCT tt.teacher_id , tt.Teacher_Name, r.Room , p.Position
								FROM Teachers_Table AS tt, Room_Table AS r, Position_Table AS p, Teachers_Room_Position AS trp
								WHERE trp.room_id = r.room_id
								AND trp.position_id = p.position_id
								AND trp.teacher_id = tt.teacher_id");
			 
			        $stmt->execute();
			        
			        while($row = $stmt->fetch()){
				     
				       echo "<tr  onclick='teacher_view_data(".$row[0].")' data-toggle='modal' href='#teacher_info_modal'>";
				        echo "<td>".$row[1]."</td>";
				       echo "<td>".$row[3]."</td>";
				       echo "<td>".$row[2]."</td>";
				       
				        echo "</tr>";
				      }
				     
		        
		        
           		$this->closeConn();
		 
	        }
	        
	        function teacher_view_profile($username, $teacher){
	        		$this->openConn();
	        			
	        			
	        			$teacher_check_id= $this ->dbh->prepare("SELECT * FROM Registered_User WHERE Username =?");
	        			$teacher_check_id-> bindParam(1, $username);
	        			$teacher_check_id->execute();
	        			
	        			$row = $teacher_check_id->fetch();
	        			$username_teacher_id = $row[1];
	        			//echo $username_teacher_id;
	        			
	        			if($username_teacher_id == $teacher){
	        				$stmt= $this->dbh->prepare("SELECT tt.teacher_id , tt.Teacher_Name, tt.Teacher_Bday, tt.Teacher_Age, tt.Teacher_Sex , tt.Teacher_Address,
	        				r.Room, p.Position
	        				 FROM Teachers_Table as tt, Room_Table as r, Position_Table as p, Teachers_Room_Position as trp  
	        				 WHERE trp.room_id = r.room_id 
	        				 AND trp.position_id =  p.position_id
	        				 AND trp.teacher_id = tt.teacher_id
	        				 AND tt.teacher_id = ?");
			     			$stmt->bindParam(1, $teacher);
			     			$stmt->execute();
			     			
			     			if($row = $stmt->fetch()){
			     					echo "<labe>Name:</label> <input type='text' value='".$row[1]. "' readonly></br>";
			     					echo "<label>Birthday:</label> <input type ='text' value='".$row[2]."' readonly></br>";
					     			echo "<label>Age:</label> <input type ='text' value='".$row[3]."' readonly></br>";
					     			echo "<label>Gender:</label>  <input type ='text' value='".$row[4]."' readonly></br>";
					     			echo "<label>Address:</label> <input type ='text' value='".$row[5]."' readonly></br>";
					     			echo "<label>Room:</label> <input type ='text' value='".$row[6]."' readonly></br>";
					     			echo "<label>Position:</label> <input type ='text' value= '".$row[7]."'  readonly></br>";
					     			echo "<br/>";
					     			echo "<br/>";
					     			echo "<button class='btn btn-primary' data-toggle='modal' href='#edit_teacher_modal' onclick ='teacher_edit(".$row[0].")'>Edit Profile</button>";
			     			}
	        			}else{
	        				$stmt= $this->dbh->prepare("SELECT tt.teacher_id , tt.Teacher_Name, tt.Teacher_Bday, tt.Teacher_Age, tt.Teacher_Sex , tt.Teacher_Address,
	        				r.Room, p.Position
	        				 FROM Teachers_Table as tt, Room_Table as r, Position_Table as p, Teachers_Room_Position as trp  
	        				 WHERE trp.room_id = r.room_id 
	        				 AND trp.position_id =  p.position_id
	        				 AND trp.teacher_id = tt.teacher_id
	        				 AND tt.teacher_id = ?");
			     			$stmt->bindParam(1, $teacher);
			     			$stmt->execute();
			     			
			     			if($row = $stmt->fetch()){
			     					echo "<labe>Name:</label> <input type='text' value='".$row[1]. "' readonly></br>";
			     					echo "<label>Birthday:</label> <input type ='text' value='".$row[2]."' readonly></br>";
					     			echo "<label>Age:</label> <input type ='text' value='".$row[3]."' readonly></br>";
					     			echo "<label>Gender:</label>  <input type ='text' value='".$row[4]."' readonly></br>";
					     			echo "<label>Address:</label> <input type ='text' value='".$row[5]."' readonly></br>";
					     			echo "<label>Room:</label> <input type ='text' value= '".$row[6]."'  readonly></br>";
					     			echo "<label>Position:</label> <input type ='text' value='".$row[7]."' readonly></br>";
			     			}
	        			}
	        			
	        			
	        		$this->closeConn();
	        }
	        
           function teacher_view_profile_via_admin( $teacher){
	        		$this->openConn();
	        			
	        			
	        			
	        		
	        				$stmt= $this->dbh->prepare("SELECT tt.teacher_id , tt.Teacher_Name, tt.Teacher_Bday, tt.Teacher_Age, tt.Teacher_Sex , tt.Teacher_Address,
	        				r.Room, p.Position
	        				 FROM Teachers_Table as tt, Room_Table as r, Position_Table as p, Teachers_Room_Position as trp  
	        				 WHERE trp.room_id = r.room_id 
	        				 AND trp.position_id =  p.position_id
	        				 AND trp.teacher_id = tt.teacher_id
	        				 AND tt.teacher_id = ?");
			     			$stmt->bindParam(1, $teacher);
			     			$stmt->execute();
			     			
			     			if($row = $stmt->fetch()){
			     					echo "<labe>Name:</label> <input type='text' value='".$row[1]. "' readonly></br>";
			     					echo "<label>Birthday:</label> <input type ='text' value='".$row[2]."' readonly></br>";
					     			echo "<label>Age:</label> <input type ='text' value='".$row[3]."' readonly></br>";
					     			echo "<label>Gender:</label>  <input type ='text' value='".$row[4]."' readonly></br>";
					     			echo "<label>Address:</label> <input type ='text' value='".$row[5]."' readonly></br>";
					     			echo "<label>Room:</label> <input type ='text' value= '".$row[6]."'  readonly></br>";
					     			echo "<label>Position:</label> <input type ='text' value='".$row[7]."' readonly></br>";
					     			echo "<br/>";
					     			echo "<br/>";
					     			echo "<button class='btn btn-primary' data-toggle='modal' href='#edit_teacher_modal' onclick ='teacher_edit(".$row[0].")'>Edit Profile</button>";
			     			}
	        		
	        			
	        			
	        		$this->closeConn();
	        }
            
            function teacher_retrieve($edit_teacher_id){
		
		              $this->openConn();
		              
		              $stmt = $this->dbh->prepare("SELECT tt.teacher_id , tt.Teacher_Name, tt.Teacher_Bday, tt.Teacher_Age, tt.Teacher_Sex , tt.Teacher_Address,
	        				 p.Position, r.Room
	        				 FROM Teachers_Table as tt, Room_Table as r, Position_Table as p, Teachers_Room_Position as trp  
	        				 WHERE trp.room_id = r.room_id 
	        				 AND trp.position_id =  p.position_id
	        				 AND trp.teacher_id = tt.teacher_id
	        				 AND tt.teacher_id = ?");
		              $stmt->bindParam(1,$edit_teacher_id);
		              $stmt->execute();
		              
		              $record = $stmt->fetch();
			
			           $list = array("edit_teacher_id"=>$record[0],
			            "edit_teacher"=>$record[1],
			            "edit_teacher_bday"=>$record[2],
			            "edit_teacher_age"=>$record[3], 
			            "edit_teacher_gender"=>$record[4], 
			           	"edit_teacher_address"=>$record[5],
			           	"position"=>$record[6],
			           	"room"=>$record[7]);

			           $json_string = json_encode($list);			
            
			           echo $json_string;
			
			           $this->closeConn();
		              
		              
	        }
           
           function teacher_save($edit_teacher_id, $edit_teacher, $edit_teacher_bday, $edit_teacher_age, $edit_teacher_gender, $edit_teacher_address,
           	 $position, $room){
		
		                $this->openConn();
		                  //setting the first letter of the word to uppercase and the kasunod na letter to lower case
						//if meada space the next letter will be uppercase :) gehap.... and then lower case liwat again...
                          $edit_teacher = ucwords(strtolower($edit_teacher));
                          $edit_teacher_gender = ucwords(strtolower($edit_teacher_gender));
                          $edit_teacher_address = ucwords(strtolower($edit_teacher_address));;
                          
                          

		                $stmt = $this ->dbh->prepare("UPDATE Teachers_Table SET 
		                Teacher_Name =? , Teacher_Bday =? , Teacher_Age =? , Teacher_Sex =?,
		                	Teacher_Address =?
		                where teacher_id=?");
		             
		                $stmt->bindParam(1, $edit_teacher);
		                $stmt->bindParam(2, $edit_teacher_bday);
		                $stmt->bindParam(3, $edit_teacher_age);
		                $stmt->bindParam(4, $edit_teacher_gender);
		                $stmt->bindParam(5, $edit_teacher_address);
		                $stmt->bindParam(6, $edit_teacher_id);
		                $stmt->execute();
		                
		               $stmt2 = $this->dbh->prepare("SELECT * FROM Position_Table WHERE Position = ?");
		               $stmt2->bindParam(1, $position);
		               $stmt2->execute();
		               
		               $row = $stmt2->fetch();
		               $position_id = $row[0];
		               
		               $stmt3 = $this->dbh->prepare("SELECT * FROM Room_Table WHERE Room = ?");
		               $stmt3->bindParam(1, $room);
		               $stmt3->execute();
		               
		              $row2= $stmt3->fetch();
		              $room_id = $row2[0];
		                
		                
		              $stmt2 = $this->dbh->prepare("UPDATE Teachers_Room_Position SET room_id = ?, position_id =?
		                WHERE teacher_id =?");
		              $stmt2->bindParam(1, $room_id);
		              $stmt2->bindParam(2, $position_id);
		              $stmt2->bindParam(3, $edit_teacher_id);
		              $stmt2->execute();
		                
		                
		               echo "<labe>Name:</label> <input type='text' value='".$edit_teacher. "' readonly></br>";
			     			echo "<label>Birthday:</label> <input type ='text' value='".$edit_teacher_bday."' readonly></br>";
					     	echo "<label>Age:</label> <input type ='text' value='".$edit_teacher_age."' readonly></br>";
					     	echo "<label>Gender:</label>  <input type ='text' value='".$edit_teacher_gender."' readonly></br>";
					     	echo "<label>Address:</label> <input type ='text' value='".$edit_teacher_address."' readonly></br>";
					     	echo "<label>Position:</label> <input type ='text' value='".$position."' readonly></br>";
					     	echo "<label>Room:</label> <input type ='text' value= '".$room."'  readonly></br>";
					     	echo "<br/>";
					     	echo "<br/>";
					     	echo "<button class='btn btn-primary' data-toggle='modal' href='#edit_teacher_modal' onclick ='teacher_edit(".$edit_teacher_id.")'>Edit Profile</button>";
	
		                $this->closeConn();
		                
		       } 
            
            function teacher_add($teacher_name, $teacher_bday, $teacher_age,$teacher_gender, $teacher_address, $teacher_position, $teacher_room){
                  $this->openConn();
                  
                  echo $teacher_room;
                  $t_name = ucwords(strtolower($teacher_name));
                  $t_address = ucwords(strtolower($teacher_address));
                  
                  $teacher_check= $this ->dbh->prepare("SELECT * FROM Teachers_Table WHERE Teacher_Name = ?");
                  $teacher_check ->bindParam(1, $t_name);
                  $teacher_check->execute();
                  
                  if($row =$teacher_check->fetch()){
                  		echo "Teacher ".$t_name." Already Exist!";
                  		return false;
                  }
                  else{
		              $stmt = $this->dbh->prepare("INSERT INTO Teachers_Table(Teacher_Name, Teacher_Bday, Teacher_Age, Teacher_Sex, Teacher_Address) 
		              		values (?,?,?,?,?)");
		              $stmt->bindParam(1, $t_name);
		              $stmt->bindParam(2, $teacher_bday);
		              $stmt->bindParam(3, $teacher_age);
		              $stmt->bindParam(4, $teacher_gender);
		              $stmt->bindParam(5, $t_address);
		              $stmt->execute();
		              $teacher_id = $this->dbh->lastInsertId();
		              
		              $stmt2 = $this->dbh->prepare("SELECT * FROM Position_Table WHERE Position = ?");
		               $stmt2->bindParam(1, $position);
		               $stmt2->execute();
		               
		               $row = $stmt2->fetch();
		               $position_id = $row[0];
		               
		               $stmt3 = $this->dbh->prepare("SELECT * FROM Room_Table WHERE Room = ?");
		               $stmt3->bindParam(1, $room);
		               $stmt3->execute();
		               
		              $row2= $stmt3->fetch();
		              $room_id = $row2[0];
              
		              $stmt4 = $this->dbh->prepare("INSERT INTO Teachers_Room_Position (teacher_id, room_id, position_id) 
		              		VALUES (?,?,?)");
		              $stmt4->bindParam(1, $teacher_id);
		              $stmt4->bindParam(2, $room_id);
		              $stmt4->bindParam(3, $position_id);
		              $stmt4->execute();
		              
		              
		              echo "success";
		            
                  }
                  $this->closeConn();

            }
            
            function view_teacher_sched($teacher_id){
            	$this->openConn();
            	
            		$stmt = $this->dbh->prepare("SELECT st.teacher_id, r.Room, s.Subject_Name, st.Day, st.Time 
            			FROM Subject_of_Teachers as st, Subject as s, Room_Table as r
            			WHERE st.room_id = r.room_id
            			AND st.subject_id = s.subject
            			AND st.teacher_id =?");
            		$stmt->bindParam(1, $teacher_id);
            		$stmt->execute();
            		
            		
            		while ($row= $stmt->fetch()){
            			echo "<tr id =".$row[0].">";
		         		echo "<td>".$row[1]."</td>";
		         		echo "<td>".$row[2]."</td>";
		         		echo "<td>".$row[3]."</td>";
		         		echo "<td>".$row[4]."<i class='icon-edit'></i></td>";
		         		echo "</tr>";
            		}
            		
            		
            	$this->closeConn();
            }
            
            function add_teacher_sched($teacher_id ,$room, $subject, $day_to_teach, $time_to_teach){
            	$this->openConn();
            		$stmt= $this->dbh->prepare("SELECT * FROM Room_Table WHERE Room=?");
            		$stmt->bindParam(1, $room);
            		$stmt->execute();
            		$row = $stmt->fetch();
            		$room_id = $row[0];
            		
            		$stmt2 = $this->dbh->prepare("SELECT * FROM Subject WHERE Subjet_Name =?");
            		$stmt2->bindParam(1, $subject);
            		$stmt2->execute();
            		$row2= $stmt2->fetch();
            		$subject_id = $row2[0];
            		
            		$stmt3 = $this->dbh->prepare("INSERT INTO Subject_of_Teachers (teacher_id,subject_id, room_id, Day, Time) VALUES (?,?,?,?,?)");
            		$stmt3->bindParam(1, $teacher_id);
            		$stmt3->bindParam(2, $subject_id);
            		$stmt3->bindParam(3, $room_id);
            		$stmt3->bindParam(4, $day_to_teach);
            		$stmt3->bindParam(5, $time_to_teach);
            		$stmt3->execute();
            		echo "success";
            	$this->closeConn();
            }
          /* 
           
           function teacher_delete($id){
                  $this->openConn();
                  $stmt = $this->dbh->prepare("DELETE FROM Teachers_Table WHERE teacher_id=?");
                  $stmt->bindParam(1, $id);
                  $stmt->execute();
                  
                  echo "Deleted Permanently";
                  $this->closeConn();
            
            }
            
           
           
		
	          
	      
           function teacher_search($search_teacher){
                  $this->openConn();
                  
                  $stmt= $this->dbh->prepare("SELECT * FROM Teacher_Profile WHERE Lastname LIKE '".$search_teacher."%'");
                  $stmt->execute();
                  
                  $searched = false;
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
									echo "<td><img src='css/images/user-icon.png'/></td>";
									echo "<td>".$row[1]."</td>";
									echo "<td>".$row[2]."</td>";
									echo "<td>".$row[3]."</td>";
									echo "<td>".$row[4]."</td>";
									echo "<td>".$row[5]."</td>";
									echo "<td>".$row[6]."</td>";
									echo "<td><button class='btn btn-success' onclick='student_edit(".$row[0].")'>Edit</button></td>";
								  	echo "<td><button class='btn btn-success' onclick='student_delete(".$row[0].")'>Delete</button></td>";
									echo "</tr>"; 	
				                  }
			         }
			         if(!$searched){
			                     echo"<script> alert('No Files Found'); </script>";
			         }					
			         $this->closeConn();
             
            }   
           

		*/
	}
?>
