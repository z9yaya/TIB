<!DOCTYPE html>
<html>
    <head>
    <!--TITLE GOES HERE-->
        <title>Sign in - Drop Deliveries</title>
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
					<a id="login_blue" class="menu menu_blue" href="pages/login.php">SIGN IN</a>
					<a id="header" class="intro intro_blue" href="../index.html">drop</a>
					<a id="deliveries" class="menu menu_blue" href=deliveries.php>DELIVERIES</a>
					<a id="tracking" class="menu menu_blue" href=deliveries.php>TRACKING</a>
					<a id="new" class="menu menu_blue" href=deliveries.php>NEW</a>	
				</header>
					<div id="content">
                        <div id="form">
							<form class="form" id="signin_form">
                                <span class="sign_title">Sign in your account</span>
								<input id="username_input" type="text" name="username" class="input_text" size="15" maxlength="30" autofocus placeholder="Email address"/><br>
								<input id="password_input" type="password" name="password" class="input_text" size="15" maxlength="30" placeholder="Password"/><br>
								<button type="submit" id="sign_in_button" class="button">SIGN IN</button>
							</form>
                            
                        <div id="separator">&nbsp;</div>
                            
                            <form class="form" id="signup_form">
                                <span class="sign_title">Register for an account</span>
							<div id="signup_text">
                                <div id="left">
									<input type="email" name="email" class="input_text" placeholder="Email address"/>
                                    <span id="email_error" class="error_signup"></span>
                                    <br/>
									<input type="password" name="reg_password" size="15" maxlength="30" class="input_text" placeholder="Password"/>
                                    <span id="password_error" class="error_signup"></span>
                                    <br/>
                                    <input type="tel" name="contact" size="12" maxlength="10" class="input_text" placeholder="Mobile phone"/>
                                <span id="contact_error" class="error_signup"></span>
								</div>
								<div id="right">
                                    <input type="text" name="f_name" size="10" maxlength="50" class="input_text" placeholder="First name"/>
                                    <span id="fn_error" class="error_signup"></span>
                                    <br/>
                                    <input type="text" name="l_name" size="10" maxlength="50" class="input_text" placeholder="Last name"/>
                                    <span id="ln_error" class="error_signup"></span>
                                    <br/>
                                    <input type="date" name="dob" placeholder="dd/mm/yyyy" class="input_text" placeholder="Date of birth"/>
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