$("#connectWithNgos").validator().on("submit", function (event){
	if (event.isDefaultPrevented()) {
		formError();
		submitMSG(false, "Did you fill in the required fields?")
		}else{
			event.preventDefault();
			submitForm();
		}
});

function submitForm(){
	//create variables with form content
	var firstName = $("[name=firstName]").val();
	var lastName = $("[name=lastName]").val();
	var formEmail = $("[name=formEmail]").val();
	var formSubject = $("[name=formSubject]").val();
	var formMessage = $("[name=formMessage]").val();

	$.ajax({
		type: "POST",
		url: "php/index.php",
		data: "firstName=" + firstName + "&lastName=" + lastName + "&formEmail=" + formEmail + "&formSubject=" + formSubject + "&formMessage=" + formMessage,
		success: function(text){
			if (text == "success") {
				formSuccess();
			}else{
				formError();
				submitMSG(false,text);
			}
		}

	});
}

function formSuccess(){
	$("#connectWithNgos")[0].reset();
	submitMSG(true, "Message Sent Successfully!")
}

function formError(){
	$("#connectWithNgos").removeClass().addClass('shake animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
		$(this).removeClass();
	});
}

function submitMSG(valid, msg){
		var msgClasses;
	if (valid){
		var msgClasses = "h3 text-center tada animated text-success";
	}else{
		var msgClasses = "h3 text-center text-danger";
	}
	$("#submitMessage").removeClass().addClass(msgClasses).text(msg);
}

$(function(){
    $(".flip").flip({
        trigger: 'hover'
    });
});