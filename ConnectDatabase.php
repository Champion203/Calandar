<?php
    	$serverName = "172.25.111.147"; //172.30.208.1
        $userName = "sa";
        $userPassword = "P@ssw0rd";
        $dbName = "Reverse_Room";

    	// $serverName = "localhost"; //172.30.208.1
        // $userName = "champ894";
        // $userPassword = "P@ssw0rd1";
        // $dbName = "ReserveRoom";
        
        $connectionInfo = array("Database"=>$dbName, "UID"=>$userName, "PWD"=>$userPassword, "MultipleActiveResultSets"=>true,"CharacterSet" =>'UTF-8');
    
        $conn = sqlsrv_connect( $serverName, $connectionInfo);
    
        if( $conn === false ) {
            die( print_r( sqlsrv_errors(), true));
        }
?>