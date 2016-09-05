<?php include '../functions/functions.php';
if (session_id() == '')
{
    session_start();
}
if(isset($_SESSION['email']))
{
    unset($_SESSION["email"]);
    unset($_SESSION['position']);
    unset($_SESSION['password']);
    header("Location: ../index.php");
}

if (!empty($_POST))
{
    if ($_POST['method'] == 'login')
    {
       authenticateUser(); 
    }
    else if ($_POST['method'] == 'signup')
    {
        registerUser();
    }
}?>
<!DOCTYPE html>
<html>
    <head>
    <!--TITLE GOES HERE-->
        <title>Sign in -  drop.it</title>
        <link rel="SHORTCUT ICON" href="../images/icon.ico" />
        <link rel="icon" href="../images/icon.ico" type="image/ico" />
        <script type="text/javascript" src="../js/script.js"></script>
        <meta charset="utf-8"/>
        <meta name=viewport content="width=device-width, initial-scale=1">
         <link async href="../css/styles.css" rel="stylesheet" type="text/css"/>
        <link href="https://fonts.googleapis.com/css?family=Fredoka+One" rel="stylesheet">
    </head>
    <body>
        <div id="back_nav">
			<div id="wrapper">
				<header>
                    <a id="login_blue" class="menu menu_blue selected" href="pages/login.php">SIGN IN</a>
                    <a id="header" class="intro intro_blue" href="../index.php">drop.it</a>
					<a id="deliveries" class="menu menu_blue" href="deliveries.php">DELIVERIES</a>
					<a id="tracking" class="menu menu_blue" href="tracking.php">TRACKING</a>
                    <a id="request" class="menu menu_blue" href="request.php">REQUEST</a>
					<a id="request" class="menu menu_blue" href="history.php">HISTORY</a>
				</header>
					<div id="content">
                        <div id="form">
							<form class="form" id="signin_form" method='POST' action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>>
                                <span class="sign_title">Sign in your account</span>
								<input id="username_input" type="text" name="email" class="input_text" size="15" maxlength="30" autofocus placeholder="Email address"/><br>
								<input id="password_input" type="password" name="password" class="input_text" size="15" maxlength="30" placeholder="Password"/>
                                <input type="hidden" name="method" value="login"><br>
								<button type="submit" id="sign_in_button" class="button">SIGN IN</button>
                                <?php writeError("login");?>
							</form>
                            
                        <div id="separator">&nbsp;</div>
                            
                            <form class="form" id="signup_form" onsubmit="return Checkstuff()" method='POST' action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>>
                                <span class="sign_title">Register for an account</span>
							<div id="signup_text">
                                <div id="left">
									<input type="email" name="email" class="input_text" placeholder="Email address" required/>
                                    <span id="email_error" class="error_signup"></span>
                                    <br/>
									<input id="password" type="password" name="password_signup" size="15" maxlength="30" class="input_text" placeholder="Password" onchange="passwordsMatch()" required/>
                                    <br/>
                                    <input id="password2" type="password" size="15" maxlength="30" class="input_text" placeholder="Repeat password" onchange="passwordsMatch()" required/>
                                    <span id="password_error" class="error_signup"></span>
                                    <?php writeError("signup");?>
								</div>
								<div id="right">
                                    <input type="text" name="name" size="10" maxlength="50" class="input_text" placeholder="Full name" required/>
                                    <span id="name_error" class="error_signup"></span>
                                    <br/>
                                    <input type="tel" name="phone" size="12" maxlength="10" class="input_text" placeholder="Mobile phone" onkeyup="checkField(signup_form.contact.value, 'contact_error', 'Only numbers allowed')" required/>
                                    <span id="contact_error" class="error_signup"></span>
                                    <br/>
                                    <input type="text" name="dob" class="input_text" placeholder="Date of birth" onfocus="(this.type='date')" required/>
                                    <input type="hidden" name="method" value="signup">
                                    <span id="dob_error" class="error_signup"></span>
                                    <br/>
                                    <input id='signup_button' type="submit" value="REGISTER" class="button">
								</div>
                                </div>
						</form>
                        </div>
                        <footer id="footer">
                        <p> Designed by Yannick Mansuy - 2016</p>
					</footer>
					</div>
				</div>
			</div>
    </body>
</html>