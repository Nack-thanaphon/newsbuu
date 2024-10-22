<?php

		$save_log=$this->model->insertData(array("table"=>"website_log","field"=>array("user_id"=>$_SESSION['ss_usercode'],"status"=>2,"create_at"=>date("Y-m-d H:i:s"))));
		if(!empty($save_log)){
			unset($_SESSION['ss_userid']);
			unset($_SESSION['ss_usercode']);
			unset($_SESSION['ss_userauth']);
			$this->xFunction->xRedirect($this->baseurl->backend->module->user->login);
		}
?>
