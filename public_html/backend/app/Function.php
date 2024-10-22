<?php

class xFunction {
  public $lang;
  public $mode;

	public function __construct($language,$mode)
	{
     $this->lang = $language;
     $this->mode = $mode;
  }
  public function metaTAG($url,$title,$overview,$img)
	{
		$html='';
    $html.='<link rel="canonical" href="'.$url.'" />';
    $html.='<meta property="og:title" content="'.$title.'" />';
    $html.='<meta property="og:type"  content="website" />';
    $html.='<meta property="og:url"  content="'.$url.'" />';
    $html.='<meta property="og:image"  content="'.$img.'" />';
    $html.='<meta property="og:site_name"  content="'.$this->lang->copyright.'" />';
    $html.='<meta property="og:description"  content="'.$overview.'" />';
    $html.='<meta name="twitter:card"  content="summary_large_image" />';
    $html.='<meta name="twitter:image"  content="'.$img.'" />';
    $html.='<meta name="twitter:title"  content="'.$title.'" />';
    $html.='<meta name="twitter:description" content="'.$overview.'" />';
    $html.='<meta name="twitter:url"  content="'.$url.'" />';
		return $html;
	}
  public function thaidate($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear";
	}
  public function check7DAYS($strDate)
	{
    $html='';
    if(!empty($strDate)){
      if( strtotime($strDate) > strtotime('-7 day') ) {
       $html='<span class="new">NEW</span>';
     }else{
       $html='';
     }
    }else{
      $html='';
    }
    return $html;
	}
	public function checkLEVEL($data){
		if(isset($data)){
			switch ($data) {
				case "1": return '<i class="ace-icon fa fa-user-circle-o" aria-hidden="true"></i> '.$this->lang->level->member; break;
        case "8": return '<i class="ace-icon fa fa-user-secret" aria-hidden="true"></i> '.$this->lang->level->admin; break;
				case "9": return '<i class="ace-icon fa fa-user-secret" aria-hidden="true"></i> '.$this->lang->level->admin; break;
				default: null;
			}
		}
	}
  public function icoLEVEL($data){
		if(isset($data)){
			switch ($data) {
				case "1": return '<i class="ace-icon fa fa-user-circle-o" aria-hidden="true"></i> '; break;
        case "8": return '<i class="ace-icon fa fa-user-secret" aria-hidden="true"></i> '; break;
				case "9": return '<i class="ace-icon fa fa-user-secret" aria-hidden="true"></i> '; break;
				default: null;
			}
		}
	}
  public function checkREADONLY($lavel){
    if(isset($lavel) && $lavel==9){
      return null;
    }else{
      return 'readonly';
    }
	}
	public function checkSTATUS($data){
		if(isset($data)){
			switch ($data) {
				case "0": return '<span class="red"><i class="ace-icon fa fa-circle"></i> '.$this->lang->status->disable; break;
				case "1": return '<span class="green"><i class="ace-icon fa fa-circle"></i> '.$this->lang->status->enabled; break;
				default: null;
			}
		}
	}
  public function checkICON($data){
		if(isset($data)){
			switch ($data) {
				case "1": return '<span class="green"><i class="ace-icon fa fa-check bigger-130"></i>'; break;
				default: null;
			}
		}
	}
	/*Check Sidebar Menu*/
	public function checkMENU($select,$module,$click=''){
    $exp=explode('|',$module);
    if(count($exp)>0){
		  if(in_array($select, $exp)) {
			  if(empty($click)){$data='class="active open"';}else{$data='';}
		  }else{
			$data='';
		  }
    }else{
      $data='';
    }
		return $data;
	}
	public function checkSUBMENU($select,$module,$tab,$page,$click=''){
    $exp=explode('|',$page);
    if(count($exp)>0){
      if(in_array($tab, $exp) && $select==$module) {
       if(empty($click)){$data='class="active"';}else{$data='';}
      }else{
       $data='';
      }
    }else{
      $data='';
    }
     return $data;
	}
	public function singleMENU($select,$module=''){
		if($select==$module){
			$data='class="active"';
		}else{
			$data='';
		}
		return $data;
	}
	/*Check Sidebar Menu*/
	/*NoCSRF*/
	public function resetToken($data){
		$jstext='';
		$jstext.='<script type="text/javascript">';
		$jstext.="$('#csrf_token').val(''); ";
		if(!empty($data)){ $jstext.="$('#csrf_token').val('".$data."'); "; }
		$jstext.='</script>';
		echo $jstext;
	}
	/*NoCSRF*/
  /*JS Script*/
	public function closeAlert(){
		$jstext='';
		$jstext.='<script type="text/javascript">';
		$jstext.=' $(".alert").alert("close"); ';
		$jstext.='</script>';
		echo $jstext;
	}
	public function setReload($var){
		$jstext='';
		$jstext.='<script type="text/javascript">';
		if(!empty($var)){ $jstext.=" $('".$var."').val(1); "; }
		$jstext.='</script>';
		echo $jstext;
	}
	public function setVar($attr,$var){
		$jstext='';
		$jstext.='<script type="text/javascript">';
		if(!empty($attr) && !empty($var)){ $jstext.=" $('#".$attr."').val('".$var."'); "; }
		$jstext.='</script>';
		echo $jstext;
	}
	public function pageReload($msg='',$url=''){
		$jstext='';
		$jstext.='<script type="text/javascript">';
		if(!empty($msg)){ $jstext.=" alert('".$msg."'); "; }
		if(empty($url)){ $jstext.=" location.reload(); "; }else{ $jstext.=" window.location='".$url."'; ";}
		$jstext.='</script>';
		echo $jstext;
	}
	public function jsRedirect($URL){
		$jstext='';
		$jstext.='<script type="text/javascript">';
		if(!empty($URL)){$jstext.=" window.location='".$URL."'; ";}
		$jstext.='</script>';
		echo $jstext;
	}
	public function xRedirect($URL){
		$redirect='';
		if(!empty($URL)){$redirect.=header('Location: '.$URL.'');}
		echo $redirect;
	}
	public function sAlert($msg,$addthis=''){
		$jstext='';
		$jstext.='<script type="text/javascript">';
		if(!empty($msg)){ $jstext.=" alert('".$msg."'); "; }
    if(!empty($addthis)){ $jstext.=$addthis; }
		$jstext.='</script>';
		echo $jstext;
	}
	public function xAlert($time){
		$jstext='';
		$jstext.='<script type="text/javascript">';
		if(!empty($time)){ $jstext.="window.setTimeout(function() { $( '.alert' ).hide(); }, ".$time.");"; }
		$jstext.='</script>';
		echo $jstext;
	}
	public function jsFocus($ID){
		$jstext='';
		$jstext.='<script type="text/javascript">$( document ).ready(function() {';
		if(!empty($ID)){ $jstext.="document.getElementById('".$ID."').focus();"; }
		$jstext.='});</script>';
		echo $jstext;
	}
	public function xFocus($ID){
		$jstext='';
		$jstext.='<script type="text/javascript">';
		if(!empty($ID)){ $jstext.='$("button.xclose").click(function(){  $(\'input[name="'.$ID.'"]\').focus()  });'; }
		$jstext.='</script>';
		echo $jstext;
	}
	public function resetFrm($name){
		$jstext='';
		$jstext.='<script type="text/javascript">';
		if(!empty($name)){ $jstext.="document.getElementById('".$name."').reset();"; }
		$jstext.='</script>';
		echo $jstext;
	}
	public function resetCKE($name){
		$jstext='';
		$jstext.='<script type="text/javascript">';
		if(!empty($name)){ $jstext.=" CKEDITOR.instances.".$name.".setData('');"; }
		$jstext.='</script>';
		echo $jstext;
	}
	public function resetVal($name){
		$jstext='';
		$jstext.='<script type="text/javascript">';
		if(!empty($name)){ $jstext.="  $('".$name."').val(''); "; }
		$jstext.='</script>';
		echo $jstext;
	}
	public function resetSLC($name){
		$jstext='';
		$jstext.='<script type="text/javascript">';
		//if(!empty($name)){ $jstext.=' $("'.$name.'").select2("val", ""); '; }
		if(!empty($name)){ $jstext.=' $("'.$name.'").val("").trigger("change"); '; }
		$jstext.='</script>';
		echo $jstext;
	}
	public function resetHtml($name){
		$jstext='';
		$jstext.='<script type="text/javascript">';
		if(!empty($name)){ $jstext.="  $('".$name."').html(''); "; }
		$jstext.='</script>';
		echo $jstext;
	}
	public function resetParsley($name){
		$jstext='';
		$jstext.='<script type="text/javascript">';
		if(!empty($name)){ $jstext.="$('".$name."').parsley().reset();"; }
		$jstext.='</script>';
		echo $jstext;
	}
  public function hideHTML($data){
		$jstext='';
		$jstext.='<script type="text/javascript">';
		if(!empty($data)){ $jstext.="  $('".$data."').hide(); "; }
		$jstext.='</script>';
		echo $jstext;
	}
	/*JS Script*/
 /*<<---Function CSS--->>*/
  public function cssAlert($type,$msg){
		if($type=='success'){
			$htmlcode='<div class="alert alert-block alert-success align-left alert_loading"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><p class="alert_overlay"><strong><i class="ace-icon fa fa-check"></i></strong> '.$msg.'<br></p></div>';
		}else if($type=='warning'){
			$htmlcode='<div class="alert alert-warning align-left alert_loading"><p class="alert_overlay"><strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></strong> '.$msg.'<br><button type="button" class="xclose" data-dismiss="alert">'.$this->lang->button->close.'</button></p></div>	';
		}else if($type=='error'){
			$htmlcode='<div class="alert  alert-danger align-left alert_loading"><p class="alert_overlay"><strong><i class="fa fa-times-circle" aria-hidden="true"></i></strong> '.$msg.'<br><button type="button"  class="xclose" data-dismiss="alert">'.$this->lang->button->close.'</button></p></div>	';
		}else if($type=='fail'){
			$htmlcode='<div class="alert  alert-danger align-left alert_loading"><p class="alert_overlay"><strong><i class="fa fa-times-circle" aria-hidden="true"></i></strong> '.$msg.'<br><button type="button"  class="xclose" data-dismiss="alert">'.$this->lang->button->close.'</button></p></div>	';
		}else{
			$htmlcode='';
		}
		echo $htmlcode;
	}
  public function resetPASS($data){
		if(isset($data)){
			if($data==1){  echo '<small class="grey">'.$this->lang->alert->notify->reset_password.'</small><br />'; }
		}
	}
  public function placeholder($data,$type=''){
		if($type=='span'){
			$htmlcode='<span class="place_upload">'.$this->lang->placeholder->$data.'</span>';
		}else if($type=='div'){
			$htmlcode='<div class="place_upload">'.$this->lang->placeholder->$data.'</div>';
		}else{
			$htmlcode='placeholder="'.$this->lang->placeholder->$data.'"';
		}
		echo $htmlcode;
	}
  public function showIMG($url,$width=''){
		if(!empty($url)){
      if(empty($width)){$width=200;}else{ $width=$width;}
			$htmlcode='<img src="'.$url.'" class="bordor" width="'.$width.'" />';
		}else{
			$htmlcode='';
		}
		echo $htmlcode;
	}
 /*<<---Function CSS--->>*/
 public function randcode($length,$lavel=''){
     $str_normal='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		 $str_number='0123456789';
		 $str_lower='abcdefghijklmnopqrstuvwxyz';
		 $str_upper='ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		 $str_special='.-+=_,!@$#*%[]{}';
		 if($lavel==1){
			 $textcode=$str_number.$str_upper;
		 }else if($lavel==2){
			 $textcode=$str_number.$str_lower.$str_upper;
		 }else if($lavel==3){
			 $textcode=$str_number.$str_lower.$str_upper.$str_special;
		 }else{
			 $textcode=$str_normal;
		 }
		 $charactersLength = strlen($textcode);
		 $randomString = "";
		 for ($i = 0; $i < $length; $i++) {
				$randomString .= $textcode[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
  public function htmlspec($text,$type=''){
		if($type==1){
			$data=htmlspecialchars($text,ENT_QUOTES);
		}else{
			$data=htmlspecialchars_decode($text);
		}
		return trim($data);
	}
  public function uploadIMG($files,$traget){
		 if($this->mode=='server'){
		 	$fp = move_uploaded_file($files,$traget);
			if(!empty($fp)){ return true;}else{ return false;	}
		}else if($this->mode=='local'){
			$fp = copy($files,$traget);
			if(!empty($fp)){ return true;}else{ return false;	}
		}else{ return false;	}
	}
  public function xEmpty($data)
	{
		if(is_array($data)){
			foreach ($data as $key => $value) {
				if (empty($value)) {
				   unset($data[$key]);
				}
			}
		}else{
			$data='';
		}
		return $data;
	}
	public function xDEL($fields,$data)
	{
		if(is_array($data)){
			$dString='';
			$d=1;
			foreach($data as $key=>$value){
				if($d<count($data)){
					$dString.=' '.$fields."='".$value."' OR";
				}else{
					$dString.=' '.$fields."='".$value."'";
				}
				$d++;
			}
		}else{
			$dString='';
		}
		return $dString;
	}
  public function autoCLICK($id){
		$jstext='';
		$jstext.='<script type="text/javascript">';
		if(!empty($id)){ $jstext.=' $("#'.$id.'").click(); '; }
		$jstext.='</script>';
		echo $jstext;
	}
  public function datetimeDB($datetime){
		if(!empty($datetime)){
      $exp_date=explode(' ',$datetime);
      $date=explode('/',$exp_date[0]);
      $datetime=$date[2].'-'.$date[1].'-'.$date[0].' '.$exp_date[1];
      $data=$datetime;
    }else{
      $data='';
    }
		return $data;
	}
  public function datetimeVIEW($datetime){
		if(!empty($datetime)){
      $exp_date=explode(' ',$datetime);
      $date=explode('-',$exp_date[0]);
      $datetime=$date[2].'/'.$date[1].'/'.$date[0].' '.$exp_date[1];
      $data=$datetime;
    }else{
      $data='';
    }
		return $data;
	}
  function resizeIMG($newWidth, $targetFile, $originalFile) {
    $info = getimagesize($originalFile);
    $mime = $info['mime'];
    switch ($mime) {
      case 'image/jpeg':
        $image_create_func = 'imagecreatefromjpeg';
        $image_save_func = 'imagejpeg';
        $new_image_ext = 'jpg';
        break;
      case 'image/png':
        $image_create_func = 'imagecreatefrompng';
        $image_save_func = 'imagepng';
        $new_image_ext = 'png';
        break;
      case 'image/gif':
        $image_create_func = 'imagecreatefromgif';
        $image_save_func = 'imagegif';
        $new_image_ext = 'gif';
        break;
      default:
        throw new Exception('Unknown image type.');
    }
    $img = $image_create_func($originalFile);
    list($width, $height) = getimagesize($originalFile);
    if($width>1170){
       $newHeight = ($height / $width) * $newWidth;
       $tmp = imagecreatetruecolor($newWidth, $newHeight);
       imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
       if (file_exists($targetFile)) {    unlink($targetFile);  }
       $image_save_func($tmp, $targetFile);
       unlink($originalFile);
    }else{
      if (file_exists($originalFile)) { copy($originalFile,$targetFile); }
      if (file_exists($targetFile)) {  unlink($originalFile);  }
    }
 }
 function getNANE($files) {
  if(!empty($files)){
    $info = pathinfo($files);
    $data =  basename($files,'.'.$info['extension']);
  }else{
    $data ='';
  }
  return $data;
 }
 public function stringOR($filed,$data)
	{
    if(!empty($data)){
     $exp=explode(',',$data);
		 if(is_array($exp)){
			 $dString='';
			 $d=1;
			 foreach($exp as $key=>$value){
				 if($d<count($exp)){
					 $dString.=' '.$filed."='".$value."' OR";
				 }else{
					 $dString.=' '.$filed."='".$value."'";
				 }
				 $d++;
			 }
		 }else{
			 $dString.=' '.$filed."='".$data."'";
		 }
   }else{
     $dString='';
   }
	 return $dString;
	}
  function page_navigator($before_p,$plus_p,$total_p,$check_page,$path){
	 $pPrev=$check_page;
	 $pPrev=($pPrev>=1)?$pPrev:1;
	 $pNext=$check_page+1;
	 $pNext=($pNext>=$total_p)?$total_p:$pNext;
	 $lt_page=$total_p-4;
	 if($total_p>=11){
		 if($check_page>=4){
		 	echo " <li $nClass ><a  href='".$path."page=1'>1</a></li><li class='SpaceC'>. . .</li>";
		 }
		 if($check_page<4){
			 for($i=1;$i<=$total_p;$i++){
				 $nClass=($check_page==$i)?"class='active'":"";
				 if($i<=4){
				 echo " <li $nClass ><a href='".$path."page=$i'>".intval($i)."</a></li>";
				 }
				 if($i==$total_p ){
				 echo "<li class='SpaceC'>. . .</li><li $nClass ><a href='".$path."page=$i'>".intval($i)."</a></li>";
				 }
			 }
		 }
		 if($check_page>=4 && $check_page<$lt_page){
			 $st_page=$check_page-3;
			 for($i=1;$i<=5;$i++){
				 $nClass=($check_page==($st_page+$i))?"class='active'":"";
				 echo " <li $nClass ><a  href='".$path."page=".intval($st_page+$i)."'>".intval($st_page+$i)."</a></li>";
			 }
			 for($i=1;$i<=$total_p;$i++){
				 if($i==$total_p ){
				 $nClass=($check_page==$i)?"class='active'":"";
				 echo "<li  class='SpaceC'>. . .</li><li  $nClass><a href='".$path."page=$i'>".intval($i)."</a></li>";
				 }
			 }
		 }
		 if($check_page>=$lt_page){
			 for($i=1;$i<=4;$i++){
				 $nClass=($check_page==($lt_page+$i))?"class='active'":"";
				 echo " <li  $nClass><a href='".$path."page=".intval($lt_page+$i)."'>".intval($lt_page+$i)."</a></li>";
			 }
		 }
	 }else{
	 	for($i=1;$i<=$total_p;$i++){
			 $nClass=($check_page==$i)?"class='active'":"";
			 echo " <li  $nClass ><a href='".$path."page=$i'  >".intval($i)."</a></li>";
		 }
	 }
 }
 function nav_arrow($type,$display='',$check_url='',$traget=''){
	$html='';
	$html_traget='';
	if(!empty($check_url)){ if(!empty($traget)){ $html_traget='target="_blank"';}else{ $html_traget=''; } }
	if($type=="left"){
		if($display=='disabled'){
			$html.='<a href="javascript:void(0)" class="click_arrow_left disabled"><i class="icons-arrow-left"></i></a>';
		}else{
			$html.='<a href="'.$check_url.'" '.$html_traget.'  class="click_arrow_left"><i class="icons-arrow-left"></i></a>';
		}
	}else if($type=="right"){
		if($display=='disabled'){
			$html.='<a href="javascript:void(0)" class="click_arrow_left disabled"><i class="icons-arrow-right"></i></a>';
		}else{
			$html.='<a href="'.$check_url.'" '.$html_traget.'  class="click_arrow_right"><i class="icons-arrow-right"></i></a>';
		}
	}else{
		$html='';
	}
	return $html;
 }
 function url_space($text){
	if(!empty($text)){
		$data=str_replace(' ','+',trim($text));
	}else{
		$data='';
	}
	return $data;
 }
 public function checkLOG($data){
   if(isset($data)){
     switch ($data) {
       case "1": return 'เข้าสู่ระบบ'; break;
       case "2": return 'ออกจากระบบ'; break;
       case "3": return 'โพสต์ข่าว'; break;
       case "4": return 'แก้ไขข่าว'; break;
       case "5": return 'ลบข่าว'; break;
       case "6": return 'เปิดข่าว'; break;
       case "7": return 'ปิดข่าว'; break;
       default: null;
     }
   }
 }
}//xFunction

?>
