<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Communitytreasures</title>
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
    
    <style>
#header {
	box-shadow: 0 0 5px #000;
	z-index: 99;
	border-bottom: 1px solid #dfdfdf;
}
.strtnw {
	background: #e91c7d none repeat scroll 0 0;
	border: 0 none;
	border-radius: 5px;
	color: #fcff1d;
	cursor: pointer;
	display: block;
	font-family: Arial, Helvetica, sans-serif;
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
    <h1> <a href="#"> <img src="<?php echo base_url(); ?>images/logo-login.png" alt=""  style="margin-top: 10px; width: 370px;" /> </a> </h1>
    <p class="login-righttop"> <a href="javascript:void(0)" class="forget-manu" style="float: left;">Forgotten your password? </a> <span style=" float: left; margin-left: 20px;"> <a href="javascript:void(0)" class="login-manu">Member Login </a> </span> </p>
    <br class="clr" />
    <div class="login-manu-sub" style="display:<?php echo $styleStatus;?>;">
          <div class="login-drop">
        <?php if(isset($errorMsg)){?>
        <div class="error-msg"> <?php echo $errorMsg;?> </div>
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
        <div class="succ-msg"> <?php echo $succMsg;?> </div>
        <?php }?>
        <?php if($errorMsg1!=""){?>
        <div class="error-msg"> <?php echo $errorMsg1;?> </div>
        <?php }?>
        <form action="<?php echo base_url();?>gateway/forgetPass" method="post" id="frnd" class="login-form">
              <input name="emailIDforFrogetPass" type="text" placeholder="Email" class="input1" required>
              <input type="submit" name="forgetPassBtn" id="forgetPassBtn" value="Submit" class="login-submit"/>
              <a href="#"> </a>
            </form>
      </div>
        </div>
  </div>
      <div class="wrapper-login">
    <div class="top-log-menu">
          <ul>
        <!-- <li><a href="<?php echo base_url(); ?>">Home</a></li>  <li><a href="<?php echo base_url(); ?>gateway/contentDetails/1">About Us</a></li>  <li><a href="<?php echo base_url(); ?>gateway/contentDetails/2">Qspace</a></li>   <li><a href="<?php echo base_url(); ?>gateway/contentDetails/3">Brand</a></li>  <li><a href="<?php echo base_url(); ?>gateway/contentDetails/4">Opportunity</a></li>  <li><a href="<?php echo base_url(); ?>">Sign Up</a></li>  <li><a href="<?php echo base_url(); ?>gateway/contentDetails/5">Contact Us</a></li> -->
        <li> <a href="<?php echo base_url(); ?>">Home </a> </li>
        <li> <a href="<?php echo base_url(); ?>gateway/contentDetails/about-us">About Us </a> </li>
        <li> <a href="<?php echo base_url(); ?>gateway/contentDetails/qspace">Qspace </a> </li>
        <li> <a href="<?php echo base_url(); ?>gateway/contentDetails/brand">Brands </a> </li>
        <li> <a href="<?php echo base_url(); ?>gateway/contentDetails/opportunity">Opportunity </a> </li>
        <li> <a href="<?php echo base_url(); ?>">Sign Up </a> </li>
        <li> <a href="<?php echo base_url(); ?>gateway/contentDetails/contact-us">Contact Us </a> </li>
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
          <div class="new_secn">
        <div class="join_secn">
              <div class="prod_logo">
            <div class="join_secn_inr">
                  <div class="vdo_imges"><img src="http://www.communitytreasures.co/images/jl.png" alt="" style=" float: right;  margin-left: 20px;" /> <a id="tutorial-videoAb" name="https://www.youtube.com/embed/t297YldJCnA" href="javascript:void(0)"> <img src="http://www.communitytreasures.co/images/blk-playutube.png" alt="" style="position: absolute; right: 30px; top: 235px; width: 142px;"/> </a></div>
                  <!--<img src="http://www.communitytreasures.co/images/jl.png" alt="" />-->
                  <h2>Join A CT Association Today</h2>
                  <p>Now you can boost your business, gain new customers and mass market Your Projects by becoming an ASP member of Community Treasures.
                With over 100 international collectives each operating in separate industries, CT strives to be the largest consolidation of 'Partnership Associations' online. </p>
                  <p>Our associations use the internet to unite local businesses, service providers, labels, good causes and talented artists. </p>
                  <p>The purpose of each association is to increase the customer base and earning potential of all joint participants, while enabling thousands of CT members to benefit from discount offers, free samples and an increased market share in multiple industries. <br />
                Each CT association and our subsidiary brands are organised and co-run by its members who are called 'ASPs' which means 'Association Partners'.</p>
                </div>
            <p>As an ASP you are able to use the Community Treasures platform as part of an association to actively establish mass marketing, distribution and growth in your chosen industries.</p>
            <p>This air of cooperation allows our ASP members to benefit from trading business to business, sharing resources while their projects remain 100% independent.</p>
            <p>By rapidly expanding, our CT Associations retain the ability to be an autonomous space in a wide variety of markets.
                  Rather than follow commercialized industry leaders, CT enjoys its independence and freedom to implement fresh new ideas, always remaining exciting and edgy, breaking the mould as we start new trends.</p>
          </div>
            </div>
        <div class="inclub_sec">
              <div class="prod_logo">
            <h3>Incubating Start ups & New Ventures</h3>
            <p>Community Treasures is the perfect place to gain support for fledgling small businesses. We nurture<br />
                  entrepreneurs who need support and provide vital connections to open new doors of opportunity.<br />
                  Join a CT Association now and move towards the career of their dreams. </p>
          </div>
            </div>
        <div class="wherw_sec">
              <div class="prod_logo">
            <div class="wherw_sec_top">
                  <div class="wherw_sec_left">
                <h2>Who Are ASPs.</h2>
                <p>All types of industry professionals from Start-ups to fully established enterprises, amateurs to experts, creative artists to good causes, all are welcome to become (ASPs) Association Partners. 
                      Becoming an 'ASP' enables you to harness the collective marketing power of our large CT membership while you promote your products and submit discount offers on the Community Treasures platform. the way you currently earn money then choose two more that reflect your passions or the industries you wish your projects to enter in the future. </p>
              </div>
                  <div class="wherw_sec_rit"> <img src="http://www.communitytreasures.co/images/whorwe.png" alt="" /> </div>
                  <div class="clear"></div>
                </div>
            <div class="wherw_sec_dwn">
                  <div class="wherw_sec_left">
                <h2>Choosing The Right CT Association To Join</h2>
                <p>There are a wide variety of CT associations for you to choose from, each focusing on its own specialised categories such as:</p>
                <p>Business Services, Performing & Creative Arts, Education, Fitness, Health & Beauty, Food & Beverage, Leisure Entertainment, Lifestyle brands, Local Community, Media, Online Currency, Outreach Programs, Personals, Property, Social, Wellbeing, Personal Development and many others.
                      We have associations uniting ASPs who work to help the most vulnerable fight hunger, build wells and schools for people in need around the world.</p>
                <p> With an ASP membership, you can participate in up to 3 different collectives. We suggest you first join an association that reflects </p>
              </div>
                  <div class="wherw_sec_rit"> <img src="http://www.communitytreasures.co/images/wh_co.png" alt="" /> </div>
                  <div class="clear"></div>
                </div>
          </div>
            </div>
        <div class="aswe_sec">
              <div class="prod_logo">
            <div class="aswe_sec_top">
                  <h2>ASP Members Can Feature 'Go Monthly' Offerings</h2>
                  <p>Our 'Go Monthly' packages are viewed by hundreds of CT members as they complete the various Queue levels and earn commissions. As an ASP, you can market your products or services, offer discounts or customised deals on our platform.
                This offer will then be available to thousands of Community treasures members increasing the online exposure for your business,product or services.</p>
                  <p> It doesn't stop there. To boost your potential earning power
                CT members can in turn, choose to market and sell your offer, gift or voucher to their friends, earning themselves a commission or gift  from the sale. This gives you, the ASP, new customers and an army of distributors within our networks.</p>
                </div>
          </div>
              <div class="aswe_sec_dwn">
            <div class="prod_logo">
                  <h2>Cross trading & Making Great Deals</h2>
                  <p>As an ASP, You are able to connect with other associations through our CT Switchboard. By association to association trading, you can find important resources like, legal services, craftsmanship for your business or negotiate better rates on merchandise stock from wholesalers in the associations. You can also find promotions and any other resources that you may need using this facility.</p>
                  <h2>Group Purchasing</h2>
                  <p>If your business relies on stock and merchandise, then in some cases you will be able to benefit from our Group buying operations. For example, if the majority of an association agree, then the moderators can organise interested members to buy in bulk.
                These Group efforts allow us to buy any items in bulk, increase our negotiating power and reduce the costs of various products and services. </p>
                </div>
          </div>
              <div class="cohst_sec">
            <div class="prod_logo">
                  <h2>Co-host Our Once Monthly Webinars</h2>
                  <p>As an ASP you can opt to co-host a once monthly webinar for CT members and the general public who are interested about information in your industry. This is a good opportunity for you to establish yourself as an authority of your chosen subject while introducing your business and brand to new potential customers.</p>
                  <h2>Exhibitions and seminars</h2>
                  <p>Every year Community Treasures aim to host a regional CT Festival that features our CT Associations and its members. As an ASP you are welcome to promote your company by acquiring a stall in our exhibition space and contribute to seminars, workshops and other activities during this annual event. </p>
                  <h2>Social Events & Holiday Meet ups</h2>
                  <p>As an ASP, You are invited to social gatherings and business networking events hosted by your association. You can also enjoy group holidays and VIP areas at selected Community Treasures events.</p>
                  <a class="bnrew" href="#gohere">view associations</a> </div>
          </div>
            </div>
        <div class="weallwin_sec">
              <div class="prod_logo">
            <h2>We All Win From An Increased<br />
                  Market Share.</h2>
            <p>By operating as part of an association you immediately benefit from our group efforts to increase our joint market share. As each association grows in popularity this success is transferred to you. As an ASP, your business or projects will acquire new leads, valuable knowledge sharing, more exposure,  new connections and a passive earning source thats driven by thousands of CT members.</p>
            <h2>Together, We Can Make A Difference ;)</h2>
            <p>CT Associations encourage all 'ASPs' Association Partners to protect the environment and help vulnerable people in need. Our aim is to increase social awareness responsibility throughout every business sector. <br />
                  By reinforcing the Community Treasures ethos of fairness, humanity, good intent and togetherness, our CT Associations can really make a difference.</p>
          </div>
            </div>
        <div class="youcan_join_sec">
              <div class="prod_logo">
            <div class="jonese_inr">
                  <h2>You Can Join A CT Association & Become an ASP for Just</h2>
                  <div class="jonese_inr_lft">
                <h2>$25</h2>
                <strong>Per Month</strong></div>
                  <div class="jonese_inr_rit">
                <p>Included in your ASP membership is:</p>
                <ul>
                      <li><span>•</span> Access to join up to 3 associations.</li>
                      <li><span>•</span> You can create an offer to thousands of members in the CT community.</li>
                      <li><span>•</span> You gain the ability to publish Your offers on CT Catalogue.</li>
                      <li><span>•</span> You can feature your business, service or talent, once a month on CT Magazine App.</li>
                      <li><span>•</span> Your product or service can be distributed and sold by the entire CT community.</li>
                      <li><span>•</span> You get Lead generation and new customers from our CT switchboard.</li>
                      <li><span>•</span> You can co-host a Webinar focusing on your chosen industry (once per quarter). </li>
                      <li><span>•</span> Inclusion at regional CT Association events and exhibitions.</li>
                    </ul>
              </div>
                  <div class="clear"></div>
                </div>
          </div>
            </div>
        <div class="ernmny_sec">
              <div class="prod_logo">
            <h2>Earn More Money As A CT Brand Builder</h2>
            <p>As an ASP you can still opt to have two types of membership and buy a Qspace which is our CT Brand Builders account. <br />
                  Simply buy a Qspace with your ASP subscription and you will be able to earn an extra income by taking a few minutes to watch 12 Ads per day and complete one small task like sharing one of our CT videos on your facebook and other social networks.<br />
                  First purchase ASP monthly membership then get your Qspace for just $49, You will be entered into our Live queue and earn great commissions for marketing our Brands and Associations. </p>
          </div>
            </div>
        <div class="rgggestre">
              <div class="prod_logo"> <a href="#">Register Now</a>
            <p id="gohere">Choose You Account & Get Started Today.</p>
          </div>
            </div>
      </div>
          <div class="prod_logo"> 
        <!-- <img src="http://www.communitytreasures.co/images/logo-login.png" alt="">-->
        
        <div class="testimonials-pagecontent">
              <h1 style="margin-bottom:30px;">Brands </h1>
              <div class="opp-newtab">
            <div style="display:none;">
                  <h3>What Are In-house Brands? </h3>
                  <div style="position:relative;"> <!--<img src="http://www.communitytreasures.co/images/brand-pic1.png" alt="" style=" float: right;  margin-left: 20px;" /> <a id="tutorial-videoAb" name="https://www.youtube.com/embed/t297YldJCnA" href="javascript:void(0)"> <img src="http://www.communitytreasures.co/images/blk-playutube.png" alt="" style="position: absolute; right: 30px; top: 275px;"/> </a> --> 
                <!--<img src="http://www.communitytreasures.co/images/blk-playutube.png" alt="" style="position: absolute; right: 130px; top: 150px;"/>--> 
              </div>
                  <p>Our brands are subsidiaries that are co-run by active members inside Community Treasures. </p>
                  <p>Each of these entities are self-governed and use our platform to actively progress in their targeted industry. </p>
                  <p>As a member, you can use our lifestyle brands to push or assist your talent or business. You can get VIP product discounts or focus on self-development. </p>
                  <p>We have brands that use our platform to help the most vulnerable people and Brands to fight hunger, build wells and build schools for people in need around the world. </p>
                  <p>Using your 'Q-space' you can apply to work with an in-house brand in any of the sectors we cover. </p>
                  <p>Through CT you can make a difference and build the career of your dreams. </p>
                  <p>Currently, There are over 30 in-house brands and associations, all reinforcing the Community Treasures ethos of fairness, good intent and togetherness. </p>
                  <p>As an active Brand Builder, you will be able to  sample up to 12 bonuses offered by our brands every time you finish a Life Cycle (complete 5 queues). </p>
                  <p>By rapidly expanding and working as one, the Community Treasures movement retains the ability to be an autonomous space in a wide variety of markets. </p>
                  <p>Rather than follow commercialized market leaders, CT enjoys its independence and freedom to implement fresh new ideas, always remaining exciting and edgy, breaking the mould as we start new trends. </p>
                  <br />
                </div>
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
                      <a href="<?php echo $Brand->facebook_url;?>" target="_blank"> <img src="http://www.communitytreasures.co/images/brand-facebook.png" alt="" /> </a>
                      <?php } else { ?>
                      <img alt="" src="http://www.communitytreasures.co/images/brand-facebook-inactive.png" width="20px;" height="20px;">
                      <?php } ?>
                      <?php if($Brand->youtube_url!="") {?>
                      <a href="<?php echo $Brand->youtube_url;?>" target="_blank"> <img src="http://www.communitytreasures.co/images/brand-youtube.png" alt="" /> </a>
                      <?php } else { ?>
                      <img alt="" src="http://www.communitytreasures.co/images/brand-youtube-inactive.png" width="20px;" height="20px;">
                      <?php } ?>
                      <?php if($Brand->twitter_url!="") {?>
                      <a href="<?php echo $Brand->twitter_url;?>" target="_blank"> <img alt="" src="http://www.communitytreasures.co/images/twitter_new.png"> </a>
                      <?php } else { ?>
                      <img alt="" src="http://www.communitytreasures.co/images/twitter_new-inactive.png" width="20px;" height="20px;">
                      <?php } ?>
                      <?php if($Brand->inst_url!="") {?>
                      <a href="<?php echo $Brand->inst_url;?>" target="_blank"> <img alt="" src="http://www.communitytreasures.co/images/inst-icon.png"> </a>
                      <?php } else { ?>
                      <img alt="" src="http://www.communitytreasures.co/images/inst-icon-inactive.png" width="20px;" height="20px;">
                      <?php } ?>
                      <?php if($Brand->skype_id!="") {?>
                      <a href="skype:<?php echo $Brand->skype_id;?>?call"> <img alt="" src="http://www.communitytreasures.co/images/skype.png"> </a>
                      <?php } else { ?>
                      <img alt="" src="http://www.communitytreasures.co/images/skype-inactive.png" width="20px;" height="20px;">
                      <?php } ?>
                      <?php if($Brand->gplus_url!="") {?>
                      <a href="<?php echo $Brand->gplus_url;?>" target="_blank"> <img alt="" src="http://www.communitytreasures.co/images/gplus1.png"> </a>
                      <?php } else { ?>
                      <img alt="" src="http://www.communitytreasures.co/images/gplus1-inactive.png" width="20px;" height="20px;">
                      <?php } ?>
                      <?php if($Brand->pdf_upload!="") {?>
                      <a href="http://globalblackenterprises.com/adminuploads/pdf_upload/download.php?file=<?php echo $Brand->pdf_upload; ?>"> <img alt="" src="http://www.communitytreasures.co/images/download.png" width="42px;"> </a>
                      <?php } else { ?>
                      <img alt="" src="http://www.communitytreasures.co/images/download-inactive.png" width="42px;" height="20px;">
                      <?php } ?>
                      <?php if($Brand->pinterest_url!="") {?>
                      <a href="<?php echo $Brand->pinterest_url;?>" target="_blank"> <img alt="" src="http://www.communitytreasures.co/images/pin.png"> </a>
                      <?php } else { ?>
                      <img alt="" src="http://www.communitytreasures.co/images/pin-inactive.png" width="20px;" height="20px;">
                      <?php } ?>
                      <?php if($Brand->another_url!="") {?>
                      <a href="<?php echo $Brand->another_url;?>" target="_blank"> <img alt="" src="http://www.communitytreasures.co/images/mag-small.png"> </a>
                      <?php } else { ?>
                      <img alt="" src="http://www.communitytreasures.co/images/mag-small-inactive.png" width="20px;" height="20px;">
                      <?php } ?>
                      <?php if($Brand->linked_in_url!="") {?>
                      <a href="<?php echo $Brand->linked_in_url;?>" target="_blank"> <img alt="" src="http://www.communitytreasures.co/images/linkedin.png"> </a>
                      <?php } else { ?>
                      <img alt="" src="http://www.communitytreasures.co/images/linkedin-inactive.png" width="20px;" height="20px;">
                      <?php } ?>
                      <?php if($Brand->gmail_link!="") {?>
                      <a href="mailto:<?php echo $Brand->gmail_link;?>"> <img alt="" src="http://www.communitytreasures.co/images/gmail-icon.png"> </a>
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
          <p class="foot_log"> <img src="<?php echo $base_url;?>images/footer_logo.png" alt=""> </p>
          <p class="footer-topplink"> <a href="#">Personal Development </a> - <a href="#">Life & Wealth Mastery </a> - <a href="#">Financial Freedom </a> - <a href="#">Good Health </a> - <a href="#">Success </a> - <a href="#">Awakenings </a> - <a href="#">Wholeness </a> - <a href="#">Harmony </a> <a href="#">Prosperity </a> - <a href="#">Humanity </a> - <a href="#">Consciousness </a> - <a href="#">Rejuvenation </a> - <a href="#">Lifestyle </a> - <a href="#">Conscious Capitalism </a> - <a href="#">Ethical </a> - <a href="#">Social Entrepreneurism </a> - <a href="#">Joy        Happiness </a> - <a href="#">Security </a> - <a href="#">Friendship </a> - <a href="#">Wellness </a> - <a href="#">Support </a> - <a href="#">Nutrition </a> </p>
          <p class="footer-newlink"> <a href="<?php echo $base_url; ?>gateway/contentDetails/earnings-disclaimer">Earnings Disclaimer </a> | <a href="<?php echo $base_url; ?>gateway/contentDetails/privacy-policy">Privacy Policy </a> | <a href="<?php echo $base_url; ?>gateway/contentDetails/terms-and-conditions">Terms & Conditions </a> | <a href="<?php echo $base_url; ?>gateway/contentDetails/compliance">Compliance </a> </p>
          <p class="footer-copyright">© communitytreasures.co. All rights reserved. </p>
        </div>
  </div>
    </div>
</body>
</html>
