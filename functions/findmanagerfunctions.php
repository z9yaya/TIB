<?php

///function used to connect to create a new connection object to connect to the database
function connect()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=tib', 'edit', 'editme');
        $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);

        return $pdo;
    }//end connect

///Used to register new users on the database,
///grabs all the data from the form, then formats it, binds it to variables for inserting into database,
///then pushes email,position and password to $_SESSION
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

///Used to authenticate an existing user on the system, grabs data from form then checks against the database and pushes to $_SESSION
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

///Used to check if a row with the specified value exist in a table
///INPUT $attribute: index name in $_GET or $_POST
///INPUT $table: name of table in database
///INPUT $column: name of column to check against in database
///INPUT $getOrpost: specifies where the data is stored, options:$_GET or $_POST
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

///Used to return single cell from database
///INPUT $table: table in the database where to look for the data
///INPUT $column: the name of the column you want to select
///INPUT $where_column: the name of the column that contains the data that needs to match the input
///INPUT $where: the data that will be looked for in the specified column.
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

///Used to return the results of a specified mySQL query
///$query is the basic mySQL query eg: "SELECT * FROM users WHERE email = :email AND password = :password".
///$bind is a nested array, must be in pairs, eg: 'array(array(':email', 'generic@email.com'), array(':password', 'passwordtext'))'
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

///function used to write the error message when trying to access a restricted page
//INPUT $method: options: "login", "signup", "request", "deliveries", "tracking"
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

///used to count the number of objects in an array
///INPUT $resultsItems: array containing data/objects
function countResults($resultsItems)
        {
            $num_rows=0;
            for ($i=0;$i < count($resultsItems); $i++) 
            {
                $num_rows++;
            }
            return $num_rows;

        }

///used to display the tracking information requested,
//checks if user is logged in, and then fetches the information for the requested delivery item that can be selected using a drop down which is also generated in this function.
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

///used to send a complaint email using the website, currently uses gmail account to send emails,
///grabs the data from the submitted form, then picks the data to generate a basic email sent to the ///email address of your choice, in this case my personal email address
function Emailer()
{
    if (isset($_POST))
            {
                 if (!empty($_POST) && !empty($_POST['contents']) && !empty($_POST['email']) && !empty($_POST['name']) && !empty($_POST['type']))
                    {
                        $account="dropitdeliveries@gmail.com";//source email, DO NOT CHANGE
                        $password="drop.itsupport";//source password, DO NOT CHANGE
                        $to="ze_yaya@msn.com";//recipient ze_yaya@msn.com
                        $from = $_POST['email']; //reply to email
                        $name = $_POST['name'];
                        $from_name= $name; //From name
                        $msg= htmlspecialchars($_POST['contents']); // HTML message
                        $subject="Enquiry Type: " . $_POST['type'];//email subject                     
                        $mail = new PHPMailer();
                        $mail->IsSMTP();
                        $mail->CharSet = 'UTF-8';
                        $mail->Host = "smtp.gmail.com";
                        $mail->SMTPAuth= true;
                        $mail->Port = 465;
                        $mail->Username= $account;
                        $mail->Password= $password;
                        $mail->SMTPSecure = 'ssl';
                        $mail->addReplyTo($from, $name);
                        $mail->FromName = $name;
                        $mail->isHTML(true);
                        $mail->Subject = $subject;
                        $mail->Body = $msg;
                        $mail->addAddress($to);
                        if(!$mail->send())
                        {
                            echo "Mailer Error: " . $mail->ErrorInfo;
                        }
                        else
                        {
                            echo "E-Mail has been sent";
                            header("Location: ../index.php");
                        }
                 }
}
}

///used to add the selected delivery ID to a hidden input on the complaint form.
function WriteID()
{
     if (isset($_POST))
            {
                 if (!empty($_POST) && !empty($_POST['delivery']))
                    {
                        echo $_POST['delivery'];
                    }

            }
}

///used to generate the dropdown menu on the log page,
///fetches id of deliverys from database where the user is the selected driver, then puts them in a select box.
function AddDropLog()
{
     if (session_id() == '')
    {
        session_start();
    }
    if (isset($_SESSION))
            {
                 if (!empty($_SESSION) && !empty($_SESSION['email']))
                    {
                        $driver = $_SESSION['email'];
                        $ID = GrabData("delivery","ID","driver",$driver);
                        if ($ID != false)
                        {
                            for ($i = 0; $i < countResults($ID); $i++)
                            {
                                echo "<option value=" . $ID[$i]['ID'];
                                echo ">" . $ID[$i]['ID'] . "</option>";
                            }
                        }
                        else 
                        {
                             echo "<option value=\"\">No deliveries assigned</option>";
                        }
                    
                        
                    }
            }
}

//used to add the instant messaging system to a page when the required criterias are met
function AddChat()
{
    if (session_id() == '')
    {
        session_start();
    }
    if (isset($_SESSION))
    {
                 if (!empty($_SESSION) && !empty($_SESSION['email']) && $_SESSION['position'] != 'customer')
                 {
                        echo '<div id=ChatSystem>
                            <div id="messageBox">
                                <div class="name">
                                <span id="name" onclick="hideChat()"></span>
                                <span id="close" onclick="closeChat()" title="Close">x</span>
                                </div>
                                <div id="id" class="chat" onmouseover="stopScroll(true)" onmouseout="stopScroll(false)"></div>
                                    <form onsubmit="event.preventDefault()">
                                    <input type="text" name="text" id="chat_input">
                                        <input type="submit" id="submitText"></form>
                            </div>
                            <div id="contactsPart">
                            <input type="checkbox" id="hideContacts" checked>
                            <div id="contacts_bar"><div class="name Hid" id="contacts_title" onclick="HideContactsBar()" title="Hide/Show contacts">Contacts</div>';
                             if ($_SESSION['position'] != 'manager')
                             {
                                 echo '<div id="manager"></div>';
                             }
                    echo '<div id="driver"></div></div></div>
                        </div>';
                 }
    }
}
?>