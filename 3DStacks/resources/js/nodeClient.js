HB.nodeClient = (function() { 

    var socket;

    function handleMessage(data){
        // evil eval
        msg = eval('(' + data + ')');
		//console.log(msg);        
    	switch (msg.type) {
			case 'new':
    			//console.log("New Player Hass Arrived With SessionID: " + msg.session);
    			$("body").prepend('<div id="'+ msg.session +'" class="new-user">A new user has joined the game!</div>').fadeIn('slow');
    			
    			var divID = '#' + msg.session
    			
    			setTimeout(function() {
    			    $(divID).fadeOut('slow',function() {
        			    $(divID).remove();
        			});
    			},3000);
    			break;
			case 'new-user-drop':
				for(block in msg.blocks){
					curBlock = msg.blocks[block].doc;

					var position = {
						x: curBlock.x,
						y: curBlock.y,
						z: curBlock.z
					}

					EVT.publish('socketPlacedBlock', [position, curBlock.color]);	
				}
				break;
			case 'drop':
				var position = {
					x: 	msg.x,
					y: 	msg.y,
					z: 	msg.z
				}
				EVT.publish('socketPlacedBlock', [position, msg.color]);
				break;
			case 'delete':
				console.log(msg);
				EVT.publish('socketDeletedBlock', [msg.intersects]);
				break;
    		default:
    			console.log("The message type was not understood",data);
    			break;
    		
    	}
    }

    function setupSocket() {
        socket = new io.Socket(window.location.hostname, {transports: ['websocket', 'server-events', 'htmlfile', 'xhr-multipart', 'xhr-polling']});
        socket.connect();
        
        socket.on('connect', function(){
         	//console.log('connected');
        });
        
        socket.on('disconnect', function(){
            //console.log('disconnect');
        });
        
        socket.on('message', handleMessage);
    }
	
	function sendBlockToSocket(position, color){
		//console.log("sending block to socket", position);
				
		socket.send(JSON.stringify({
            type      : 'drop',
			x		  : position.x,
			y		  : position.y,
			z		  : position.z,
			color	  : color
        }));

		//console.log(point);
	}
	
	function sendDeleteToSocket(intersects){
		socket.send(JSON.stringify({
            type      : 'delete',
			intersects: intersects
        }));

		//console.log(intersects[0].object);
	}
    
    return {
        
        init: function() {
            setupSocket();
            EVT.subscribe('placeBlock', sendBlockToSocket);
			EVT.subscribe('deleteBlock', sendDeleteToSocket)
        }
        
    }

})();