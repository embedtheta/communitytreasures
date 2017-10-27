<!--<form action="http://www.raversdirect.com/raversdirect/login" method="post" id="directForm" style="display:block">
                    <p>
                      <input type="text" name="txtemail" value="<?php echo $_SESSION["USER_EMAIL"];?>" >
                        <input type="password" name="txtpassword" value="<?php echo base64_decode($_SESSION["USER_PASSWORD"]);?>">
                        <input name="" type="submit" value="">
                    </p>
 </form>-->
 <form action="http://www.raversdirect.com/raversdirect/login" method="post" id="directForm" style="display:none">
                    <p>
                       <input name="txtemail" onfocus="if($(this).val()=='email')$(this).val('');" onblur="if($(this).val()=='')$(this).val('email');" value="<?php echo $_SESSION["USER_EMAIL"];?>" type="text">
                        <input name="txtpassword" placeholder="password" type="password" onfocus="if($(this).val()=='******')$(this).val('');" onblur="if($(this).val()=='')$(this).val('******');" value="<?php echo base64_decode($_SESSION["USER_PASSWORD"]);?>">
                        <input name="" type="submit" value="">
                    </p>
 </form>
 <?php
       /*  echo "<pre>"; 
         print_r($_SESSION);
         echo "----------".base64_decode($_SESSION["USER_PASSWORD"]);
		 Array
(
    [RefID] => 0
    [REFERER] => http://ravestorysociety.com/
    [UID] => 1000
    [UserID] => RaveStory
    [PaymentStatus] => 1
    [society] => 7
    [USER_EMAIL] => ravestory@gmail.com
    [USER_PASSWORD] => MTIzNDU2
)*/
              
 ?>               