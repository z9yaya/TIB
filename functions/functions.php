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
///$bind is a nested array, must be in pairs, eg: 'array(array(:email, 'ze_yaya@msn.com'))'
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
    if ($method == 'request')
    {
        echo "<span class='php_error' id='login_error_php'>Please <b>sign in</b> or <b>register</b></br>to request a delivery</span>";
    }
     if ($method == 'deliveries')
    {
        echo "<span class='php_error' id='login_error_php'>Please <b>sign in</b> or <b>register</b></br>to view your deliveries</span>";
    }
    if ($method == 'tracking')
    {
        echo "<span class='php_error' id='login_error_php'>Please <b>sign in</b> or <b>register</b></br>to track a delivery</span>";
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

function trackPackages()
{
    if (CheckExist('email', 'delivery', 'user', $_SESSION))
    {
        $ID = GrabMoreData('SELECT ID FROM delivery WHERE user = :email AND status = "In Transit"', array(array(':email', $_SESSION['email'])));
        if(countResults($ID) > 1)
        {
            $IDval = $ID[0]['ID'];
            $selected = $IDval;
            echo "<form id='packageNumber' method='POST' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>
                    <label for='select_id' style='font-weight: bold;color: rgba(44, 70, 98, 0.55);'>DELIVERY NUMBER: </label><select id='select_id' name='ID' class='dropdown_number' onchange='(document.getElementById(\"packageNumber\").submit())'>";
            if (!empty($_POST['ID']))
            {
                $selected = $_POST['ID'];
            }
            for ($i = 1; $i <= countResults($ID); $i++)
            {
                echo "<option value=" . $ID[$i - 1]['ID'];
                if($ID[$i - 1]['ID'] == $selected)
                {echo " selected";}
                echo ">" . $i . "</option>";
            }
            echo "</select></form>";
        }
        else
        {
             $tracking = GrabMoreData('SELECT delivery_id, time, location FROM history WHERE delivery_id = (SELECT ID FROM delivery WHERE user = :email AND status = "In Transit") ORDER BY time DESC', array(array(':email', $_SESSION['email'])));
        }
        if (!empty($_POST['ID']))
        {
             $tracking = GrabMoreData('SELECT delivery_id, time, location FROM history WHERE delivery_id = :id ORDER BY time DESC', array(array(':id', $_POST['ID'])));
        }if (empty($_POST['ID']) && !empty($IDval))
        {
             $tracking = GrabMoreData('SELECT delivery_id, time, location FROM history WHERE delivery_id = :id ORDER BY time DESC', array(array(':id', $IDval)));
        }
        if (!isset($tracking) || !$tracking)
        {
            echo "<br/>You do not have any packages in transit at the moment..<br/><br/><br/><input type='button' onclick='(window.location.href = \"deliveries.php\")' value='VIEW YOUR DELIVERIES' class='button'/> ";
        }
        else
        {
            echo '<div id="table_holder">
                    <table>
                            <thead><tr>
                                     <th style="text-align: left;padding-left: 10px;
	                                   padding-right: 5px;">Location</th>
                                     <th>Time</th>
                                     <th>Date</th>
                                  </tr>
                            </thead>
                            <tbody>
                            ';
            foreach ($tracking as $step)
            {
                echo '<tr>
                <td class="delivery_location">' . ucfirst($step['location']) . '</td>
                ';
                echo '<td class="delivery_time">' . date('h:i a',$step['time']) . '</td>
                ';
                echo '<td class="delivery_date">' . date('D j M',$step['time']) . '</td></tr>
                ';
            }
            echo '</tbody></table></div>';
        }
    }
    else
        {
            echo "<br/>You have not requested a delivery yet..<br/><br/><br/><input type='button' onclick='(window.location.href = \"request.php\")' value='REQUEST A DELIVERY' class='button'/> ";
        }
}
?>