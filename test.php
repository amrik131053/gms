<?php
include "connection/connection.php";
// // date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)

 // $sql1 = "SELECT * FROM Staff Where IDNo='171006'";
 //        $q1 = sqlsrv_query($conntest, $sql1);
 //        while ($row = sqlsrv_fetch_array($q1, SQLSRV_FETCH_ASSOC)) 
 //        {
 //            $userName = $row['Name'];
 //            $fatherName = $row['FatherName'];
 //        	$a=$row;
 //        }
 //            print_r($a);

// header('Content-Type: application/xls');                                               // excel downloading
//     header('Content-Disposition:attachment; filename='.$code.'.xls');



// CREATE TABLE IF NOT EXISTS `meter_reading` (
//   `ID` int(11) NOT NULL AUTO_INCREMENT,
//   `article_no` bigint(20) DEFAULT NULL,
//   `location_id` int(11) DEFAULT NULL,
//   `current_owner` bigint(20) DEFAULT NULL,
//   `reading_date` date DEFAULT NULL,
//   `current_reading` bigint(20) DEFAULT NULL,
//   `unit` int(11) DEFAULT NULL,
//   `amount` int(11) DEFAULT NULL,
//   PRIMARY KEY (`ID`)
// ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


// mysqli_query($conn,"CREATE TABLE IF NOT EXISTS `outside_owners` ( `id` bigint(20) NOT NULL AUTO_INCREMENT, `name` varchar(100) DEFAULT NULL, `designation` varchar(100) DEFAULT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;");






// CREATE TABLE IF NOT EXISTS `hostel_student_leaves` (
//   `ID` int(11) NOT NULL AUTO_INCREMENT,
//   `student_id` bigint(20) DEFAULT NULL,
//   `start_date` date DEFAULT NULL,
//   `end_date` date DEFAULT NULL,
//   `leave_count` int(11) DEFAULT NULL,
//   `remarks` varchar(200) DEFAULT NULL,
//   `depart_time` datetime DEFAULT NULL,
//   `arrival_time` datetime DEFAULT NULL,
//   PRIMARY KEY (`ID`)
// ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;


// // USE `lims`;
// CREATE TABLE IF NOT EXISTS `block_type_master` (
//   `id` int(11) NOT NULL AUTO_INCREMENT,
//   `type` varchar(50) DEFAULT NULL,
//   PRIMARY KEY (`id`)
// ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
// // CREATE TABLE IF NOT EXISTS `hostel_permissions` (
//   `id` int(11) NOT NULL AUTO_INCREMENT,
//   `emp_id` bigint(20) DEFAULT NULL,
//   `building_master_id` int(11) DEFAULT NULL,
//   PRIMARY KEY (`id`)
// ) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;


// CREATE TABLE IF NOT EXISTS `hostel_student_summary` (
//   `id` int(11) NOT NULL AUTO_INCREMENT,
//   `article_no` int(11) DEFAULT 0,
//   `student_id` bigint(20) DEFAULT 0,
//   `location_id` int(11) DEFAULT 0,
//   `status` int(11) DEFAULT 0,
//   `session` varchar(50) DEFAULT NULL,
//   `check_in_date` date DEFAULT NULL,
//   `check_out_date` date DEFAULT NULL,
//   `reference_no` varchar(50) DEFAULT NULL,
//   PRIMARY KEY (`id`)
// ) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;




// $sql = "SELECT  * FROM Admissions where ClassRollNo='1930258'";
// $stmt1 = sqlsrv_query($conntest,$sql);


//         while($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
//          {
//           $IDNo= $row['IDNo'];
//           $stu_name= $row['StudentName'];
//           $array=$row;
//          }
//       print_r($array);
// $email='';
// $sql22="SELECT * FROM Staff Where IDNo='131053'";
// $q122 = sqlsrv_query($conntest,$sql22);
// while($row1 = sqlsrv_fetch_array($q122, SQLSRV_FETCH_ASSOC))
// {
// 	$array=$row1;
// 	if ($row1['OfficialEmailID']) 
// 	{
//     	$email.=$row1['OfficialEmailID'];
		
// 	}
// 	else{
//     	$email.=$row1['EmailID'];
// 	}
//     $SenderName=$row1['Name'];
//     $Designation=$row1['Designation'];

