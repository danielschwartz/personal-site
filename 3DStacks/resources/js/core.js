/*
	HB (3DStacks) Global Namespace
*/
var camera, scene, renderer;
var projector, plane, cube;
var mouse2D, mouse3D, ray,
	rollOveredFace, isShiftDown = false,
	theta = 45, isCtrlDown = false,
	posX = 1400, posZ = 1400;

var HB = {};

HB.core = (function() {
	
	function initWorld(){
		//lets create the users viewport (camera)
		camera = new THREE.Camera(40,window.innerWidth / window.innerHeight, 1 ,10000)
		camera.position.y = 800;
		camera.target.position.y = 0;

		scene = new THREE.Scene();	

		//layout the grid so that users must conform to block grids
		var geometry = new THREE.Geometry();
		geometry.vertices.push(new THREE.Vertex(new THREE.Vector3(-500,0,0)));
		geometry.vertices.push(new THREE.Vertex(new THREE.Vector3(500,0,0)));

		//choose the material we want our grid to confrom to (how we want it to look)
		var material = new THREE.LineBasicMaterial({color: 0x00000, opacity: 0.4});

		//create a 20x20 3d grid
		for(var i=0;i<=20;i++){
			//we create a line based on the previously defined geometry and material
			var line = new THREE.Line(geometry,material);
			//give the line a z position
			line.position.z = (i*50)-500;
			//plot the line onto the canvas
			scene.addObject(line);

			var line = new THREE.Line(geometry,material);
			line.position.x = (i*50)-500;
			line.rotation.y = 90 * Math.PI / 180;
			scene.addObject(line);
		}

		projector = new THREE.Projector();

		plane = new THREE.Mesh(new Plane(1000,1000,20,20), new THREE.MeshFaceMaterial());
		plane.rotation.x = -90 * Math.PI / 180;
		scene.addObject(plane);

		mouse2D = new THREE.Vector3(0,10000,0.5);
		ray = new THREE.Ray(camera.position, null);

		//lets make some realistic looking lighting :)
		var ambientLight = new THREE.AmbientLight(0xffffff);
		scene.addLight(ambientLight);
		
		var directionalLight = new THREE.DirectionalLight(0xffffff);
		directionalLight.position.x = Math.random() - 0.5;
		directionalLight.position.y = Math.random() - 0.5;
		directionalLight.position.z = Math.random() - 0.5;
		directionalLight.position.normalize();
		scene.addLight(directionalLight);

		var directionalLight = new THREE.DirectionalLight(0x808080);
		directionalLight.position.x = Math.random() - 0.5;
		directionalLight.position.y = Math.random() - 0.5;
		directionalLight.position.z = Math.random() - 0.5;
		directionalLight.position.normalize();
		scene.addLight(directionalLight);
		
		//render the initial scene
		renderer = new THREE.CanvasRenderer();
		renderer.setSize(window.innerWidth, window.innerHeight);
		$(".container").append(renderer.domElement);
	};
	
	function loop(){
		if(isCtrlDown)
			theta += mouse2D.x * 3;
		
		mouse3D = projector.unprojectVector(mouse2D.clone(), camera);
		ray.direction = mouse3D.subSelf(camera.position).normalize();
		
		var intersects = ray.intersectScene(scene);
		
		//console.log(intersects);
		
		if(intersects.length > 0){
			if(intersects[0].face != rollOveredFace){
				if(rollOveredFace) rollOveredFace.material = [];
				rollOveredFace = intersects[0].face;
				rollOveredFace.material = [new THREE.MeshBasicMaterial({color: 0xff0000, opacity: 0.5})];
			}
		}
		else if(rollOveredFace){
			rollOveredFace.material = [];
			rollOveredFace = null;
		}
		
		camera.position.x = posX * Math.sin(theta * Math.PI / 360);
		camera.position.z = posZ * Math.cos(theta * Math.PI / 360);
		renderer.render(scene, camera);
		
		//this is to update that FPS window if we choose to include it
		//stats.update()
		
	};
	
	function initEventBindings(){
		$(document).mousemove(function(e){
			e.preventDefault();

			//gives us an x and y between 0,0 and 1.0
			mouse2D.x = (e.clientX / window.innerWidth) * 2 - 1;
			mouse2D.y = - (e.clientY / window.innerHeight) * 2 + 1;
			
			//console.log(mouse2D.x,mouse2D.y);
		});
		
		$(document).click(function(e){
			e.preventDefault();
			
			//get our current intersects with objects
			var intersects = ray.intersectScene(scene);
			//console.log(scene);
			
			//make sure our mouse is actually on the canvas
			if(intersects.length > 0){
				//is shift pressed? if so we want to delete
				if(isShiftDown){
					//check if we just clicked on the plane or if we actually clicked on an object
					//if we did delete that object from the scene
					EVT.publish('deleteBlock', [intersects]);
				}
				else{
					//create a Vector3 position using the matrix
					var position = new THREE.Vector3().add(intersects[0].point, intersects[0].object.rotationMatrix.multiplyVector3(intersects[0].face.normal.clone()));
					
					//make Vector3 adhere to grid
					position.x = Math.floor(position.x / 50) * 50 + 25;
					position.y = Math.floor(position.y / 50) * 50 + 25;
					position.z = Math.floor(position.z / 50) * 50 + 25;
										
					EVT.publish('placeBlock', [position, randomHexColor()]);	
				}
			}
		});
		
		$(document).keydown(function(e){
			//console.log(e.keyCode);
			switch(e.keyCode){
				case 16:
					isShiftDown = true;
					break;
				case 17:
					isCtrlDown = true;
					break;
				case 40:
					//console.log("down pressed", camera.position.x);
					posX += 100;
					posZ -= 100;
					break;
				case 38:
					//console.log("up pressed", camera.position.x);
					posX -= 100;
					posZ += 100;
					break;
			}
		});
		
		$(document).keyup(function(e){
			switch(e.keyCode){
				case 16:
					isShiftDown = false;
					break;
				case 17:
					isCtrlDown = false;
					break;
			}
		});
	};
	
	function randomHexColor(){
		return "0x" + Math.floor(Math.random()*16777215).toString(16);
	};
	
	function placeBlock(position, color){	
		console.log("client placing block", position);

		//create a new cube object based on our defaults
		var block = new THREE.Mesh(new Cube(50,50,50), [new THREE.MeshLambertMaterial({color: color, opacity: 1, shading: THREE.FlatShading}), new THREE.MeshFaceMaterial()]);
				
		//position the block correctly according to a 50 unit grid
		block.position.x = position.x;
		block.position.y = position.y;
		block.position.z = position.z;
		block.overdraw = true;
		
		scene.addObject(block);
		
	};
	
	//we make our own delete function because the built in one isn't great
	function deleteBlock(intersects){
		var block 		  = intersects[0].object.position,
			deleteKey	  = block.x + "," + block.y + "," + block.z;
			
		//we implement our own delete method, because its cooler, more accurate, and works accross sockets using our (x,y,z) string key
		for(object in scene.objects){
			curBlock = scene.objects[object].position;
			curKey = curBlock.x + "," + curBlock.y + "," + curBlock.z;
			
			if(curKey == deleteKey){
				(scene.objects).splice(object,1);
			}
		}
	};
	
	
	
	/**
	 * public object
	 */
    return {
        init : function() {
           	initWorld();
			initEventBindings();
			setInterval(loop, 1000/60);
			
			
    		HB.core.initSocketBindings();
    		

			HB.core.initClientBindings();
			
    	},

		initClientBindings: function(){
			EVT.subscribe('placeBlock',placeBlock);
			EVT.subscribe('deleteBlock', deleteBlock)
		},
    	
    	initSocketBindings : function() {
			HB.nodeClient.init();
	        EVT.subscribe('socketPlacedBlock', placeBlock);
			EVT.subscribe('socketDeletedBlock', deleteBlock);
    	}
    }
    
})();