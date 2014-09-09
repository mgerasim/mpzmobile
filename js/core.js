$(document).ready(function () {
	$("#name input").keyup(handleNameChange);
	$("#phone input").keyup(handlePhoneChange);
	$("#address input").keyup(handleAddressChange);
	$("#user input").keyup(handleUserChange);
	
	$("#save").click(handleSave);
	
});

var handleSave = function handleSave() {
	var bOk = false;
	bOk = checkName();
	bOk = checkPhone();
	bOk = checkAddress();
	bOk = checkUser();
	if (bOk) {
		saveOrder();
	}
	else {
	
	}
}


function saveOrder(){
	$$a({
	        type:'post',
	        url:'saveorder.php',
	        data:{'z':'1'},
	        response:'text',
	        success:function (data) {
				
	            $('#save_result').text = data;
	        }
	    });
    
  };
  


/* CHANGE */
function handleNameChange() {
	$("#name label").text("ФИО:");
	$("#name label").css('color', 'black');
}
function handlePhoneChange() {
	$("#phone label").text("Контактный телефон:");
	$("#phone label").css('color', 'black');
}
function handleAddressChange() {
	$("#address label").text("Адрес:");
	$("#address label").css('color', 'black');
}
function handleUserChange() {
	$("#user label").text("Фамилия агента:");
	$("#user label").css('color', 'black');
}

/* CHECK */
function checkName() {
	if ($("#name input").val() == "") {
		$("#name label").text("Укажите ФИО:");
		$("#name label").css('color','red');
		return false;	
	}
	return true;
}

function checkPhone() {
	if ($("#phone input").val() == "") {
		$("#phone label").text("Укажите контактный номер:");
		$("#phone label").css('color','red');
		return false;	
	}
	return true;
}

function checkAddress() {
	if ($("#address input").val() == "") {
		$("#address label").text("Укажите адрес:");
		$("#address label").css('color','red');
		return false;	
	}
	return true;
}

function checkUser() {
	if ($("#user input").val() == "") {
		$("#user label").text("Укажите фамилию агента:");
		$("#user label").css('color','red');
		return false;	
	}
	return true;
}