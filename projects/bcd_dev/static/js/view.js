$("form").submit(function (e) {
	e.preventDefault();

	var $form = $(this),
		id = $form.find( 'input[name="id"]' ).val(),
		action = $form.find( 'input[name="action"]' ).val(),
		url = $form.attr( 'action' ),
		site = {
			"id": id,
			"action": action
		}

	console.log(site);
	
	$.post( url, site ,
      function(resp) {
          if(resp == 'success'){
            window.location = "view-all.php"
          }
          else{
            console.log(resp);
          }
      }
    );
    
});