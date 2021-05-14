<?php
class DbOperation
{
	private $connection;
	function __construct()
	{
		require_once('DbConnect.php');
		require_once("jdf2.php") ;
		/*include_once('header.php');
		require_once('../tools/object/random-generate-num.php') ;
		include_once("../tools/Classes/VerificationCode.php");*/
		$db=new DbConnect();
		$this->connection=$db->connect();
	}
	
	///////////////////////////////////////////////////////////////////////
	
	function getDate(){
		
		//-----------------------
		$date_up = jdate("Y-m-d",'','','','en');
		$time_up = jdate('H-i-s','','','','en');
		$date_miladi= date("Y-m-d");
		$date_time_miladi = $date_miladi.' '.$time_up;
		$date_now=$date_up.' '.$time_up;

		return $date_now;		
	}
	///////////////////////////////////////////////////////////////////////
	
	function visitReserve($client_code,$doctor_code,$date_visit,$time_visit_of,$time_visit_to){
		
		$connect2 = new DbConnect;
		//-----------------------
		$date_up = jdate("Y-m-d",'','','','en');
		$time_up = jdate('H-i-s','','','','en');
		$date_miladi= date("Y-m-d");
		$date_time_miladi = $date_miladi.' '.$time_up;
		//----------------------- Getting work_flow of doctor:
		/*$records=array();
		$output=$this->getApi('http://doctorsoffice.farahiin.ir/doctor/api/Api.php?apicall=getworkflow&doctor_code='.$doctor_code);		
		foreach ($output as $out) {
			$record=array();
			$record['doctor_code']=$out->doctor_code;
			$record['doctor_name']=$out->fname.' '.$out->lname;
			$record['doctor_day_of_week']=$out->day_of_week;
			$record['doctor_situ']=$out->situ;
			$record['doctor_time_of']=$out->time_of;
			$record['doctor_time_to']=$out->time_to;
			$record['doctor_slot_time']=$out->slot_time;
			array_push($records,$record);
		}*/
		$out_re=0;
		$date = new DateTime($date_visit);
		$day_number=$date->format( 'N' )+2;
		$output=$this->getApi('http://doctorsoffice.farahiin.ir/doctor/api/Api.php?apicall=checkworkflow&doctor_code='.$doctor_code.'&day_of_week='.$day_number.'&time='.$time_visit_of);
		if($output->status == 200 ){
			//--------------------------
			$sqlup="select * from `visit` WHERE `doctor_code`='".$doctor_code."' AND `date_visit`='".$date_visit."' AND (`time_visit_of`<= '".$time_visit_of."' AND `time_visit_to` >= '".$time_visit_of."') ";
			$qup=$connect2->query($sqlup);
			$helpup=mysqli_fetch_array($qup);
			if(empty($helpup['id'])){
				$sql="INSERT INTO `visit`( `client_code`, `doctor_code`, `date_visit`, `time_visit_of`, `time_visit_to`, `situation`, `date_time_submit`) VALUES 
				('".$client_code."' ,'".$doctor_code."' ,'".$date_visit."' ,'".$time_visit_of."', '".$time_visit_to."','0','".$date_time_miladi."') ";		
				$result = $connect2->query($sql);
				if($result)
					$out_re=1001;	
				else		
					$out_re=1002;
			}else{							
				$out_re=1003;
			}
		}else{
			$out_re=1004;
		}
		return $out_re;		
	}
	///////////////////////////////////////////////////////////////////////
	function searchListDoctors($city,$proficiency,$education){
		
		$records=array();
		$output=$this->getApi('http://doctorsoffice.farahiin.ir/doctor/api/Api.php?apicall=getlistdoctors&city='.$city.'&proficiency='.$proficiency.'&education='.$education);
		//print_r($output->data);
		foreach ($output->data as $out) {
			$record=array();
			$record['doctor_code']=$out->code;
			$record['doctor_name']=$out->fname.' '.$out->lname;
			$record['doctor_state']=$out->state;
			$record['doctor_city']=$out->city;
			$record['doctor_address']=$out->address;
			$record['doctor_proficiency']=$out->proficiency;
			$record['doctor_education']=$out->education;
			array_push($records,$record);
		}
		//------------------------------------------------------------
		return $records;
	}

