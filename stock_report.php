<?php
require('fpdf/fpdf.php');
// $servername1 = "localhost";
// $username1 = "bhagi";
// $password1 = "@Sarbjot@98157";
// $dbname1 = "lims";

// $conn = new mysqli($servername1, $username1, $password1, $dbname1);   
include "connection/connection.php";
 $ID=$_POST['ID'];
$d=0;
 $location=" SELECT * , rm.Floor as FloorName, rm.RoomNo as abc, lm.RoomNo as RoomNo ,lm.ID as L_ID from location_master lm INNER JOIN room_master rm on lm.Floor=rm.FloorID INNER JOIN room_name_master rnm on lm.RoomName=rnm.ID INNER JOIN room_type_master rtm on lm.Type=rtm.ID INNER join building_master bm on lm.Block=bm.ID where lm.ID='$ID'";
            
                $location_run=mysqli_query($conn,$location);
                while ($location_row=mysqli_fetch_array($location_run)) 
                {
                   $LocationID=$location_row['L_ID'];
              $Name=$location_row['Name'];
              $FloorName=$location_row['FloorName'];
              $RoomNo=$location_row['RoomNo'];
              $RoomType=$location_row['RoomType'];         
              $RoomName=$location_row['RoomName'];         
              $location_owner=$location_row['location_owner'];
               $CollegeID=$location_row['CollegeID'];

              $d++;
            }

    $collegeGet=" SELECT * from colleges WHERE ID='$CollegeID'";
    $collegeGet_run=mysqli_query($conn,$collegeGet);
                while ($college_row=mysqli_fetch_array($collegeGet_run)) 
                {
                 $CollegeName=$college_row['name'];
                }
class PDF extends FPDF
{
  function subWrite($h, $txt, $link='', $subFontSize=12, $subOffset=0)
{
  // resize font
  $subFontSizeold = $this->FontSizePt;
  $this->SetFontSize($subFontSize);
  
  // reposition y
  $subOffset = ((($subFontSize - $subFontSizeold) / $this->k) * 0.3) + ($subOffset / $this->k);
  $subX        = $this->x;
  $subY        = $this->y;
  $this->SetXY($subX, $subY - $subOffset);

  //Output text
  $this->Write($h, $txt, $link);

  // restore y position
  $subX        = $this->x;
  $subY        = $this->y;
  $this->SetXY($subX,  $subY + $subOffset);

  // restore font size
  $this->SetFontSize($subFontSizeold);
}

   function Header()
{ 
$LocationID  = $GLOBALS['LocationID'];


}





function Footer()
{ 
 $ctime = date("d-m-Y");
 
    // Position at 1.5 cm from bottom
    $this->SetXY(180,-10);
    // Times italic 8
    $this->SetFont('Times','I',12
  );
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
    $this->SetXY(10,-10);
}

}

$pdf = new PDF();
 $pdf->AddPage();
               $pdf->SetFont('Times','b',40);
                  $pdf->SetXY(5,20);
                  $pdf->MultiCell(200,24,'Stock Register',0,'C',False);
                   $pdf->SetFont('Times','b',25);
                 $pdf->SetXY(5,40);   
                $pdf->MultiCell(200,24,$RoomType,0,'C',False);
                 $pdf->SetXY(5,55);
                 $pdf->MultiCell(200,24,$RoomName,0,'C',False);
 $pdf->SetFont('Times','b',20);
                 $pdf->SetXY(5,70);   
                $pdf->MultiCell(200,24,$CollegeName,0,'C',False);

                $pdf->SetFont('Times','b',20);
                 $pdf->SetXY(5,90);
                $pdf->MultiCell(200,24,'Block : '.$Name.'- Floor : '.$FloorName.'- Room No : '.$RoomNo,0,'C',False);
$pdf->Image('dist/img/logo-login.png', 79, 120, 60.78);
                $pdf->SetFont('Times','B',40);
                   $pdf->SetXY(5,200);
                $pdf->MultiCell(200,24,strtoupper("Guru Kashi University"),0,'C',False);
                 // $pdf->SetFont('Times','b',20);
                  $pdf->SetFont('Times','B',20);
