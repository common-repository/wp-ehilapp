<?php

function ehilappboxhead() {
    echo "

	<style>


		.titolo_boxehilapp{ margin-left:20px; margin-top: 3px; font-size:20px; cursor:pointer; font-weight: bold; padding: 5px 0px 0px;}
		.testo-boxehilapp{ margin:15px;  float:right;}

		.apriehilapp{ font-size:18px; font-family:Verdana, Geneva, sans-serif; float:right; margin-right:50px;}
		.apriehilapp:hover{ font-size:22px; font-family:Verdana, Geneva, sans-serif; cursor:pointer;}
		.chiudiehilapp{ font-size:18px; color:#000; font-weight:bold; position:absolute; right:20px; top:2%;  cursor:pointer;}
		#ehilappimg{ float:left; width:100px;}





		#ehilappbox{ box-shadow: -5px -5px 5px rgba(0, 0, 0,0.8); width:450px; height:210px; background-color:#8B0000; background-image: linear-gradient( #001475, #002cff); color:#fff;  z-index:+300; position:fixed; right:0%; bottom: 0%; font-family:Verdana, Geneva, sans-serif;
		border-radius: 15px 15px 0px 0px;}


		.wrapehilapp {

		    border:1px solid yellow;
		    margin:10px 10px 0px 10px;
			padding:10px;
		    cursor:pointer;

		}

		.wrapehilapp:hover {
			background-color:rgba( 0, 0, 0, 0.3);
		}

		.wrapehilapp:before {
		    content:'';
		    display:inline-block;
		    height:100%;
		    vertical-align:middle;
		    margin-left:-0.25em; /* adjusts spacing */
		}
		.ehilapptextbox {
		    display:inline-block;
		    vertical-align:middle;
		    width:300px;
			color: #fff;
			font-size: 18px;
		}

		.ehilappdown {
		    font-size: 20px;
		    color: #000;
		    padding-left: 10px;
		    padding-right: 10px;
		    text-align: center;
		    background-color: yellow;
		    margin: 3px 10px 10px 10px !important;
			margin-top: 10px;
		    letter-spacing: 20px;
		    cursor:pointer;
		}
		.ehilappdown:hover {
		    font-size: 22px;
		    color: #002cff;
		    font-weight: bold;
		    background-color: #fff;
		}

		ehilappimg {
		    float:left;
			padding:5px;
		}

		.invisibleehilapp {
		    height:100px;
		    display:inline-block;
		    vertical-align:middle;
		}


	</style>

	<script>

		document.addEventListener('DOMContentLoaded', function () {
			function fadeInBox(el) {
			  el.style.opacity = 0;
			  var last = +new Date();
			  var tick = function() {
				el.style.opacity = +el.style.opacity + (new Date() - last) / 1000;
				last = +new Date();
				if (+el.style.opacity < 1) {
				  (window.requestAnimationFrame && requestAnimationFrame(tick)) || setTimeout(tick, 16);
				} else {
					moveDown();
					document.querySelector('.titolo_boxehilapp').innerHTML = 'CLICCA PER MOSTRARE';
				}
			  };
			  tick();
			}
			el = document.querySelector('#ehilappbox');
			fadeInBox(el);
			

			var posEhilappbox = 0;	
			function moveDown() {
			  var elem = document.querySelector('#ehilappbox');   
			  
			  var id = setInterval(frame, 5);
			  function frame() {
				if (posEhilappbox == -168) {
				  clearInterval(id);
				} else {
				  posEhilappbox--; 
				  elem.style.bottom = posEhilappbox + 'px'; 
				}
			  }
			}
			
			function moveUp() {
			  var elem = document.querySelector('#ehilappbox');   
			  
			  var id = setInterval(frame, 5);
			  function frame() {
				if (posEhilappbox == 0) {
				  clearInterval(id);
				} else {
				  posEhilappbox++; 
				  elem.style.bottom = posEhilappbox + 'px'; 
				}
			  }
			}
			


			function fadeOutBox(el) {
			  el.style.opacity = 1;
			  var last = +new Date();
			  var tick = function() {
				el.style.opacity = +el.style.opacity - (new Date() - last) / 1000;
				last = +new Date();
				if (+el.style.opacity > 0) {
				  (window.requestAnimationFrame && requestAnimationFrame(tick)) || setTimeout(tick, 16);
				} else {
					moveDown();
					document.querySelector('.titolo_boxehilapp').innerHTML = 'CLICCA PER ABBASSARE';
				}
			  };
			  tick();
			}

			document.querySelector('.titolo_boxehilapp').addEventListener('click', function() {
				if (posEhilappbox == -168) {
				   moveUp();
				   document.querySelector('.titolo_boxehilapp').innerHTML = 'CLICCA PER ABBASSARE';
				}
				if (posEhilappbox == 0) {
				   moveDown();
				   document.querySelector('.titolo_boxehilapp').innerHTML = 'CLICCA PER MOSTRARE';
				}

			});
			
			document.querySelector('.chiudiehilapp').addEventListener('click', function() {
					fadeOutBox(el);
			});

		});
       
	</script>

    
    
    
    ";
}

