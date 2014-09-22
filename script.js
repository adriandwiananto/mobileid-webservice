$(document).ready(function(){
	//called when key is pressed in form
	$('.form-signin').bind("keyup keypress", function(e) {
		var code = e.keyCode || e.which;
		//disable enter key form
		if (code  == 13) {
			$("#errmsg").html("Enter pressed").show().fadeOut("slow");
			e.preventDefault();
			//return false;
		}

    	//if the letter is not digit then display error and don't type anything
		if (code != 8 && code != 0 && (code < 48 || code > 57) && (code < 96 || code > 105)) {
		// if (code != 8 && code != 0 && (code < 48 || code > 57)) {
        	//display error message
        	$("#errmsg").html("Digits Only").show().fadeOut("slow");
            return false;
    	}

    	var digit = $('.form-control').val().length;
    	// $(".debugger").html("char len:"+digit).show();
    	if($('button').length == 0){
			if(digit == 16){
				$('form').append('<button class="btn btn-lg btn-primary btn-block" type="submit">Masuk</button>');
				// if('.form-signin'[3]){$(".debugger").html("true").show();}
			}
		}else{
			if(digit != 16){
				$('button').remove();
			}
		}
	});
});