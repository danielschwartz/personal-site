var EVT = (function() {
    
    var cache = {};
    
    return {
        
        /**
         * Publish an event
         *
         * @param {string} topic
         * @param {array} args
         */
        publish : function(topic, args){
        	if (cache[topic]) {
        	    for (var i = 0; i < cache[topic].length; i++) {
            		cache[topic][i].apply(EVT, args || []);
            	}
        	}
        },
        
        /**
         * Subscribe to an event 
         *
         * @param {string} topic
         * @param {function} callback
         */
        subscribe : function(topic, callback){
        	if(!cache[topic]){
        		cache[topic] = [];
        	}
        	cache[topic].push(callback);
        	return [topic, callback]; // Array
        },
        
        /**
         * Unsubscribe to an event
         *
         * @param {string} handle
         * @param {function} callback
         */
        unsubscribe : function(handle, callback){
        	var t = handle[0];
        	if (cache[t]) {
        	    for(var i = 0; i < cache[t].length; i++) {
        		    if(cache[t][i] == handle[1]) {
        			    cache[t].splice(idx, 1);
        		    }
        	    }
        	}
        },
    }

})();

//HB.EVT = EVT;

/* EXAMPLE

EVT.subscribe('###click', function() {
  // do stuff

})  

EVT.subscribe('###click', funcOne)

var funcOne = function(argOne, argTwo) {
  // do stuff

}

window.addEventListener('onclick', function() { 
  var coors;
  EVT.pubish('###click', [coors])

})

//*/