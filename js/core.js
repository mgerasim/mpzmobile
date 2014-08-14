$(document).ready(function () {
	$("#name input").keyup(handleNameChange);
	$("#phone input").keyup(handlePhoneChange);
	$("#address input").keyup(handleAddressChange);
	$("#user input").keyup(handleUserChange);
	
	$("#save").click(handleSave);
	
	initTariff();	
});

var handleSave = function handleSave() {
	var bOk = false;
	bOk = checkName();
	bOk = checkPhone();
	bOk = checkAddress();
	bOk = checkUser();
	if (bOk) {
	
	}
	else {
	
	}

}
/* INIT */
function initTariff() {
	var xml_request = 	'<?xml version="1.0" encoding="UTF-8"?>' +
						 '<request reqType="GET_AV_TARIFF_INFO" '+
							'svcNum="q5345a22" ' +
							'svcTypeId="INTERNET_LOGIN" ' +
							'<SvcAddress ' +
							'> '+
							'infoType="2" ' +
							'destSystem="1" ' +
							'svcClassIdList="" ' +
						'</request>';
	$.ajax({
		type: 'POST',
		url: 'http://10.200.2.47:85/elk',
		data: 'xml='+xml_request,
		dataType: 'text',
		success: function(responseData, textStatus, jqXHR) {
        	var value = responseData.someKey;
    	},
    	error: function (responseData, textStatus, errorThrown) {
        	alert('POST failed.');
    	}
	});
	console.log(xml_request);
}

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