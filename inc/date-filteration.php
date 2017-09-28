<?php
session_start();
//error_reporting(E_ALL);
include("../functions.inc.php");

	require_once("../classes/xlsxwriter.php");	
	$writer = new XLSXWriter();
	
	$tdate = date("Y-m-d");

   //define("HOST", "localhost"); //Define a hostname
   //define("USER", "root");      //Define a username
   //define("PASSWORD", "");		//Define a password
   //define("DB", "zayavka");  //Define a database

   //$con = mysqli_connect(HOST, USER, PASSWORD, DB) OR DIE("Error in  connecting DB : " . mysqli_connect_error());  //Database connection
	
	if((!empty($_POST['startDate'])&&(!empty($_POST['endDate'])))) {	// Check whether the date is empty			
		$startDate = date('Y-m-d H:i:s',strtotime($_POST['startDate']));
		$endDate = date('Y-m-d H:i:s',strtotime($_POST['endDate']));

		
/* 		$result = mysqli_query($con,'SELECT t.id, c.fio as client, c.unit_desc, c.adr, t.subj, t.date_create, t.ok_by, u.fio, t.user_init_id, t.user_to_id, d.name, c.posada, t.ok_date
from tickets as t, clients as c, users as u, deps as d
where t.client_id = c.id and t.ok_by=u.id and t.unit_id=d.id and t.date_create BETWEEN  "'.$startDate.'" and "'.$endDate.'"');  */

	$stmt = $dbConnection->prepare('SELECT t.id, c.fio as client, c.unit_desc, c.adr, t.subj, t.date_create, t.ok_by, u.fio, t.user_init_id, t.user_to_id, d.name, c.posada, t.ok_date
	from tickets as t, clients as c, users as u, deps as d
	where t.client_id = c.id and t.ok_by=u.id and t.unit_id=d.id and t.date_create BETWEEN  "'.$startDate.'" and "'.$endDate.'"+ INTERVAL 1 DAY + INTERVAL -1 SECOND');

    $stmt->execute();
    $res = $stmt->fetchAll();
	var_dump($stmt);
	
						$sheet_name = 'zayavka';
						$header = array('Заявка(ID)'=>'integer','Клиент'=>'string','Район'=>'integer','Договор'=>'string','Тема заявки'=>'string','Дата создания'=>'datetime','Кто закрыл(ID)'=>'integer','Кто закрыл(ФИО)'=>'string','Кто заводил(ФИО)'=>'string','Исполнитель'=>'string','Отдел'=>'string','Сельсовет'=>'string','Дата закрытия'=>'datetime');	
						$st3 = array(['font-style'=>'bold']);				
						$writer->writeSheetHeader($sheet_name, $header); //шапка xls файла 	

		//$num_rows = mysqli_num_rows($res); //Check whether the result is 0 or greater than 0.
		//if($num_rows > 0){
			//$str = '<div class="media">';
			//$i = 0;
			foreach($res as $row) {
				 $i++;
    		//while($row = mysqli_fetch_array($res,MYSQLI_ASSOC)){  //Fetching the data from the database
/* 				$str.='<div class="well">
				<div class="row">
				<div class="col-sm-8">
				<a class="pull-left" href="#">
				
					</a><div class="media-body">                                 
					<p id="cname"><strong>'.$row['id'].'</strong></p> 
					<p><strong>ISO Code :</strong>'.$row['client'].'</p>
					<p><strong>ISD Code :</strong>'.$row['unit_desc'].'</p>
					
					</div></div>
					<div class="col-sm-4"><p class="pull-right"><strong>Created Date: </strong>'.$row['adr'].'</p></div>
					</div></div><hr>'; */
					$writer->writeSheetRow($sheet_name, array($row['id'],$row['client'],$row['unit_desc'],$row['adr'],$row['subj'],$row['date_create'],$row['ok_by'],$row['fio'],$row['user_init_id'],$row['user_to_id'],$row['name'],$row['posada'],$row['ok_date'])); //заполняем массив	
			}
			//$str.= '</div>';
			//echo $str;
			echo '<br />Количество выполненных заявок за период с '.$startDate.' по '.$endDate.' : <strong>'.$i.'</strong><br />';
			//echo '<br /> '.sizeof($res);
			//echo '<br /> '.count($res);
			
			$writer->writeToFile('../reports/zayavka_'.$tdate.'.xlsx'); //пишем файл
			//print($_POST['startDate']);
		//}else{
		//	echo '<div class="well well-large well-transparent lead"><center>Нет записей</center></div>';	
		//}
		//header('Location: report.php');
		//unset($_POST['startDate']);
		//unset($_POST['endDate']);
		
	} /* else {
		echo '<div class="well well-large well-transparent lead"><center>Нет записей</center></div>';
	} */
