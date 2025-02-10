<?php
class CategoryTemplate {

	public static function showCategories($categories) {
		$res = '<hr class="featurette-divider">';
		foreach($categories as $category) {
			$res .= '			
			<div class="featurette">
			  <div class="container">
			    <a class="row" href="categories?cat='.$category->id.'">
  			      <div class="col-md-7">
				    <h1 class="featurette-heading">'.$category->name.'</h1>
				    <p class="lead">'.$category->description.'</p>
			      </div>
			      <div class="col-md-5">
				    <img src="assets/img/categories/'.$category->img.'" width="100%">
			      </div>
			    </a>
			  </div>
			</div>

			<hr class="featurette-divider">';
			
		}
		return $res;
	}
	
	public static function showCategory($category) {
		return '			
		<div class="featurette">
		  <div class="container">
		    <div class="row" href="categories?cat='.$category->id.'">
 			      <div class="col-md-7">
			    <h1 class="featurette-heading">'.$category->name.'</h1>
			    <p class="lead">'.$category->description.'</p>
		      </div>
		      <div class="col-md-5">
			    <img src="assets/img/categories/'.$category->img.'" width="100%">
		      </div>
		    </div>
		  </div>
		</div>
		';
	}
}
?>