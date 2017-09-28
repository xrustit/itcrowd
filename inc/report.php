<?php
session_start();
//error_reporting(E_ALL);
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

	$today = date("Y-m-d");	
	
	$stmt1 = $dbConnection->prepare('select * from clients');

	$stmt1->execute();
    $res2 = $stmt1->fetchAll();
	//var_dump($stmt1);
	
			if(isset($_POST['sendot']))
				{
					$dir = '/reports';
					//if ([] === (array_diff(scandir($dir), array('.', '..')))) {		//проверка на наличие файлов в папке, в т.ч. скрытых	
						$m->From( "itcrowd@alpufa.ru" ); // от кого отправляется почта 
						$m->To( "ruslan261186@gmail.com" ); // кому адресованно
						//$m->To( "xrustit@gmail.com",'xrustit' );	
                                                $m->Cc( "alpufa@mail.ru ");	
						$m->Cc( "ranis-khasanov@mail.ru ");							
						$m->Subject( "Отчеты за месяц itcrowd" );
						//$m->Body( "" );    
						$m->Bcc( "xrustit@gmail.com"); // копия письма отправится по этому адресу
						//$m->Bcc( ""); // скрытая копия отправится по этому адресу
						$m->Priority(3) ;    // приоритет письма
						$m->Attach( 'reports/zayavka_'.$today.'.xlsx', '', '', 'attachment') ; // прикрепленный файл 
						$m->Attach( 'reports/clients_'.$today.'.xlsx', '', '', 'attachment') ; // прикрепленный файл2 
						//$m->Attach( "1.jpg", "", "image/jpeg", "attachment");
						//$m->smtp_on( "smtp.asd.com", "login", "password" ) ; // если указана эта команда, отправка пойдет через SMTP 
						$m->log_on(true);
						$m->Send();    // а теперь пошла отправка
                        
						echo '<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Письмо отправлено!</div>';
						//echo "Показывает исходный текст письма:<br><pre>", $m->Get(), "</pre>";						
						//unlink('otchet_'.$_SESSION['user_name'].'.xlsx'); //после отправки почты удаляем файл
							
				//	} else {
				//		echo '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Внимание!</strong> директория пуста!</div>';
				//	}
				}	
			
				if( isset($_POST['bclient']) )
					{
						$sheet_name = 'clients';
						$header = array('ID'=>'integer','Клиент'=>'string','Тел-1'=>'string','Тел-2'=>'string','Тел-3'=>'string','Район'=>'string','Email-1'=>'string','Email-2'=>'string','Email-3'=>'string','Код'=>'string','Сайт'=>'string','Наименование'=>'string','Регион'=>'string');	
						$st3 = array(['font-style'=>'bold']);				
						$writer->writeSheetHeader($sheet_name, $header); //шапка xls файла 											
					
										
					
				foreach($res2 as $row) {
					$writer->writeSheetRow($sheet_name, array($row['id'],$row['fio'],$row['tel'],$row['tel2'],$row['tel3'],$row['adr'],$row['email'],$row['email2'],$row['email3'],$row['cod'],$row['site'],$row['posada'],$row['region'])); //заполняем массив	
                }
				$writer->writeToFile('reports/clients_'.$today.'.xlsx'); //пишем файл
				
				}	
?>


      <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

	  
	<style type="text/css">
	 .demo { position: relative; }
      .demo i {
        position: absolute; bottom: 10px; right: 24px; top: auto; cursor: pointer;
      }
      
	</style>


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
        				<button type="submit" name="bclient" type="button" class="btn btn-success btn-sm btn-block">
        					<span class="glyphicon glyphicon-user" ></span> Клиенты
        				</button>					
        			</form>
    			</div>  			
				<br />
				<div class='col-md-12'>
        			<form method="post">
        				<button type="submit" name="sendot" type="button" class="btn btn-info vivod btn-sm btn-block">
        					<span class="glyphicon glyphicon-list-alt" ></span> Отправить на ящик
        				</button>					
        			</form>
    			</div>

				
            </div>			
			
		</div>
		<div class="col-md-9" id="content_worker">

 
		<div class="_container" >
			<div class="row">
				<h3 class="text-center"></h3>
				<div class="col-lg-1 col-md-1 col-sm-1"></div>
				<div class="col-lg-10 col-md-10 col-sm-10">
						<div class="col-md-4 _col-md-offset-4 demo">
							<h4>Выберите дату выгрузки заявок</h4>
							<input type="text" id="config-demo" class="form-control">
							<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
						</div>
				</div>		  
			</div>
			<div class="col-lg-1 col-md-1 col-sm-1"></div>
		</div>
		<hr>
		
		<div class="col-lg-1 col-md-1 col-sm-1"></div>
		<div class="col-lg-10 col-md-10 col-sm-10">
			<div class="loader text-center" style="display:none"><img src="img/loading.gif"></div>
			<div class="response"></div>
		</div>
		<div class="col-lg-1 col-md-1 col-sm-1"></div>




    

		<script type="text/javascript">
  $(document).ready(function() {

       

        $('.demo i').click(function() {
          $(this).parent().find('input').click();
        });

      

        updateConfig();

        function updateConfig() {
          var options = {};
		  options.opens = "center";
options.ranges = {
            'Сегодня': [moment(), moment()],
            'Вчера': [moment().subtract('days', 1), moment().subtract('days', 1)],
            'За неделю': [moment().subtract('days', 6), moment()],
            'За 30 дней': [moment().subtract('days', 29), moment()],
            'За месяц': [moment().startOf('month'), moment().endOf('month')],
            'Прошлый месяц': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
            };
    
          $('#config-demo').daterangepicker(options, function(start, end, label) { 
		  var startDate = start.format('YYYY-MM-DD'); var endDate = end.format('YYYY-MM-DD');
		  passDate(startDate,endDate);
		  //console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
		  
		   });
          
        }

      });

function passDate(startDate,endDate) {
    $('.loader').show();
    //date = d.getFullYear() + '-' + (d.getMonth() + 1) + '-' + d.getDate();
    $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: '/inc/date-filteration.php', // the url where we want to POST
            data: 'startDate='+startDate+'&endDate='+endDate, // our data object
        })
        // using the done promise callback
        .done(function(data) {
            $('.loader').hide();
            // log data to the console so we can see
            $('.response').html(data);
            // here we will handle errors and validation messages
        });
}

		</script>

        </div>

    </div>



</div>			
		
<?php
 include("footer-report.inc.php");
?>

<?php
	}
	}
 else {
    include 'auth.php';
} 
?>