<input type="hidden" id="main_last_new_ticket" value="<?= get_last_ticket_new($_SESSION['helpdesk_user_id']); ?>">

<div class="container">
    <div class="page-header" style="margin-top: -15px;">
        <h3><i class="fa fa-tachometer"></i> <?= lang('DASHBOARD_TITLE'); ?></h3>
    </div>
 
 
    <div class="col-md-12">
    
               <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-bullhorn"></i> <?= lang('DASHBOARD_last_news'); ?></div>
                <div class="panel-body">

                    <div id="last_news" style="max-height:600px;scroll-behavior:initial;overflow-y:scroll;"></div>

                </div>
            </div>    
    </div>


</div>
        

