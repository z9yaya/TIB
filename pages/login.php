<!DOCTYPE html>
<html>
    <head>
    <!--TITLE GOES HERE-->
        <title>Sign in - Drop Deliveries</title>
        <link rel="SHORTCUT ICON" href="../images/icon.ico" />
        <link rel="icon" href="../images/icon.ico" type="image/ico" />
        <script type="text/javascript" src="../js/script.js"></script>
        <meta charset="utf-8"/>
         <link async href="../css/styles.css" rel="stylesheet" type="text/css"/>
        <link href="https://fonts.googleapis.com/css?family=Baloo+Tamma" rel="stylesheet">
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
								<label id="title_username">Enter your e-mail:<br /></label><input id="username_input" type="text" name="username" size="15" maxlength="30" autofocus/><br>
								<label id="title_password">Enter your password:<br /></label><input id="password_input" type="password" name="password" size="15" maxlength="30"/><br>
								<button type="submit" id="sign_in_button">sign in</button>
							</form>
                        <div id="separator">&nbsp;</div>
                            <form class="form" id="signup_form">
							<div id="signup_text">
								<select name="title" id="title" class="input_text">
									<option value="none" selected>Select a title</option>
									<option value="mr">Mr</option>
									<option value="mrs">Mrs</option>
									<option value="ms">Ms</option>
								</select>
                                <p id="title_error" class="error_signup"></p>
								<p>
									<label class="input_label">First Name: </label><br/>
									<input type="text" name="f_name" size="10" maxlength="50" class="input_text"/>
								</p>
                                <p id="fn_error" class="error_signup"></p>
								<p>
                                    <label class="input_label">Last Name: </label><br/>
									<input type="text" name="l_name" size="10" maxlength="50" class="input_text"/>
								</p>
                                <p id="ln_error" class="error_signup"></p>
                                <p>
									<label class="input_label">Date Of Birth: </label><br/>
                                    <input type="text" name="dob" size="10" maxlength="10" placeholder="dd/mm/yyyy" class="input_text"/> 
                                </p>
                                <p id="dob_error" class="error_signup"></p>
								<p>
                                    <label class="input_label">Mobile (no spaces): </label><br/>
                                    <input type="tel" name="contact" size="12" maxlength="10" class="input_text"/>
                                </p>
                                <p id="contact_error" class="error_signup"></p>
								<p>
									<label class="input_label">E-mail: </label><br/>
									<input type="email" name="email" class="input_text"/>
								</p>
                                <p id="email_error" class="error_signup"></p>
									<label class="input_label">Password: </label><br/>
									<input type="password" name="reg_password" size="15" maxlength="30" class="input_text" placeholder="min 8 characters"/>
                                <p id="password_error" class="error_signup"></p>
								<div id="signup_location">
										<label class="input_label">Do you live in brisbane?<br/></label>
										<input type="radio" id="yes" name="in_brisbane" value="yes" /><label for="yes" class="input_label">Yes</label>
										<input type="radio" id="no" name="in_brisbane" value="no"/><label for="no" class="input_label">No </label>
                                        <p id="radio_error" class="error_signup"></p>
										<!-- <label class="input_label" id="signup_suburb_label">Suburb: </label>
										<input type="text" name="reg_suburb" size="10" maxlength="50" id="suburb_input" class="input_text" /> -->
								</div>
								<div id="device_question">
									<label class="input_label">From which device(s) do you access wifi internet from?</label><br/><br/>
									<input type="checkbox" id="smartphone" name="device" value="smartphone" class="input_label"/><label for="smartphone" class="input_label">Smartphone</label>
									<input type="checkbox" id="tablet" name="device" value="tablet" class="input_label"/><label for="tablet" class="input_label">Tablet</label>
									<input type="checkbox" id="laptop" name="device" value="laptop" class="input_label"/><label for="laptop" class="input_label">Laptop</label>
								</div>
							</div>
							<a id="signup_button" onclick="validate()">register</a>
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