
 <form action="http://www.raversdirect.com/raversdirect/login" method="post" id="directForm" style="display:none">
                    <p>
                       <input name="txtemail" onfocus="if($(this).val()=='email')$(this).val('');" onblur="if($(this).val()=='')$(this).val('email');" value="<?php echo $_SESSION["USER_EMAIL"];?>" type="text">
                        <input name="txtpassword" placeholder="password" type="password" onfocus="if($(this).val()=='******')$(this).val('');" onblur="if($(this).val()=='')$(this).val('******');" value="<?php echo base64_decode($_SESSION["USER_PASSWORD"]);?>">
                        <input name="" type="submit" value="">
                    </p>
 </form>
           