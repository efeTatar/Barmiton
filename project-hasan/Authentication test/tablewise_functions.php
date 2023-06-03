<?php

    /*
        User Credentials Manipulation
    */

    function add_user_credentials ($username, $password, $name, $surname)
    {
        if(check_username($username) == 1) return 0;

        if (($table = fopen("user_credentials.csv", "a")) == FALSE) return 0;

        $user_id = rand(100000, 999999);

        $user_data = "\n".$username.",".$password.",".$name.",".$surname.",".$user_id;
        fwrite($table, $user_data);

        fclose($table);
        add_user_rights($user_id, 1, 1, 0, 0, 0, 0);
        return 1;
    }

    function delete_user_credentials ($username)
    {
        if(check_username($username) == 0) return 0;

        if (($table = fopen("user_credentials.csv", "r")) == FALSE) return 0;

        $data = fetch_data_line($table, $username);
        $user_credentials = "\n".$data[0].",".$data[1].",".$data[2].",".$data[3].",".$data[4]; 
        fclose($table);

        $credentials = file_get_contents("user_credentials.csv");
        $credentials = str_replace($user_credentials, "", $credentials);

        file_put_contents("user_credentials.csv", "");
        file_put_contents("user_credentials.csv", $credentials);

        delete_user_rights($data[4]);

        return 1;
    }

    /*
        User Rights Manipulation
    */

    function add_user_rights ($user_id, $AR, $C, $PM, $VR, $AC, $UA)
    {    
        if (($table = fopen("user_rights.csv", "a")) == FALSE) return 0;

        $user_rights = "\n".$user_id.",".$AR.",".$C.",".$PM.",".$VR.",".$AC.",".$UA;
        fwrite($table, $user_rights);

        fclose($table);
        return 1;

    }

    function modify_user_rights ($user_id, $AR, $C, $PM, $VR, $AC, $UA)
    {
        if (($table = fopen("user_rights.csv", "r+")) == FALSE) return 0;

        $table = find_user_id_rights($table, $user_id);

        $user_rights = $user_id.",".$AR.",".$C.",".$PM.",".$VR.",".$AC.",".$UA;
        fwrite($table, $user_rights);

        fclose($table);
        return 1;

    }

    function delete_user_rights ($user_id)
    {
        if (($table = fopen("user_rights.csv", "r")) == FALSE) return 0;

        $data = fetch_data_line($table, $user_id);
        $user_rights = "\n".$data[0].",".$data[1].",".$data[2].",".$data[3].",".$data[4].",".$data[5].",".$data[6]; 
        fclose($table);

        $rights = file_get_contents("user_rights.csv");
        $rights = str_replace($user_rights, "", $rights);

        file_put_contents("user_rights.csv", "");
        file_put_contents("user_rights.csv", $rights);

        return 1;
    }

    /*
        Fetch Data
    */

    /*
        Verify Information
    */
    
    function check_credentials($username, $password){

        if (($table = fopen("user_credentials.csv", "r")) == FALSE) return 0;
        
    	while (($data = fgetcsv($table)) !== FALSE){ 
            if (strcmp($data[0], $username) == 0 && strcmp($data[1], $password) == 0 ){
                fclose($table);
                return 1;
            }
        }

        fclose($table);
        return 0;
    }

    function check_username($username){

        if (($table = fopen("user_credentials.csv", "r")) == FALSE) return 0;

        while (($data = fgetcsv($table)) !== FALSE){
            if (strcmp($data[0], $username) == 0) return 1;
        }

        fclose($table);
        return 0;

    }
    
    function fetch_user_credentials($username, $table){

        while (($data = fgetcsv($table)) !== FALSE){
            if (strcmp($data[0], $username) == 0){
                return $data;
            }
        }

        return 0;
    }

    function find_user_id_rights($table, $user_id){

        while (($data = fgets($table, 7)) !== FALSE){
            if (strcmp($data, $user_id) == 0){
                fseek($table, ftell($table) - 6);
                return $table;
            }
            fgets($table);
        }

        return -1;
    }

    function fetch_id_line_number($table, $id_number){

        fseek($table, 0);

        $i = 0;
        while(($data = fgetcsv($table)) !== FALSE){
            if(strcmp($data[0], $id_number) == 0){
                return $i;
            }
            $i++;
        }

        return -1;

    }

    function fetch_data_line($table, $username){
        fseek($table, 0);
        while (($data = fgetcsv($table)) !== FALSE){
            if (strcmp($data[0], $username) == 0) return $data;
        }
        return -1;
    }

?>