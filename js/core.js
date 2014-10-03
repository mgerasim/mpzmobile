$(document).ready(function () {
	$("#lastname input").keyup(handleLastNameChange);
	$("#firstname input").keyup(handleFirstNameChange);
	$("#phone input").keyup(handlePhoneChange);
	$("#address input").keyup(handleAddressChange);
	$("#user input").keyup(handleUserChange);
	
	$("#save").click(handleSave);
	
});

var handleSave = function handleSave() {
	var bOk = false;
	bOk = checkLastName();
	bOk = checkFirstName();
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
	$.ajax({
	        type:'POST',
	        url:'/saveorder.php',
	        data:{'lastname':$("#lastname input").val(), 'firstname':$("#firstname input").val(), 'secondname':$("#secondname input").val(), 'phone':$("#phone input").val(), 'address':$("#address input").val(), 'user':$("#user input").val(), 'tariff':$("#tariff input").val(), 'comments':$('#comments').val(), 'usluga-1':$('#checkbox-1a').is(':checked'), 'usluga-2':$('#checkbox-2a').is(':checked'), 'usluga-3':$('#checkbox-3a').is(':checked')  },
	        response:'text',
	        success:function (data) {
				$('#save_result').text(data);
	        }
	    });
    
  };
  


/* CHANGE */
function handleLastNameChange() {
	$("#lastname label").text("Фамилия:");
	$("#lastname label").css('color', 'black');
}
function handleFirstNameChange() {
	$("#firstname label").text("Имя:");
	$("#firstname label").css('color', 'black');
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
function checkLastName() {
	if ($("#lastname input").val() == "") {
		$("#lastname label").text("Укажите фамилию:");
		$("#lastname label").css('color','red');
		return false;	
	}
	return true;
}

function checkFirstName() {
	if ($("#firstname input").val() == "") {
		$("#firstname label").text("Укажите имя:");
		$("#firstname label").css('color','red');
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