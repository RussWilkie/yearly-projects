$(document).ready(function () {
	$body = $("body");
    
   let maxSize, increaseAmt, num = 0;
   
   //Changes # of images to populate based on browser width
   function checkWidth(){
		let width = $(window).width();
		if(width <= 440){
			increaseAmt=10;
		}
		else{
			increaseAmt=20;
		}
   }
   showImages(num);
   
   $("#show-more").click(function(){
	   num = num+increaseAmt;
	   showImages(num);
   });

   function showImages(count){
	   //Used to store images
	   let content = '';
	  
	   checkWidth();
	   
    $.ajax({
		beforeSend: function() { 
		$body.addClass("loading");
		},
        type: 'POST',
		url: './scripts/reader.php',
		data: 'id=testdata',
		dataType: 'json',
		cache: false,
		success: function(data) {
			if(count+increaseAmt >= data.length){
				maxSize=data.length;
				$('#show-more').css('display', 'none');
			}
			else{
				maxSize = count+increaseAmt;
			}
			//Images are read into content variable
			for(let i = count; i<maxSize; i++)
			{	
					content +='<div class="container"><a href="' 
					+ data[i]
					+ '" data-lightbox="mygallery"><img src="' 
					+ data[i]
					+ '"> <div class="overlay"><img src="images/magnify.png"></div></a></div>';
				
			};
		},
		//content is appended after ajax request finishes
		complete: function() { 
			$('#images').append(content);
			$body.removeClass("loading"); 
			}
	});
   }
   
	
});
