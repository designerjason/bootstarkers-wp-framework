<div id="homecarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
    <ol class="carousel-indicators">
<?php	
$banners = get_field('homepage_banner');

	$i=0;
	    foreach ($banners as $banner) { //output the slider navigation
        echo '<li data-target="#homecarousel" data-slide-to="'.$i.'"';
		if($i == 0) {echo ' class="active" ';}
        echo '></li>';

        $i++;		
	    }
		
?>
    </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
<?php	

	$i=0;
	    foreach( $banners as $banner ) { //outputs the banner images which have been uploaded on the 'home' page entry
		echo '<div class="'; 
		if($i == 0) {echo 'active ';} //applies active class to first item only
		echo 'item">';
		echo '<img src="'.$banner['banner_image']['sizes']['banner'].'" />';
        echo '</div>';
        $i++;		
	    }
?>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#homecarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#homecarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a>
</div>