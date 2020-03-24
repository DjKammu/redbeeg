<?php 
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	
	$timezone = new DateTimeZone("Asia/Kolkata");
	
	setlocale(LC_MONETARY, 'en_IN');
	
class connection
{
		private $hostname = 'localhost';
		private $username = 'root';
		private $password = 'root';
		private $dbname = 'redbeeg';
		private $data = array();
		public $conn = '';
		
		public function __construct()
		{
			$this->conn = new mysqli($this->hostname,$this->username,$this->password,$this->dbname);
			
			$this->mysqli = new mysqli($this->hostname,$this->username,$this->password,$this->dbname);
			
			//$this->access_var = 'yes';
			try
			{
				if($this->conn->connect_error)
				{
					throw new Exception('Connection Error!');
					exit;
				}
			}
			
			catch(Exception $ex)
			{
				echo $ex->getmessage();
			}
		}
		
		
		public function insert($data)
		{
			if($this->conn->query($data)==TRUE)
			{
				return  mysqli_insert_id($this->conn);
			}
			
			else
			{
				return 0;
			}
		}
		
		
		public function select($data)
		{
			$result = $this->conn->query($data);
			$data = array();
			if($result==TRUE)
			 {
				while($row = $result->fetch_array()) 
				{
					$data[] = $row;
				}
				return $data;
			 }
		}
		
		public function select_assoc($data)
		{
			$result = $this->conn->query($data);
			$data = array();
			if($result==TRUE)
			 {
				while($row = $result->fetch_assoc()) 
				{
					$data[] = $row;
				}
				return $data;
			 }
		}

		public function count_row($data)
		{
			$result = $this->conn->query($data);
			
			$data = $result->num_rows;
		
			return $data;
		} 
		
		public function select_where($data)
		{
			$result = $this->conn->query($data);
			$data = array();
			if($result==TRUE)
			 {
				while($row = $result->fetch_assoc()) 
				{
					$data[] = $row;
				}
				return $data;
			 }
		}
		
		public function select_where_with_param($table , $where_clause)
		{
			// check for optional where clause
			$whereSQL = '';
			if(!empty($where_clause))
			{
				// check to see if the 'where' keyword exists
				if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
				{
					// not found, add keyword
					$whereSQL = " WHERE ".$where_clause;
				} else
				{
					$whereSQL = " ".trim($where_clause);
				}
			}
			
			$qry = "SELECT * FROM $table".$whereSQL;
			
			$result = $this->conn->query($qry);
			
			$data = array();
			
			if($result==TRUE)
			 {
				while($row = $result->fetch_assoc()) 
				{
					$data[] = $row;
				}
				return $data;
			 }
		}
		
		public function select_where_with_param_order($table , $where_clause, $order)
		{
			// check for optional where clause
			$whereSQL = '';
			if(!empty($where_clause))
			{
				// check to see if the 'where' keyword exists
				if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
				{
					// not found, add keyword
					$whereSQL = " WHERE ".$where_clause;
				} else
				{
					$whereSQL = " ".trim($where_clause);
				}
			}
			
			$qry = "SELECT * FROM $table".$whereSQL.' '.$order;
			
			$result = $this->conn->query($qry);
			
			$data = array();
			
			if($result==TRUE)
			 {
				while($row = $result->fetch_assoc()) 
				{
					$data[] = $row;
				}
				return $data;
			 }
		}
		
		public function select_where_with_fields($table , $where_clause , $fields)
		{
			// check for optional where clause
			$whereSQL = '';
			if(!empty($where_clause))
			{
				// check to see if the 'where' keyword exists
				if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
				{
					// not found, add keyword
					$whereSQL = " WHERE ".$where_clause;
				} else
				{
					$whereSQL = " ".trim($where_clause);
				}
			}
			
			$qry = "SELECT $fields FROM $table".$whereSQL; 
			
		
			
			
			$result = $this->conn->query($qry);
			
			$data = array();
			
			if($result==TRUE)
			 {
				while($row = $result->fetch_assoc()) 
				{
					$data[] = $row;
				}
				return $data;
			 }
		}
		
