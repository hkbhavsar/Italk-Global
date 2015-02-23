// http://www.artviper.net/bumpbox.php
// requirement: do not use id=flashcontent
$(document.body).ready(function() {
    
	var path = $("#base_url").val()+'js/bumpbox/';
	var allBumps = $('.bumpbox');
	var i=0;
	allBumps.each(function(e){
		var content = String(allBumps[e]);

		// preload image
		if($(allBumps[e]).attr('href').indexOf('.jpg') != -1 || $(allBumps[e]).attr('href').indexOf('.gif') != -1 || $(allBumps[e]).attr('href').indexOf('.png') != -1){
			$(document.body).append('<img src="' + content + '" style="display: none;" />');
		}

		// hide inline content
		if($(allBumps[e]).attr('href').indexOf('^') != -1){
			$('#'+$(allBumps[e]).attr('href').replace('^','')).css('display','none');
		}

		// set id of each element to a number 0..n
		$(allBumps[e]).attr('id',i);
		i++;
	});

	$('.bumpbox').click(function(e){
		// stop link from being followed
		e.preventDefault();

		var content = $(this).attr('href');
		var actualID = $(this).attr('id');
		var maxw = 0;
		var maxh = 0;
		var title = '';
		var hr = '';

		if($(this).attr('rel') != ''){
			var tmp = $(this).attr('rel').split('-');
			// typecast them to numbers so if you try to add something to them later it will work
			maxw = Number(tmp[0]);
			maxh = Number(tmp[1]);
		}

		if($(this).attr('title') != null){
			title = $(this).attr('title');
		}

		if($(this).attr('href') != null){
			hr = $(this).attr('href');
		}

		var w = $(window).width();
		var h = $(window).height();
		var s = $(window).scrollTop();

		if(maxw == 0){	maxw = 640;	}
		if(maxh == 0){	maxh = 480;	}

		// if rel set box bigger than screen, restrict it to the screen size
		var padding = 160;
		if(maxw > (w-padding) || maxh > (h-padding)) {	// if width or height of image is > width or height of screen area
			// resize whichever's bigger and then resize the other based on the ratio
			if (maxw > (w-padding)) {
				// account for if the item is within the w-padding range, so the screen is wide enough but not tall enough
				if (maxh > (h-padding)) {
					// do width first since we don't want to set maxh before we use it
					maxw = Math.round((maxw * (h-padding)) / maxh);
					maxh = h-padding;
				}
				else {
					// do height first since we don't want to set maxw before we use it
					maxh = Math.round((maxh * (w-padding)) / maxw);
					maxw = w-padding;
				}
			}
			else {
				// do width first since we don't want to set maxh before we use it
				maxw = Math.round((maxw * (h-padding)) / maxh);
				maxh = h-padding;
			}
		}

		if(content.indexOf('.jpg') != -1 || content.indexOf('.gif') != -1 || content.indexOf('.png') != -1){
			var img = new Image();
			img.src = content;
			img.style.margin = '20px';

			// constrain large images to the window size
			if(img.width > (w-padding) || img.height > (h-padding)) {	// if width or height of image is > width or height of screen area
				// resize whichever's bigger and then resize the other based on the ratio
				if (img.width > (w-padding)) {
					// account for if the item is within the w-padding range, so the screen is wide enough but not tall enough
					if (img.height > (h-padding)) {
						// do width first since we don't want to set img.height before we use it
						img.width = Math.round((img.width * (h-padding)) / img.height);
						img.height = h-padding;
					}
					else {
						// do height first since we don't want to set img.width before we use it
						img.height = Math.round((img.height * (w-padding)) / img.width);
						img.width = w-padding;
					}
				}
				else {
					// do width first since we don't want to set img.height before we use it
					img.width = Math.round((img.width * (h-padding)) / img.height);
					img.height = h-padding;
				}
			}

			maxw = img.width;
			maxh = img.height;
		}

		var maxwInnerDiv = maxw;
		var maxhInnerDiv = maxh;

		maxw += 40;
		maxh += 40;

		var middleH = Math.round(w/2);
		var middleV = Math.round(h/2);
		var endleft = Math.round((w-maxw) / 2);
		var endtop = Math.round(((h - maxh) / 2) + s);

		var el = $('<div style="width:1px;height:1px;position:absolute;border:2px solid #303132;padding:4px; url(' + path + 'ajax-loader.gif) no-repeat center center;left:' + middleH + 'px;top:' + (middleV+s) + 'px;cursor:pointer;display:block;z-index:100000;-moz-border-radius:10px;-webkit-border-radius:10px;border-radius:10px;"></div>');

		var bg = $('<div style="background:#000;width:100%;height:100%;opacity:0.9;position:absolute;top:' + s + 'px;left:0;"></div>');

		var cl = $('<img src="' + path + 'closed.png" id="nycloser" style="width:24px;height:24px;position:absolute;top:-16px;right:-16px;z-index:100000;" />');

		var removeBumpBox = function() {
			bg.remove();
			el.children().remove();

			el.animate({
					width: 1,
					height: 1,
					left: middleH,
					top: middleV+s
				},{
					duration: 500, 
					specialEasing: {
						width: 'swing',
						height: 'swing'
					},
					complete: function() {
						el.remove();
					}
				}
			);
		}

		cl.click(removeBumpBox);
/*
// leaves the bumpbox on the screen as a dot once it animates out...?
		$(document.body).keyup(function(e){
			if(e.keyCode == 27){	//escape keycode
				removeBumpBox();
			}
		});
*/
		$(document.body).append(bg);
		$(document.body).append(el);
		el.append(cl);

		$(window).scroll(function(){
			bg.css('top',$(window).scrollTop());
		});

		el.animate({
				width: maxw,
				height: maxh,
				left: endleft,
				top: endtop
			},{
				duration: 500, 
				specialEasing: {
					width: 'swing',
					height: 'swing'
				},
				complete: function() {
					el.css('background','#000');

					if(content.indexOf('.jpg') != -1 || content.indexOf('.gif') != -1 || content.indexOf('.png') != -1){
						// image
						el.append(img);
					}
					else if(content.indexOf('.swf') != -1){
						// swf
						var div = $('<div id="flashcontent" style="padding:20px;width:' + maxwInnerDiv + 'px;height:' + maxhInnerDiv + 'px;"></div>');
						el.append(div);

						var obj = flashembed('flashcontent', {
							src: content,
							width: maxwInnerDiv,
							height: maxhInnerDiv,
							wmode: 'transparent',	// required to keep it behind modal dialog boxes
							expressInstall: path + 'expressInstall.swf',
							version: [9, 115]	// min version required
						});
					}
					else if(content.indexOf('.flv') != -1 || content.indexOf('.f4v') != -1 || content.indexOf('.mp4') != -1){
						// video
						var div = $('<div id="flashcontent" style="padding:20px;width:' + maxwInnerDiv + 'px;height:' + maxhInnerDiv + 'px;"></div>');
						el.append(div);

						var f = flowplayer('flashcontent', {
							src: path + 'flowplayer-3.1.5.swf',
//							buffering: true,
//							autoplay: true,
//							clip: content,
							wmode: 'transparent',	// required to keep it behind modal dialog boxes
							expressInstall: path + 'expressInstall.swf',
							version: [9, 115]	// min version required
						},{
							plugins: {
								pseudo: { url: path + 'flowplayer.pseudostreaming-3.1.3.swf' }
							},
							clip: {
								provider: 'pseudo',
								scaling: 'fit',
								autoPlay: true,
								url: content
							}
						});

// not working in IE
//						f.onStart(function(file) {
//							var meta = file.metaData;
							// do not try to animate the transition, causes flashing video issues and scrollbar issues
//							el.css({width:(meta.width+40),height:(meta.height+40),left: ((w-(meta.width+40)) / 2),top: (((h - meta.height+40) / 2) + s)});
//							$('#flashcontent').css({width:meta.width,height:meta.height});
/*							$('#flashcontent').remove();
							el.animate({
									width: meta.width+40,
									height: meta.height+40,
									left: (w-(meta.width+40)) / 2,
									top: ((h - meta.height+40) / 2) + s
								},{
									duration: 500, 
									specialEasing: {
										width: 'swing',
										height: 'swing'
									},
									complete: function() {
										// attempting to change #flashcontent width and height causes flashing video issues
//										$('#flashcontent').css({width:meta.width,height:meta.height});
										var div = $('<div id="flashcontent" style="padding:20px;width:' + meta.width + 'px;height:' + meta.height + 'px;"></div>');
										el.append(div);

										var f = flowplayer('flashcontent', {
											src: path + 'flowplayer-3.1.5.swf',
//											buffering: true,
//											autoplay: true,
//											clip: content,
											wmode: 'transparent',	// required to keep it behind modal dialog boxes
											expressInstall: path + 'expressInstall.swf',
											version: [9, 115]	// min version required
										},{
											plugins: {
												pseudo: { url: path + 'flowplayer.pseudostreaming-3.1.3.swf' }
											},
											clip: {
												provider: 'pseudo',
												scaling: 'fit',
												autoPlay: true,
												url: content
											}
										});
									}
								}
							);*/
//						});
					}
					else if(content.indexOf('.mp3') != -1){
						// audio
						var div = $('<div id="flashcontent" style="padding:20px;width:' + maxwInnerDiv + 'px;height:' + (maxh-50) + 'px;"></div>');
						el.append(div);

						var f = flowplayer('flashcontent', {
							src: path + 'flowplayer-3.1.5.swf',
//							buffering: true,
//							autoplay: true,
//							clip: content,
							wmode: 'transparent',	// required to keep it behind modal dialog boxes
							expressInstall: path + 'expressInstall.swf',
							version: [9, 115]	// min version required
						},{ 
							playlist: [ 
//								'coverart.jpg', 
								{
									url: content, 
									onStart: function(song) {	// probably should use onMetaData instead
										var meta = song.metaData;

										var tempArray = new Array(meta.TPE1.length, meta.TALB.length, meta.TIT2.length);
										var maxWidth = 160;	// default
										var characterWidth = 9;	// change this if the font size is changed

										for(var i=0; i<tempArray.length; i++){
											maxWidth = Math.max(tempArray[i]*characterWidth, maxWidth);
										}

										// do not let the content width be greater than the flash object width
										if (maxWidth > maxw) {
											maxWidth = maxw;
										}

										this.getPlugin('content').css({width:maxWidth});
										this.getPlugin('content').setHtml(
											"<p>Artist:<b> " + meta.TPE1 + "</b></p>" +
											"<p>Album:<b> " + meta.TALB + "</b></p>" +
											"<p>Title:<b> " + meta.TIT2 + "</b></p>"
										);
									}
								}
							],
							plugins: {
								content: {
									url: 'flowplayer.content-3.1.0.swf',
									backgroundColor: '#2d3e46',
									top: 25,
									right: 25,
									width: 160,	// overridden in onStart
									height: 60
								},
								controls: {
									height: 30,
									fullscreen: false
								}
							}
						});
					}
					else if(content.indexOf('^') == 0){
						// inline content
						var div = $('<div style="padding:20px;width:auto;height:auto;color:#fff;overflow:hidden;">' + $('#'+content.replace('^','')).html() + '</div>');
						el.append(div);
					}
					else {
						// pdf or link
						var div = $('<div style="overflow:hidden;padding:20px;width:' + maxwInnerDiv + 'px;height:' + maxhInnerDiv + 'px;"></div>');
						el.append(div);

						var x = $('<iframe id="test" src="' + content + '" frameborder="0" style="overflow:auto;frameborder:0;width:' + maxwInnerDiv + 'px;height:' + maxhInnerDiv + 'px;"></iframe>');
						div.append(x);
					}

					// add title to top
					if(title != ''){
						var t = $('<div style="height:20px;position:absolute;top:-30px;left:20px;color:#eee;opacity:0.9;z-index:10000;font-family:verdana;font-size:11px;">' + title + '</div>');
						el.append(t);
					}

					// add URL: to bottom as long as it is not inline content
					if(content.indexOf('^') != 0){
						var x1 = $('<a href="' + hr + '" style="width:auto;height:20px;position:absolute;left:20px;bottom:-30px;color:#eee;text-decoration:none;font-family:verdana;font-size:11px;">URL: ' + hr + '</a>');
						el.append(x1);
					}
				}
			}
		);

		var nextID = Number($(this).attr('id')) + 1;

		if(allBumps[nextID] != null){
			var nx = $('<a style="width:30px;height:20px;background:#000 url(' + path + 'next.jpg) no-repeat center center;position:absolute;right:10px;bottom:-10px;display:block;"></a>');

			nx.click(function(e){
				bg.remove();										 
				el.remove();										 
				var nextID = Number(actualID);
				nextID++;
				nextID = String(nextID);
				$(allBumps[nextID]).trigger('click');
			})
			el.append(nx);
		}

		var prevID = Number($(this).attr('id')) - 1;

		if(allBumps[prevID] != null){
			var nx2 = $('<a style="width:30px;height:20px;background:#000 url(' + path + 'prev.jpg) no-repeat center center;position:absolute;right:50px;bottom:-10px;display:block;"></a>');

			nx2.click(function(e){
				bg.remove();										 
				el.remove();										 
				var nextID = Number(actualID);
				nextID--;
				nextID = String(nextID);
				$(allBumps[nextID]).trigger('click');
			})
			el.append(nx2);
		}
	});
})