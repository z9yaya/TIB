<?php

function connect()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=tib', 'edit', 'editme');
        $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);

        return $pdo;
    }//end connect

function registerUser()
    {
        if (CheckExist('email', 'users', 'email', $_POST))
        {
            include '../pages/login.php';
            echo "<span class='php_error'>This email is already in use</span>";
        }
        else
        {
            if (isset($_POST))
            {
                 if (!empty($_POST) && !empty($_POST['email']))
                    {
                         $email = $_POST['email'];
                         $name = $_POST['name'];
                         $password = $_POST['password'];
                         $phone = $_POST['phone'];
                         $a = date_parse_from_format('Y-m-d', $_POST['dob']);
                         $dob = mktime(0, 0, 0, $a['month']-1, $a['day'], $a['year']);
                         $salt = rand( 0000000000, 9999999999);
                         try
                         {
                             $pdo = connect();
                             $query= "INSERT INTO users(email, name, password, phone, dob, salt)
                             VALUES(:email, :name, SHA2(CONCAT(:password, :salt), 0), :phone, :dob, :salt);";
                             $prepare = $pdo->prepare($query);
                             $prepare -> bindValue(':email', $email);
                             $prepare -> bindValue(':name', $name);
                             $prepare -> bindValue(':password', $password);
                             $prepare -> bindValue(':phone', $phone);
                             $prepare -> bindValue(':dob', $dob);  
                             $prepare -> bindValue(':salt', $salt);
                             $prepare->execute();
                         }
                         catch (PDOException $e)
                         {
                             echo $e -> getMessage();
                         }
                 }
            }
        }
}
function CheckExist($attribute, $table, $column, $getOrpost)
{
    if (isset($getOrpost))
            {
                 if (!empty($getOrpost) && !empty($getOrpost[$attribute]))
                    {
                         $input = $getOrpost[$attribute];
                         try
                         {
                             $pdo = connect();
                             $sql= 'SELECT ' . $column . ' FROM ' . $table . ' where ' . $column . ' = :attribute';
                             $prepare = $pdo->prepare($sql);
                             $prepare->bindValue(':attribute', $input);
                             $prepare->execute();
                         }
                         catch (PDOException $e)
                         {
                             echo $e -> getMessage();
                         }
                         $data = $prepare->fetchAll(PDO::FETCH_ASSOC);
                         if (countResults($data) != 0)
                         {
                             return true;
                         }
                         else
                         {
                             return false;
                         }
                         
                    }  
            }
}
function countResults($resultsItems)
        {
            $num_rows=0;
            for ($i=0;$i < count($resultsItems); $i++) 
            {
                $num_rows++;
            }
            return $num_rows;
        }
registerUser();
?>