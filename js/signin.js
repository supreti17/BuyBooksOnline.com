window.onload = function() {
	var signUpText = document.getElementById("sign_up_text");
	var signInText = document.getElementById("sign_in_text");
	signUpText.onclick = hideSignIn;
	signInText.onclick = hideSignUp;
}

function hideSignIn() {
	document.getElementById("signin_form").style.display = "none";
	document.getElementById("signup_form").style.display = "block";
}

function hideSignUp() {
	document.getElementById("signup_form").style.display = "none";
	document.getElementById("signin_form").style.display = "block";
}

