function intro() {
init();
function init(){
	$('a.submit').click(login);
	$('a.register').click(register);
}
function register(){
var registerData={name:$('.register input[name=name]').val(),password:$('.register input[name=password]').val(),email:$('.register input[name=email]').val()};
	var response=$.ajax({
		type: "POST",
		url: "http://fu.no-ip.biz/php/register.php",
		data: registerData,
		crossDomain: true,
		dataType: "jsonp",
		cache: false,
	});
	response.success(function(data){
		if(data.success){
		registerSuccess(data.message);
		}else{
		registerFail(data.message);
		}
	});
}
function login(){
	var loginData={name:$('.login input[name=name]').val(),password:$('.login input[name=password]').val()};
	var response=$.ajax({
		type: "POST",
		url: "http://fu.no-ip.biz/php/login.php",
		data: loginData,
		crossDomain: true,
		dataType: "jsonp",
		cache: false,
	});
	response.success(function(data){
		if(data.access){
		loginSuccess(data.message);
		}else{
		loginFail(data.message);
		}
	});
}
function loginSuccess(message){
	alert('loginSuccess');
}
function loginFail(message){
	alert('loginFail');
}
function registerSuccess(message){
	alert('registerSuccess');
}
function registerFail(message){
	alert('registerFail');
}
}
$(document).ready(intro);
