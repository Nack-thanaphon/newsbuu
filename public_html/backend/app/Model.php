<?php

class Model {

	public $db;

	public function __construct($db)
  {
        $this->db = $db;
  }
	public function insertSQL($data)
	{
		$sql='';
		if(is_array($data)){
			 $sql.=' INSERT INTO '.$data['table'];
			 $field=array_keys($data['field']);
			  $sql.=' (';
			  for($i=0;$i<count($field);$i++){ if($i<count($field)-1){ $sql.= "`".$field[$i]."` ,"; }else{ $sql.=  "`".$field[$i]."`"; }}
		     $sql.=')';
			 $sql.=' VALUES ';
		     $value=array_values($data['field']);
			 $sql.='(';
			  for($i=0;$i<count($value);$i++){ if($i<count($value)-1){ $sql.= "'".$value[$i]."' ,"; }else{ $sql.= "'".$value[$i]."'"; }}
		     $sql.=');';
		}else{ $sql=''; }

		return $sql;

	}

	public function selectSQL($data)
	{
		 $sql='';
		  if(is_array($data)){
			if(!empty($data['table']) && !empty($data['field'])){
				  $sql.='SELECT '.$data['field'].' FROM '.$data['table'];
				  if(!empty($data['where'])){ $sql.=' WHERE '.$data['where']; }
				  if(!empty($data['group_by'])){ $sql.=' GROUP BY '.$data['group_by']; }
				  if(!empty($data['sort_by'])){ $sql.=' ORDER BY '.$data['sort_by']; }
				  if(!empty($data['limit'])){ $sql.=' LIMIT '.$data['limit']; }
			}else{
				  $sql='';
			}
		  }else{
				  $sql='';
		  }

		  return $sql;
	}

	public function updateSQL($data)
	{
		$sql='';
		if(is_array($data)){
			 $sql.=' UPDATE '.$data['table'].' SET ';
			 if(is_array($data['field'])){
			 	$keys=array_keys($data['field']);
				$value=array_values($data['field']);
				for($i=0;$i<count($keys);$i++){ if($i<count($keys)-1){$sql.= $keys[$i]."='".$value[$i]."' ,"; }else{ $sql.= $keys[$i]."='".$value[$i]."'"; }}
			 }
			 if(!empty($data['where'])){ $sql.=' WHERE '.$data['where']; }
		}else{ $sql=''; }

		return $sql;

	}

	public function deleteSQL($data)
	{
		 $sql='';
		  if(is_array($data)){
			if(!empty($data['table']) && !empty($data['where'])){
				  $sql.='DELETE FROM '.$data['table'];
				  if(!empty($data['where'])){ $sql.=' WHERE '.$data['where']; }
			}else{ $sql='';	}
		  }else{ $sql=''; }

		  return $sql;

	}

	public function insertData($setData)
	{
		 $query=$this->insertSQL($setData);
		 if(!empty($query)){ $data=$this->db->query_last_id($query); }else{ $data=''; }
		 return $data;
	}//insertData

	public function getDataList($setData)
	{
		 $query=$this->selectSQL($setData);
		 if(!empty($query)){
			  $select= $this->db->query($query);
			  if($this->db->num_rows($select)>0){
				  while($result=$this->db->fetch_array_assoc($select)){ $data[]= $result; }
			  }else{ $data=''; }
		 }else{ $data='';}
		 return $data;
	}//getDataList

	public function getData($setData)
	{
		 $query=$this->selectSQL($setData);
		  if(!empty($query)){
			  $select= $this->db->query($query);
			  if($this->db->num_rows($select)>0){  $result=$this->db->fetch_array_assoc($select);  $data= $result; }else{ $data=''; }
		 }else{ $data='';}

		 return $data;

	}//getData

	public function getDuplicate($setData)
	{
		 $query=$this->selectSQL($setData);
		  if(!empty($query)){
			 $select= $this->db->query($query);
			 if($this->db->num_rows($select)>0){ $data=true;}else{ $data=false; }
		 }else{ $data=false; }

		 return $data;

	}//getDuplicate

	public function updateData($setData)
	{
		 $query=$this->updateSQL($setData);
		 if(!empty($query)){
				if(!$this->db->query($query)){	$data=false; }else{ $data=true; }
		 }else{ $data=false; }

		 return $data;

	}//updateData

	public function deleteData($setData)
	{
		 $query=$this->deleteSQL($setData);
		 if(!empty($query)){
				if(!$this->db->query($query)){ $data=false; }else{ $data=true; }
		 }else{ $data=false; }

		 return $data;

	}//deleteData


}

?>
