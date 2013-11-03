<?php
class Mysql{

//FUNCTION FOR MYSQL SELECT
function select($table_name,$slimit=false,$elimit=false,$order_by=false,$sort_by="ASC",$cond=false){

 	$result_info=array();
	if($table_name)
	{
			
			if($order_by)
			{
				$order_by=" Order By $order_by $sort_by";
			}
			else
			{
					$order_by='';
			}
			
			if($slimit)
			{
				$limit=" limit $slimit, $elimit"; 

			}
			else if($elimit)
			{
				$limit=" limit 0, $elimit"; 
			}
			else
			{
				$limit="";
			
			}
			if($cond)
			{
				$cond= " where $cond";
			}
			
			$sql="select * from $table_name $cond $order_by $limit";
			
			$result=Execute_command($sql);
			$a=0;
			try
			{		while($record=mysql_fetch_array($result))
					{
						$result_info[$a]=$record;
						$a++;
						
					}
			}
			catch(Exception $e)
			{
				$_SESSION['mysql_eror']=$result;
			}
	
	}
	return $result_info;
	
}
//FUNCTION FOR MYSQL INSERT
function insert($data_array){

	if(count($data_array)>0){
	
		if(count($data_array['columns_name'])>0){	
		
			$cond='';
			$b=1;
			foreach($data_array['columns_name'] as $key =>$value) {
					$column_values.="$key='$value'";

					if($b<count($data_array['columns_name'])){

						$column_values.=",";
					}	
				$b++;
			}
			$sql="insert into ".$data_array['table_name']." set $column_values";
			
			$result=Execute_command($sql);
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

	}

}
//FUNCTION FOR MYSQL UPDATE
function update($data_array){
	
	if(count($data_array)>0){
		
		if(count($data_array['columns_name'])>0) {	

			$cond='';

			$b=1;

			foreach($data_array['columns_name'] as $key =>$value) 
			{
					$column_values.="$key='$value'";

					if($b<count($data_array['columns_name']))

					{

						$column_values.=",";

					}	

				$b++;
			}
			
			$sql="update ".$data_array['table_name']." set $column_values where ".$data_array['condition']."";

			$result=Execute_command($sql);
			if($result==1)
			{
				return true;
			}
			else
			{
				$_SESSION['mysql_eror']="There is something wrong: ".$result;
				return false;

			}

		}

	}
}

//FUNCTION FOR MYSQL DELETE
function delete($table=null,$conditions=false) {
	
		if ($table===null) return false;
		if ($conditions)
		{
			$conditions = "WHERE $conditions";
		}
		$result = Execute_command("DELETE FROM $table $conditions");
		
		if($result==1)
		{
			return true;
		}
		else
		{
			return false;

		}

	}	
}
?>