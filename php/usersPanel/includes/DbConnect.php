<?php
class DbConnect
{
	private $connection;
	function __construct(){
		
	}
	
	function Connect()
	{
		include_once('Constants.php');
		$this->connection=new mysqli("mysql2","fgatieco_doctorsoffice","mod024fUQtTLj70Z","fgatieco_doctorsoffice");
		//$this->connection=new mysqli("mysql","fgatieco_doctorsoffice","mod024fUQtTLj70Z","fgatieco_doctorsoffice");
		if(mysqli_connect_errno()){
			echo "Failed to connect to MySQL: ".mysqli_connect_error();
		}
		mysqli_query($this->connection,"SET NAMES 'utf8'");
		return $this->connection;
	}
	
	function query($sql)
	{
		$Server_name = "mysql2";
		//$Server_name = "mysql";
		$Server_username = "fgatieco_doctorsoffice";
		$Server_password = "mod024fUQtTLj70Z";
		$Dbname = "fgatieco_doctorsoffice";
		$link=mysqli_connect($Server_name,$Server_username,$Server_password) or
		 exit("Error in connect to server");
		if($link)
		{
			if(mysqli_select_db($link,$Dbname))
			{
				mysqli_query($link,"set names utf8");
				mysqli_query($link,"set charset utf8");
				$result = mysqli_query($link,$sql);
				if(!$result)
				{
					echo "Error in query";
				}
				return $result;
				
			}
			else{
				echo "Erron in connect to database";
			}
		}
		else{
		   echo "Error in connect to server";
		}
	}
}