	///////////////////////////////////////////////////////////////////////
	function searchDoctor($doctor_name,$medical_sys_num){
		
		$records=array();
		$output=$this->getApi('http://doctorsoffice.farahiin.ir/doctor/api/Api.php?apicall=getdoctor&doctor_name='.$doctor_name.'&medical_sys_num='.$medical_sys_num);
		foreach ($output->data as $out) {
			$record=array();
			$record['doctor_code']=$out->code;
			$record['doctor_name']=$out->fname.' '.$out->lname;
			$record['doctor_state']=$out->state;
			$record['doctor_city']=$out->city;
			$record['doctor_address']=$out->address;
			$record['doctor_proficiency']=$out->proficiency;
			$record['doctor_education']=$out->education;
			array_push($records,$record);
		}
		//------------------------------------------------------------
		return $records;
	}
	///////////////////////////////////////////////////////////////////////
	
	function updateUserInfo($client_code,$fname,$lname,$tell,$email,$state,$city,$address,$national){
		
		$connect2 = new DbConnect;
		//-----------------------
		$date_up = jdate("Y-m-d",'','','','en');
		$time_up = jdate('H-i-s','','','','en');
		$date_miladi= date("Y-m-d");
		$date_time_miladi = $date_miladi.' '.$time_up;
		//-----------------------
		$sqlup="select * from `clients` WHERE code='".$client_code."'";
		$qup=$connect2->query($sqlup);
		$helpup=mysqli_fetch_array($qup);
		if(empty($helpup['id'])){
			$sql="INSERT INTO `clients`( `code`, `fname`, `lname`, `tell`, `email`, `state`, `city`, `address`, `national`, `date_time_register`) VALUES 
			('".$client_code."' ,'".$fname."' ,'".$lname."' ,'".$tell."', '".$email."','".$state."','".$city."','".$address."','".$national."','".$date_time_miladi."') ";		
			$result = $connect2->query($sql);
			if($result)
				return true;			
			return false;
		}else{
			$sql="UPDATE `clients` SET  `fname`='".$fname."', `lname`='".$lname."', `tell`='".$tell."', `email`='".$email."', `state`='".$state."',
			`city`='".$city."', `address`='".$address."', `national`='".$national."'
			WHERE `code`='".$client_code."' ";		
			$result = $connect2->query($sql);
			if($result)
				return true;			
			return false;
		}

				
	}	

	///////////////////////////////////////////////////////////////////////
	function getWishlist($client_code){
		
		$connect2 = new DbConnect;
		$sql_1="SELECT * FROM wishlist WHERE `client_code`='".$client_code."' ORDER BY `id` DESC ";
		$result_1 = $connect2->query($sql_1);
		$comments=array();
		while($row1=mysqli_fetch_assoc($result_1)){

			$comment=array();
			$comment['id']=$row1['id'];
			$comment['client_code']=$row1['client_code'];
			$comment['doctor_code']=$row1['doctor_code'];
			$comment['date_time_submit']=$row1['date_time_submit'];
			//------------------------------------			
			$output=$this->getApi('http://doctorsoffice.farahiin.ir/api/Api.php?apicall=getcommentsdoctor&doctor_code=11');
			foreach ($output as $out) {
				//print_r($out);
				$comment['doctor_name']=$out->fname.' '.$out->lname;
			}
			//------------------------------------
			array_push($comments,$comment);
		}
		//------------------------------------------------------------
		return $comments;
	}

