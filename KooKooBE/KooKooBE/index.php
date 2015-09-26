<?php

/* TODO: Add code here */
require('config/globalconfig.php');
include_once('class/model_articletype.php');
include_once('class/model_article.php');
include_once('class/model_user.php');

$objArticleType = new model_ArticleType($objConnection);
$arrCategories =  $objArticleType->getAllArticleType(0,null,'`ParentID`=0','Level');


?>

<?php
include_once('include/_header.inc');
/*include_once('include/_menu.inc');
include_once('include/_cat_list.inc');
*/
?>
<link rel="stylesheet" type="text/css" href="css/gallery.css" />
<script src="js/ga.js" type="text/javascript"></script>
<script type="text/javascript">
   $(document).ready(function () {
    $(".item").click(function (e) {
        /*e.stopPropagation();
        $(".item").removeClass("clicked");
        $(this).toggleClass("clicked");
        $("body").addClass("showing-item");
 
        var offset = $(this).offset();
        var pos = offset.left + $(this).width()
        var center = $(".gallery").width() / 2;
        if (pos > center) {
            var align = "left";
        } else {
            var align = "right";
        }
        $(this).removeClass(".left, .right").addClass(align);
 
        return false;*/
    });
 
    $('html').click(function () {
        $(".item").removeClass("clicked");
        $("body").removeClass("showing-item");
    });
});
</script>

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '117244345278368',
      xfbml      : true,
      version    : 'v2.4'
    });

    // ADD ADDITIONAL FACEBOOK CODE HERE
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
<style> 
#header
{
	display:none;
}
#main
{		
	background: none;		
}
#main #content
{
	text-align:center;
}
</style>
<div id="content">	
<?php 
//left side
//include_once('include/_slogan.inc');
?>
<img class="slogan" src="images/home-slogan.png" />
	<div class="gallery">
<?php
foreach($arrCategories as $item)
{
	echo '<div class="item">';
	echo '	<a href="article_list.php?cid='.$item[global_mapping::ArticleTypeID].'" title="'.$item[global_mapping::ArticleTypeName].'"><img align="left" src="'.$item[global_mapping::Thumbnail].'"></a>	';	
	echo '	<span class="caption">';
	echo '	  <h1>';
	echo '		'.$item[global_mapping::ArticleTypeName];
	echo '	  </h1>';
	echo '	  <p>';
	echo '		'.$item[global_mapping::ArticleTypeName];
	echo '	  </p>';
	echo '	</span>';
	echo '  </div>';
}
	?>
	</div>
</div>


<?php 
//footer
include_once('include/_footer.inc');
?>
