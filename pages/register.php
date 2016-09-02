<!DOCTYPE html>
<html>
    <head>
        <!--TITLE GOES HERE-->
        <title>Register - Spots</title>
		<link rel="SHORTCUT ICON" href="../images/icon.ico" />
		<link rel="icon" href="../images/icon.ico" type="image/ico" />
        <script type="text/javascript" src="../js/script.js"></script>
        <meta charset="utf-8"/>
        <link href="../css/styles.css" rel="stylesheet" type="text/css"/>
		<link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'> <!--FONT LICENSE AND SOURCE https://www.google.com/fonts/specimen/Lobster -->
    </head>
    <body>
		<div id="back_nav">
            <div id="wrapper">
                <?php include('../php/nav.php');
                    displayNav("register");?>
				<div id="content_base">
					<div id="content">
						<form id="single_form_long">
							<div id="signup_text">
								<select name="title" id="title" class="input_text">
									<option value="none" selected>Select a title</option>
									<option value="mr">Mr</option>
									<option value="mrs">Mrs</option>
									<option value="ms">Ms</option>
								</select>
                                <p id="title_error" class="error_signup"></p>
								<p>
									<label class="input_label">First Name: </label>
									<input type="text" name="f_name" size="10" maxlength="50" class="input_text"/>
								</p>
                                <p id="fn_error" class="error_signup"></p>
								<p>
                                    <label class="input_label">Last Name: </label>
									<input type="text" name="l_name" size="10" maxlength="50" class="input_text"/>
								</p>
                                <p id="ln_error" class="error_signup"></p>
                                <p>
									<label class="input_label">Date Of Birth: </label>
                                    <input type="text" name="dob" size="10" maxlength="10" placeholder="dd/mm/yyyy" class="input_text"/> 
                                </p>
                                <p id="dob_error" class="error_signup"></p>
								<p>
                                    <label class="input_label">Mobile (no spaces): </label>
                                    <input type="tel" name="contact" size="12" maxlength="10" class="input_text"/>
                                </p>
                                <p id="contact_error" class="error_signup"></p>
								<p>
									<label class="input_label">E-mail: </label>
									<input type="email" name="email" class="input_text"/>
								</p>
                                <p id="email_error" class="error_signup"></p>
									<label class="input_label">Password: </label>
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
				</div>
				<footer id="footer">
					<p>Ronald Grande &amp; Yannick Mansuy - CAB230 - 2016</p>
				</footer>
			</div>
		</div>
    </body>
</html>