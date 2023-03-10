<?php
    $result = $user->getAllUser();
    $no_of_rows = $result->rowCount();
    if ($no_of_rows == 0) {
        echo json_encode(
            array("Message" => "No user found")
        );
    } else {
        $user_array = array();
    
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
    
            $user = array(
                "id" => $id,
                "name" => $name,
                "email" => $email,
            );
    
            // push data to the array
            array_push($user_array, $user);
        }
        // convert to json
        echo json_encode($user_array);
    }
?>