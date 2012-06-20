(function(){
	
	//use hoverintent so we get a delay
	$("#nav .categories li a").hoverIntent(
	  function () {
		//turn off all other hovers
		if($("#nav .categories li").hasClass('active'))
			$("#nav .categories li").removeClass('active');
		
		//make menu item active
		$(this).parent().addClass('active');
		
		//grab menu item
		var li = $(this).parent();
		
		//bind the mouse over to the document to get rid of the overlay
		$(document).bind('mouseover',function(){
			//unbind it
			$(document).unbind('mouseover');
			//unbind the menu item
			$(li).unbind('mouseover');
			//turn off the menu item
			li.removeClass('active');
			//hide the overlay
			$("#overlay").hide();						
		});
		
		//dont allow mouse evets to propogate from menu item
		$(li).mouseover(function(e){
			e.stopPropagation();
		});
		//position the overlay
		positionOverlay(li);
		//show the overlay
		$("#overlay").show();
	  }, 
	  function () {		
	  }//stop propogation on the link
	).mouseover(function(e){
		e.stopPropagation();
	});
	//stop propogation on the overlay
	$("#overlay").mouseover(function(e){
		e.stopPropagation();
	});
	
	function positionOverlay(li){
		//grab the offset of our menu item and which overlay to display		
		var offset = $(li).offset(), 
			delta = 36,
			type = $(li).find('a').text();
		
		//corrections for class names
		switch(type){
			case '+more':
				type = 'more';
				break;
			case 'bed & bath':
				type = 'bed';
				break;
			case 'kitchen & dining':
				type = 'kitchen';
				break;
		}
				
		//change the spacing for subnav
		if($(li).parent().hasClass('sub'))
			delta = 33;
		
		//hide all types
		$("#overlay .wrapper").hide();
		
		//show the correct overlay
		$("#overlay ." + type).show();
		
		//position the overlay
		$("#overlay").css({
			left: offset.left,
			top:  offset.top + delta
		});
	}

})();
