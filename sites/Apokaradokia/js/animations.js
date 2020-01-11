var animFlag = false

var wHeight = $( window ).height();
var wWidth 	= $( '.container' ).width();
$('#intro').height(wHeight);
var boxHeight 	= (wHeight - 100)/4;
var boxWidth 	= (wWidth - 80)/3;
$('#intro .box').css({	"height":boxHeight,
				"width":boxWidth,});

var wMiddle = (wHeight/2)-(boxHeight/2);
var wCenter = (wWidth/2)-(boxWidth/2);
//alert(wWidth/2 +' - ' + boxWidth/2 + ' - ' + wCenter);
$('#intro .box').css({	top: wMiddle,
				left: wCenter
				});

$(document).ready(function(){
	$('#intro .box').each(function(index) {
		setTimeout(function(){
			$('#intro .box'+(index+1)).fadeIn(500);

				setTimeout(function(){
					$('#intro .box'+(index+1)).fadeOut(500);},1500);
			if(index == '5'){
				setTimeout(function(){
					spread(wWidth, wHeight, boxWidth, boxHeight);},2000);
			}

		}, 1000*index);
		animFlag = true;
		
	});
});
    

$(window).resize(debouncer(function (e) {


setTimeout(function(){	
	var wHeight = $( window ).height();
	var wWidth 	= $( '.container' ).width();
	$('#intro').animate({height:wHeight});
	var boxHeight 	= (wHeight - 100)/4;
	var boxWidth 	= (wWidth - 80)/3;
	$('#intro .box').css({	"height":boxHeight,
					"width":boxWidth,});

	var wMiddle = (wHeight/2)-(boxHeight/2);
	var wCenter = (wWidth/2)-(boxWidth/2);
	//alert(wWidth/2 +' - ' + boxWidth/2 + ' - ' + wCenter);
	$('#intro .box').css({	top: wMiddle,
					left: wCenter
					});

	$(document).ready(function(){


			$('#intro .box').each(function(index) {
				setTimeout(function(){
					$('#intro .box'+(index+1)).fadeIn(500);
					if(index == '5'){
						setTimeout(function(){
							spread(wWidth, wHeight, boxWidth, boxHeight);},2000);
					} 	
				}, 1000*index);
				
			});
	});
},500);//end set time out

    
    
}));
  
//--------------------------------------------------------------------------------------------------------------------------------------------------
//---------------------------PREVENT RESIZE TO FIRE UP MORE THAN ONE EVENT
//----------------------------------------------------------------------------------------------------------------------------------------------------
//just wrap funtion in this 
//    $(window).resize(debouncer(function (e) {
//        // do stuff 
//    }));
function debouncer(func, timeout) {
    var timeoutID, timeout = timeout || 500;
    return function () {
        var scope = this, args = arguments;
        clearTimeout(timeoutID);
        timeoutID = setTimeout(function () {
            func.apply(scope, Array.prototype.slice.call(args));
        }, timeout);
    }
}// Select all links with hashes


function spread(windowW, windowH, bWidth, bHeight){
	//$('#intro .box').fadeOut(500);
	console.log("spread");
	setTimeout(function(){
		$('#intro .box1').fadeIn(1500).css({top:'20px'});
		$('#intro .box2').fadeIn(1500).css({top: (bHeight+40)+'px'});
		$('#intro .box3').fadeIn(1500).css({left:'20px', top: (bHeight+40)+'px'});
		$('#intro .box4').fadeIn(1500).css({left:((windowW/2)+(bWidth/2))+20+'px',top: (bHeight+40)+'px'});
		$('#intro .box5').fadeIn(1500).css({top: ((bHeight*2)+60)+'px'});
		$('#intro .box6').fadeIn(1500).css({top: ((bHeight*3)+80)+'px'});
	
		setTimeout(function(){$('.scrollDown').addClass('blink');}, 1000);

	}, 1000);
};