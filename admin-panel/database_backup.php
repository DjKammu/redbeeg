<?php 

define("DB_HOST" , "localhost");
define("DB_USER" , "ibitore3_contest");
define("DB_PASSWORD" , "ibitore3_contest");
define("DB_NAME" , "ibitore3_contest");
date_default_timezone_set('Asia/Kolkata');


/* backup the db OR just a table */
function backup_tables($host,$user,$pass,$name,$tables = '*')
{ 
     
	
	$link = mysql_connect($host,$user,$pass);
	mysql_select_db($name,$link);
	
	//get all of the tables
	if($tables == '*')
	{
		$tables = array();
		$result = mysql_query('SHOW TABLES');
		while($row = mysql_fetch_row($result))
		{
			$tables[] = $row[0];
		}
	}
	else
	{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
	
	//cycle through
	foreach($tables as $table)
	{
        
		$result = mysql_query('SELECT * FROM '.$table);
		$num_fields = mysql_num_fields($result);
		
		$return.= 'DROP TABLE IF EXISTS '.$table.';';
		$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
		$return.= "\n\n".$row2[1].";\n\n";
		
		for ($i = 0; $i < $num_fields; $i++) 
		{
			while($row = mysql_fetch_row($result))
			{
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j<$num_fields; $j++) 
				{
					$row[$j] = addslashes($row[$j]);
					$row[$j] = ereg_replace("\n","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j<($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
		$return.="\n\n\n";
     
	}
	
	//save file
	
    $file='DBBackup/db-backup-'.date("Y-m-d H:i:s").'.sql';
	$handle = fopen($file,'w+');
	fwrite($handle,$return);
	fclose($handle);
      
}



backup_tables(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME); 




 $thelist="";
 if ($handle = opendir('DBBackup')) { 
    while (false !== ($file = readdir($handle)))
    {
        if ($file != "." && $file != ".." && strtolower(substr($file, strrpos($file, '.') + 1)) == 'sql')
        {
            /* $thelist .= '<li><a href="DBBackup/'.$file.'">'.$file.'</a></li>'; */
            $thelist .= '<li><a href="DBBackup/downloadDb.php?fileName='.$file.'">'.$file.'</a></li>'; 
        }
    }
    closedir($handle);
 } 
 
echo "<h2>Database Backup Files</h2>";
echo "Click to download<br>";
echo $thelist;
exit;
?>