function ehilappboxheadmobile() {
	echo"
		<style>


		.titolo_boxehilapp{font-size:16px !important; margin-left:16px; margin-top: 3px; font-size:20px; cursor:pointer; font-weight: bold; padding: 5px 0px 0px;}
		.testo-boxehilapp{ margin:15px;  float:right;}

		.apriehilapp{ font-size:18px; font-family:Verdana, Geneva, sans-serif; float:right; margin-right:50px;}
		.apriehilapp:hover{ font-size:20px; font-family:Verdana, Geneva, sans-serif; cursor:pointer;}
		.chiudiehilapp{ font-size:18px; color:#000; font-weight:bold; position:absolute; right:20px; top:2%;  cursor:pointer;}
		#ehilappimg{ float:left; width:220px;}





		#ehilappbox{ box-shadow: -5px -5px 5px rgba(0, 0, 0,0.8); width:270px; height:170px; background-color:#8B0000; background-image: linear-gradient( #001475, #002cff); color:#fff;  z-index:+300; position:fixed; right:0%; bottom: 0%; font-family:Verdana, Geneva, sans-serif;
		border-radius: 15px 15px 0px 0px;}


		.wrapehilapp {

		    border:1px solid yellow;
		    margin:10px 10px 0px 10px;
			padding:10px;
		    cursor:pointer;
			height: 122px;

		}

		.wrapehilapp:hover {
			background-color:rgba( 0, 0, 0, 0.3);
		}

		.wrapehilapp:before {
		    content:'';
		    display:inline-block;
		    height:100%;
		    vertical-align:middle;
		    margin-left:-0.25em; /* adjusts spacing */
		}
		.ehilapptextbox {
		    display:inline-block;
		    vertical-align:middle;
		    width:300px;
			color: #fff;
			font-size: 18px;
		}

		.ehilappdown {
		    font-size: 20px;
		    color: #000;
		    padding-left: 10px;
		    padding-right: 10px;
		    text-align: center;
		    background-color: yellow;
		    margin: 3px 10px 10px 10px !important;
			margin-top: 10px;
		    letter-spacing: 20px;
		    cursor:pointer;
		}
		.ehilappdown:hover {
		    font-size: 22px;
		    color: #002cff;
		    font-weight: bold;
		    background-color: #fff;
		}

		ehilappimg {
		    float:left;
			padding:5px;
		}

		.invisibleehilapp {
		    height:100px;
		    display:inline-block;
		    vertical-align:middle;
		}


	</style>

	<script>

		document.addEventListener('DOMContentLoaded', function () {
			function fadeInBox(el) {
			  el.style.opacity = 0;
			  var last = +new Date();
			  var tick = function() {
				el.style.opacity = +el.style.opacity + (new Date() - last) / 1000;
				last = +new Date();
				if (+el.style.opacity < 1) {
				  (window.requestAnimationFrame && requestAnimationFrame(tick)) || setTimeout(tick, 16);
				} else {
					moveDown();
					document.querySelector('.titolo_boxehilapp').innerHTML = 'CLICCA PER MOSTRARE';
				}
			  };
			  tick();
			}
			el = document.querySelector('#ehilappbox');
			fadeInBox(el);
			

			var posEhilappbox = 0;	
			function moveDown() {
			  var elem = document.querySelector('#ehilappbox');   
			  
			  var id = setInterval(frame, 5);
			  function frame() {
				if (posEhilappbox == -132) {
				  clearInterval(id);
				} else {
				  posEhilappbox--; 
				  elem.style.bottom = posEhilappbox + 'px'; 
				}
			  }
			}
			
			function moveUp() {
			  var elem = document.querySelector('#ehilappbox');   
			  
			  var id = setInterval(frame, 5);
			  function frame() {
				if (posEhilappbox == 0) {
				  clearInterval(id);
				} else {
				  posEhilappbox++; 
				  elem.style.bottom = posEhilappbox + 'px'; 
				}
			  }
			}
			


			function fadeOutBox(el) {
			  el.style.opacity = 1;
			  var last = +new Date();
			  var tick = function() {
				el.style.opacity = +el.style.opacity - (new Date() - last) / 1000;
				last = +new Date();
				if (+el.style.opacity > 0) {
				  (window.requestAnimationFrame && requestAnimationFrame(tick)) || setTimeout(tick, 16);
				} else {
					moveDown();
				}
			  };
			  tick();
			}

			document.querySelector('.titolo_boxehilapp').addEventListener('click', function() {
				if (posEhilappbox == -132) {
				   moveUp();
				   document.querySelector('.titolo_boxehilapp').innerHTML = 'CLICCA PER ABBASSARE';
				}
				if (posEhilappbox == 0) {
				   moveDown();
				   document.querySelector('.titolo_boxehilapp').innerHTML = 'CLICCA PER MOSTRARE';
				}

			});
			
			document.querySelector('.chiudiehilapp').addEventListener('click', function() {
					fadeOutBox(el);
			});
			
			document.querySelector('#ehilappimg').addEventListener('mouseover', function() {

	                document.querySelector('#ehilappimg').setAttribute('src', '" . plugins_url( '../images/popup-mobile-hover.png', __FILE__ ) . "')

			});
			document.querySelector('#ehilappimg').addEventListener('mouseout', function() {

	                document.querySelector('#ehilappimg').setAttribute('src', '" . plugins_url( '../images/popup-mobile.png', __FILE__ ) . "')

			});


		});
       
	</script>";
}


