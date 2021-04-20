function validate_car() {
	const reg = /[0-9][0-9][0-9][0-9][A-Z][A-Z][A-Z]/
	
	var errors = "";
	document.getElementById('error_Registration').innerHTML = "";
	document.getElementById('error_Model').innerHTML = "";
	document.getElementById('error_RegistrationDate').innerHTML = "";
	document.getElementById('error_Brand').innerHTML = "";
	document.getElementById('error_Condition').innerHTML = "";
	document.getElementById('error_Upgrades').innerHTML = "";
	document.getElementById('error_Price').innerHTML = "";
	document.getElementById('error_Category').innerHTML = "";


	if (document.getElementById("Registration").value.length==0){
		errors += "The 'Registration' can't be empty \n";
		document.getElementById('error_Registration').innerHTML = "The 'Registration' can't be empty";

	} else {
		if (!reg.test(document.getElementById("Registration").value)) {
			errors += "The 'Registration' number is invalid must be in format '0000AAA'"
			document.getElementById('error_Registration').innerHTML = "The 'Registration' number is invalid must be in format '0000AAA'";

		}

	}
    
    if (document.getElementById("Model").value.length==0){
		errors += "The 'Model' can't be empty \n";
		document.getElementById('error_Model').innerHTML = "The 'Model' can't be empty";

    }
    
    if (document.getElementById("RegistrationDate").value.length==0){
		errors += "The 'Registration Date' can't be empty \n";
		document.getElementById('error_RegistrationDate').innerHTML = "The 'Registration Date' can't be empty";
	}
	if (document.getElementById("Category").value.length==0){
		errors += "The 'Price' can't be empty \n";
		document.getElementById('error_Category').innerHTML = "The 'Category' can't be empty";
	}

	if (document.getElementById("Price").value.length==0){
		errors += "The 'Price' can't be empty \n";
		document.getElementById('error_Price').innerHTML = "The 'Price' can't be empty";
	}
	if (parseInt(document.getElementById("Price").value) < 0) {
		errors += "The 'Price' must be an Integer \n";
		document.getElementById('error_Price').innerHTML = "The 'Price' must be an Integer";
	}
    
    if (document.getElementById("Brand").value.length==0){
		errors += "The 'Brand' can't be empty \n";
		document.getElementById('error_Brand').innerHTML = "The 'Brand' can't be empty";

	}    

	var radiochecker = false;
	if (document.getElementById("New").checked){
		radiochecker = true;
	} else if (document.getElementById("Used").checked) {
		radiochecker = true;
	} else if (document.getElementById("Old").checked) {
		radiochecker = true;
	} else {

		errors += "The 'Condition' can't be empty \n";
		document.getElementById('error_Condition').innerHTML = "The 'Condition' can't be empty";

	}
	
	var checkedValue = ""; 
	var inputElements = document.getElementsByClassName('Upgrade');
	for(var i=0; inputElements[i]; ++i){
		if(inputElements[i].checked){
			checkedValue += inputElements[i].value + " ";
		}
	}

	if (checkedValue.length==0){
		errors += "The 'Upgrades' can't be empty \n";
		document.getElementById('error_Upgrades').innerHTML = "The 'Upgrades' can't be empty";

	}
	if (errors.length > 0){
		//document.getElementById('error').innerHTML = errors;

	} else {
        //console.log("fuciona2");
        document.formcars.action="index.php?page=controller_user&op=create";
		document.formcars.submit();
	}
	
}