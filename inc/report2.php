<?php
session_start();
include("../functions.inc.php");

if (validate_user($_SESSION['helpdesk_user_id'], $_SESSION['code'])) {
if (validate_admin($_SESSION['helpdesk_user_id'])) {
   include("head.inc.php");
   include("navbar.inc.php");
   
   	// load the libmail class
	require_once("classes/libmail.php");
	// load the XLSXWriter class
	require_once("classes/xlsxwriter.php");

	$writer = new XLSXWriter();
	$m = new Mail; 	
    $mdate = $_POST['mdate'];

			?>



<div class="container">
	<div class="page-header" style="margin-top: -15px;">
		<h3 ><i class="fa fa-users"></i> <?=lang('REPORT_title');?></h3>
	</div>
 
    <div class="row">
		<div class="col-md-3">
			<div class="alert alert-info" role="alert">
				<small>
				<i class="fa fa-info-circle"></i> 
				<?=lang('REPORT_info');?>
			  </small>
			</div>
			
			
			<div class="row butts">

				<div class='col-md-12'>
        			<form method="post">
        				<button type="submit" name="sendot" type="button" class="btn btn-info vivod btn-sm btn-block">
        					<span class="glyphicon glyphicon-list-alt" ></span> Заявки
        				</button>					
        			</form>
    			</div>
    			<div class='col-md-12'>
        			<form method="post">
        				<button type="submit" name="bclient" type="button" class="btn btn-success btn-sm btn-block">
        					<span class="glyphicon glyphicon-user" ></span> Клиенты
        				</button>					
        			</form>
    			</div>  
				
            </div>			
			
		</div>
		<div class="col-md-9" id="content_worker">
		
<div class="col-md-4 col-md-offset-4 demo">
            <h4>Select the date to filter records</h4>
            <input type="text" id="config-demo" class="form-control placeholded">
            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
		
</div>
	

                <?php
				$tdate = date("Y-m-d");  //2017-07-13 00:00:00 .$tdate.

 ?>
 <!---->
                     <table class="table table-bordered table-hover" style=" font-size: 14px; " id="table_">
                        <thead>
                        <tr>
                            <th><center><?=lang('APPROVE_info');?></center></th> 

                            <th><center><?=lang('REPORT_client');?></center></th> 
                            <th><center><?=lang('REPORT_raion');?></center></th> 
                            <th><center><?=lang('REPORT_dogovor');?></center></th> 
                            <th><center><?=lang('REPORT_themez');?></center></th> 
                            <th><center><?=lang('REPORT_opendate');?></center></th> 
                            <th><center><?=lang('REPORT_idclosed');?></center></th> 
                            <th><center>Кто закрыл</center></th> 
					
                            <th><center><?=lang('REPORT_zavodil');?></center></th> 
                            <th><center><?=lang('REPORT_isp');?></center></th> 
                            <th><center><?=lang('REPORT_otdel');?></center></th> 
                            <th><center><?=lang('REPORT_cname');?></center></th> 
                            <th><center><?=lang('REPORT_closedate');?></center></th> 
                        </tr>
                        </thead>
                        <tbody>

					<?php
					
					
					
 				if( isset( $_POST['sendot'] ) )
					{ 
				var_dump($_POST['startDate']);
					echo $_POST['endDate'];
					}
						$sheet_name = 'zayavka';
						$header = array('Заявка(ID)'=>'integer','Клиент'=>'string','Район'=>'integer','Договор'=>'string','Тема заявки'=>'string','Дата создания'=>'datetime','Кто закрыл(ID)'=>'integer','Кто закрыл(ФИО)'=>'string','Кто заводил(ФИО)'=>'string','Исполнитель'=>'string','Отдел'=>'string','Сельсовет'=>'string','Дата закрытия'=>'datetime');	
						$st3 = array(['font-style'=>'bold']);				
						$writer->writeSheetHeader($sheet_name, $header); //шапка xls файла 		

												


	if((!empty($_POST['startDate'])&&(!empty($_POST['endDate'])))) {	// Check whether the date is empty			
		$startDate = date('Y-m-d',strtotime($_POST['startDate']));
		$endDate = date('Y-m-d',strtotime($_POST['endDate']));
		
$stmt = $dbConnection->prepare('SELECT t.id, c.fio as client, c.unit_desc, c.adr, t.subj, t.date_create, t.ok_by, u.fio, t.user_init_id, t.user_to_id, d.name, c.posada, t.ok_date
from tickets as t, clients as c, users as u, deps as d
where t.client_id = c.id and t.ok_by=u.id and t.unit_id=d.id and t.date_create BETWEEN  "'.$startDate.'" and "'.$endDate.'"');  // Execute the query
	

                $stmt->execute();
                $res1 = $stmt->fetchAll();
				var_dump($res1);		
					
										
					
				foreach($res1 as $row) {
					
                    ?>


                        <tr>						
				
                            <td><small><?=$row['id'];?></small></td>

                            <td><small><?=$row['client'];?></small></td>
                            <td><small><?=$row['unit_desc'];?></small></td>
                            <td><small><?=$row['adr'];?></small></td>
                            <td><small><?=$row['subj'];?></small></td>
                            <td><small><?=$row['date_create'];?></small></td>
                            <td><small><?=$row['ok_by'];?></small></td>
                            <td><small><?=$row['fio'];?></small></td>
                            <td><small><?=$row['user_init_id'];?></small></td>
                            <td><small><?=$row['user_to_id'];?></small></td>
                            <td><small><?=$row['name'];?></small></td>
                            <td><small><?=$row['posada'];?></small></td>	
                            <td><small><?=$row['ok_date'];?></small></td>								
                        </tr>

                <?php
					$writer->writeSheetRow($sheet_name, array($row['id'],$row['client'],$row['unit_desc'],$row['adr'],$row['subj'],$row['date_create'],$row['ok_by'],$row['fio'],$row['user_init_id'],$row['user_to_id'],$row['name'],$row['posada'],$row['ok_date'])); //заполняем массив	
                

		
				
				}

			} else {				
				echo 'No record found';
				echo $startDate.'-'.$endDate;
			} 


			
				//$writer->writeToFile('zayavka_'.$tdate.'.xlsx'); //пишем файл
				
/* 				} sendot */
                /* } */
                ?>
				


        </div>

    </div>
	<br /> 


</div>
<?php
 include("footer.inc.php");
?>

<?php
	}
	}
else {
    include 'auth.php';
}
?>