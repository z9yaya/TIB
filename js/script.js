function passwordsMatch() {
    if (document.getElementById("password").value != document.getElementById("password2").value) {
        document.getElementById("password_error").style.display = "inline";
		document.getElementById("password_error").innerHTML = "Passwords do not match";
        return false;
    } else {
        return true;
    }
}