		public function update_where($data)
		{
			$result = $this->conn->query($data);
			if($result==TRUE)
			 {
				return 1;
			 }
			 else
			 {
				 return 0;
			 }
		} 
		
		public function delete($data)
		{   
			$result = $this->conn->query($data);
			if($result==TRUE)
			 {
				return 1;
			 }
			 
			 else
			 {
				 return 0;
			 }
		}
		
		public function getExcerpt($str, $startPos, $maxLength) 
		{
			if(strlen($str) > $maxLength) 
			{
				$excerpt   = substr($str, $startPos, $maxLength-3);
				$lastSpace = strrpos($excerpt, ' ');
				$excerpt   = substr($excerpt, 0, $lastSpace);
				$excerpt  .= '...';
			}
			
			else 
			{
				$excerpt = $str;
			}
			
			return $excerpt;
		}
		
		public function InsertData($table_name, $form_data)
		{  
			// retrieve the keys of the array (column titles)
			$fields = array_keys($form_data);

			// build the query
			$sql = "INSERT INTO ".$table_name."
			(`".implode('`,`', $fields)."`)
			VALUES('".implode("','", $form_data)."')";

			// run and return the query result resource
				//echo $sql; exit;
			
			if($this->conn->query($sql)==TRUE)
			{
				return  mysqli_insert_id($this->conn);
			}
			
			else
			{
				return 0;
			}
				
		}
		
		public function DeleteData($table_name, $where_clause='')
		{
			// check for optional where clause
			$whereSQL = '';
			if(!empty($where_clause))
			{
				// check to see if the 'where' keyword exists
				if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
				{
					// not found, add keyword
					$whereSQL = " WHERE ".$where_clause;
				} else
				{
					$whereSQL = " ".trim($where_clause);
				}
			}
			// build the query
			$sql = "DELETE FROM ".$table_name.$whereSQL;

			// run and return the query result resource
			
			$result = $this->conn->query($sql);
			if($result==TRUE)
			{
				return 1;
			}
			else
			{
				 return 0;
			}
			
		}
		
		public function UpdateData($table_name, $form_data, $where_clause='')
		{
			// check for optional where clause
			$whereSQL = '';
			if(!empty($where_clause))
			{
				// check to see if the 'where' keyword exists
			if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
				{
					// not found, add key word
					$whereSQL = " WHERE ".$where_clause;
				} else
				{
					$whereSQL = " ".trim($where_clause);
				}
			}
			// start the actual SQL statement
			$sql = "UPDATE ".$table_name." SET ";

			// loop and build the column /
			$sets = array();
			foreach($form_data as $column => $value)
			{
				 $sets[] = "`".$column."` = '".$value."'";
			}
			$sql .= implode(', ', $sets);

			// append the where statement
			$sql .= $whereSQL;

			// run and return the query result
			$result = $this->conn->query($sql);
			if($result==TRUE)
			{
				return 1;
			}
			else
			{
				 return 0;
			}
		}
		
		
		public function Sort_by_value($array,$field_name,$order)
		{
			$price = array();
			foreach ($array as $key => $row)
			{
				$price[$key] = $row[$field_name];
			} 
			array_multisort($price, $order, $array);
			
			return $array;
		}  // not working
		
