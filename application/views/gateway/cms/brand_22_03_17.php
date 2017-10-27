<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Communitytreasures
    </title>
    <link href="<?php echo base_url(); ?>css/style3.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>images/headerlogo.png" type="image/x-icon"/>
    <!--<link href="<?php echo base_url(); ?>css/main.css" rel="stylesheet" type="text/css"/><link href="<?php echo base_url(); ?>css/style_new.css" rel="stylesheet" type="text/css"/>-->
    <link href="<?php echo base_url(); ?>css/style_community_login.css" rel="stylesheet" type="text/css"/>
    <!--new added ujjwal sana-->
    <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.9.1.min.js">
    </script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/main.js">
    </script>
    <!--new added ujjwal sana-->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js">
    </script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/fancyBoxContent/jquery.fancybox.js?v=2.1.4">
    </script>
    <!--fancy box-->
    <script type="text/javascript" src="<?php echo base_url(); ?>js/fancyBoxContent/jquery.fancybox.js?v=2.1.4">
    </script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>js/fancyBoxContent/jquery.fancybox.css?v=2.1.4" media="screen" />
    <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.sticky.js">
    </script>
    <script language="javascript"> 	$( document ).ready(function() {
        $("#tutorial-video1").click(function() {
          $.fancybox.open('<iframe width="660" height="415" src="<?php if($pageDetails->video_path != ""){ echo $pageDetails->video_path;}else{?>www.youtube.com/embed/2-4aZwXuu7M<?php }?>?autoplay=1" frameborder="0" allowfullscreen></iframe>');
        }
                                   );
      }
                                                       );
      /* function chkValid(){	 var flagNew = true; 	 if(document.getElementById("user_name_formAcymailing1").value == "" || document.getElementById("user_name_formAcymailing1").value == "Name Here..."){		 alert("Please Enter Your Name");		 flagNew = false;	 }	 if(document.getElementById("user_email_formAcymailing1").value == "" || document.getElementById("user_email_formAcymailing1").value == "Enter VALID Email Here..."){		 alert("Please Enter Your Email");		 flagNew = false;	 }	 if(flagNew == true){		document.getElementById("signupForm").submit();	 }else{		 return false;	 } }*/ </script>
    <!--3/9/2015 done by ujjwal sana-->
    <script type="text/javascript"> function emailValid(email){
        var emailReg = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        var error = "";
        if(email == ""){
          error = "Email field is required.";
        }
        else if(!emailReg.test(email) && email != ""){
          error = "Please enter the valid Email.";
        }
        return error;
      }
      $(document).ready(function() {
        $("#submitId").click(function(e) {
          var email = $("#signUpEmailId").val();
          var error = emailValid(email);
          if(error != ""){
            $.fancybox.open(error);
            $("#signUpEmailId").focus();
            return false;
          }
          else{
            return true;
          }
        }
                            );
        <?php if(isset($msg)){
          ?>        $.fancybox.open('<?php echo $msg;?>');
          <?php }
        ?>    }
        );
    </script>
    <script>    $(window).load(function(){
        $("#header").sticky({
          topSpacing: 0 }
                           );
      }
                              );
    </script>  
    <style>  #header {
      box-shadow: 0 0 5px #000;
      z-index: 99;
      border-bottom: 1px solid #dfdfdf;
      }
      .strtnw{
        background: #e91c7d none repeat scroll 0 0;
        border: 0 none;
        border-radius: 5px;
        color: #fcff1d;
        cursor: pointer;
        display: block;
        font-family: Arial,Helvetica,sans-serif;
        font-size: 27px;
        font-weight: bold;
        line-height: 46px;
        margin-top: 13px;
        position: relative;
        width: 100%;
        z-index: 0;
        text-align:center;
      }
    </style>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,700' rel='stylesheet' type='text/css'>
    <script src='https://www.google.com/recaptcha/api.js'>
    </script>
  </head>
  <body>
    <div class="login-container">
      <div class="top-login_top" id="header">  
        <div class="wrapper-login">    
          <h1>
            <a href="#">
              <img src="<?php echo base_url(); ?>images/logo-login.png" alt=""  style="margin-top: 10px; width: 370px;" />
            </a>
          </h1>    
          <p class="login-righttop"> 
            <a href="javascript:void(0)" class="forget-manu" style="float: left;">Forgotten your password?
            </a>
            <span style=" float: left; margin-left: 20px;">
              <a href="javascript:void(0)" class="login-manu">Member Login
              </a>
            </span> 
          </p>    
          <br class="clr" />    
          <div class="login-manu-sub" style="display:<?php echo $styleStatus;?>;">      
            <div class="login-drop">        
              <?php if(isset($errorMsg)){?>        
              <div class="error-msg">
                <?php echo $errorMsg;?>
              </div>        
              <?php }?>        
              <form action="<?php echo base_url();?>gateway/login" method="post" id="frnd" class="login-form">          
                <input name="emailID" type="text" placeholder="Email" class="input1" required>          
                <input name="password" type="password" placeholder="Password" class="input2" required>          
                <input type="submit" name="logIN" id="logIN" value="Login" class="login-submit"/>        
              </form>      
            </div>    
          </div>    
          <div class="forget-manu-sub" style="display:<?php echo $styleStatus1;?>;">      
            <div class="login-drop">        
              <?php if($succMsg!=""){?>        
              <div class="succ-msg">
                <?php echo $succMsg;?>
              </div>        
              <?php }?>        
              <?php if($errorMsg1!=""){?>        
              <div class="error-msg">
                <?php echo $errorMsg1;?>
              </div>        
              <?php }?>        
              <form action="<?php echo base_url();?>gateway/forgetPass" method="post" id="frnd" class="login-form">          
                <input name="emailIDforFrogetPass" type="text" placeholder="Email" class="input1" required>          
                <input type="submit" name="forgetPassBtn" id="forgetPassBtn" value="Submit" class="login-submit"/>          
                <a href="#">
                </a>        
              </form>      
            </div>    
          </div>  
        </div>  
        <div class="wrapper-login">
          <div class="top-log-menu">
            <ul>  
              <!-- <li><a href="<?php echo base_url(); ?>">Home</a></li>  <li><a href="<?php echo base_url(); ?>gateway/contentDetails/1">About Us</a></li>  <li><a href="<?php echo base_url(); ?>gateway/contentDetails/2">Qspace</a></li>   <li><a href="<?php echo base_url(); ?>gateway/contentDetails/3">Brand</a></li>  <li><a href="<?php echo base_url(); ?>gateway/contentDetails/4">Opportunity</a></li>  <li><a href="<?php echo base_url(); ?>">Sign Up</a></li>  <li><a href="<?php echo base_url(); ?>gateway/contentDetails/5">Contact Us</a></li> -->  
              <li>
                <a href="<?php echo base_url(); ?>">Home
                </a>
              </li>  
              <li>
                <a href="<?php echo base_url(); ?>gateway/contentDetails/about-us">About Us
                </a>
              </li>  
              <li>
                <a href="<?php echo base_url(); ?>gateway/contentDetails/qspace">Qspace
                </a>
              </li>  
              <li>
                <a href="<?php echo base_url(); ?>gateway/contentDetails/brand">Brands
                </a>
              </li>  
              <li>
                <a href="<?php echo base_url(); ?>gateway/contentDetails/opportunity">Opportunity
                </a>
              </li>  
              <li>
                <a href="<?php echo base_url(); ?>">Sign Up
                </a>
              </li>  
              <li>
                <a href="<?php echo base_url(); ?>gateway/contentDetails/contact-us">Contact Us
                </a>
              </li>
            </ul>  
          </div>  
          <br class="clr" />
        </div>  
      </div>
      <div class="top-login">    
        <!--New section added-->    
        <div class="fontent_bottom" style="text-align:center;">
          <script type="text/javascript">
            $(document).ready(function() {
              $("#tutorial-videoAb").click(function() {
                $.fancybox.open('<iframe width="660" height="415" src="https://www.youtube.com/embed/t297YldJCnA" frameborder="0" allowfullscreen></iframe>');
              }
                                          );
            }
                             );
          </script>
		  <style type="text/css">
			.brands-cat ul li{height:229px !important;}
		  </style>
          <!--New section added-->
          <div class="fontent_bottom" style="text-align:center;">
            <div class="prod_logo">
             <!-- <img src="http://www.communitytreasures.co/images/logo-login.png" alt="">-->
             <div class="new_secn">
             <div>
             <div><img src="http://www.communitytreasures.co/images/blk-playutube.png" alt="" />
             <h2>Join A CT Association Today</h2>
             Now you can boost your business, gain new customers and mass market Your Projects by becoming an ASP member of Community Treasures.
