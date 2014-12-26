$(document).ready(main);


function main(){	
	$(window).hover(function(){
			$('.menudepto').addClass('hover');
		},function(){
			$('.menudepto').removeClass('hover');	
		}			
	);
}