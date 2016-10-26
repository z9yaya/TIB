var packageNumber = 1;
//INPUT obj: input from a form
//checks if an input is empty or not then returns true if it is.
function isEmpty(obj) {
	if (obj.length === 0) {
		return true;
	} else {
		return false;
	}
}//end isEmpty

//INPUT error_id: string value representing id attribute of HTML <p> tag
/*inserts html in between HTML <p> tags notifying of an empty field*/
function printEmptyFieldError(error_id) {
	document.getElementById(error_id).innerHTML = "This field cannot be empty";
}//end printEmptyFieldError()

//INPUT fn_or_ln: string value to be prepended in message
//INPUT error_id: string value representing id attribute of HTML <p> tag
/*to be used for first name and last name validation displays invalid input message*/
function printInvalidFieldError(fn_or_ln ,error_id) {
	document.getElementById(error_id).innerHTML = fn_or_ln + " name can only contain letters and spaces";
}//end printInvalidFieldError

//INPUT obj: form name attribute
//INPUT id: string value representing id attribute of HTML <p> tag
//INPUT fn_or_ln: string value to be prepended in message
/*to be used for first name and last name validation, executes validation for
empty, invalid and valid fields and displays corresponding message*/
function checkName(obj, id, fn_or_ln) {
	var name_pattern = /^[a-z,A-Z ]+$/;

	if (isEmpty(obj, id)) {
		printEmptyFieldError(id);
	} else if (!name_pattern.test(obj)){
		printInvalidFieldError(fn_or_ln, id)
	} else {
		document.getElementById(id).innerHTML = "";
	}
}//end checkName

//INPUT obj: form name attribute
//INPUT id: string value representing iattribute of HTML <p> tag
//INPUT rgx: regex to be tested
//INPUT msg: message to be displayed for invalid inputs
/*generic field validator executes validation for
empty, invalid and valid fields and displays corresponding message*/
function checkField(obj, id, rgx, msg) {
	if (isEmpty(obj)) {
		printEmptyFieldError(id);
	} else if (!rgx.test(obj)) {
		document.getElementById(id).innerHTML = msg;
	} else {
		document.getElementById(id).innerHTML = "";
	}
}//end chedkField

/*to be used for password validation, executes validation for
empty, invalid and valid fields and displays corresponding message*/
function passwordsMatch() {
    if(isEmpty(document.getElementById("password2").value)) {
		printEmptyFieldError("password_error");
	} else if (document.getElementById("password").value != document.getElementById("password2").value) {
        console.log(document.getElementById("password").value);
        console.log(document.getElementById("password2").value);
        document.getElementById("password_error").style.display = "inline";
		document.getElementById("password_error").innerHTML = "Passwords do not match";
        return false;
    } else {
        document.getElementById("password_error").style.display = "none";
        console.log(document.getElementById("password").value);
        console.log(document.getElementById("password2").value);
        return true;
    }
}

//INPUT obj: form name attribute
//INPUT id: string value representing id attribute of HTML <p> tag
//INPUT rgx: regex to be tested
//INPUT msg: message to be displayed for invalid inputs
/*generic field validator executes validation for
empty, invalid and valid fields and displays corresponding message*/
function checkField(obj, id, msg) {
    var rgx= new RegExp(/[0-9]{10}/);
	if (isEmpty(obj)) {
		printEmptyFieldError(id);
        return false;
	} else if (!rgx.test(obj)) {
        document.getElementById(id).style.display="inline";
		document.getElementById(id).innerHTML = msg;
        return false;
	} else {
        document.getElementById(id).style.display="none";
		document.getElementById(id).innerHTML = "";
        return true;
	}
}//end chedkField


/*execute functions to check password and number*/
function Checkstuff()
{
    var numb = checkField(document.getElementById('numberInput').value, 'contact_error', 'Only numbers allowed');
    var pass = passwordsMatch();
    if (!numb || !pass)
        {
            console.log("false");
            console.log(numb);
            console.log(pass);
            return false;
        }
    else
        console.log("true");
        return true;
}



/*Used to create a new Package */
function AddPackage()
{
    if (packageNumber < 5)
       {
            var div = document.createElement('div');
            packageNumber++;
            div.className="package";
            div.innerHTML='<input type="button" class="exit" onclick="Exit(this);" value="x" title="Remove package"><span class="title">PACKAGE ' + packageNumber + '</span><input type="number" step="0.01" min="0.5" max="15" id="weight" name="weight[]" size="12" maxlength="10" class="input_text" placeholder="Weight in kg" required/><br><textarea rows="4" cols="50" name="contents[]" class="input_text textarea textarea_height" placeholder="Package contents" onkeyup="this.className=\' input_text textarea text_long\'" required></textarea></div>';
            document.getElementById("packages_container").appendChild(div);  
       }
    else
        {
             document.getElementById("button_new_package").style.display="none";
            var div = document.createElement('div');
            packageNumber++;
            div.className="package";
            div.innerHTML='<span class="exit" onclick="Exit(this);">x</span><span class="title">PACKAGE ' + packageNumber + '</span><input type="number" step="0.01" min="0.5" max="15" id="weight" name="weight[]" size="12" maxlength="10" class="input_text" placeholder="Weight in kg" required/><br><textarea rows="4" cols="50" name="contents[]" class="input_text textarea textarea_height" placeholder="Package contents" onkeyup="this.className=\' input_text textarea text_long\'" required></textarea></div>';
            document.getElementById("packages_container").appendChild(div);  
        }
}

//used to remove package input boxes and hide the "ADD PACKAGE" button when the limit of 6 has been //reached,
//the button is re-added when the number of packages is below 6
function Exit(Element)
{
    Element.parentElement.remove();
    packageNumber--;
    if (packageNumber < 6 && document.getElementById("button_new_package").style.display=="none")
        {
            document.getElementById("button_new_package").style.display="inline-block";
        }
        
}

//used to assign value to an input, before changing it to a date input
//INPUT Today: the specified date in format Y-m-d
//INPUT Object: the element that needs to be changed.
function ChangeDate(Today, Object)
{
    Object.value=Today;
    Object.type='date';
    
}

//used to assign a value to an input, before changing it to a time input
//INPUT Today: the specified time in format H:i
//INPUT Object: the element that needs to be changed
function ChangeTime(Today, Object)
{
    Object.value=Today;
    Object.type='time';
    
}

function ScrollingToServices()
{
        scrollTo(0, window.innerHeight);
}
    