With over 100 international collectives each operating in separate industries, CT strives to be the largest consolidation of 'Partnership Associations' online. 
Our associations use the internet to unite local businesses, service providers, labels, good causes and talented artists. 

The purpose of each association is to increase the customer base and earning potential of all joint participants, while enabling thousands of CT members to benefit from discount offers, free samples and an increased market share in multiple industries. 
Each CT association and our subsidiary brands are organised and co-run by its members who are called 'ASPs' which means 'Association Partners'. </div>

As an ASP you are able to use the Community Treasures platform as part of an association to actively establish mass marketing, distribution and growth in your chosen industries.

This air of cooperation allows our ASP members to benefit from trading business to business, sharing resources while their projects remain 100% independent. 

By rapidly expanding, our CT Associations retain the ability to be an autonomous space in a wide variety of markets.
Rather than follow commercialized industry leaders, CT enjoys its independence and freedom to implement fresh new ideas, always remaining exciting and edgy, breaking the mould as we start new trends.


</div>
             <div><h3>Incubating Start ups & New Ventures</h3><p>Community Treasures is the perfect place to gain support for fledgling small businesses. We nurture entrepreneurs who need support and provide vital connections to open new doors of opportunity. 
Join a CT Association now and move towards the career of their dreams. 
</p></div>
             
             </div>
              <div class="testimonials-pagecontent">
                <h1>Brands
                </h1>
                <div class="opp-newtab">
                  <h3>What Are In-house Brands?
                  </h3>
                  <div style="position:relative;">
                    <img src="http://www.communitytreasures.co/images/brand-pic1.png" alt="" style=" float: right;  margin-left: 20px;" />
                    <a id="tutorial-videoAb" name="https://www.youtube.com/embed/t297YldJCnA" href="javascript:void(0)">
                      <img src="http://www.communitytreasures.co/images/blk-playutube.png" alt="" style="position: absolute; right: 30px; top: 275px;"/>
                    </a>
                    <!--<img src="http://www.communitytreasures.co/images/blk-playutube.png" alt="" style="position: absolute; right: 130px; top: 150px;"/>-->
                  </div> 
                  <p>Our brands are subsidiaries that are co-run by active members inside Community Treasures.
                  </p>
                  <p>Each of these entities are self-governed and use our platform to actively progress in their targeted industry.
                  </p>
                  <p>As a member, you can use our lifestyle brands to push or assist your talent or business. You can get VIP product discounts or focus on self-development.
                  </p>
                  <p>We have brands that use our platform to help the most vulnerable people and Brands to fight hunger, build wells and build schools for people in need around the world.
                  </p>
                  <p>Using your 'Q-space' you can apply to work with an in-house brand in any of the sectors we cover.
                  </p>
                  <p>Through CT you can make a difference and build the career of your dreams.
                  </p>
                  <p>Currently, There are over 30 in-house brands and associations, all reinforcing the Community Treasures ethos of fairness, good intent and togetherness.
                  </p>
                  <p>As an active Brand Builder, you will be able to  sample up to 12 bonuses offered by our brands every time you finish a Life Cycle (complete 5 queues).
                  </p>
                  <p>By rapidly expanding and working as one, the Community Treasures movement retains the ability to be an autonomous space in a wide variety of markets.
                  </p>
                  <p>Rather than follow commercialized market leaders, CT enjoys its independence and freedom to implement fresh new ideas, always remaining exciting and edgy, breaking the mould as we start new trends.
                  </p>
                  <br />
                </div>
                <?php      if(count($BrandList) > 0){          foreach($BrandList as $key=>$BrandLists){                   ?>
                <div class="brands-cat">
                  <h2>
                    <?php if($BrandLists->title!="") { echo $BrandLists->title; } ?>
                  </h2>
                  <ul>
                    <?php   foreach( $BrandLists->getAds as $key =>$Brand ) { ?>
                    <li>
                      <?php if($Brand->ad_image!="") {?>
                      <img src="http://globalblackenterprises.com/adminuploads/adpost/<?php echo $Brand->ad_image;?>" alt=""  width="165px;" height="158px;"/>
                      <?php } else { ?>
                      <img alt="" src="http://globalblackenterprises.com/adminuploads/adpost/1.png" width="165px;" height="158px;">
                      <?php } ?>
                      <p class="icon-brands">
                        <?php if($Brand->facebook_url!="") {?>
                        <a href="<?php echo $Brand->facebook_url;?>" target="_blank">
                          <img src="http://www.communitytreasures.co/images/brand-facebook.png" alt="" />
                        </a>
                        <?php } else { ?>
                        <img alt="" src="http://www.communitytreasures.co/images/brand-facebook-inactive.png" width="20px;" height="20px;">
                        <?php } ?>
                        <?php if($Brand->youtube_url!="") {?>
                        <a href="<?php echo $Brand->youtube_url;?>" target="_blank">
                          <img src="http://www.communitytreasures.co/images/brand-youtube.png" alt="" />
                        </a>
                        <?php } else { ?>
                        <img alt="" src="http://www.communitytreasures.co/images/brand-youtube-inactive.png" width="20px;" height="20px;">
                        <?php } ?>
                        <?php if($Brand->twitter_url!="") {?>
                        <a href="<?php echo $Brand->twitter_url;?>" target="_blank">
                          <img alt="" src="http://www.communitytreasures.co/images/twitter_new.png">
                        </a>
                        <?php } else { ?>
                        <img alt="" src="http://www.communitytreasures.co/images/twitter_new-inactive.png" width="20px;" height="20px;">
                        <?php } ?>
                        <?php if($Brand->inst_url!="") {?>
                        <a href="<?php echo $Brand->inst_url;?>" target="_blank">
                          <img alt="" src="http://www.communitytreasures.co/images/inst-icon.png">
                        </a>
                        <?php } else { ?>
                        <img alt="" src="http://www.communitytreasures.co/images/inst-icon-inactive.png" width="20px;" height="20px;">
                        <?php } ?>
                        <?php if($Brand->skype_id!="") {?>
                        <a href="skype:<?php echo $Brand->skype_id;?>?call">
                          <img alt="" src="http://www.communitytreasures.co/images/skype.png">
                        </a>
                        <?php } else { ?>
                        <img alt="" src="http://www.communitytreasures.co/images/skype-inactive.png" width="20px;" height="20px;">
                        <?php } ?>
                        <?php if($Brand->gplus_url!="") {?>
                        <a href="<?php echo $Brand->gplus_url;?>" target="_blank">
                          <img alt="" src="http://www.communitytreasures.co/images/gplus1.png">
                        </a>
                        <?php } else { ?>
                        <img alt="" src="http://www.communitytreasures.co/images/gplus1-inactive.png" width="20px;" height="20px;">
                        <?php } ?>
                        <?php if($Brand->pdf_upload!="") {?>
                        <a href="http://globalblackenterprises.com/adminuploads/pdf_upload/download.php?file=<?php echo $Brand->pdf_upload; ?>">
                          <img alt="" src="http://www.communitytreasures.co/images/download.png" width="42px;">
                        </a>
                        <?php } else { ?>
                        <img alt="" src="http://www.communitytreasures.co/images/download-inactive.png" width="42px;" height="20px;">
                        <?php } ?>
                        <?php if($Brand->pinterest_url!="") {?>
                        <a href="<?php echo $Brand->pinterest_url;?>" target="_blank">
                          <img alt="" src="http://www.communitytreasures.co/images/pin.png">
                        </a>
                        <?php } else { ?>
                        <img alt="" src="http://www.communitytreasures.co/images/pin-inactive.png" width="20px;" height="20px;">
                        <?php } ?>
                        <?php if($Brand->another_url!="") {?>
                        <a href="<?php echo $Brand->another_url;?>" target="_blank">
                          <img alt="" src="http://www.communitytreasures.co/images/mag-small.png">
                        </a>
                        <?php } else { ?>
                        <img alt="" src="http://www.communitytreasures.co/images/mag-small-inactive.png" width="20px;" height="20px;">
                        <?php } ?>
                        <?php if($Brand->linked_in_url!="") {?>
                        <a href="<?php echo $Brand->linked_in_url;?>" target="_blank">
                          <img alt="" src="http://www.communitytreasures.co/images/linkedin.png">
                        </a>
                        <?php } else { ?>
                        <img alt="" src="http://www.communitytreasures.co/images/linkedin-inactive.png" width="20px;" height="20px;">
                        <?php } ?>
                        <?php if($Brand->gmail_link!="") {?>
                        <a href="mailto:<?php echo $Brand->gmail_link;?>">
                          <img alt="" src="http://www.communitytreasures.co/images/gmail-icon.png">
                        </a>
                        <?php } else { ?>
                        <img alt="" src="http://www.communitytreasures.co/images/gmail-icon-inactive.png" width="20px;" height="20px;">
                        <?php } ?>
                      </p>
                      <?php } ?>
                  </ul>
                  <br class="clr" />
                </div>
                <?php }       }else{      ?>           
                <?php } ?>
              </div>
            </div>
          </div>
          <!--New section end-->   
        </div>	
        <!--New section end-->               
        <div class="footer-login">    
          <div class="wrapper-login">        
            <p class="foot_log">
              <img src="<?php echo $base_url;?>images/footer_logo.png" alt="">
            </p>          
            <p class="footer-topplink"> 
              <a href="#">Personal Development
              </a> - 
              <a href="#">Life & Wealth Mastery
              </a> - 
              <a href="#">Financial Freedom
              </a> - 
              <a href="#">Good Health
              </a> - 
              <a href="#">Success
              </a> - 
              <a href="#">Awakenings
              </a> - 
              <a href="#">Wholeness
              </a> - 
              <a href="#">Harmony
              </a> 
              <a href="#">Prosperity
              </a> - 
              <a href="#">Humanity
              </a> - 
              <a href="#">Consciousness
              </a> - 
              <a href="#">Rejuvenation
              </a> - 
              <a href="#">Lifestyle
              </a> - 
              <a href="#">Conscious Capitalism
              </a> - 
              <a href="#">Ethical
              </a> - 
              <a href="#">Social Entrepreneurism
              </a> - 
              <a href="#">Joy        Happiness
              </a> - 
              <a href="#">Security
              </a> - 
              <a href="#">Friendship
              </a> - 
              <a href="#">Wellness
              </a> - 
              <a href="#">Support
              </a> - 
              <a href="#">Nutrition
              </a> 
            </p>                
            <p class="footer-newlink">
              <a href="<?php echo $base_url; ?>gateway/contentDetails/earnings-disclaimer">Earnings Disclaimer
              </a> | 
              <a href="<?php echo $base_url; ?>gateway/contentDetails/privacy-policy">Privacy Policy
              </a> |
              <a href="<?php echo $base_url; ?>gateway/contentDetails/terms-and-conditions">Terms & Conditions
              </a> |
              <a href="<?php echo $base_url; ?>gateway/contentDetails/compliance">Compliance
              </a>
            </p>
            <p class="footer-copyright">© communitytreasures.co. All rights reserved.
            </p>    
          </div>  
        </div>
      </div>
      </body>
    </html>
