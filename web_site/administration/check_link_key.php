<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $postData = file_get_contents("php://input");

        $data = json_decode($postData, true);

            if ($data !== null) {
                echo json_encode(array("message" => "Data received successfully", "data" => $data));
                $tableName = $_SESSION['selectedTable'] ; 
                $sql = "SHOW KEYS FROM $tableName WHERE Key_name = 'PRIMARY'";
                $stmt = $pdo->query($sql);

                $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $primaryKeyName = $row['Column_name'];
                            
                $query = "SELECT COUNT(*) FROM ecrit WHERE $primaryKeyName = :primaryKeyValue";
                $statement = $pdo->prepare($query);

                foreach ($data as $key => $value) {
                    if ($key === $primaryKeyName) {
                        $primaryKeyValue = $value;
                    } 
                }

                $statement->bindParam(':primaryKeyValue', $primaryKeyValue, PDO::PARAM_INT);
                $statement->execute();
                            
                $result = $statement->fetchColumn();

                if ($result > 0) {
                    echo 'var inEcrit = true;';
                    echo "var nbliaison = '$result';";  
                } else {
                    echo 'var inEcrit = false;';
                };      
            };
        } else {
            http_response_code(400); 
            echo json_encode(array("error" => "Invalid JSON data"));
        }
    } else {
        http_response_code(405); 
        echo json_encode(array("error" => "Only POST requests are allowed"));
    }

?>