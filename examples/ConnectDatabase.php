<?php
    	$serverName = "localhost"; //172.30.208.1
        $userName = "champ894@tu.ac.th";
        $userPassword = "1139700012961";
        $dbName = "ReserveRoom";
    
        $connectionInfo = array("Database"=>$dbName, "UID"=>$userName, "PWD"=>$userPassword, "MultipleActiveResultSets"=>true,"CharacterSet" =>'UTF-8');
    
        $conn = sqlsrv_connect( $serverName, $connectionInfo);
    
        if( $conn === false ) {
            die( print_r( sqlsrv_errors(), true));
        }
?>