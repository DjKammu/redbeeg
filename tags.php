<?php 
include'header.php';

// get the category form url and make a query
$tag_query = "SELECT tags FROM `contest` where tags is NOT NULL";

$tags = $obj->select_where($tag_query);

$tags = ($tags) ? $tags : [];

 $tagsArr = [];

if(count($tags) > 1){
    

	foreach ($tags as $key => $tag) { 
		 $tags = ($tag['tags']) ? 
                               explode(' ',str_replace(array('#',','),' ', $tag['tags'])) : [];        
        foreach (array_filter($tags) as $key => $tag) {
            $tagsArr[] = $tag;
        }
	}

	$tagsArr = (array_unique($tagsArr));
    asort($tagsArr);
}
?>

   
<div class="mt-5 pt-5"></div>

<div class="container">
	<?php
     
    $tagHtml = '';  

    foreach (array_filter($tagsArr) as $key => $tag) {
        $url = 	$base_url.'tag/'.$tag;
        $tagHtml .= "<a href='$url'> #$tag </a>";
    }

    echo $tagHtml;

	?>
	<h3> </h3>
	
</div>
   
   <?php include'footer.php';  ?>
  
