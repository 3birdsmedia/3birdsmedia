//$(document).ready(
function enablefields() {
	//window.alert($('input.pprint').is(':checked'));	
	if($('input.pprint').is(':checked')){
		//$('input.upload').removeAttr('disabled');
		$('div.pprint').fadeIn('fast');
		$('div.blank').fadeOut('fast');
	}else{
		//$('input.upload').attr('disabled', 'disabled');
		$('div.blank').fadeIn('fast');
		$('div.pprint').fadeOut('fast');
	}
	
}
//);

$(document).ready(function(){
	$("#AddToCartForm").validate();
});

/* CHECK IF THE NUMBER IS A FLOAT!!!!-------*/

function isFloat(value) {
		if (/\./.test(value)) {
		 
		return true;
		 
		} else {
		 
		return false;
		 
		}
}

/*   UPDATE THE PRICE OF THE FIRST INPUT !!!!!!!   */
function displayVals() {
		var qty = $("#qty").val()
		var totalprice = (<?php echo $price ?>*1) * (qty*1); 
			$("#price").html(" $" + totalprice + ".00");
			$('#priceHidden').attr('value', totalprice);
		//alert (qty);
	};

$("#qty").keypress(displayVals);
$("#qty").keydown(displayVals);
$("#qty").keyup(displayVals);
		
		

//function displayPrice(){
//Get the value from the input field
$('.bqty').change(function(){
   var bqty = $('#bqty').val();
   //Divide it by 25
	var checkPrime = (bqty*1)/25;
	alert (checkPrime);
	
	//Check if the result is a float
	checkedNum = isFloat(checkPrime);
	alert (checkedNum);
	//If the result is a float attach an error to the input field
	if(checkedNum == true){
		alert(checkPrime + ' ' + checkedNum +' is float');
		$('#bqty').after('<label class="error">Please use increments of 25</label>');
	}else{
	//if its not, then change the price to the new total.
		alert(checkPrime + ' ' + checkedNum + ' is Integer');
	}
});