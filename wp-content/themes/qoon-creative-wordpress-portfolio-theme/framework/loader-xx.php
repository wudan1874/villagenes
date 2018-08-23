<?php 
echo '
<div class="oi_loader">
<div class="loading_xx">
	<img class="whale" src="'.wp_upload_dir()[baseurl].'/2017/11/loading-whale.png">
	<svg class="loading_svg" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="574.558px" height="240px" viewBox="0 0 574.558 120" xml:space="preserve">
	<defs>
		<pattern id="water" width=".25" height="1.1" patternContentUnits="objectBoundingBox">
		  <path fill="#fff" d="M0.25,1H0c0,0,0-0.659,0-0.916c0.083-0.303,0.158,0.334,0.25,0C0.25,0.327,0.25,1,0.25,1z"/>
		</pattern>

		<!-- <text id="text" transform="matrix(1 0 0 1 -8.0684 116.7852)" font-size="161.047">Loading</text> -->
		<circle id="text" transform="matrix(1 0 0 1 105 40)" cx="20" cy="20" r="100"/>

		<mask id="text_mask">
		  <use x="0" y="0" xlink:href="#text" opacity="1" fill="#78b1d5"/>
		</mask>
	</defs>

	<use x="0" y="0" xlink:href="#text" fill="#78b1d5"/>

	<rect class="water-fill" mask="url(#text_mask)" fill="url(#water)" x="-400" y="0" width="1600" height="120"/>
	</svg>

	
	
</div>
</div>';
?>