<?php 

 function forgot_password ($email){

	

		

		$password=false;

	

			$sql="select * from users where email='".$email."'";

$result=Execute_command($sql);

			while($row = mysql_fetch_array($result)){

				if($row["email"]==$email){

					$password=$row["password"];

				}	

			}

		

		

		return $password;	

}

 

function validate_status($email){



$status=false;

			$sql="select * from users where email='$email' limit 1";



			$result=Execute_command($sql);

			if($row = mysql_fetch_array($result)){

			

			if($row["is_active"]==1){

					

					$status=true;

				}	

			}

		

		

		return $status;	



} 





 function validate ($email , $password,$user_type){

	

		

		$validation=false;



			$sql="select * from users where email='$email' and user_type='$user_type' limit 1";

		

			$result=Execute_command($sql);

			if($row = mysql_fetch_array($result)){

			if($row["password"]==$password){

				

					$validation=true;

				}	

			}

		

		

		return $validation;	

}

 



///////////////////////////////////creats a session veriable and logs in the user actualy////////////////////

	 function login($email){

		

			

			$sql="select * from users where email='".$email."' limit 1";

			$result=Execute_command($sql);

			if($row = mysql_fetch_array($result)){

			$_SESSION["USER_EMAIL"]= $row["email"];
			$_SESSION["USER_LOGIN_EMAIL"]= $row["email"];
			
			$_SESSION["USER_ID"]=$row["user_id"];
			$_SESSION["USER_LOGIN_ID"]= $row["user_id"];
			$_SESSION["USER_LOGIN"]=$row["login"];
			$_SESSION["USER_TYPE"]=$row["user_type"];
			$_SESSION["USER_NAME"]=$row["name"];

			}

			

		

		

	}

/////////////////////////////////Validates a user details and logs him in as well/////////////////////////

	 function validateandligin($email,$password,$user_type){

		$validatetion=false;

		

	

				if(validate($email,$password,$user_type)){

						if(validate_status($email))

						{

							$validatetion="Active";

							login($email);
							

						}else
						{
							$validatetion="InActive";
						}

	

				}
				

				return $validatetion;

	}

//////////////////////////////////Logs a User Out/////////////////////////////////////////////////////////

	 function Logout(){

	unset($_SESSION["USER_EMAIL"]);

	unset($_SESSION["USER_ID"]);

	unset($_SESSION["USER_LOGIN"]);

unset($_SESSION["USER_LOGIN_EMAIL"]);
unset($_SESSION["USER_LOGIN_ID"]);
unset($_SESSION["USER_TYPE"]);





	}	



//$test = new Sessopn_Controle(); 

//$test->validateandligin("masoom","USER","123456");

//print_r($_SESSION);

//$test->Logout();

//print_r($_SESSION);

//$test->validateandligin("naveed","RESTAURANT","1123581321");

//print_r($_SESSION);















// ###########3 admin_ area ###############***************









 function admin_validate ($login , $password){

	

		

		$validation=false;

	

			$sql="select * from admin_login where login='".$login."'";



			$result=Execute_command($sql);

			while($row = mysql_fetch_array($result)){

			if($row["password"]==$password){

					

					$validation=true;

				}	

			}

		

		

		return $validation;	

}

 



///////////////////////////////////creats a session veriable and logs in the user actualy////////////////////

	 function admin_login($login){

		

		

			$sql="select * from admin_login where login='".$login."'";

$result=Execute_command($sql);

			while($row = mysql_fetch_array($result)){

				//$_SESSION["admin_EMAIL"]= $row["email"];

				$_SESSION["ADMIN_ID"]=$row["admin_id"];

				$_SESSION["ADMIN_LOGIN"]=$row["login"];

		

			

		}

		

	}

/////////////////////////////////Validates a user details and logs him in as well/////////////////////////

	 function admin_validateandligin($login,$passwprd){

		$validatetion=false;

		if(admin_validate($login,$passwprd)){

			$validatetion=true;

			admin_login($login);

		}

		return $validatetion;

	}

//////////////////////////////////Logs a User Out/////////////////////////////////////////////////////////

	 function admin_Logout(){

	//unset($_SESSION["USER_EMAIL"]);

	unset($_SESSION["ADMIN_ID"]);

	unset($_SESSION["ADMIN_LOGIN"]);

	}	





function admin_update_password($login , $NewPassword){





if($login && $NewPassword)

{

	

$sql="update admin_login set password='".$NewPassword."' where login='".$login."' ";

$result=Execute_command($sql);

}

else

{

$_SESSION['mysql_eror']="Please provide data to update database";

}

			if($result==1)

			{

			 	return true;

			}

			else

			{

				$_SESSION['mysql_eror']=$result;

				return false;

				

			}





}











?>