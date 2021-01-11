const form = document.getElementById('form');
const studentid = document.getElementById('studentid');
const email = document.getElementById('email');
const password = document.getElementById('password');
const password2 = document.getElementById('password2');

form.addEventListener('submit', e => {
	e.preventDefault();
	
	checkInputs();
});

function checkInputs() {

	const studentidValue = studentid.value.trim();
	const emailValue = email.value.trim();
	const passwordValue = password.value.trim();
	const password2Value = password2.value.trim();
	
	// Check if student id is empty or not
	if(studentidValue === '') {
		setErrorFor(studentid, 'Student ID cannot be blank');
	} else {
		setSuccessFor(studentid);
	}
	
	// Check if email is empty or not and if it is a valid email
	if(emailValue === '') {
		setErrorFor(email, 'Email cannot be blank');
	} else if(!isValidEmail(emailValue)) {
		setErrorFor(email, 'Not a valid email');
	} else {
		setSuccessFor(email);
	}
	
	// Check if password is empty or not and if it has minimum of 8 characters
	if(passwordValue === '') {
		setErrorFor(password, 'Password cannot be blank');
	} else if(!isValidPassword(passwordValue)) {
		console.log(passwordValue);
        setErrorFor(password, 'Password must contain at least eight characters');
    } else {
		setSuccessFor(password);
	}
	
	// Check if confirmation password is empty or not and if it is the same as previous password
	if(password2Value === '') {
		setErrorFor(password2, 'Confirmation password cannot be blank');
	} else if(passwordValue !== password2Value) {
		setErrorFor(password2, 'Passwords does not match');
	} else{
		setSuccessFor(password2);
	}
}

function setErrorFor(input, message) {
	const formControl = input.parentElement;
    const small = formControl.querySelector('small');

	// Display error message and icon if there is an error
    formControl.className = 'form-control error';
	small.innerText = message;
	formControl.style.marginBottom = "6px";
}

function setSuccessFor(input) {

	// Display success message on correct input
	const formControl = input.parentElement;
	formControl.className = 'form-control success';
	formControl.style.marginBottom = "0";
}
	
// Function to check valid email using regex
function isValidEmail(emailValue) {
	return /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/.test(emailValue);
}

// Function to check valid password using regex, with minimum of 8 characters and must be a combination of alphabet
// and numeric
function isValidPassword(passwordValue) {
	return /^((?=\S*?[a-z])(?=\S*?[0-9]).{7,})\S$/.test(passwordValue);
}