		public function get_team_by_rank($sub_contest_id)
		{
	
			$contest = "SELECT * FROM `sub_contests` WHERE sub_id=".$sub_contest_id."";
			
			$contest_data = $this->select_where($contest);
			
			$contest_data = $contest_data[0];
			
			$decoded_array  = json_decode($contest_data['ranks']);
				
			$limit = $contest_data['winners'];
			
			$data = "SELECT  ROUND(SUM(credit_points)) AS points,user_id,team_id FROM `user_question_ans` WHERE sub_contest_id=".$sub_contest_id." GROUP BY team_id ORDER BY SUM(credit_points) DESC LIMIT $limit";
			
			$result = $this->select_where($data); 

			$count = count(array_filter($result));
			
			if($count>0)
			{ 
				$d=1;
				
				foreach($decoded_array as $array)
				{    
					if($array->to !=0)
					{
						$from = $array->from;
						$to = $array->to;
						$diff = $to-$from+1;
					
					}

					else
					{
						$diff = 1;	
					}
				
					$i=0;
					
					foreach($result as $row)
					{ 
						if($i<$diff)
						{  
							$team_ids[] = $row['team_id'];
							$user_points[] = $row['points'];
							unset($result[$i]);
						}
						
						$i++;
					}
					
				
					foreach($team_ids as $team_id)
					{
						$data_points = "SELECT  SUM(credit_points) AS points FROM `user_question_ans` WHERE sub_contest_id=".$sub_contest_id." AND team_id=".$team_id."";
			
						$result_points = $this->select_where($data_points);
						
						$result_points = $result_points[0];
						
						
						$user = "SELECT `name` FROM `team` WHERE team_id=".$team_id."";
						
						$user_data = $this->select_where($user);
						
						$user_data = $user_data[0];
						
						//$existing_balance = $user_data ['earning_balance'];
						
						$update_result = TRUE;
				
						$user_data['rank'] = $d;
						//$user_data['earning_balance'] = $new_balance;
						$user_data['points'] = round($result_points['points'],3);
						$list[] = $user_data;
						$d++;
						
						
					}
					
				
					$result = array_values($result);
					
					unset($team_ids);
					
				}
				
				return $list;
				
				//echo "<pre>";print_r($list);die();
				
				
			 
			}
			
			else
			{	
				$list = array();
				return $list;
			
			}
		}
		
		
		function mime_content_type($filename) {
			
			// die("hello");
							        $mime_types = array(

							            'txt' => 'text/plain',
							            'htm' => 'text/html',
							            'html' => 'text/html',
							            'php' => 'text/html',
							            'css' => 'text/css',
							            'js' => 'application/javascript',
							            'json' => 'application/json',
							            'xml' => 'application/xml',
							            'swf' => 'application/x-shockwave-flash',
							            'flv' => 'video/x-flv',

							            // images
							            'png' => 'image/png',
							            'jpe' => 'image/jpeg',
							            'jpeg' => 'image/jpeg',
							            'jpg' => 'image/jpeg',
							            'gif' => 'image/gif',
							            'bmp' => 'image/bmp',
							            'ico' => 'image/vnd.microsoft.icon',
							            'tiff' => 'image/tiff',
							            'tif' => 'image/tiff',
							            'svg' => 'image/svg+xml',
							            'svgz' => 'image/svg+xml',

							            // archives
							            'zip' => 'application/zip',
							            'rar' => 'application/x-rar-compressed',
							            'exe' => 'application/x-msdownload',
							            'msi' => 'application/x-msdownload',
							            'cab' => 'application/vnd.ms-cab-compressed',

							            // audio/
							            'mp3' => 'audio/mpeg',
							            //video
							            
							            'qt'  => 'video/quicktime',
							            'mov' => 'video/quicktime',
							            'mp4' => 'video/mp4',
							            'mkv' => 'video/mkv',
							            'flv' => 'video/flv',
							            'avi' => 'video/avi',
							            'mov' => 'video/mov',
							            '3gp' => 'video/3gp',
							            'webm' => 'video/webm',

							            // adobe
							            'pdf' => 'application/pdf',
							            'psd' => 'image/vnd.adobe.photoshop',
							            'ai' => 'application/postscript',
							            'eps' => 'application/postscript',
							            'ps' => 'application/postscript',

							            // ms office
							            'doc' => 'application/msword',
							            'rtf' => 'application/rtf',
							            'xls' => 'application/vnd.ms-excel',
							            'ppt' => 'application/vnd.ms-powerpoint',

							            // open office
							            'odt' => 'application/vnd.oasis.opendocument.text',
							            'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
							        );

							        $ext = strtolower(array_pop(explode('.',$filename)));
							        if (array_key_exists($ext, $mime_types)) {
							            return $mime_types[$ext];
							        }
							        elseif (function_exists('finfo_open')) {
							            $finfo = finfo_open(FILEINFO_MIME);
							            $mimetype = finfo_file($finfo, $filename);
							            finfo_close($finfo);
							            return $mimetype;
							        }
							        else {
							            return 'application/octet-stream';
							        }
							    }
		
}
?>