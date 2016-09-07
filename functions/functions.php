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
            return false;
        }
        else
        {
            if (isset($_POST))
            {
                 if (!empty($_POST) && !empty($_POST['email']))
                    {
                         $email = $_POST['email'];
                         $name = $_POST['name'];
                         $password = $_POST['password_signup'];
                         $phone = $_POST['phone'];
                         $a = date_parse_from_format('Y-m-d', $_POST['dob']);
                         $dob = mktime(0, 0, 0, $a['month'], $a['day'], $a['year']);
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
                            if (session_id() == '')
                            {
                                session_start();
                            }
                            else if(isset($_SESSION['email']))
                            {
                                unset($_SESSION["email"]);
                                unset($_SESSION['position']);
                                unset($_SESSION['password']);
                            }
                            $_SESSION['position'] = "customer";
                            $_SESSION['email'] = $email;
                            $_SESSION['password'] = GrabData('users', 'password', 'email', $email);
                            header("Location: ../index.php");
                         }
                         catch (PDOException $e)
                         {
                             echo "There was an error, contact the system adminstrator and copy this error: " . $e -> getMessage();
                         }
                 }
            }
        }
}

function authenticateUser()
{
    if (CheckExist('email', 'users', 'email', $_POST))
    {
        try
        {
            $pdo = connect();
            $email = $_POST['email'];
            $password = $_POST['password'];
            $query = $pdo->prepare("SELECT * FROM users WHERE email = :email AND password = SHA2(CONCAT(:password, salt), 0)");
            $query -> bindValue(':email', $email);
            $query -> bindValue(':password', $password);
            $query -> execute();
            
        }
        catch (PDOException $e) 
        {
            echo $e -> getMessage();
        }
        if ($query -> rowCount() == 1)
        {
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            if (session_id() == '')
            {
                session_start();
            }
            else if(isset($_SESSION['email']))
            {
                unset($_SESSION["email"]);
                unset($_SESSION['position']);
                unset($_SESSION['password']);
            }
            $_SESSION['position'] = $data[0]['position'];
            $_SESSION['email'] = $data[0]['email'];
            $_SESSION['password'] = $data[0]['password'];
            header("Location: ../index.php");
            
        }
        else
        {
            return false;
        }
        
        
        
    }
    else
    {
       return false;
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
                         if ($prepare -> rowCount() != 0)
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
function GrabData($table, $column, $where_column, $where)
{
                         $input = $where;
                         try
                         {
                             $pdo = connect();
                             $sql= 'SELECT ' . $column . ' FROM ' . $table . ' where ' . $where_column . ' = :attribute';
                             $prepare = $pdo->prepare($sql);
                             $prepare->bindValue(':attribute', $input);
                             $prepare->execute();
                         }
                         catch (PDOException $e)
                         {
                             echo $e -> getMessage();
                         }
                         if ($prepare -> rowCount() != 0)
                         {
                             $data = $prepare->fetchAll(PDO::FETCH_ASSOC);
                             return $data;
                         }
                         else
                         {
                             return false;
                         }
                         
}

///$query is the basic mySQL query eg: "SELECT * FROM users WHERE email = :email AND password = :password".
///$bind is a array, can have nested arrays I think, must be in pairs, eg: 'array(array(:email, 'ze_yaya@msn.com'))'
function GrabMoreData($query, $bind)
{
                         try
                         {
                             $pdo = connect();
                             $sql= $query;
                             $prepare = $pdo->prepare($sql);
                             foreach ($bind as $attribute)
                             {
                                $prepare->bindValue($attribute[0], $attribute[1]); 
                             }
                             $prepare->execute();
                         }
                         catch (PDOException $e)
                         {
                             echo $e -> getMessage();
                         }
                         if ($prepare -> rowCount() != 0)
                         {
                             $data = $prepare->fetchAll(PDO::FETCH_ASSOC);
                             return $data;
                         }
                         else
                         {
                             return false;
                         }
                         
}

function writeError($method)
{
    if (!empty($_POST))
    {
        if ($_POST['method'] == 'login' && !authenticateUser() && $method == "login")
        {
            echo "<span class='php_error' id='login_error_php'>The email or password is incorrect</span>";
        }
        else if ($_POST['method'] == 'signup' && !registerUser() && $method == "signup")
        {
            echo "<span class='php_error'>This email is already in use</span>";
        }
    }
}

//generates a table of the inputted data
//Will work with data collected from GrabMoreData
//NOT tested for data collected from GrabData
function generateForm($data){
	$dat = $data;
	echo "<table border=2 width=100%>><tr>";
	while ($id = current($dat[0])) {
		if($id){
			echo "<th>".key($data[0])."</th>";
		}
		next($data[0]);
	}
	foreach($data as $arr1){
		echo "</tr><tr>";
		foreach($arr1 as &$arr){
			echo "<td>";
			if($arr > 1000000000){
				echo date("d-m-Y", $arr)."<br/>".date("h:i A", $arr);
			}else{
				echo $arr;
			}
			echo "</td>";
		}
	}
	echo "</tr>";
	echo "</table>";
}
?>