	///////////////////////////////////////////////////////////////////////
	function getCommentsDoctor($doctor_code){
		
		$connect2 = new DbConnect;
		$sql_1="SELECT * FROM comment WHERE `doctor_code`='".$doctor_code."' ORDER BY `id` DESC ";
		$result_1 = $connect2->query($sql_1);
		$comments=array();
		while($row1=mysqli_fetch_assoc($result_1)){

			$comment=array();
			$comment['id']=$row1['id'];
			$comment['client_code']=$row1['client_code'];
			$comment['doctor_code']=$row1['doctor_code'];
			$comment['title']=$row1['title'];
			$comment['caption']=$row1['caption'];
			$comment['situation']=$row1['situation'];
			$comment['date_time_submit']=$row1['date_time_submit'];
			array_push($comments,$comment);
		}
		//------------------------------------------------------------
		return $comments;
	}

	///////////////////////////////////////////////////////////////////////
	function getCommentsClient($client_code){
		
		$connect2 = new DbConnect;
		$sql_1="SELECT * FROM comment WHERE `client_code`='".$client_code."' ORDER BY `id` DESC ";
		$result_1 = $connect2->query($sql_1);
		$comments=array();
		while($row1=mysqli_fetch_assoc($result_1)){

			$comment=array();
			$comment['id']=$row1['id'];
			$comment['client_code']=$row1['client_code'];
			$comment['doctor_code']=$row1['doctor_code'];
			$comment['title']=$row1['title'];
			$comment['caption']=$row1['caption'];
			$comment['situation']=$row1['situation'];
			$comment['date_time_submit']=$row1['date_time_submit'];
			array_push($comments,$comment);
		}
		//------------------------------------------------------------
		return $comments;
	}
///////////////////////////////////////////////////////////////////////	

	function addToWishlist($client_code,$doctor_code){
		
		$connect2 = new DbConnect;
		//-----------------------
		$date_up = jdate("Y-m-d",'','','','en');
		$time_up = jdate('H-i-s','','','','en');
		$date_miladi= date("Y-m-d");
		$date_time_miladi = $date_miladi.' '.$time_up;
		//-----------------------
		$sql="INSERT INTO `wishlist`(`client_code`, `doctor_code`, `date_time_submit`) VALUES 
			('".$client_code."' ,'".$doctor_code."' ,'".$date_time_miladi."') ";		
		$result = $connect2->query($sql);
		if($result)
			return true;			
		return false;		
	}		

	///////////////////////////////////////////////////////////////////////
	
	function commentToDoctor($client_code,$doctor_code,$title,$caption){
		
		$connect2 = new DbConnect;
		//-----------------------
		$date_up = jdate("Y-m-d",'','','','en');
		$time_up = jdate('H-i-s','','','','en');
		$date_miladi= date("Y-m-d");
		$date_time_miladi = $date_miladi.' '.$time_up;
		//-----------------------
		$sql="INSERT INTO `comment`( `client_code`, `doctor_code`, `title`, `caption`, `situation`, `date_time_submit`) VALUES 
			('".$client_code."' ,'".$doctor_code."' ,'".$title."' ,'".$caption."', 0 ,'".$date_time_miladi."') ";		
		$result = $connect2->query($sql);
		if($result)
			return true;			
		return false;		
	}			
	///////////////////////////////////////////////////////////////////////
	function getApi($url){
		//next example will recieve all messages for specific conversation
		//$service_url = 'https://example.com/api/conversations/[CONV_CODE]/messages&apikey=[API_KEY]';
		$service_url = $url;
		$curl = curl_init($service_url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$curl_response = curl_exec($curl);
		if ($curl_response == false) {
			$info = curl_getinfo($curl);
			curl_close($curl);
			die('error occured during curl exec. Additioanl info: ' . var_export($info));
		}else{
			curl_close($curl);
			$decoded = json_decode($curl_response);
			if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
				die('error occured: ' . $decoded->response->errormessage);
			}else{
				//echo 'response ok!';
				//print_r($decoded);
				//var_export($decoded->response);
				return $decoded;
			}
			
		}
		return null;
	}
}






