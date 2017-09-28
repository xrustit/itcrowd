<div id="footer" style=" padding-bottom: 70px; ">
    <div class="container" style=" padding: 20px; ">
        <div class="col-md-8">
            <p class="text-muted credit"><small>Redone by <a href="mailto:xrustit@gmail.com">R.Kashapov</a> (с) 2016.</p>
            </small>
        </div>
        <?php


        if (priv_status($_SESSION['helpdesk_user_id']) == "0") {$pri="куратор";}
        if (priv_status($_SESSION['helpdesk_user_id']) == "1") {$pri="користувач";}
        ?>
        <div class="col-md-4">

        </div>
    </div>
</div>
<?php if ($lang == "ua") {$lang = "uk"; }?>
<script type="text/javascript">
    var MyHOSTNAME = "<?php echo $CONF['hostname']; ?>";
    var MyLANG = "<?php echo $lang; ?>";
</script>
<script src="<?=$CONF['hostname']?>js/jquery-1.11.0.min.js"></script>
<script src="<?=$CONF['hostname']?>js/bootstrap/js/bootstrap.min.js"></script>

<script src="<?=$CONF['hostname']?>js/jquery-ui-1.10.4.custom.min.js"></script>
<script src="<?=$CONF['hostname']?>js/jquery.ui.autocomplete.js"></script>
<script src="<?=$CONF['hostname']?>js/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<script src="<?=$CONF['hostname']?>js/chosen.jquery.min.js"></script>
<script src="<?=$CONF['hostname']?>js/s2/select2.min.js"></script>
<script src="<?=$CONF['hostname']?>js/bootstrap-paginator.js"></script>
<script src="<?=$CONF['hostname']?>js/jquery.autosize.min.js"></script>
<script src="<?=$CONF['hostname']?>js/jquery.noty.packaged.min.js"></script>
<script src="<?=$CONF['hostname']?>js/ion.sound.min.js"></script>
<script src="<?=$CONF['hostname']?>js/jquery.multi-select.js"></script>
<script src="<?=$CONF['hostname']?>js/moment.min.js"></script>
<script src="<?=$CONF['hostname']?>js/daterangepicker.js"></script>
<script src="<?=$CONF['hostname']?>js/summernote.min.js"></script>
<script src="<?=$CONF['hostname']?>js/summernote-lang.js"></script>
<script src="<?=$CONF['hostname']?>js/jquery.titlealert.js"></script>
<script src="<?=$CONF['hostname']?>js/highcharts.js"></script>
<script src="<?=$CONF['hostname']?>js/bootbox.min.js"></script>
<script src="<?=$CONF['hostname']?>js/moment-with-langs.js"></script>
<script src="<?=$CONF['hostname']?>js/jquery.ui.autocomplete.scroll.min.js"></script>

<!-- jPList Core -->		
<link href="<?=$CONF['hostname']?>js/jplist/css/jplist.core.min.css" rel="stylesheet" type="text/css" />
<script src="<?=$CONF['hostname']?>js/jplist/js/jplist.core.min.js"></script>

<!-- jplist bootstrap pagination bundle -->			
<script src="<?=$CONF['hostname']?>js/jplist/js/jplist.bootstrap-pagination-bundle.min.js"></script>
	
<!-- Pagination Bundle -->			
<link href="<?=$CONF['hostname']?>js/jplist/css/jplist.pagination-bundle.min.css" rel="stylesheet" type="text/css" />
<script src="<?=$CONF['hostname']?>js/jplist/js/jplist.pagination-bundle.min.js"></script>

<!-- jPList textbox filter control -->
<link href="<?=$CONF['hostname']?>js/jplist/css/jplist.textbox-filter.min.css" rel="stylesheet" type="text/css" />
<script src="<?=$CONF['hostname']?>js/jplist/js/jplist.textbox-filter.min.js"></script>

<link href="<?=$CONF['hostname']?>js/jplist/css/jplist.history-bundle.min.css" rel="stylesheet" type="text/css" />
<script src="<?=$CONF['hostname']?>js/jplist/js/jplist.history-bundle.min.js"></script>


<!-- sort bundle -->
<script src="<?=$CONF['hostname']?>/js/jplist/js/jplist.sort-bundle.min.js"></script>



<!-- jPList toggle bundle -->
<script src="<?=$CONF['hostname']?>/js/jplist/js/jplist.filter-toggle-bundle.min.js"></script>
<link href="<?=$CONF['hostname']?>/js/jplist/css/jplist.filter-toggle-bundle.min.css" rel="stylesheet" type="text/css" />
<!-- jPList preloader control -->
<script src="<?=$CONF['hostname']?>/js/jplist/js/jplist.preloader-control.min.js"></script>
<link href="<?=$CONF['hostname']?>/js/jplist/css/jplist.preloader-control.min.css" rel="stylesheet" type="text/css" />

<!-- Handlebars Templates Library: http://handlebarsjs.com -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/handlebars.js/2.0.0-alpha.4/handlebars.min.js"></script>
<!-- handlebars template -->
<script id="jplist-template" type="text/x-handlebars-template">
   {{#each this}}
   
                 
      <div class="tbl-item box">	
                        
         <div class="block right">
            <p class="title">{{subj}}</p>
            <p class="desc">{{client_id}}</p>
         </div>
      </div>
                                      
   
   {{/each}}
</script>	


<!-- FOR UPLOADER -->
<?php if ($CONF['file_uploads'] == "true") { ?>
<script src="<?=$CONF['hostname']?>js/tmpl.min.js"></script>
<script src="<?=$CONF['hostname']?>js/load-image.min.js"></script>
<script src="<?=$CONF['hostname']?>js/canvas-to-blob.min.js"></script>
<script src="<?=$CONF['hostname']?>js/jquery.fileupload.js"></script>
<script src="<?=$CONF['hostname']?>js/jquery.fileupload-ui.js"></script>
<script src="<?=$CONF['hostname']?>js/jquery.fileupload-process.js"></script>
<script src="<?=$CONF['hostname']?>js/jquery.fileupload-image.js"></script>
<script src="<?=$CONF['hostname']?>js/jquery.fileupload-validate.js"></script>
<?php } ?>
<!-- FOR UPLOADER -->


<script src="<?=$CONF['hostname']?>/js/core.js"></script>

</body>
</html>
