
var collecScreen={},
	collecProd = {},
	collecCustom = {},
	prodToDisplay = {},
	templates = {},
	rootFlux = 'http://nag-lvpp-01.ig-1.net',
	V = {
	
	langToggle :function(){
		if(lang == "_fr_FR"){
			$('.lang').text('English')
			$('#footer li:first-child a').attr('href', 'http://www.louisvuitton.fr/front/#/fra_FR/Newsletter')
		}else{
			$('.lang').text('Français')
			$('#footer li:first-child a').attr('href', 'http://www.louisvuitton.co.uk/front/#/eng_GB/Newsletter')
		}
		$('.lang').on('click', function(e){
			e.preventDefault()
				if(lang == '_fr_FR'){
					lang = '_en_GB'
				}else{
					lang = '_fr_FR'
				}
			
			var dest = parseUri(document.URL).query.split('&lang=')[0]+'&lang='+lang;
			window.location.href = 'index.php?'+dest;
		})
	},
	homeAnim: function(){
		var home = new TimelineLite()
		home.from($('.welcomeBox  span:first-child'), 1, {left:-400, autoAlpha:0, delay:1.5})
		.from($('.welcomeBox  span:first-child ~ span'),1, {left:'50%', autoAlpha:0},'-=0.2')
		.from($('.welcomeBox .text'),1, { autoAlpha:0})
	},
	polaAnim : function(){
		var pola = new TimelineLite()
		pola.staggerFrom($('.pola img'), 3,{autoAlpha:0.2}, 0.8)
	},
	/*GESTION DE LA GRID */
	// Getter de l id dans l url
	_getId: function(){
		return id;
		
	},
// Getter de sku dans l url
	_getSku: function(){
		if(window.location.search){
			var sku = window.location.search
			sku = sku.split('sku=')[1]
			sku = sku.split('&')[0]
			return sku
		}
	},
	gridFill : function(){
	 		// je lance gridfill et ses ajax une fois que la collecScreen est charge
	 		// car je dois aussi utilisé des info de cette deniere
			var paramUrl = V._getId()
	
			$(document).on('collecProdLoaded', function(){
				/*COL EVENTS*/
		
				//TJRS LA MEME ON RECUPERE LES NEWS DU SITE PEU IMPORTE ID OU PAS
				if($('#eventCol').length){

					var collecActu = _.sortBy(collecScreen.actu.news, function(item){
						var itemDate = item.date.split('/')
						var now = new Date(itemDate[2],itemDate[1],itemDate[0]).getTime();
						return now;
					}); 
						collecActu = collecActu.reverse();


					eventToDisplay = collecActu;
					eventToDisplay.splice(0,0,collecScreen.gridHaze[2])
					eventToDisplay.splice(4,0,collecScreen.actu.bloc_revivez)
					eventToDisplay = eventToDisplay.slice(0,5);
					$('#eventCol').html(_.template(templates.eventColTpl, {data:eventToDisplay})).removeClass('hidden')
				}
				/***** COL MULTIMEDIA  *****/
				if($('#multimedia #grid').length){
					/*RESTE A VOIR POUR POEME*/
					collectionMulti2 = collecScreen['multimedia'].grid[1];
				
					$('#multiCol1').html(_.template(templates.multiCol1Tpl, {data:collecScreen['multimedia'].grid[0]})).removeClass('hidden')
					$('#multiCol2').html(_.template(templates.multiCol2Tpl, {data:collecScreen['multimedia'].grid[1]})).removeClass('hidden')
					$('#multiCol3').html(_.template(templates.multiCol3Tpl, {data:collecScreen['multimedia'].grid[2]})).removeClass('hidden')
		
				}
				/***** COL VIDEO CARNET *****/
				if($('#videoCol').length){
					
					videoToDisplay = collecScreen.multimedia.grid;
					_.each(collecScreen.multimedia.grid,function(item,key){
						videoToDisplay[key] = _.where(collecScreen.multimedia.grid[key].medias,{cat:'vid'});
					})
					videoToDisplay = _.flatten(videoToDisplay); // ma collec de video recupéré dans multimedia
				
					videoToDisplay.splice(1,0,collecScreen.gridHaze[3]); // ajou du bloc violet dans la collec
					//console.log(videoToDisplay.length)
					//videoToDisplay = videoToDisplay.slice(0,4);
					$('#videoCol').html(_.template(templates.videoColTpl, {data:videoToDisplay})).removeClass('hidden');
				}
				/********COL PRODUIT************/
				if($('#prodCol').length){
					prodToDisplay = _.sample(collecProd.products, 4);
					prodToDisplay.splice(0,0,collecScreen.gridHaze[0]);
					prodToDisplay.splice(2,1,collecScreen.discover[0]);
					if(!paramUrl){
						$('#prodCol').html(_.template(templates.prodColTpl, {data:prodToDisplay})).removeClass('hidden');
						V.cutLength();
					}
				}
				/********* COL PATRIMOINES *********/
				if($('#objPatrCol').length){
					objPatrToDisplay = collecProd.patrimoines
					objPatrToDisplay.splice(1,0,collecScreen.gridHaze[1]);
					/*
					console.log('objPatrToDisplay',objPatrToDisplay);
					var pouet = _.groupBy(objPatrToDisplay, 'sku') 
					console.log('objPatrToDisplay groupby',pouet);
					*/
						objPatrToDisplay = objPatrToDisplay.slice(0,9);
					if(!paramUrl){
						$('#objPatrCol').html(_.template(templates.objPatrColTpl, {data:objPatrToDisplay})).removeClass('hidden')
					} 
				}
				/*********** SI CONNECT ***************/
				if(paramUrl) { 
					
					$.ajax({
						url : rootFlux+'/flux_minisite/clients/'+paramUrl+'.json',
						dataType:'json'

					}).done(function(response){
						collecCustom = response
					}).complete(function(){
						$(document).trigger('collecCustomLoaded')
					})

					$(document).on('collecCustomLoaded', function(){
						if($('#prodCol').length){

							//1er objet video bonus
							if( typeof(collecCustom.products) != 'undefined' ){
								if( collecCustom.products.sku.length ){
									prodToDisplay = _.sample(collecProd.products, 4);
									//Quand on a la liste des produits clients on injecte dans la liste des 
									//produits a afficher les items clients en replacement des items aléatoires
									_.each(collecCustom.products.sku,function(item,key){
										prodToDisplay[key] = _.where(collecProd.products,{sku:item})[0];
									})
									prodToDisplay.splice(0,0,collecScreen.gridHaze[0]);
									prodToDisplay.splice(1,0,collecScreen.bonus[0]);
									if(parseUri(document.URL).file == 'odyssee.php'){
										prodToDisplay = prodToDisplay.slice(0,5);
									} else if(collecCustom.products.sku.length<5){	
										prodToDisplay = prodToDisplay.slice(0,5);

									}
								}
							}
							$('#prodCol').html(_.template(templates.prodColTpl, {data:prodToDisplay})).removeClass('hidden');
							V.cutLength();
						}

						/*PATRIMOINES*/
						if($('#objPatrCol').length){
							if( typeof(collecCustom.patrimoines) != 'undefined' ){
								if( collecCustom.patrimoines.sku.length ){
									_.each(collecCustom.patrimoines.sku,function(item,key){
										objPatrToDisplay[key] = _.where(collecProd.patrimoines,{sku:item})[0];
									})
									objPatrToDisplay.splice(1,0,collecScreen.gridHaze[1]);

									if(parseUri(document.URL).file == 'odyssee.php'){
										objPatrToDisplay = objPatrToDisplay.slice(0,9);
									} else if(collecCustom.patrimoines.sku.length<9){
										objPatrToDisplay = objPatrToDisplay.slice(0,9);

									}
								}
							}
							$('#objPatrCol').html(_.template(templates.objPatrColTpl, {data:objPatrToDisplay})).removeClass('hidden')
						}
					})
				}
			})	// EN COLLECPRODLOADED

			$.ajax({
				url : rootFlux+'/flux_minisite/products'+lang+'.json',
				dataType:'json'
			}).done(function(data){
				collecProd = data;
			}).complete(function(){
				$(document).trigger('collecProdLoaded')
			})
	},
	underscore : function(){
	
		var pageId = $('body').attr('id');
		/*TPL*/		
		templates.headerTpl = $('[data-tpl="headerTpl"]').html()
		templates.welcomeTpl = $('[data-tpl="welcomeTpl"]').html()
		templates.newsActuTpl = $('[data-tpl="newsActuTpl"]').html()
		templates.infoShopTpl = $('[data-tpl="infoShopTpl"]').html()
		templates.mentionsTpl = $('[data-tpl="mentionsTpl"]').html()
		templates.swiperSlideTpl = $('[data-tpl="swiperSlideTpl"]').html()
		templates.swiperProdInfoTpl = $('[data-tpl="swiperProdInfoTpl"]').html()
		templates.prodColTpl = $('[data-tpl="prodColTpl"]').html()
		templates.objPatrColTpl = $('[data-tpl="objPatrColTpl"]').html()
		templates.eventColTpl = $('[data-tpl="eventColTpl"]').html()
		templates.multiCol1Tpl = $('[data-tpl="multiCol1Tpl"]').html()
		templates.multiCol2Tpl = $('[data-tpl="multiCol2Tpl"]').html()
		templates.multiCol3Tpl = $('[data-tpl="multiCol3Tpl"]').html()
		templates.videoColTpl = $('[data-tpl="videoColTpl"]').html()
		$('[data-tpl]').remove()
		
		$(document).on('collecScreenLoaded', function(){
			/*TPL COMMUN A TTE LES PAGES*/
			$('#header').html(_.template(templates.headerTpl, {data:collecScreen['header']})).removeClass('hidden');

			/*TPL WELCOME*/
			if($('#'+pageId).find('#welcome').length){
				$('#welcome').html(_.template(templates.welcomeTpl, {data:collecScreen[pageId]})).removeClass('hidden');
			}

			/*TPL MENTIONS*/
			if($('#'+pageId).find('.mentions').length){
				$('#aside').html(_.template(templates.mentionsTpl, {data:collecScreen[pageId]})).removeClass('hidden');
			}

			/*TPL INFO ASIDE SHOP*/
			if($('#'+pageId).find('#aside.info').length){
				$('#aside').html(_.template(templates.infoShopTpl, {data:collecScreen[pageId]})).removeClass('hidden');
			}

			/*TPL ACTU NEWS LIST*/
			if($('#'+pageId).find('ul.actu').length){
				var collecActu = _.sortBy(collecScreen[pageId].news, function(item){
					var itemDate = item.date.split('/')
					var now = new Date(itemDate[2],itemDate[1],itemDate[0]).getTime();
					return now;
				}); 
					collecActu = collecActu.reverse();
				_.each(collecActu,function(item){
					$('ul.actu').append(_.template(templates.newsActuTpl, {data:item})).removeClass('hidden');
				})
			}

			/*TPL SWIPER*/
			if($('#'+pageId).find('ul.swiper-wrapper').length){
				/*IMG PC*/
				
				$(document).on('collecProdLoaded', function(){
					
					var productSku = V._getSku()
					produitImg = _.where(collecProd.patrimoines,{sku:productSku})[0];		
					if(produitImg){
						$('#swiperProdInfo').append(_.template(templates.swiperProdInfoTpl, {data:produitImg})).removeClass('hidden')
						if($('.no-touch').length){
							_.each(produitImg.medias,function(item){
								$('ul.swiper-wrapper').append(_.template(templates.swiperSlideTpl, {data:item})).removeClass('hidden')
							})
						}	
						/*IMG MOB*/
						if($('.touch').length){
							_.each(produitImg.medias_mob,function(item){
								$('ul.swiper-wrapper').append(_.template(templates.swiperSlideTpl, {data:item})).removeClass('hidden')
							})
						}	
						V.swiper()
						}else{
							window.location.href = "index.php";
						}	
				})

				$.ajax({
					url : rootFlux+'/flux_minisite/products'+lang+'.json',
					dataType:'json'
				}).done(function(response){
					collecProd = response
				}).complete(function(){
					$(document).trigger('collecProdLoaded')
				})
			}
		})

	
	},
	swiper: function(){
		if(!$('.touch').length){
			var option = {
				mode:'horizontal',
				speed:50,
				loop: false,
				createPagination:true,
				pagination: '.product-paginate',
				paginationClickable:true,
				updateOnImagesReady:true,
				resistance:false,
				simulateTouch:false,
				onFirstInit:function(){
					$('.swiper-slide').each(function(index){
						$(this)
						.find('figure img')
						.load(function(){
							$(this).addClass('visible')
							$(this).closest('.swiper-slide').removeClass('loading')
						})
					})	
				
				},
				onImagesReady : function(){	
					if($('.swiper-slide').length > 1){
						$(".product-paginate")
						.prepend('<a href="#" class="prev"></a>')
						.append('<a href="#" class="next"></a>')
						.css({
							opacity:1
						})
					}
				}
			}
		}else{
			var option = {
				mode:'horizontal',
				speed:500,
				loop: false,
				createPagination:true,
				pagination: '.product-paginate',
				paginationClickable:true,
				updateOnImagesReady:true,
				resistance:false,
				onFirstInit:function(){
					$('.swiper-slide').each(function(index){
						$(this)
						.find('figure img')
						.load(function(){
							$(this).addClass('visible')
							$(this).closest('.swiper-slide').removeClass('loading')
						})
					})	
				},
				onImagesReady : function(){
					$(".product-paginate")
					.prepend('<a href="#" class="prev"></a>')
					.append('<a href="#" class="next"></a>')
					.css({
						opacity:1
					})
					if($('.swiper-slide').length > 1){
						$(".product-paginate")
						.prepend('<a href="#" class="prev"></a>')
						.append('<a href="#" class="next"></a>')
						.css({
							opacity:1
						})
					}
				}
			}
		}
		
		var mySwiper = $('.swiper-container').swiper(option)
		$(document).on('click', '.swiper-control a.next',function(){
			if($('.swiper-slide-active').is(':last-child')){
				mySwiper.swipeTo(0)
			}else{
				mySwiper.swipeNext()
			}
		})
		$(document).on('click', '.swiper-control a.prev',function(){
			if($('.swiper-slide-active').is(':first-child')){
				var lastIndex = $('.swiper-slide:last-child').index()
				mySwiper.swipeTo(lastIndex)
			}else{
				mySwiper.swipePrev()
			}
		})
	},
	modal : function(){
		/*POPIN VIDEO*/
		var myPlayer,
			$popin = $('.popin')
		videojs.options.flash.swf = "./video/video-js.swf";

		$(document).on('click touch','.play', function(){
			//var src = $('.poster',this).data('video-src')
			var src = $('.poster',this).data('video-src'),
				strg = src.split('.mp4')[0].split('.webm')[0]

			var videoSrc = [
					{ type: "video/webm", src: strg+".webm"},
					{ type: "video/mp4", src: strg+".mp4"}
			]
			
			//'http://video-js.zencoder.com/oceans-clip.webm'
			
			$popin.addClass('video').fadeIn(500)
					.find('.wrapper')
					.append('<figure class="loading"><a href="#" class="close">Retour</a><video id="video" class="video-js vjs-default-skin" controls preload="auto"><a href="#" class="close"></a></video></figure>')
				 	videojs("video").ready(function(){
						
						myPlayer = this
						myPlayer.src(videoSrc)
						myPlayer.play()
						myPlayer.on('loadeddata', function(){
							$popin.find('figure').removeClass('loading')
						})
						myPlayer.on('ended', function(){
							myPlayer.dispose()
							$popin.fadeOut(500, function(){
								$popin.removeClass('video').find('figure').remove()
							})
						})
					})
				videojs("video").on('error', function(){
					//console.log('error')
				})
		})
		/*POPIN IMG*/
		$(document).on('click', 'a.popinImg', function(e){
			e.preventDefault()
			var imgSrc = $(this).attr('href')
			if(!$popin.hasClass('img')){
				$popin.addClass('img').find('.wrapper')
				.append('<figure class="loading"><a href="#" class="close">Retour</a><img src='+imgSrc+' alt="Louis Vuitton"/></figure')
				
				$popin.find('img').load(function(){
					$popin.fadeIn(500, function(){
						$(this).find('figure').removeClass('loading')
					})
				})
			}
		})
		/*Popin Close*/
		$(document).on('click touch','.popin, .popin .close', function(e){	
			e.preventDefault()
			if($popin.hasClass('video')){
				myPlayer.dispose()
				$popin.fadeOut(400, function(){
					$popin.removeClass('video')
					.find('figure')
					.remove()
					
					
					
					
				})
			}else{
				$popin.fadeOut(400, function(){
					$popin
					.removeClass('img')
					.find('figure')
					.remove()
				
				})
			}
			
		})
		$(document).on('click','#video, .close' , function(e){
			e.stopPropagation()	
		})
	},
	activeNav : function(){
		var url = window.location.pathname;
			
		$('#nav a').removeClass('active').each(function(){
			page = $(this).data('nav')
			if(url.indexOf(page) !== -1){
			
				$(this).data('nav', page).addClass('active')
			}
		})
		if(url.indexOf("produit") !== -1){
	
				$('#nav a[data-nav=carnet]').addClass('active')
			}
	},
	navMob : function(){
		$(document).on('click', '.navDisplay',function(e){
			e.preventDefault()
			$('.navDisplay, #nav').toggleClass('active')
		})
	},
	gMap:function(){
		var myOptions = {
			zoom: 15	
		},
		map = new google.maps.Map(document.getElementById("map"), myOptions),
		infowindow = new google.maps.InfoWindow(),
		geocoder = new google.maps.Geocoder(),
		address = $('#aside .address').text()
		
		geocoder.geocode( { 'address': address}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				map.setCenter(results[0].geometry.location);
				marker = new google.maps.Marker({
					position: results[0].geometry.location,
					map: map,
					icon: './img/mapIcon.png'
				});
				google.maps.event.addListener(marker, 'click', function() {
					infowindow.setContent('Le magasin est situé au <br/> ' + address);
					infowindow.open(map, this);
				})
			} 
		});
	},
	toggleAside : function(){
		$(document).on('click', '.button', function(e){
				e.preventDefault()
				
				var id = $(this).attr('href'),
					$acces = $('.acces')
				$(this).closest('.button-ct').find('.button').removeClass('active')	
				$(this).addClass('active')	
				$('#horaire, #map').removeClass('active').css({
					opacity:0
				})
				$(id).addClass('active').animate({
					opacity:1
				},500)
		})		
	},
	parseLink : function(){
			var param = window.location.search
			$('#header a, #grid a, .ribbon a').each(function(){
				var rootUrl = $(this).attr('href')
				$(this).attr('href', rootUrl+ param)
			})
	},
	cutLength: function(){
		$('#prodCol .pola1 figcaption span').each(function(){
			if($(this).text().length> 20){
				var truncateText = $(this).text().substring(0, 20).split(" ").join(" ") + "..."
				$(this).text(truncateText)
			}
			
		})
	},

	shareDisplay: function(){
		$('.share').on('click', function(){
			$(this).toggleClass('open')
		})
	},

	init: function(){
	
		V.underscore()
		
		$(document).on('collecScreenLoaded', function(){
		
			V.homeAnim()
			V.polaAnim()
			V.navMob()
			V.langToggle()
			V.modal()
			V.parseLink()
			V.shareDisplay()
	
			if($('#home #grid, #carnet #grid, #multimedia #grid').length){
				V.gridFill()
			}	

			if($('#map').length){
				V.gMap()
			}

			V.activeNav()
			V.toggleAside()
			$('body').css({opacity:1})
		})

		// AJAX CALL ECRAN
			
		$.ajax({
			url : rootFlux+'/flux_minisite/ecrans'+lang+'.json', // HERE
			dataType:'json'
		}).done(function(response){
			collecScreen = response;
		}).complete(function(){
			$(document).trigger('collecScreenLoaded');
		})
	}
}
$(document).ready(function(){
	V.init()
	$('#welcome').load(function(){
		alert('ada')
	})
})


