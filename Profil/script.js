document.getElementById("formsMail").style.display = "none";

function toggleFormMail() {
	if(document.getElementById("formsMail").style.display = "none"){
		document.getElementById("formsMail").style.display = "block";
	} else {
		document.getElementById("formsMail").style.display = "none";
	}
}

function closeFormMail(){
	if(document.getElementById("formsMail").style.display="block"){
		document.getElementById("formsMail").style.display="none";
	}else{
		document.getElementById("formsMail").style.display="block";
	}
}


document.getElementById("formsMdp").style.display = "none";

function toggleFormPwd() {
	if(document.getElementById("formsMdp").style.display = "none"){
		document.getElementById("formsMdp").style.display = "block";
	} else {
		document.getElementById("formsMdp").style.display = "none";
	}
}

function closeFormPwd(){
	if(document.getElementById("formsMdp").style.display="block"){
		document.getElementById("formsMdp").style.display="none";
	}else{
		document.getElementById("formsMdp").style.display="block";
	}
}