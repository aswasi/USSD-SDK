<?php

class Model_Partners extends Zend_Db_Table_Abstract
{
	protected $_name = 'organizations';
	
	public function addData($data){
                   $row = $this->createRow();
				   
				   $row->guid = uniqid('acild-');
				   
                   $row->setFromArray($data);
                   //save the new row
                   return $row->save();
           }
	
	public function updateData($id, $data)
		 {
			
			$select = $this->select()
						->where('id=?',$id);
			$rows= $this->fetchAll($select);
			if(!empty($rows)){
				foreach ($rows as $row) {
				$row->setFromArray($data);
				//save the new row
				return $row->save();
				}
				return TRUE;
			}else{
				return FALSE;
			}
	       
		 }
		 
		  public function fetchData(){
		 	$select = $this->select()
					->where('deleted=?',0)
					->where('type=?','player')
					->order('dateregistered DESC');
			return $this->fetchAll($select);
		 }
	  
	  public function fetchDataByGuid($guid){
	  	$select = $this->select()
				->where('guid=?',$guid);
		return $this->fetchRow($select);
	  }
	  
	   public function fetchDataById($id){
	  	$select = $this->select()
				->where('id=?',$id);
		return $this->fetchRow($select);
	  }
	   
	   
	   
	   public function partnerCount(){
		 	$select = $this->select()
				->where('deleted=?',0);
			$partners =  $this->fetchAll($select);
			
			if($partners){
				$partnersarray  = $partners->toArray();
				return count($partnersarray)-1;
			}else{
				return 0;
			}
		 }
		  
		  
}

