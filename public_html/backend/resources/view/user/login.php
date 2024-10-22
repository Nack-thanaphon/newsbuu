
<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$this->lang->sitename?> - <?=$this->lang->module->user->login?></title>
    <link rel="stylesheet"  href="<?=$this->_assets?>font-awesome/font-awesome.min.css" />
    <link rel="stylesheet"  href="<?=$this->_assets?>custom/style.css" />
    <script src="<?=$this->_assets?>js/jquery-2.1.4.min.js" ></script>
</head>
<body>
<!-- /plugins -->
<script src="<?=$this->plugins?>check/parsley_th.js" ></script>
<link rel="stylesheet"  href="<?=$this->plugins?>check/parsley.css" />
<script src="<?=$this->plugins?>content/autocomplete_off.js" ></script>
<script src="<?=$this->plugins?>content/block_copy.js" ></script>
<!-- /plugins -->
<div class="form">
  <div align="center"><h1><?=$this->lang->page->user_login?></h1></div><br />
  <form name="frm" id="frm" method="post" class="login-form"  data-parsley-validate="">
    <div class="input_content"><label><?=$this->lang->label->username?>:</label><input type="text" id="username" name="username" readonly
onfocus="this.removeAttribute('readonly');" required="" /></div>
    <div class="input_content"><label><?=$this->lang->label->password?>:</label><input type="password" id="password" name="password" required="" /></div>
    <input type="hidden" id="csrf_token" name="csrf_token" value="<?=$this->nocsrf->generate('csrf_token')?>">
    <button name="submit" id="submit" type="submit"><span id="loading"><i class="fa fa-sign-in"></i> <?=$this->lang->button->login?></span></button>
    <!--AJAX Message-->
    <div id="message"></div>
    <!--AJAX Message-->
   </form>
</div>
<script type="text/javascript">
	 $(function () {
		  $('#frm').parsley().on('field:validated', function() {
            var ok = $('.parsley-error').length === 0;
                $('.bs-callout-info').toggleClass('hidden', !ok);
                $('.bs-callout-warning').toggleClass('hidden', ok);
             })
          .on('form:submit', function() {
			  var formData = new FormData();
					formData.append('module', 'Service');
					formData.append('action', 'check-login');
					formData.append('username',$("#username").val());
					formData.append('password',$("#password").val());
					formData.append('csrf_token',$("#csrf_token").val());
				  $( "#loading").html('<i class="ace-icon fa fa-spinner fa-spin white bigger-130"></i> <?=$this->lang->alert->loading->please_wait?>...');
					$.ajax({
						url : "<?=$this->baseurl->backend->module->user->form?>",
						type: "POST",
						contentType: false,
						processData: false,
						data : formData,
						success: function(data, textStatus, jqXHR)
						{
							if(textStatus=='success'){
								$( "#message" ).html(data);
							}
							$( "#loading" ).html('<i class="fa fa-sign-in"></i> <?=$this->lang->button->login?>');
						},
						error: function (jqXHR, textStatus, errorThrown){	alert('Error!'); location.reload(); }
					});
			      return false;
          });
        });
</script>
</body>
</html>