function ehilappbox() {
    echo '
    
    
    
	<div id="ehilappbox">

			<div class="titolo_boxehilapp">clicca per seguire</div>
	


		<a target="_blank" href="https://play.google.com/store/apps/details?id=com.follex.ale.ehilapp">
		<div class="wrapehilapp">
		    <div class="invisibleehilapp"></div>
		    <img id="ehilappimg" src="' . plugins_url( '../images/ehilapp.png', __FILE__ ) . '" > 
		    <p class="ehilapptextbox" >Scarica <b>EHILAPP</b> per seguire '.get_bloginfo('name').' dal tuo smartphone</p>
		</div>
			<div class="ehilappdown"><span>SCARICA</span></div></a>

			<p class="chiudiehilapp"><img width="35px" src="' . plugins_url( '../images/closebox.png', __FILE__ ) . '" /></p>
	</div>
    
    
    
    ';
}

function ehilappboxmobile() {
    echo '
		<div id="ehilappbox">

			<div class="titolo_boxehilapp">clicca per seguire</div>
		<a target="_blank" href="https://play.google.com/store/apps/details?id=com.follex.ale.ehilapp">
			<div class="wrapehilapp">
				<div class="invisibleehilapp"></div>
				<img id="ehilappimg" src="' . plugins_url( '../images/popup-mobile.png', __FILE__ ) . '" > 
			</div></a>

				<p class="chiudiehilapp"><img width="35px" src="' . plugins_url( '../images/closebox.png', __FILE__ ) . '" /></p>
		</div>';
}	


if($params['parametro1'] == "2"){
	if(wp_is_mobile()){
		add_action( 'wp_head', 'ehilappboxheadmobile' );
		add_action( 'wp_footer', 'ehilappboxmobile' );
	} else {
		add_action( 'wp_head', 'ehilappboxhead' );
		add_action( 'wp_footer', 'ehilappbox' );		
	}
}


?>