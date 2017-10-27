<!DOCTYPE html>
<html lang="en">
	<!--head start-->
	<?php if(isset($head)): echo $head; endif;?>
    <!--head end-->

    <body>
    	<!--header start-->
        <?php if(isset($header)): echo $header; endif;?>
        <!--header end-->
    
        <div class="wrapper">
        	<!--menu start-->
            <?php if(isset($menu)): echo $menu; endif;?>
            <!--menu end-->
          
            <div class="main_container">
            	<!--body start-->
                <?php if(isset($body)): echo $body; endif;?>
                <!--body end-->
                <!--right_side start-->
                <?php if(isset($rightBar)): echo $rightBar; endif;?>
                <!--right_side end-->
                <br class="clear">
            </div>
          	<!--all user view start-->
            <?php if(isset($allUserView)): echo $allUserView; endif;?>
            <!--all user view end-->
         
        </div>
    	<!--footer start-->
        <?php if(isset($footer)): echo $footer; endif;?>
        <!--footer start-->
    
    </body>
</html>