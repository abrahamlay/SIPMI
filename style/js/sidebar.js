$("active li").live("click", function(){
	  $("active li").removeClass("active");
	  $(this).addClass("active");
});

	  /* $('li#menu2').click(
		function(){
			$('p.merah').append(' hello ');
			
			$('p.merah').toggle('slow');
		});

	$('button#button3').click(
		function(){
		
		$.get(
		'http://localhost:10000/abraham/ajax/service.php',
				function(danbo){
					$('p.merah').html(danbo.length);
				});
		
		});
 */
});