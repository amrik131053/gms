<?php
include "../connection/connection.php";
ini_set('max_execution_time', '0');
// set_time_limit(0);
ini_set('memory_limit', '20000M');
// ini_set('upload_max_filesize', '512M');
// ini_set('post_max_size', '512M');
date_default_timezone_set("Asia/Kolkata");
// $dbname=$_POST['db'];
$servername = "10.0.8.10";
$username = "$username1";
$password = "$password1";
// Database configuration
if ($_POST['db']!='All')
{
    $database_name = $_POST['db'];
        $conn = new mysqli($servername, $username, $password, $database_name);
        $conn->set_charset("utf8");
        // Get connection object and set the charset
        // Get All Table Names From the Database
        $tables = array();
        $sql = "SHOW TABLES";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_row($result)) 
        {
            if ($row[0]!='question_bank') 
            {
                $tables[] = $row[0];
            }
            
        }
        $sqlScript = "";
        foreach ($tables as $table) 
        {
            // Prepare SQLscript for creating table structure
            $query = "SHOW CREATE TABLE $table";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_row($result);
            $sqlScript.= "\n\n" . $row[1] . ";\n\n";
            $query = "SELECT * FROM $table";
            $result = mysqli_query($conn, $query);
            $columnCount = mysqli_num_fields($result);
            // Prepare SQLscript for dumping data for each table
            for ($i = 0;$i < $columnCount;$i++) 
            {
                while ($row = mysqli_fetch_row($result)) 
                {
                    $sqlScript.= "INSERT INTO $table VALUES(";
                    for ($j = 0;$j < $columnCount;$j++) 
                    {
                        $row[$j] = $row[$j];
                        if (isset($row[$j])) 
                        {
                            $sqlScript.= '"' . $row[$j] . '"';
                        } else {
                            $sqlScript.= '""';
                        }
                        if ($j < ($columnCount - 1)) 
                        {
                            $sqlScript.= ',';
                        }
                    }
                    $sqlScript.= ");\n";
                }
            }
            $sqlScript.= "\n";
        }
        if (!empty($sqlScript)) 
        {
            // Save the SQL script to a backup file
           $files[]=$backup_file_name = $database_name . '_backup_' . date('Y-m-d') . '.sql';
            $fileHandler = fopen($backup_file_name, 'w+');
            $number_of_lines = fwrite($fileHandler, $sqlScript);
            fclose($fileHandler);
            // Download the SQL backup file to the browser
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($backup_file_name));
            header('Content-Transfer-Encoding: binary');
            // header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($backup_file_name));
            ob_clean();
            flush();
            readfile($backup_file_name);
            exec('rm ' . $backup_file_name);
        }
$zipname = $database_name . '_backup_'. date('d-m-Y').'.zip';

}
else
{
    $show = "show databases";
$show_run = mysqli_query($conn, $show);
while ($show_row = mysqli_fetch_array($show_run)) 
{
    if ($show_row[0] != 'information_schema' && $show_row[0] != 'performance_schema' && $show_row[0] != 'phpmyadmin' && $show_row[0] != 'mysql' && $show_row[0] != 'test' ) 
    {
        $database_name = $show_row[0];
       
        $conn->set_charset("utf8");
        // Get connection object and set the charset
        // Get All Table Names From the Database
        $tables = array();
        $sql = "SHOW TABLES";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_row($result)) 
        {
            if ($row[0]!='question_bank') 
            {
                $tables[] = $row[0];
            }
        }
        $sqlScript = "";
        foreach ($tables as $table) 
        {
            // Prepare SQLscript for creating table structure
            $query = "SHOW CREATE TABLE $table";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_row($result);
            $sqlScript.= "\n\n" . $row[1] . ";\n\n";
            $query = "SELECT * FROM $table";
            $result = mysqli_query($conn, $query);
            $columnCount = mysqli_num_fields($result);
            // Prepare SQLscript for dumping data for each table
            for ($i = 0;$i < $columnCount;$i++) 
            {
                while ($row = mysqli_fetch_row($result)) 
                {
                    $sqlScript.= "INSERT INTO $table VALUES(";
                    for ($j = 0;$j < $columnCount;$j++) 
                    {
                        $row[$j] = $row[$j];
                        if (isset($row[$j])) 
                        {
                            $sqlScript.= '"' . $row[$j] . '"';
                        } else {
                            $sqlScript.= '""';
                        }
                        if ($j < ($columnCount - 1)) 
                        {
                            $sqlScript.= ',';
                        }
                    }
                    $sqlScript.= ");\n";
                }
            }
            $sqlScript.= "\n";
        }
        if (!empty($sqlScript)) 
        {
            // Save the SQL script to a backup file
           $files[]=$backup_file_name = $database_name . '_backup_' . date('Y-m-d') . '.sql';
            $fileHandler = fopen($backup_file_name, 'w+');
            $number_of_lines = fwrite($fileHandler, $sqlScript);
            // fclose($fileHandler);
            // Download the SQL backup file to the browser
            // header('Content-Description: File Transfer');
            // header('Content-Type: application/octet-stream');
            // header('Content-Disposition: attachment; filename=' . basename($backup_file_name));
            // header('Content-Transfer-Encoding: binary');
            // // header('Expires: 0');
            // header('Cache-Control: must-revalidate');
            // header('Pragma: public');
            // header('Content-Length: ' . filesize($backup_file_name));
            // ob_clean();
            // flush();
            // readfile($backup_file_name);
            // exec('rm ' . $backup_file_name);
        }
    }
}
// $files = array('readme.txt', 'test.html', 'image.gif');


$zipname = 'Local Backup_' . date('d-m-Y').'.zip';
}
$zip = new ZipArchive;
$zip->open($zipname, ZipArchive::CREATE);
foreach ($files as $file) {
  $zip->addFile($file);
}
$zip->close();
header('Content-Type: application/zip');
header('Content-disposition: attachment; filename='.$zipname);
header('Content-Length: ' . filesize($zipname));
readfile($zipname);


?>