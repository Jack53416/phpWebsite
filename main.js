toggleLoginForm.visible = false;
toggleSubmitForm.visible = false;

function toggleLoginForm(){
	if(toggleLoginForm.visible)
		document.getElementById('loginForm').classList = "hidden";
	else
		document.getElementById('loginForm').classList = "visible";
	toggleLoginForm.visible = !toggleLoginForm.visible;
}

function toggleSubmitForm(){
	if(toggleSubmitForm.visible){
		document.querySelector('.signUpForm').classList = "signUpForm hidden";
		document.querySelector('.flexContainer').style.animation = "";
	}
	else{
		document.querySelector('.signUpForm').classList = "signUpForm visible";
		let pageContent = document.querySelector('.flexContainer');
		pageContent.classList = "flexContainer content";
		pageContent.style.animation = "blur 1s 0.2s linear forwards";
	}
	toggleSubmitForm.visible = !toggleSubmitForm.visible;
}
