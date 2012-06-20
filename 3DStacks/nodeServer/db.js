var cradle = require('cradle');
var db = new(cradle.Connection)().database('blocks');
var tempArray = [];

var database = {
	initDb: function(){
		db.exists(function(err,res){
			if(res == false){
				db.create(function(err,res){
					console.log("Welcome to 3DStacks!\ndatabase created successfully!");
				});
				
				db.save('_design/blocks', {
				    all: {
				        map: function (doc) {
				            if (doc) emit(doc);
				        }
				    }
				});
			}
			if(res == true){
				console.log("Welcome to 3DStacks!\ndatabase initialized successfully!");
			}
		});
	},
	
	insertIntoDb: function(block){
		var key = block.x + "," + block.y + "," + block.z;
		
		//console.log(key);
		
		db.save(key, {
			x: 			block.x,
			y: 			block.y,
			z: 			block.z,
			color: 		block.color
		}, function (err, res) {
			if(err)
				console.log("Error Inserting Into DB!\n", err);
			else
				console.log("Inserted Into DB Succussfully!\n", res);
		});
	},
	
	removeBlockForKey: function(key){
		db.get(key, function (err, doc) {
			var id, rev;
			if(doc.id)
				id = doc.id;
			else if(doc._id)
				id = doc._id;
			else
				id = doc.x + "," + doc.y + "," + doc.z;
				
			if(doc.rev)
				rev = doc.rev;
			else if(doc._rev)
				rev = doc._rev;
		
			//console.log(doc.id, doc._id, doc.rev, doc._rev);
			//console.log("\n\n\n", doc);
			db.remove(id, rev, function (err, res) {
			    console.log(res,err);
			});
		});
	},
	
	getAllBlocks: function(callback){
		db.all(function(err, docs) {
			for(var i = 0; i < docs.length; i++){
				if(docs[i].id.indexOf("_design") == -1){
					tempArray.push(docs[i].id);
				}
			};


			db.get(tempArray, function(err,docs){
				//console.log(docs);
				callback(docs);
			});
		});
		
	}
	
};

exports.database = database;