$pdf->SetXY(5,230);
                $pdf->MultiCell(200,24,"Talwandi Sabo (Bathinda) Punjab ,India",0,'C',False);



$pdf->AddPage();
$pdf->SetFont('Times','',8);
$pdf->SetXY(90,20);
$pdf->SetFont('Times','b',20);
$pdf->Write(0,'INDEX');
$pdf->SetFont('Times','b',10);
$pdf->SetXY(10,32);
$pdf->Cell(10,6,'Sr No',1,0,'C',0);
$pdf->Cell(57,6,'Article Name',1,0,'C',0);
$pdf->Cell(61,6,'Count',1,0,'C',0);
$pdf->Cell(65,6,'Page',1,0,'C',0);
 $srno=1;          
               $page_start=3;
               $page_end=0;
               $a_count=0;
                    $Count_Article=" SELECT distinct ma.ArticleCode, ma.ArticleName FROM stock_summary ss INNER JOIN master_article ma  ON ma.ArticleCode=ss.ArticleCode  where ss.LocationID='$LocationID' and ss.Status='2' order by ArticleCode";
                  $Count_Article_run=mysqli_query($conn,$Count_Article);
                while($Count_Article_row=mysqli_fetch_array($Count_Article_run)) 
                { 
                  $a_count++;
                  $c_count=0;
                  $j=0;

                $articlename[]=$Count_Article_row['ArticleName'];
                 $articlecode=$Count_Article_row['ArticleCode'];
                 // print_r($articlename);
                   $CoArticle=" SELECT  * FROM stock_summary ss INNER JOIN master_article ma  ON ma.ArticleCode=ss.ArticleCode  where ss.ArticleCode='$articlecode' and ss.LocationID='$LocationID' and ss.Status='2'  ";
                  $CoArticle_run=mysqli_query($conn,$CoArticle);
                while($CoArticle_row=mysqli_fetch_array($CoArticle_run)) 
                {
                $c_count++;
                $j++;
                 
                 if ($c_count==10)
                             {
                 $page=ceil($c_count/11);
                             }
                             else
                             {
                              $page=ceil($c_count/11);
                             }
                 
                 $page_end=$page_start+$page-1;
              // $srno;
             }
              if ($page_start==$page_end)
               {
               $p[]=$page_start;
               
              } 
              else
              {
                  $p[]=$page_start."-".$page_end;
              }
   
$srno++;

$page_start=$page_end+1;
 $count[]=$c_count;
 $page_[]=$p;
}
for($i=0,$y=38;$i<$a_count;$i++)
{ 
  $pdf->SetXY(10,$y);           
  $pdf->Cell(10,6,$i+1,1,0,'C',0);
  $pdf->Cell(57,6,$articlename[$i],1,0,'C',0);
  $pdf->Cell(61,6,$count[$i],1,0,'C',0);
  $pdf->Cell(65,6,$p[$i],1,0,'C',0);
  $y=$y+6;

}
  $srno=1;  
