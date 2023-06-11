<?php

    define("user_credentials", "../../data/user_credentials.csv");
    define("user_rights", "../../data/user_rights.csv");

    /*
        User manipulation functions ================================================================================================================
    */

    function user_log ($username, $password, $name, $surname, $rights)
    {

        if(username_exist_check($username) == 0) return -1;

        $user_id = user_id_generate();

        $credentials = generate_user_credentials_string(
            $user_id, $username, $password, $name, $surname
        );

        $user_rights = generate_user_rights_string(
            $user_id, $rights
        );

        user_credentials_append($credentials);

        user_rights_append($user_rights);

        return 0;
    }

    function user_destroy ($user_id)
    {
        $credentials_array = user_credentials_fetch ($user_id);

        $rights_array = TEST_fetch_user_rights ($user_id);

        $credentials = generate_user_credentials_string(
            $credentials_array[0], $credentials_array[1], $credentials_array[2], $credentials_array[3], $credentials_array[4]
        );

        $rights = generate_user_rights_string(
            $user_id, 
            array($rights_array[1], $rights_array[2], $rights_array[3])
        );

        user_credentials_destroy($credentials);

        user_rights_destroy($rights);

        return 0;
    }

    function user_rights_modify($user_id, $rights)
    {
        $rights_array = TEST_fetch_user_rights($user_id);
        
        user_rights_destroy(
            generate_user_rights_string(
                $user_id,
                array($rights_array[1], $rights_array[2], $rights_array[3])
            )
        );

        user_rights_append(
            generate_user_rights_string(
                $user_id,
                $rights
            )
        );
    }

    function user_credentials_modify($user_id, $username, $password, $name, $surname)
    {
        $credentials_array = user_credentials_fetch ($user_id);

        $credentials = generate_user_credentials_string(
            $credentials_array[0], $credentials_array[1], $credentials_array[2], $credentials_array[3], $credentials_array[4]
        );

        user_credentials_destroy($credentials);

        if(strcmp($username, "") == 0) $username = $credentials_array[1];
        if(strcmp($password, "") == 0) $password = $credentials_array[2];
        if(strcmp($name, "") == 0) $name = $credentials_array[3];
        if(strcmp($surname, "") == 0) $surname = $credentials_array[4];

        $credentials = generate_user_credentials_string(
            $user_id, $username, $password, $name, $surname
        );

        user_credentials_append($credentials);

        return 0;
    }

    /*
        Tableswise functions =======================================================================================================================
    */

    function user_credentials_append ($credentials)
    {
        if (($table = fopen(user_credentials, "a")) == FALSE) return -1;
        
        fwrite($table, $credentials);

        fclose($table);

        return 0;
    }

    function user_credentials_destroy ($credentials)
    {
        $updated_credential_list = file_get_contents(user_credentials);
        $updated_credential_list = str_replace($credentials, "", $updated_credential_list);

        file_put_contents(user_credentials, "");
        file_put_contents(user_credentials, $updated_credential_list);

        return 0;
    }

    function user_rights_append ($rights)
    {
        if (($table = fopen(user_rights, "a")) == FALSE) return -1;
        
        fwrite($table, $rights);

        fclose($table);

        return 0;
    }

    function user_rights_destroy ($rights)
    {
        $updated_rights_list = file_get_contents(user_rights);
        $updated_rights_list = str_replace($rights, "", $updated_rights_list);

        file_put_contents(user_rights, "");
        file_put_contents(user_rights, $updated_rights_list);

        return 0;
    }

    /*
        Stringifiers / Generators ==================================================================================================================
    */

    function user_id_generate ()
    {
        return rand(100001, 999999);
    }

    function generate_user_credentials_string ($user_id, $username, $password, $name, $surname)
    {
        $credentials = "\n".$user_id.",".$username.",".$password.",".$name.",".$surname; 

        return $credentials;
    }

    function generate_user_rights_string ($user_id, $rights)
    {
        $user_rights = "\n".$user_id.",".$rights[0].",".$rights[1].",".$rights[2];

        return $user_rights;
    }

    /*
        Fetching functions =========================================================================================================================
    */

    function user_credentials_fetch ($user_id)
    {
        if (($table = fopen(user_credentials, "r")) == FALSE) return -1;

        while (($data = fgetcsv($table)) !== FALSE){
            
            if (strcmp($data[0], $user_id) == 0)
            {
                fclose($table);
                return $data;
            }
            
        }

        fclose($table);
        return 1;
    }

    function TEST_fetch_user_rights ($user_id)
    {
        if (($table = fopen(user_rights, "r")) == FALSE) return -1;

        while (($data = fgetcsv($table)) !== FALSE){
            
            if (strcmp($data[0], $user_id) == 0)
            {
                fclose($table);
                return $data;
            }
            
        }

        fclose($table);
        return 1;
    }

    function fetch_user_id ($username)
    {
        if (($table = fopen(user_credentials, "r")) == FALSE) return -1;

        while (($data = fgetcsv($table)) !== FALSE)
        {
            if (strcmp($data[1], $username) == 0)
            {
                fclose($table);
                return $data[0];
            }
        }

        fclose($table);
        return 1;
    }

    function fetch_username ($user_id)
    {
        if (($table = fopen(user_credentials, "r")) == FALSE) return -1;

        while (($data = fgetcsv($table)) !== FALSE)
        {
            if (strcmp($data[0], $user_id) == 0)
            {
                fclose($table);
                return $data[1];
            }
        }

        fclose($table);
        return "USER NOT FOUND";
    }

    function fetch_name_surname ($user_id)
    {
        if (($table = fopen(user_credentials, "r")) == FALSE) return "ERROR";

        while (($data = fgetcsv($table)) !== FALSE)
        {
            if (strcmp($data[0], $user_id) == 0)
            {
                fclose($table);
                return $data[3]." ". $data[4];
            }
        }

        fclose($table);
        return "USER NOT FOUND"; 
    }

    /*
        Verifying functions ========================================================================================================================
    */

    function check_credentials ($username, $password)
    {
        $user_id = fetch_user_id($username);
        
        if($user_id == -1 || $user_id == 1) return 1;

        $credentials = user_credentials_fetch($user_id);

        if(strcmp($password, $credentials[2]) == 0) return 0;

        return 1;
    }

    function check_adminship ($user_id)
    {
        $rights = TEST_fetch_user_rights($user_id);

        if($rights[3] == 1) return 0;
        
        else return 1;
    }

    function check_log_status()
    {
        session_start();

        if ((session_status() != PHP_SESSION_ACTIVE || $_SESSION["username"] == "")){
            return 1;
        }

        return 0;
    }

    function username_exist_check($username)
    {
        if (($table = fopen(user_credentials, "r")) == FALSE) return -1;

        while (($data = fgetcsv($table)) !== FALSE){
            
            if (strcmp($data[1], $username) == 0)
            {
                fclose($table);
                return 0;
            }
            
        }

        fclose($table);
        return 1;
    }

    /*
        Display functions ========================================================================================================================
    */
    
    function user_info_display($user_id)
    {
        $username = fetch_username($user_id);
        $name_surname = fetch_name_surname($user_id);

        session_start();

        if(check_adminship($user_id) == 0){
            echo "<h1 class='multicolor-text'>".$name_surname."</h1>";
            echo "<p class='multicolor-text'>@".$username."</p>";
            echo "<p class='multicolor-text'>".$user_id."</p>";
            if(strcmp($_SESSION["user_id"], $user_id) == 0){
                user_info_modify_button_display($user_id);
            }
            return;
        }

        echo "<h1>".$name_surname."</h1>";
        echo "<p>@".$username."</p>";
        echo "<p>".$user_id."</p>";
        if(strcmp($_SESSION["user_id"], $user_id) == 0){
            user_info_modify_button_display($user_id);
        }

        return;
    }

    function user_info_modify_button_display($user_id){
        echo "<p><a href='user-modify-form.php?user_id=".$user_id."'>Modify Profile</a></p>";
    }

    function user_log_in_state_display()
    {
        session_start();

        if(!isset($_SESSION["username"]))
        {
            echo    "<p id='log-in-button'>
                        <a href='sign-in-form.php'>
                            Sign In
                        </a>
                    </p>";
            
            return;
        }

        echo    "<p>
                    <a href='../content/profile-page.php?user_id=".$_SESSION["user_id"]."'>"
                        .$_SESSION["username"].
                    "</a>
                </p>";

        echo    "<p>
                    <a href='../requests/user-moderation-requests/sign-out-request.php'>
                        Sign Out
                    </a>
                </p>";
        
        return;
    }

    function display_admin_console_button()
    {
        session_start();

        if(!isset($_SESSION["user_id"])) return -1;

        echo    "<p id='admin-console-button'>
                    <a href='admin-console.php'>
                        Admin Console
                    </a>
                </p>";
        
        return 0;
    }

?>