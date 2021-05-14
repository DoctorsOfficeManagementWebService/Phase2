<?php
require_once '../includes/DbOperation.php';
require_once("../includes/jdf2.php") ;
//include_once('../includes/header.php');
function isTheseParameterAvailable($params){
	$available=true;
	$missingParams="";
	
	foreach($params as $param){
		if(!isset($_POST[$param]) || strlen($_POST[$param])<=0){
			$available=false;
			$missingParams=$missingParams. ", ".$param;
		}
	}
	
	if(!$available){
		$response=array();
		$response['status']=404;
		$response['data']= array('error' => 'Parameters '.$missingParams.' missing');
		//echo json_encode($response);
		deliver_response($response);
		die();
	}
}

$response=array();
if(isset($_GET['apicall'])){
	switch($_GET['apicall']){
		////////////////////////
		case 'getdate':		
			$date_up = jdate("Y-m-d",'','','','en');
			$time_up = jdate('H-i-s','','','','en');
			$date_now=$date_up.' '.$time_up;
			if($date_now){
				$response['status']=200;
				$response['data']=$date_now;
			}
			else{
				$response['status']=400;
				$response['data']=array('error' => 'There is an error.');
			}
		break;
		////////////////////////
		case 'visitreserve':
			isTheseParameterAvailable(
			array('client_code','doctor_code','date_visit','time_visit_of','time_visit_to'));
			$db=new DbOperation();
			$result=$db->visitReserve(
			$_POST['client_code'],$_POST['doctor_code'],$_POST['date_visit'],$_POST['time_visit_of'],$_POST['time_visit_to']);
			if($result==1001){
				$response['status']=200;
				$response['data']=array('message' => 'The time you requested was reserved.');
			}
			else if($result==1002){
				$response['status']=400;
				$response['data']=array('error' => 'Sorry, Error in database,try again.');
			}
			else if($result==1003){
				$response['status']=400;
				$response['data']=array('error' => 'Sorry, This visit time has already been booked.');
			}
			else if($result==1004){
				$response['status']=400;
				$response['data']=array('error' => 'Sorry, The doctor does not have time to visit at this time.');
			}
		break;
		////////////////////////
		case 'searchlistdoctors':
			if(isset($_GET['city']) || isset($_GET['proficiency']) || isset($_GET['education'])){
				$db=new DbOperation();
				$output=$db->searchListDoctors($_GET['city'],$_GET['proficiency'],$_GET['education']);
				if($output){
					$response['status']=200;
					$response['data']=$output;
				}
				else{
					$response['status']=400;
					$response['data']=array('error' => 'There is no data.');
				}
			}else{
				$response['status']=400;
				$response['data']=array('error' => 'Please enter one of parameters (city,proficiency,education).');
			}
		break;
		////////////////////////////
		case 'searchdoctor':
			if(isset($_GET['doctor_name']) || isset($_GET['medical_sys_num'])){
				$db=new DbOperation();
				$output=$db->searchDoctor($_GET['doctor_name'],$_GET['medical_sys_num']);
				if($output){
					$response['status']=200;
					$response['data']=$output;
				}
				else{
					$response['status']=400;
					$response['data']=array('error' => 'There is no data.');
				}
			}else{
				$response['status']=400;
				$response['data']=array('error' => 'Please enter one of parameters (doctor_name,medical_sys_num).');
			}
		break;
		////////////////////////
		case 'updateuserinfo':
			isTheseParameterAvailable(
			array('client_code','fname','lname','tell','email','state','city','address','national'));
			$db=new DbOperation();
			$result=$db->updateUserInfo(
			$_POST['client_code'],$_POST['fname'],$_POST['lname'],$_POST['tell'],$_POST['email'],$_POST['state'],$_POST['city'],$_POST['address'],$_POST['national']);
			if($result){
				$response['status']=200;
				$response['data']=$db->getWishlist($_POST['client_code']);
			}
			else
			{
				$response['status']=400;
				$response['data']=array('error' => 'An error has occurred.');
			}
		break;
		////////////////////////////
		case 'getwishlist':
			if(isset($_GET['client_code'])){
				$db=new DbOperation();
				$output=$db->getWishlist($_GET['client_code']);
				if($output){
					$response['status']=200;
					$response['data']=$output;
				}
				else{
					$response['status']=400;
					$response['data']=array('error' => 'There is no data.');
				}
			}else{
				$response['status']=400;
				$response['data']=array('error' => 'Please enter client code.');
			}
		break;
		////////////////////////////
		case 'getcommentsdoctor':
			if(isset($_GET['doctor_code'])){
				$db=new DbOperation();
				$output=$db->getCommentsDoctor($_GET['doctor_code']);
				if($output){
					$response['status']=200;
					$response['data']=$output;
				}
				else{
					$response['status']=400;
					$response['data']=array('error' => 'There is no data.');
				}
			}else{
				$response['status']=400;
				$response['data']=array('error' => 'Please enter doctor code.');
			}
		break;
		////////////////////////////
		case 'getcommentsclient':
			if(isset($_GET['client_code'])){
				$db=new DbOperation();
				$output=$db->getCommentsClient($_GET['client_code']);
				if($output){
					$response['status']=200;
					$response['data']=$output;
				}
				else{
					$response['status']=400;
					$response['data']=array('error' => 'There is no data.');
				}
			}else{
				$response['status']=400;
				$response['data']=array('error' => 'Please enter doctor code.');
			}
		break;
		////////////////////////
		case 'addtowishlist':
			isTheseParameterAvailable(
			array('client_code','doctor_code'));
			$db=new DbOperation();
			$result=$db->addToWishlist(
			$_POST['client_code'],$_POST['doctor_code']);
			if($result){
				$response['status']=200;
				$response['data']=$db->getWishlist($_POST['client_code']);
			}
			else
			{
				$response['status']=400;
				$response['data']=array('error' => 'An error has occurred.');
			}
		break;
		////////////////////////
		case 'commenttodoctor':
			isTheseParameterAvailable(
			array('client_code','doctor_code','title','caption'));
			$db=new DbOperation();
			$result=$db->commentToDoctor(
			$_POST['client_code'],$_POST['doctor_code'],$_POST['title'],$_POST['caption']);
			if($result){
				$response['status']=200;
				$response['data']=$db->getCommentsClient($_POST['client_code']);
			}
			else
			{
				$response['status']=400;
				$response['data']=array('error' => 'An error has occurred.');
			}
		break;
		////////////////////////
		
		////////////////////////

		
	}//switch
}else{
	$response['error']=true;
	$response['message']='Invalid API Call';
}

