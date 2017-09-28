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


<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
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
		<div class="loader text-center" style="display:none"><img src="img/loading.gif"></div>
			<div class="col-md-4 col-md-offset-4 demo">
						<h4>Select the date to filter records</h4>
						<input type="text" id="config-demo" class="form-control placeholded">
						<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>					
			</div>	


        </div>

    </div>
	<br /> 


</div>
<?php
 include("_footer.inc.php");
?>
		<script type="text/javascript" src="../js/moment.min.js"></script>
		<script type="text/javascript" src="../js/daterangepicker.js"></script>
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
              'Today': [moment(), moment()],
              'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
              'Last 7 Days': [moment().subtract(6, 'days'), moment()],
              'Last 30 Days': [moment().subtract(29, 'days'), moment()],
              'This Month': [moment().startOf('month'), moment().endOf('month')],
              'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
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
            url: 'report.inc.php', // the url where we want to POST
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
<?php
	}
	}
else {
    include 'auth.php';
}
?>