$pagebottomNumber=3;
$page_number=0;

    $Page_Article=" SELECT distinct ma.ArticleCode, ma.ArticleName FROM stock_summary ss INNER JOIN master_article ma  ON ma.ArticleCode=ss.ArticleCode  where ss.LocationID='$LocationID' and ss.Status='2' order by ArticleCode";
                  $Page_Article_run=mysqli_query($conn,$Page_Article);
                while($Page_Article_row=mysqli_fetch_array($Page_Article_run)) 
                {           
                  $page_number++;
                $ArticleNameHead=$Page_Article_row['ArticleName'];
                $ArticleCodeHead=$Page_Article_row['ArticleCode'];
                $pdf->AddPage();
                 // $pdf->SetXY(10,10);
                 $pdf->SetFont('Times','b',20);
                
                  $pdf->SetXY(5,3);
                  $pdf->MultiCell(200,24,$ArticleNameHead,0,'C',False);
                
                $Countforpage=0;
                $y=32;

                   $description="SELECT  * FROM stock_summary ss INNER JOIN master_article ma  ON ma.ArticleCode=ss.ArticleCode  where ss.LocationID='$LocationID' and ss.ArticleCode='$ArticleCodeHead ' and ss.Status='2' order by IssueDate asc";            
                  $description_run=mysqli_query($conn,$description);
                while($description_row=mysqli_fetch_array($description_run)) 
                {
                 
                $Countforpage++;
                if ($Countforpage==11 || $Countforpage==21 || $Countforpage==31 || $Countforpage==41 || $Countforpage==51 || $Countforpage==61 || $Countforpage==71 || $Countforpage==81 || $Countforpage==91 || $Countforpage==101 || $Countforpage==111 || $Countforpage==121 || $Countforpage==131 || $Countforpage==141 || $Countforpage==151 ) {
                 $pdf->AddPage();
                 
                 $pdf->SetFont('Times','b',20);
                   $pdf->SetXY(5,3);
                  $pdf->MultiCell(200,24,$ArticleNameHead,0,'C',False);
                 $y=32;
                   }
                   else
                   {

                   }   
          $IDNo=$description_row['IDNo'];
          $BillNo=$description_row['BillNo'];
          if($description_row['BillDate']!='0000-00-00')
          {
            $BillDate=date("d-m-Y", strtotime($description_row['BillDate']));
          }
          else
          {
            $BillDate='';
          }
          // $BillDate=date("d-m-Y", strtotime($description_row['BillDate']));
        
         //  $CPU='';

         // if (trim($description_row['CPU'])!='' || trim($description_row['CPU'])==' ' ) {
         //    // $a_sign="-";
         //    $CPU.=trim($description_row['CPU'])."-";
         //  }

         //  if (trim($description_row['Storage'])!=''  || trim($description_row['Storage'])==' ' ) {
         //    // $a_sign="-";
         //    $CPU.=trim($description_row['Storage'])."-";
         //  }
         //  if (trim($description_row['Memory'])!=''  || trim($description_row['Memory'])==' ') {
         //    // $a_sign="-";
         //    $CPU.=trim($description_row['Memory'])."-";

         //  }if (trim($description_row['OS'])!='' || trim($description_row['OS'])==' ') {
         //    // $a_sign="-";
         //    $CPU.=trim($description_row['OS'])."-";

         //  }if (trim($description_row['Brand'])!='' || trim($description_row['Brand'])==' ') {
         //    // $a_sign="-";
         //    $CPU.=trim($description_row['Brand']);

         //  }if (trim($description_row['Model'])!='' || trim($description_row['Model'])==' ') {
         //    // $a_sign="-";
         //    $CPU.="-".trim($description_row['Model']);
         //  }
         // // echo  $CPU;
         // // echo "<br>";
         //   $CPU = str_replace(array('NA','-'), array('',''), $CPU);
          $a_sign=" -";
        $b_sign=" -";
        $c_sign=" -";
        $d_sign=" -";
        $e_sign=" -";
     $CPU="";
          if ($description_row['CPU']=='NA')
           {
            $CPU.=' ';
           }
          else
          {
              $CPU.=$description_row['CPU'];
          }
             if ($description_row['Storage']=='NA')
           {
            $CPU.=' ';
           }
          else
          {
             $CPU.=$description_row['Storage'];
          }
           if ($description_row['Memory']=='NA')
           {
            $CPU.=' ';
           }
          else
          {
            $CPU.=$description_row['Memory'];
          }
           if ($description_row['OS']=='NA')
           {
            $CPU.=' ';
           }
          else
          {
            $CPU.=$description_row['OS'];
          }
           if ($description_row['Brand']=='NA')
           {
            $CPU.=' ';
           }
          else
          {
            $CPU.=$description_row['Brand'];
          }
           if ($description_row['Model']=='NA')
           {
            $CPU.=' ';
           }
          else
          {
            $CPU.=$description_row['Model'];
          }
           // $CPU=$description_row['CPU'].$a_sign.$description_row['Storage'].$b_sign.$description_row['Memory'].$c_sign.$description_row['OS'].$d_sign.$description_row['Brand'].$e_sign.$description_row['Model'];

             $SerialNo=$description_row['SerialNo'];   
            $Device= $description_row['DeviceSerialNo'];       
             $IssueDate= date("d-m-Y", strtotime($description_row['IssueDate']));
       
 $srno++;       
$pagebottomNumber++;  
$pdf->SetXY(10,22);
$pdf->SetFont('Times','',10);
$pdf->Cell(15,10,'Sr No',1,0,'L',0);
// $pdf->Cell(20,10,'QR No',1,0,'L',0);
$pdf->Cell(28,10,'Bill No',1,0,'L',0);
$pdf->Cell(30,10,'Bill Date',1,0,'L',0);  
$pdf->Cell(99,10,'Specifications',1,0,'L',0);
//$pdf->Cell(28,10,'Device Serial No',1,0,'L',0);
//$pdf->Cell(24,10,'Local Serial No',1,0,'L',0);
$pdf->Cell(21,10,'Date of Issue',1,0,'L',0);
// for($i=0,$y=32;$i<$Countforpage;$i++)
// { 
  $pdf->SetXY(10,$y);           
  $pdf->Cell(15,24,$Countforpage,1,0,'C',0);
  // $pdf->Cell(20,24,$IDNo,1,0,'C',0);
  $y = $pdf->GetY();
$x = $pdf->GetX();

 $z=strlen($BillNo);
 // $z=36;
if ($z<18)
 {
  $pdf->MultiCell(28,24,$BillNo,1,'C',False);
  
}
elseif($z<33)
{$pdf->MultiCell(28,12,$BillNo,1,'C',False);
 
}
elseif($z<65)
{$pdf->MultiCell(28,8,$BillNo,1,'C',False);
 
}
else
{
  $pdf->MultiCell(28,4,$BillNo,1,'C',False);
}

// $pdf->SetXY($x, $y);
 $pdf->SetXY($x+28, $y);
  // $pdf->Cell(23,24,$BillNo,1,0,'C',0);
    $pdf->Cell(30,24,$BillDate,1,0,'C',0);
    $pdf->SetXY($x+28+30, $y);
 $zc=strlen($CPU);

$space=substr_count($CPU, ' ');
$myspace='';
if ($zc<27)
 {
  $pdf->MultiCell(99,24,$CPU,1,'C',False);
}
elseif($zc<50)
{

  $pdf->MultiCell(99,24,$CPU,1,'C',False);
 
}
elseif($zc<60)
{

  $pdf->MultiCell(99,12,$CPU,1,'C',False);
 
}
elseif($zc>100)
{

$pdf->MultiCell(99,12,$CPU,1,'C',False);
 
}
else
 {
  $pdf->MultiCell(99,12,$CPU,1,'C',False);
}
// $y = $pdf->GetY();
// $x = $pdf->GetX();
$pdf->SetXY($x+47+28+30, $y);
//  $z=strlen($SerialNo);
// if ($z<15)
//  {
//   $pdf->MultiCell(28,24,$SerialNo,1,'C',False);
  
// }
// elseif($z<30)
// {$pdf->MultiCell(28,12,$SerialNo,1,'C',False);
 
// }
// elseif($z<45)
// {$pdf->MultiCell(28,8,$SerialNo,1,'C',False);
 
// }
// else
// {
//   $pdf->MultiCell(28,4,$SerialNo,1,'C',False);
// }
$pdf->SetXY($x+28+47+28+30,$y);

 // $pdf->MultiCell(47,24,$SerialNo,1,'C',False);
//  $z=strlen($Device);
// if ($z<15)
//  {
//   $pdf->MultiCell(24,24,$Device,1,'C',False);
  
// }
// elseif($z<30)
// {$pdf->MultiCell(24,12,$Device,1,'C',False);
 
// }
// elseif($z<45)
// {$pdf->MultiCell(24,8,$Device,1,'C',False);
 
// }
// else
// {
//   $pdf->MultiCell(24,4,$Device,1,'C',False);
// }

 // $pdf->Cell(24,24,$Device,1,0,'C',0);

$pdf->SetXY($x+28+47+28+30+24,$y);
 $pdf->Cell(21,24,$IssueDate,1,0,'C',0);
  $y=$y+24;
// }
}
}

$pdf->Output();
?>
