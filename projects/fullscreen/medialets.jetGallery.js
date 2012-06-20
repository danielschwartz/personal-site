medialets.jetGallery = function (options){

	this.options = {
		$frame: $m('gallery'),
		$slider: $m('items'),
		width: 1024,
		threshold: 0.5
	};

	this.local = {
		slideshow: null,
		slides: $m.find('.item'),
		locked: false,
		dragging: false,
		panLock: false
	}

	this.init = function(options){
		var self = this;


		//merge defaults with passed in options
		medialets.deepCopy(options, self.options);

		//create our necessary device orientation object
		self.local.orientation = new $m.autoOrientation({
          $target : $m('container'),
          format : 'interstitial',
          orientation : 'portrait'
        });
        //initialize the slideshow   
        self.local.slideshow = new $m.slideshow({
          $frame : self.options.$frame,
          $slider : self.options.$slider,
          slideWidth : self.options.width,
          orientationObject : self.local.orientation,
          threshold: self.options.threshold,
          touch: true,
      	  tracking: false
        });
        
        self.bindControls();
        self.resetOrientation();

        self.local.animInterval = setInterval(function(){
        	self.initAnimation();
        }, 200);

	};

	this.bindControls = function (){
		var self = this;

		//rotation event
		/*
		window.addEventListener('orientationchange', function(){
			self.resetOrientation();
		});
		*/
		setInterval(function(){
			self.resetOrientation();
		}, 200)
		
		$m.bind($m.find('.box.info'), $m.ui.tap, function(e){
			e.preventDefault();
			e.stopPropagation();
			self.local.slideshow.slideTo(self.local.slideshow.local.currentSlide + 1);
		});

		$m.bind($m.find('.action-wrap-back'), $m.ui.tap, function(e){
			e.preventDefault();
			e.stopPropagation();
			self.local.slideshow.slideTo(self.local.slideshow.local.currentSlide - 1);
		});


		//not used -- this is for translating the last slide
		/*
		$m.bind(self.local.slides[2], 'm.touchend', function(e){
			e.preventDefault();
			e.stopPropagation();

			console.log(e.data.xDirection + ' , ' + e.data.xDelta);

			if(e.data.xDirection === 'left' && e.data.xDelta < -50){
				self.local.slides[2].style.webkitTransform = "translate3d(" + -self.local.width + "px,0,0)";
			}
			else if(e.data.xDirection === 'right' && e.data.xDelta > 50){
				//we are not panned
				if(self.local.slides[2].style.webkitTransform.match(/translate3d\(0/) !== null){
					console.log('Not Panned: ' + e.data.xDelta);
					self.local.interval1 = setInterval(function(){
						clearInterval(self.local.interval1);
						self.local.slideshow.slideTo(1);
					},10);
				}
				//we are panned
				else{
					console.log('Panned: ' + e.data.xDelta);
					self.local.slides[2].style.webkitTransform = "translate3d(" + 0 + "px,0,0)";
					self.local.interval2 = setTimeout(function(){
						clearInterval(self.local.interval2);
						self.local.slideshow.slideTo(2);
					},15);	
				}
			}	

		});
		*/


		/* .match(/translate3d\(0/) */
	};

	this.resetOrientation = function (){
		var orientation = window.orientation,
			self = this,
			width = window.innerWidth;

		if(self.local.width !== width){
			self.local.slideshow.o.slideWidth = width;
			self.local.slideshow.o.$slider.style.width = (width * (self.local.slides.length + 1)) + 'px';
			self.local.slideshow.slideTo(self.local.slideshow.local.currentSlide);
			self.local.slides[2].style.webkitTransform = "translate3d(" + 0 + "px,0,0)";
			
			self.local.width = window.innerWidth;	
		}
	}

	this.initAnimation = function (){
		var $slide = $m('slide1'),
			logo = $m.find('.logo', $slide)[0],
			tagline = $m.find('.tagline', $slide)[0],
			bold = $m.find('.bold', $slide)[0],
			normal = $m.find('.normal', $slide)[0],
			imageBox = $m.find('.box.image', $slide)[0],
			infoBox = $m.find('.box.info', $slide)[0];

		clearInterval(this.local.animInterval);

		//what happens after the fadein
		logo.addEventListener('webkitTransitionEnd', function(){
			logo.removeEventListener('webkitTransitionEnd', arguments.callee);

			 bold.addEventListener('webkitTransitionEnd', function(){
			 	bold.removeEventListener('webkitTransitionEnd', arguments.callee);
			 	bold = normal;

			 	bold.addEventListener('webkitTransitionEnd', function(){
			 		bold.removeEventListener('webkitTransitionEnd', arguments.callee);
			 		normal = $m.find('.seclusion', $slide)[0];

			 		normal.style.opacity = 1;
			 		imageBox.style.opacity = 1;
			 		infoBox.style.opacity = 1;

			 		imageBox.style.bottom = "0px";
	 				infoBox.style.bottom = "0px";
	 				setTimeout(function(){
		 				infoBox.style.left = "296px";
		 			}, 500);
			 	});

			 	$m.removeClass(bold, 'normal');
			 	$m.addClass(bold, 'bold');
			 	$m.addClass(bold, 'inspired');



			 });
			 //fade out first bold word
			 bold.style.opacity = 0;

		});
		//fadein the first box
		logo.style.opacity = 1;


			
	}


	//kickstart our gallery
	this.init(options);
	
};