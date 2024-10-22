<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$this->lang->sitename?> - <?=$this->lang->module->user->setPassword?></title>
    <link rel="stylesheet"  href="<?=$this->_assets?>font-awesome/font-awesome.min.css" />
    <link rel="stylesheet"  href="<?=$this->_assets?>custom/style.css" />
    <script src="<?=$this->_assets?>js/jquery-2.1.4.min.js" ></script>
</head>
<body>
// 	<!-- /plugins -->
<script src="<?=$this->plugins?>check/parsley_th.js" ></script>
<link rel="stylesheet"  href="<?=$this->plugins?>check/parsley.css" />
<script src="<?=$this->plugins?>content/autocomplete_off.js" ></script>

// 	<!-- /plugins -->
<div class="form">
  <div align="center"><h1><?=$this->lang->page->setPassword?></h1></div><br />
  <form name="frm" id="frm" method="post" class="login-form"  data-parsley-validate="">
    <div class="input_content"><label><?=$this->lang->label->username?>:</label><input type="text" id="username" name="username" value="<?=$getUsername?>" readonly   /></div>
    <div class="input_content"><label><?=$this->lang->label->new_password?>:</label><input type="password" id="password" name="password"  data-parsley-trigger="keyup" data-parsley-minlength="4" data-parsley-minlength-message="<?=$this->lang->alert->notify->pw_least8?>"  data-parsley-equalto="#password"  required="" /></div>
    <div class="input_content"><label><?=$this->lang->label->confirm_password?>:</label><input type="password" id="confirm_password" name="confirm_password" data-parsley-trigger="keyup"  data-parsley-equalto="#password" required="" /></div>
    <input type="hidden" id="uid" name="uid" value="<?=$_GET['uid']?>">
    <input type="hidden" id="identify" name="identify" value="<?=$_GET['identify']?>">
    <input type="hidden" id="csrf_token" name="csrf_token" value="<?=$this->nocsrf->generate('csrf_token')?>">
    <button name="submit" id="submit" type="submit"><span id="loading"><?=$this->lang->button->ok?></span></button>
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
					formData.append('action', 'change-password');
					formData.append('id',$("#uid").val());
          formData.append('identify',$("#identify").val());
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