////////////////////////////////
function deliver_response($response){
	// Define HTTP responses
	$http_response_code = array(
		100 => 'Continue',  
		101 => 'Switching Protocols',  
		200 => 'OK',
		201 => 'Created',  
		202 => 'Accepted',  
		203 => 'Non-Authoritative Information',  
		204 => 'No Content',  
		205 => 'Reset Content',  
		206 => 'Partial Content',  
		300 => 'Multiple Choices',  
		301 => 'Moved Permanently',  
		302 => 'Found',  
		303 => 'See Other',  
		304 => 'Not Modified',  
		305 => 'Use Proxy',  
		306 => '(Unused)',  
		307 => 'Temporary Redirect',  
		400 => 'Bad Request',  
		401 => 'Unauthorized',  
		402 => 'Payment Required',  
		403 => 'Forbidden',  
		404 => 'Not Found',  
		405 => 'Method Not Allowed',  
		406 => 'Not Acceptable',  
		407 => 'Proxy Authentication Required',  
		408 => 'Request Timeout',  
		409 => 'Conflict',  
		410 => 'Gone',  
		411 => 'Length Required',  
		412 => 'Precondition Failed',  
		413 => 'Request Entity Too Large',  
		414 => 'Request-URI Too Long',  
		415 => 'Unsupported Media Type',  
		416 => 'Requested Range Not Satisfiable',  
		417 => 'Expectation Failed',
		500 => 'Internal Server Error',  
		501 => 'Not Implemented',  
		502 => 'Bad Gateway',  
		503 => 'Service Unavailable',  
		504 => 'Gateway Timeout',  
		505 => 'HTTP Version Not Supported'
		);

	// Set HTTP Response
	header('Access-Control-Allow-Origin: *');
	header('HTTP/1.1 '.$response['status'].' '.$http_response_code[ $response['status'] ]);
	// Set HTTP Response Content Type
	header('Content-Type: application/json; charset=utf-8');
	// Format data into a JSON response
	$json_response = json_encode($response);
	// Deliver formatted data
	echo $json_response;

	exit;
}

///////////////////////////////
deliver_response($response);
//echo json_encode($response);
?>





