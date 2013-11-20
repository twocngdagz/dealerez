<?php

class export2CSV{
    
    public $delimiter = "\t";
    public $row_end = "\n";
    
    function exportDb2CSV($delimiter,$row_end){
        $this->delimiter = $delimiter;
        $this->row_end = $row_end;
		
		
    }
    
	  function setParameters($delimiter,$row_end){
        $this->delimiter = $delimiter;
        $this->row_end = $row_end;
		
		
    }
	
    function create_csv_file_header($data)
    {
        $row = "";
        if (count($data)>0){
            foreach ($data[0] as $key=>$val)
            {
                if ($row){
                    $row .= $this->delimiter . $key;
                }else{
                    $row .= $key;
                }
            }
            $row .= $this->row_end;
        }
        return $row;
    }
    
    
    function create_csv_file_row($row)
    {
        $res = "";
        foreach ($row as $key=>$val)
        {
            if ($res){
                $res .= $this->delimiter .$val;
            }else{
                $res .= $val;
            }
        }
        $res .= $this->row_end;

        return $res;
		
    }
    
    function create_csv_file($data)
    {
        $csv = $this->create_csv_file_header($data);
        foreach ($data as $key=>$val){
            $csv .= $this->create_csv_file_row($val);
        }
        return $csv;
		
    }
	
	
	
	function create_csv_file_row_Evercarlisting($row)
    {
        $res = "";
        foreach ($row as $key=>$val)
        {
            if ($res){
                $res .= "," .$val;
            }else{
                $res .= $val;
            }
        }
        $res .= $this->row_end;
    
        return $res;
    }
	
	
	 function create_csv_file_Evercarlisting($data)
    {
       // $csv = $this->create_csv_file_header($data);
        foreach ($data as $key=>$val){
            $csv .= $this->create_csv_file_row_Evercarlisting($val);
        }
        return $csv;
    }
	
	
	
	#################FOR CARS.COM#####################
	function create_csv_file_row_Carsdotcom($row)
    {
        $res = "";
        foreach ($row as $key=>$val)
        {
            if ($res){
                $res .= "|" .$val;
            }else{
                $res .= $val;
            }
        }
        $res .= $this->row_end;
    
        return $res;
    }
	
	
	 function create_csv_file_Carsdotcom($data)
    {
       // $csv = $this->create_csv_file_header($data);
        foreach ($data as $key=>$val){
            $csv .= $this->create_csv_file_row_Carsdotcom($val);
        }
        return $csv;
    }
	################FOR CARS.COM ###########################
	
	##############FOR DYANTECH.COM##########################
	
	function create_csv_file_row_ryantech($row)
    {
        $res = "";
        foreach ($row as $key=>$val)
        {
            if ($res){
                $res .= "\t" .$val;
            }else{
                $res .= $val;
            }
        }
        $res .= $this->row_end;
    
        return $res;
    }
	
	
	 function create_csv_file_Ryantech($data)
    {
       // $csv = $this->create_csv_file_header($data);
        foreach ($data as $key=>$val){
            $csv .= $this->create_csv_file_row_ryantech($val);
        }
        return $csv;
    }
	
	
	##############FOR DYANTECH.COM END##########################
}

?>