// }
// echo $email;
// print_r($array);

// CREATE DATABASE IF NOT EXISTS `lims` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
// USE `lims`;

// -- Dumping structure for table lims.faulty_track
// CREATE TABLE IF NOT EXISTS `faulty_track` (
//   `ID` int(11) NOT NULL AUTO_INCREMENT,
//   `article_no` int(11) DEFAULT NULL,
//   `location_id` int(11) DEFAULT NULL,
//   `time_stamp` datetime DEFAULT NULL,
//   `direction` varchar(50) DEFAULT NULL,
//   `remarks` text DEFAULT NULL,
//   `reference_no` varchar(50) DEFAULT NULL,
//   `working_status` int(11) DEFAULT NULL,
//   `status` int(11) DEFAULT NULL,
//   `updated_by` int(11) DEFAULT NULL,
//   `token_no` int(11) NOT NULL DEFAULT 101,
//   `forwarded_to` int(11) DEFAULT NULL,
//   PRIMARY KEY (`ID`)
// ) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4;

// $a=0;
// $sql_ref = "SELECT *, stock_summary.reference_no as refNo FROM stock_summary INNER  join stock_description on stock_summary.IDNo=stock_description.IDNo  where (stock_description.OwerID='0' AND stock_summary.Corrent_owner!='0') ORDER BY Direction desc";
// $resultRef = mysqli_query($conn, $sql_ref);
// while ($row = mysqli_fetch_array($resultRef)) 
//     {	$location=$row['LocationID'];
//     	echo "<br>".$location;
//      $owner=$row['Corrent_owner'];
//      $ref=$row['refNo'];
//         echo "<br>".$owner;

//     		echo "<br>".$qry11="Update stock_description set OwerID='$owner' where LocationID='$location' and stock_description.OwerID='0' and reference_no='$ref' ";
// 			//echo "<br>".$qry112="Update stock_summary set Corrent_owner='$owner' where LocationID='$location' AND stock_summary.Corrent_owner='' ";
//     		 //mysqli_query($conn,$qry112);
//     		 mysqli_query($conn,$qry11);

//             $a++;

//     }
// echo $a;
//     $sql_ref = "SELECT * FROM stock_description INNER  join stock_summary on stock_summary.IDNo=stock_description.IDNo  where (stock_description.OwerID='' AND stock_summary.Corrent_owner='') ORDER BY Direction desc";
// $resultRef = mysqli_query($conn, $sql_ref);
// while ($row = mysqli_fetch_array($resultRef)) 
//     {   $location=$row['LocationID'];
//         echo "<br>".$location;
//         echo $sql="SELECT location_owner FROM location_master where ID='$location'";
//         $res=mysqli_query($conn,$sql);
//         while($run=mysqli_fetch_array($res))
//         {
//             $owner=$run[0];
//             echo "<br>".$qry11="Update stock_description set OwerID='$owner' where LocationID='$location' and stock_description.OwerID='' ";
//             echo "<br>".$qry112="Update stock_summary set Corrent_owner='$owner' where LocationID='$location' AND stock_summary.Corrent_owner='' ";
//              mysqli_query($conn,$qry112);
//              mysqli_query($conn,$qry11);


//         }
//     }
// //     	echo "<br>".$a++;

// $sql_ref = "SELECT * FROM stock_description INNER  join stock_summary on stock_summary.IDNo=stock_description.IDNo  where stock_description.reference_no='0' ORDER BY Direction desc";
//     $resultRef = mysqli_query($conn, $sql_ref);
//     while ($row = mysqli_fetch_array($resultRef)) 
//     {
//     	$id1=$row['IDNO'];

//  $one=date("His");
//  $two= date("myd");
//  $three= substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'),1,8);
//  $four=substr(str_shuffle($one.$two.$three),1,8);
// $result =$one.$three.$two.$four;



// echo $qry="Update stock_description set reference_no='$result' where IDNO='$id1'";

//  mysqli_query($conn,$qry);

// $qry1="Update stock_summary set reference_no='$result' where IDNo='$id1'";

// mysqli_query($conn,$qry1);
		



//    }





?>