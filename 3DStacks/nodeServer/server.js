#!/usr/local/bin/node

var http    = require('http');
var fs      = require('fs');
var test	= require('assert');
var sys 	= require("sys");


//get our global settings JSON object
//var Settings = require('../resources/settings.js').Settings;
var Functions = require('./functions.js').functions;
var Database = require('./db.js').database;


/******************************************

			    SERVER SETUP

******************************************/
var server = http.createServer(function (req, res) {
    
	//console.log('connection');

    var url = req.url;
    
    if (url === '/' || url === '') {
        url = '/index.html'
    }

    // this works like a file server
    fs.readFile(__dirname + '/..' + url, "binary", function(err, file) {
        
        if(err) {
            res.writeHead(404);
            res.end(err + "\n" + err);
            return;
        }

        // apply extension filtering to content types here !!!
        res.writeHead(200);
        res.end(file, "binary");
    
    });
    
});

/******************************************

			    SOCKET.IO SETUP

******************************************/
var io = require('./Socket.IO-node'); 
var socket = io.listen(server, {transports: ['websocket', 'server-events', 'htmlfile', 'xhr-multipart', 'xhr-polling']}); 


/******************************************

		DATABASE SETUP - CouchDB

******************************************/

//Will create the db and views if they are not already present. Migrations to new Db's will happen automatically if you delete the db from couch.
Database.initDb();

/******************************************

		SOCKET COMMUNICATION SETUP

******************************************/
socket.on('connection', function(client){
	        
    // new client is here!
	console.log("new client");
		
	Database.getAllBlocks(function(blocks){
		//console.log(blocks[0]);
		//console.log("________________________",blocks,"________________________");
		
		client.send(JSON.stringify({
			type      : 'new-user-drop',
			session   : client.sessionId,
			blocks	  : blocks 
		}));
	});
	
	
	
    client.broadcast(JSON.stringify({ 
        type    : 'new',
        session : client.sessionId
    }));

	
    client.on('message', function(m){
        var msg = eval('(' + m + ')');

        switch (msg.type) {
            case 'drop':
				var block = {
					x	      : msg.x,
					y		  : msg.y,
					z		  : msg.z,
					color	  : msg.color
				}				
				Database.insertIntoDb(block);
				
				//broadcast block to clients
				
				block.type = 'drop';
				
				//console.log(block.x,block.y,block.z);
				
				client.broadcast(JSON.stringify(block));
				break;
			case 'delete':
				var position = msg.intersects[0].object.position;
				var key = position.x + "," + position.y + "," + position.z;
				
				Database.removeBlockForKey(key);
				
				
				var block = {
					type: 		'delete',
					intersects: msg.intersects
				}
				
				client.broadcast(JSON.stringify(block));
				break;
            default: break;
        }
    });
    
    client.on('disconnect', function(){
        client.broadcast(JSON.stringify({
            type        : 'disconnect',
            session     : client.sessionId
        }));		
    });

});

// IMPORTANT: replace the second variable with your IP address on the network
// to test web socket connection amongst multiple computers
server.listen(8124);