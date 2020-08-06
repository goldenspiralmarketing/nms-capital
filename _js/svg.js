define( 'svg',
	[
		'jquery'
	],
	function ( $ ) {

		/* SVG Shape measuring tools via http://stackoverflow.com/questions/30355241/get-the-length-of-a-svg-line-rect-polygon-and-circle-tags */
		/**
		* Used to get the length of a rect
		*
		* @param el is the rect element ex $('.rect')
		* @return the length of the rect in px
		*/
		var getRectLength = function(el){
			var w = el.attr('width');
			var h = el.attr('height');

			return (w*2)+(h*2);
		};

		/**
		* Used to get the length of a Polygon
		*
		* @param el is the Polygon element ex $('.polygon')
		* @return the length of the Polygon in px
		*/
		var getPolygonLength = function(el){
			var points = el.attr('points');
			points = points.split(" ");
			var x1 = null, x2, y1 = null, y2 , lineLength = 0, x3, y3;
			for(var i = 0; i < points.length; i++){
				var coords = points[i].split(",");
				if(x1 === null && y1 === null){

					if(/(\r\n|\n|\r)/gm.test(coords[0])){
						coords[0] = coords[0].replace(/(\r\n|\n|\r)/gm,"");
						coords[0] = coords[0].replace(/\s+/g,"");
					}

					if(/(\r\n|\n|\r)/gm.test(coords[1])){
						coords[0] = coords[1].replace(/(\r\n|\n|\r)/gm,"");
						coords[0] = coords[1].replace(/\s+/g,"");
					}

					x1 = coords[0];
					y1 = coords[1];
					x3 = coords[0];
					y3 = coords[1];

				}else{

					// if(coords[0] !== "" && coords[1] !== ""){
					if(!isNaN(coords[0]) && !isNaN(coords[1])){

						if(/(\r\n|\n|\r)/gm.test(coords[0])){
							coords[0] = coords[0].replace(/(\r\n|\n|\r)/gm,"");
							coords[0] = coords[0].replace(/\s+/g,"");
						}

						if(/(\r\n|\n|\r)/gm.test(coords[1])){
							coords[0] = coords[1].replace(/(\r\n|\n|\r)/gm,"");
							coords[0] = coords[1].replace(/\s+/g,"");
						}

						x2 = coords[0];
						y2 = coords[1];
						// console.log('x: ' + x2);
						// console.log('y: ' + y2);

						lineLength += Math.sqrt(Math.pow((x2-x1), 2)+Math.pow((y2-y1),2));

						// console.log('line length: ' + lineLength);

						x1 = x2;
						y1 = y2;
						if(i == points.length-2){
							lineLength += Math.sqrt(Math.pow((x3-x1), 2)+Math.pow((y3-y1),2));
						}

					}
				}

			}
			return (lineLength * 1.05);

		};

		/**
		* Used to get the length of a line
		*
		* @param el is the line element ex $('.line')
		* @return the length of the line in px
		*/
		var getLineLength = function(el){
			var x1 = el.attr('x1');
			var x2 = el.attr('x2');
			var y1 = el.attr('y1');
			var y2 = el.attr('y2');
			var lineLength = Math.sqrt(Math.pow((x2-x1), 2)+Math.pow((y2-y1),2));
			return lineLength;

		};

		/**
		* Used to get the length of a circle
		*
		* @param el is the circle element
		* @return the length of the circle in px
		*/
		var getCircleLength = function(el){
			var r = el.attr('r');
			var circleLength = 2 * Math.PI * r;
			return circleLength;
		};


		/**
		* Used to get the length of the path
		*
		* @param el is the path element
		* @return the length of the path in px
		*/
		var getPathLength = function(el){
			var pathCoords = el.get(0);
			var pathLength = pathCoords.getTotalLength();
			return pathLength;
		};

		var preCalculate = function() {
			/* SVG Draw Pre-calculations */
			if($('.svg-draw').length){
				$('.svg-draw').each(function(){

					// get length of all svg elements, and assign the largest of each svg's paths to 'length' var... this will be our stroke offset

					var thisSVG = $(this);
					var thisLines;
					if($(this).find('#outlines').length){
						thisLines = $(this).find('#outlines');
					} else {
						thisLines = $(this);
					}
					var length = '';
					thisLines.find('path').each(function(){
						thisLength = Math.ceil(this.getTotalLength());
						if(thisLength > length){
							length = thisLength;
						}
					});
					thisLines.find('rect').each(function(){
						thisLength = Math.ceil(getRectLength($(this)));
						if(thisLength > length){
							length = thisLength;
						}
					});
					thisLines.find('polygon').each(function(){
						// console.log('polygon' + $(this).attr('points'));
						thisLength = Math.ceil(getPolygonLength($(this)));
						if(thisLength > length){
							length = thisLength;
						}
						// console.log('rounded polygon' + thisLength);
					});
					thisLines.find('line').each(function(){
						thisLength = Math.ceil(getLineLength($(this)));
						if(thisLength > length){
							length = thisLength;
						}
					});
					thisLines.find('circle').each(function(){
						thisLength = Math.ceil(getCircleLength($(this)));
						if(thisLength > length){
							length = thisLength;
						}
					});

					// assign value to attribue (not currently beign used, could be useful)
					thisSVG.attr("stroke-length", length);

					// set initial values, which will be animated out
					thisSVG.css({
						'stroke-dasharray': length,
						'stroke-dashoffset': length
					});

				});
				// console.log('svg scripts');
			}
		};


		return {
			pre_calculate: preCalculate
		};

	}
);
