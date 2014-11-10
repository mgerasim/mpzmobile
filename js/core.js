$(document).ready(function () {
	$("#lastname input").keyup(handleLastNameChange);
	$("#firstname input").keyup(handleFirstNameChange);
	$("#phone input").keyup(handlePhoneChange);
	$("#address input").keyup(handleAddressChange);
	$("#user input").keyup(handleUserChange);
	$("#supervisor input").keyup(handleSupervisorChange);
	
	$("#save").click(handleSave);
	
});

var handleSave = function handleSave() {
	var bOk = true;
	checkLastName();
	if (bOk) bOk = checkLastName();
	checkFirstName();
	if (bOk) bOk = checkFirstName();
	checkPhone();
	if (bOk) bOk = checkPhone();
	checkAddress();
	if (bOk) bOk = checkAddress();
	checkUser();
	if (bOk) bOk = checkUser();
	checkSupervisor();
	if (bOk) bOk = checkSupervisor();
	if (bOk) {
		saveOrder();
	}
}


function saveOrder(){
	var city = "";
	if (YMaps.location) {
		city = YMaps.location.city;
	}	
	var longitude = 0;	
	if (YMaps.location) {
		longitude = YMaps.location.longitude;
	}		
	var	latitude = 0;	
	if (YMaps.location) {
		latitude = YMaps.location.latitude;
	}	
	if (city =='') {
		city = 'не определен';
		longitude = 0;
		latitude = 0;
	}
	$.ajax({
	        type:'POST',
	        url:'/saveorder.php',
	        data:{'lastname':$("#lastname input").val(), 'firstname':$("#firstname input").val(), 'secondname':$("#secondname input").val(), 'phone':$("#phone input").val(), 'address':$("#address input").val(), 'user':$("#user input").val(), 'tariff':$("#tariff input").val(), 'comments':$('#comments').val(), 'usluga-1':$('#checkbox-1a').is(':checked'), 'usluga-2':$('#checkbox-2a').is(':checked'), 'usluga-3':$('#checkbox-3a').is(':checked'), 'city':city, 'longitude':longitude, 'latitude':latitude, 'supervisor':$("#supervisor input").val()  },
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
function handleSupervisorChange() {
	$("#supervisor label").text("Супервайзер:");
	$("#supervisor label").css('color', 'black');
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

function checkSupervisor() {
	if ($("#supervisor input").val() == "") {
		$("#supervisor label").text("Укажите супервайзерa:");
		$("#supervisor label").css('color','red');
		return false;	
	}
	return true;
}