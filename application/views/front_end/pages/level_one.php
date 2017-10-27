
    <div class="lefts_side">
      <div class="tabsectionstep">
        <div class="containertab">
            <ul class="tabs">
                <li><a href="#tab1" <?php if($openTabId == "" || $openTabId == "tab1"):?>class="current"<?php endif; ?>>Step1</a></li>
                <li><a href="#tab2" <?php if($openTabId == "tab2"):?>class="current"<?php endif; ?>>Step2</a></li>
                <li><a href="#tab3" <?php if($openTabId == "tab3"):?>class="current"<?php endif; ?>>Step3</a></li>
                <li><a href="#tab4" <?php if($openTabId == "tab4"):?>class="current"<?php endif; ?>>Product Upload</a></li>
            </ul>
          <div class="tab_container">
		  <?php if($tabhide!=1){?>
            <div id="tab1" class="tab_content ">
              <div class="white-bg">
                <div class="yvideo extra-pad"> <span class="watch-thisvideo"><?php echo $stepWiseVideo[1][1]["content_title"];?></span>
                  <div class="palvidd" style="width:556px; height:320px;"> <img src="<?php echo base_url().'adminuploads/level_wise_images/'.$stepWiseVideo[1][1]["content_image"];?>" width="573" height="320" /> </div>
                  
                  <!-- <iframe id="palvidd" width="573" height="320" frameborder="0" src="http://www.youtube.com/embed/-EkL81gUe_A" allowfullscreen=""></iframe>-->
                  
                  <div class="basic-modal-content">
                    <iframe width="573" height="320" frameborder="0" src="<?php echo $stepWiseVideo[1][1]["../../fornt_end/pages/path"];?>" allowfullscreen=""></iframe>
                  </div>
                </div>
                <h3 class="headign-left"> <?php echo $stepWiseVideo[1][1]["content"];?></h3>
                <h3 class="heading-right"><img border="0" alt="" src="<?php echo base_url();?>images/rarrow.png"></h3>
                <br class="clear">
                <div class="ab_inner"><strong><?php echo $stepWiseVideo[1]["A"]["serial_field"];?> </strong>
                  <h3 class="d_hdr"><?php echo $stepWiseVideo[1]["A"]["title"];?></h3>
                  <span><a class="watch-video-tut" id="tutorial-videoS1" name="<?php echo $stepWiseVideo[1]["A"]["path"];?>" href="javascript:void(0)">Watch Video</a></span> </div>
                <div class="white-space pp"> <img class="nobor kk" width="422" height="180" alt="" src="<?php echo base_url().'adminuploads/level_wise_images/'.$stepWiseVideo[1]["A"]["content_image"];?>" style=" display:block; margin:auto;"  /> </div>
                <div class="ab_inner "><strong><?php echo $stepWiseVideo[1]["B"]["serial_field"];?></strong>
                  <h3><?php echo $stepWiseVideo[1]["B"]["title"];?></h3>
                  <span><a class="watch-video-tut" name="<?php echo $stepWiseVideo[1]["B"]["path"];?>" id="tutorial-videoS2" href="javascript:void(0)">Watch Video</a></span></div>
                <div class="white-space pp"> <img class="nobor kk" style=" display:block; margin:auto;" width="250" height="157" alt="" src="<?php echo base_url().'adminuploads/level_wise_images/'.$stepWiseVideo[1]["B"]["content_image"];?>"  /> </div>
                
                <!--end white-space-->
                
                <div class="ab_inner"><strong><?php echo $stepWiseVideo[1]["C"]["serial_field"];?></strong>
                  <h3><?php echo $stepWiseVideo[1]["C"]["title"];?></h3>
                  <span><a class="watch-video-tut" name="<?php echo $stepWiseVideo[1]["C"]["path"];?>" id="tutorial-videoS3" href="javascript:void(0)">Watch Video</a></span></div>
                <div class="white-space"> 
                  <!--<div class="your-pic"><img class="nobor" width="93" height="89" alt="" src="<?php echo base_url(); ?>images/TenPaypal.png" style="float:right;cursor:pointer; " onclick="window.location.href='<?php echo base_url();?>paypalTenDollarPayment/parallelpayment.php?parentPaypalID=<?php echo $parentInfo[0]["paypalAC"];?>&uid=<?php echo $this->session->userdata('userId');?>'" >
                    <p style="width:300px; margin-top: 35px; float:left">-Click On Paypal button to pay $25</p>
                  </div>-->
                  <div class="pricewraper">
                    <?php if(count($afroProduct) >0){
                        $color = 'green';
                        $i = 0;
                        foreach ($afroProduct as $afro){ 
                            if($i == 1){ $color = 'orang';}
                            if($i == 2){ $color = 'blue';}
                            $i++;
                       
?>
                    <div class="singpric <?php echo $color;?>">
                      <div class="pblackbox">
                        <p class="topp"><?php echo $afro->title;?></p>
                        <div class="pric"> <span class="psign"><?php echo $afro->currency_code;?></span> <span class="pmainpric"><?php echo $afro->cost;?></span> </div>
                        <p class="botp">One time payment</p>
                      </div>
                      <?php echo $afro->description;?>
                      <div class="prcbutt"><a href="javascript:void(0)" class="pricbuy" onclick="window.location.href='<?php echo base_url();?>gbe_payment/catalog/<?php echo $afro->id;?>'">Buy It Now</a></div>
                    </div>
                    <?php } } ?>
                  </div>
                </div>
                <br class="clear">
                <div class="ab_inner"><strong><?php echo $stepWiseVideo[1]["D"]["serial_field"];?></strong>
                  <h3><?php echo $stepWiseVideo[1]["D"]["title"];?></h3>
                  <span><a class="watch-video-tut" name="<?php echo $stepWiseVideo[1]["D"]["path"];?>" id="tutorial-videoS4" href="javascript:void(0)">Watch Video</a></span></div>
                <div class="white-space">
                  <div class="your-pic"> <img id="empPic" style="margin-right:25px;" src="<?php echo base_url(); ?>useruploads/<?php echo $userInfo[0]["profile"];?>" width="70" height="70" alt="">
                    <p><?php echo $stepWiseVideo[1]["D"]["content"];?></p>
                    <form enctype="multipart/form-data" action="<?php echo base_url();?>dashboard/profilePicUpload" method="post" class="rday">
                      <label style="display: block; clear: both;">
                      <input type="file" onchange="readURL(this);" name="user_file" id="file">
                      <input type="submit" class="extra-blue-btn"  name="user_file_submit" value="user_file_submit" >
                      <div class="clear"></div>
                      </label>
                    </form>
                  </div>
                </div>
                <br class="clear">
                <div class="ab_inner"><strong><?php echo $stepWiseVideo[1]["E"]["serial_field"];?></strong>
                  <h3 class="d_hdr"><?php echo $stepWiseVideo[1]["E"]["title"];?></h3>
                  <span><a class="watch-video-tut" name="<?php echo $stepWiseVideo[1]["E"]["path"];?>" id="tutorial-videoS5" href="javascript:void(0)">Watch Video</a></span></div>
                <?php
            //$viewArray = array("TEACHER","PAYING USER","ADMIN","HEAD VOLUNTEERS","VOLUNTEERS","STUDENT");
            $viewArray = array("PAYING USER","ADMIN");
            if(in_array($this->session->userdata('userType'), $viewArray)){
                unset($viewArray);
        ?>
                <div class="white-space">
                  <p style="margin-bottom: 30px;"><?php echo $stepWiseVideo[1]["E"]["content"];?></p>
                  <form action="<?php echo base_url();?>dashboard/userPaypalUpdate" method="post" name="form1" id="form1">
                    <label><a target="_blank" href="https://www.paypal.com/"><img class="nobor" src="<?php echo base_url(); ?>images/paypal.png" width="116" height="30" alt=""></a></label>
                    <label>
                      <input type="text" name="user_paypal_name" value="<?php echo $userInfo[0]["paypalAC"];?>" >
                      <input type="submit" value="user_paypal_submit" class="extra-blue-btn"  name="user_paypal_submit">
                    </label>
                    <div class="clear"></div>
                  </form>
                </div>
                <?php }?>
                
                
                <br class="clear">
                <div class="ab_inner"><strong><?php echo $stepWiseVideo[1]["F"]["serial_field"];?></strong>
                  <h3 class="d_hdr"><?php echo $stepWiseVideo[1]["F"]["title"];?></h3>
                  <span id="passCh"><a class="watch-video-tut" name="<?php echo $stepWiseVideo[1]["F"]["path"];?>" id="tutorial-videoS5" href="javascript:void(0)">Watch Video</a></span>
                </div>
                <div class="white-space change_pass">
                  <div class="pink-area">
                      <div class="upl_form">
                        <form method="post" name="changePassword" id="changePasswordId" action="<?php echo base_url();?>dashboard/changePassword">
                        
                            <p>
                                <label>Old Password :</label>
                                <input type="password" name="oldpassword" id="oldpassword">
                            </p>
                            <p>
                                <label>Password :</label>
                                <input type="password" name="password" id="password">
                                
                            </p>
                            <p>
                                <label>Confirm Password :</label>
                                <input type="password" name="cpassword" id="cpassword">
                                <input type="hidden" name="pppp" id="pppp" value="<?php echo $userInfo[0]['password'];?>">
                            </p>
                            <p>
                                <input type="submit" value="update" name="passwordUpdate" id="passwordUpdate" onclick="return passwordCheck();"> 
                            </p>
                      </form>
                    </div>
                  </div>
                </div>
                
                
                
                <?php $ccc = 0; if($ccc == 1){?>
                <br class="clear">
                <div class="ab_inner"><strong><?php echo $stepWiseVideo[1]["F"]["serial_field"];?></strong>
                  <h3 class="d_hdr"><?php echo $stepWiseVideo[1]["F"]["title"];?></h3>
                  <span><a class="watch-video-tut" name="<?php echo $stepWiseVideo[1]["F"]["path"];?>" id="tutorial-videoS5" href="javascript:void(0)">Watch Video</a></span>
                </div>
                <div class="white-space">
                  <div class="pink-area">
                    <form onsubmit="return valFormCountryCode()" action="<?php echo base_url();?>dashboard/userCountryUpdate" method="post" name="formCountryCode" id="formCountryCode">
                      <select id="country" name="country">
                        <option value="">Select Country </option>
                        <?php if(count($countryList) > 0){ 
                            foreach($countryList as $cl){
                                ?>
                        <option value="<?php echo $cl->country_id;?>" <?php if($cl->country_id == $userInfo[0]["country"]){?> selected="selected" <?php }?>><?php echo $cl->name;?></option>
                        <?php }}?>
                      </select>
                      <input type="submit" value="Submit" class="extra-blue-btn extra-freebies" name="freebies_submit" style="float: right;">
                    </form>
                  </div>
                </div>
                <?php }?>
                <br class="clear">
              </div>
            </div>
            <!--1tab end......... -->
            
            <div id="tab2" class="tab_content hide">
              <?php 
            $viewArray = array("TEACHER","ADMIN","HEAD VOLUNTEERS","VOLUNTEERS","STUDENT");
            if(in_array($this->session->userdata('userType'), $viewArray) || ($this->session->userdata('userType') == "PAYING USER" && $userInfo[0]["afrooPaymentStatus"]=="1")){
            unset($viewArray);
            ?>
              <div class="white-bg">
                <div class="yvideo extra-pad"> <span class="watch-thisvideo"><?php echo $stepWiseVideo[2][1]["content_title"];?></span>
                  <div class="palvidd" style="width:556px; height:320px;"> <img src="<?php echo base_url().'adminuploads/level_wise_images/'.$stepWiseVideo[2][1]["content_image"];?>" width="573" height="320" /> </div>
                  <div class="basic-modal-content">
                    <iframe width="573" height="320" frameborder="0" src="<?php echo $stepWiseVideo[2][1]["../../fornt_end/pages/path"];?>" allowfullscreen=""></iframe>
                  </div>
                </div>
                
                <div class="tab2-text">
                  <h1><?php echo $stepWiseVideo[2][1]["content"];?></h1>
                  <!-- <h2>PROMOTE</h2>--> 
                </div>
                <div class="ab_inner clearfix"><strong><?php echo $stepWiseVideo[2]["A"]["serial_field"];?></strong>
                  <h3><?php echo $stepWiseVideo[2]["A"]["title"];?></h3>
                  <a class="watch-video-tut1" name="<?php echo $stepWiseVideo[2]["A"]["path"];?>" id="tutorial-video5" href="javascript:void(0)">Watch Video</a></div>
                <div class="white-space">
                  <h3 class="new_head"><?php echo $stepWiseVideo[2]["A"]["content_title"];?></h3>
                  <p><?php echo $stepWiseVideo[2][1]["content"];?></p>
                  <div id="cont" style="display:none;">Lorem ipsum </div>
                  <div class="website-icon"> <a href="<?php echo $url['../../fornt_end/pages/gmail'];?>" style="font-size:25px;font-weight:bold;"><img class="nobor" src="<?php echo base_url(); ?>images/gmail.png" width="95" height="70" alt=""></a> <a href="<?php echo $url['../../fornt_end/pages/yahoo'];?>"><img class="nobor" src="<?php echo base_url(); ?>images/yahoo.png" width="114" height="70" alt=""></a> </div>
                </div>
                <br class="clear">
                <div class="ab_inner"><strong><?php echo $stepWiseVideo[2]["B"]["serial_field"];?></strong>
                  <h3><?php echo $stepWiseVideo[2]["B"]["title"];?></h3>
                  <a href="javascript:void(0)" name="<?php echo $stepWiseVideo[2]["B"]["path"];?>" id="tutorial-video6" class="watch-video-tut1">Watch Video</a></div>
                <div class="white-space">
                  <div class="clickopen"> <?php echo $stepWiseVideo[2]["B"]["content_title"];?> </div>
                  <div class="togclk" style=" display:none;"> 
                    <?php 
                    if(count($step2Url) > 0):
                        foreach ($step2Url as $s2e):
                    ?>
                      <a href="<?php echo $s2e->url;?>"><?php echo $s2e->title;?></a> 
                    <?php 
                        endforeach;  
                    endif;
                    ?>
                      </div>
                </div>
                <br class="clear">
                <div class="ab_inner"><strong><?php echo $stepWiseVideo[2]["C"]["serial_field"];?></strong>
                  <h3><?php echo $stepWiseVideo[2]["C"]["title"];?></h3>
                  <a href="javascript:void(0)" name="<?php echo $stepWiseVideo[2]["C"]["path"];?>" id="tutorial-video6" class="watch-video-tut1">Watch Video</a></div>
                <div class="white-space">
                  <h3 class="new_head"><?php echo $stepWiseVideo[2]["C"]["content_title"];?></h3>
                  <p><?php echo $stepWiseVideo[2]["C"]["content"];?></p>
                  <div class="ved">
                    <ul id="mycarousel" class="jcarousel-skin-tango">
                      <?php foreach ( $userYoutube as $key=>$val){
						  $arr     = explode("embed/",$userYoutube[$key]["youtubeUrl"]);
						  $title   = urlencode($userYoutube[$key]["youtubeName"]);
						  $url     = urlencode("https://www.youtube.com/watch?v=".$arr[1]);
						  $summary = urlencode(base_url());
						  $image   = urlencode("http://img.youtube.com/vi/$video_id/0.jpg");
				     ?>
                      <li>
                        <iframe width="138" height="103" frameborder="0" allowfullscreen="" src="http://www.youtube.com/embed/<?php echo $arr[1];?>"></iframe>
                        <h5><?php echo $userYoutube[$key]["youtubeName"];?></h5>
                        <input type="hidden" name="youtubeUrl<?php echo $userYoutube[$key]["id"];?>" id="youtubeUrl<?php echo $userYoutube[$key]["id"];?>" value="<iframe width='138' height='103' frameborder='0' allowfullscreen='' src='http://www.youtube.com/embed/<?php echo $arr[1];?>'></iframe>" />
                        <div class="cbz" style="cursor:pointer; background: #031F30; cursor: pointer; line-height:22px; margin-bottom: 5px; width: 138px; position:relative;"><a href="javascript:void(0)" id="copyYouTube<?php echo $userYoutube[$key]["id"];?>">Copy URL</a></div>
                        <a class="share-btn" href="javascript:void(0)">Share</a> <a class="download-btn" href="javascript:void(0)" onclick="downloadVideo('<?php echo $arr[1];?>')">Download</a>
                        <div class="share-popup" id="shareZone1" style="background-color:#fff; display:none">
                          <ul id="logoZone">
                              <li><a href="javascript:void(0)" id="button" onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $title;?>&amp;p[summary]=<?php echo $summary;?>&amp;p[url]=<?php echo $url; ?>&amp;&p[images][0]=<?php echo $image;?>', 'sharer', 'toolbar=0,status=0,width=550,height=400');" target="_parent"><img src="<?php echo base_url();?>images/facebook.png" border="0" /></a></li>
                            <li><a href="javascript:void(0)" onclick="window.open('http://twitter.com/share?text=<?php echo $title; ?>&url=<?php echo $url; ?>', 'child', 'scrollbars,width=650,height=600'); return false"><img src="<?php echo base_url();?>images/twitter.png" border="0" /></a></li>
                            <li><a href="javascript:void(0)" onclick="window.open('https://plus.google.com/share?url=<?php echo $url; ?>&title=<?php echo $title;?>&caption=<?php echo $title;?>&description=<?php echo $summary;?>', 'child', 'scrollbars,width=650,height=600'); return false"><img src="<?php echo base_url();?>images/google_plus.png" border="0" /></a></li>
                          </ul>
                        </div>
                      </li>
                      <?php } ?>
                    </ul>
                  </div>
                </div>
                <br class="clear">
                <div class="ab_inner sing"><strong><?php echo $stepWiseVideo[2]["D"]["serial_field"];?></strong>
                  <h3><?php echo $stepWiseVideo[2]["D"]["title"];?></h3>
                  <a class="watch-video-tut1" name="<?php echo $stepWiseVideo[2]["D"]["path"];?>" id="tutorial-video7" href="javascript:void(0)">Watch Video</a></div>
                <div class="white-space">
                  <div class="extra-share">
                    <div class="share-text">
                      <h3 class="new_head"><?php echo $stepWiseVideo[2]["D"]["content_title"];?></h3>
                      <p><?php echo $stepWiseVideo[2]["D"]["content"];?></p>
                    </div>
                    <div class="share-pic"> <img class="share-none" src="<?php echo base_url(); ?>adminuploads/level_wise_images/<?php echo $stepWiseVideo[2]["D"]["content_image"];?>"> </div>
                  </div>
                  <div class="clear"></div>
                </div>
                <div class="ab_inner sing"><strong><?php echo $stepWiseVideo[2]["E"]["serial_field"];?></strong>
                  <h3><?php echo $stepWiseVideo[2]["E"]["title"];?> </h3>
                  <a class="watch-video-tut1" name="<?php echo $stepWiseVideo[2]["E"]["path"];?>" id="tutorial-video8" href="javascript:void(0)">Watch Video</a></div>
                <div class="white-space">
                  <div class="extra-share">
                    <div class="share-text">
                      <h3 class="new_head"><?php echo $stepWiseVideo[2]["E"]["content_title"];?></h3>
                      <p><?php echo $stepWiseVideo[2]["E"]["content"];?></p>
                    </div>
                    <div class="share-pic"><img class="share-none" src="<?php echo base_url(); ?>adminuploads/level_wise_images/<?php echo $stepWiseVideo[2]["E"]["content_image"];?>"></div>
                    <div class="clear"></div>
                  </div>
                </div>
                <br class="clear">
                <div class="ab_inner"><strong><?php echo $stepWiseVideo[2]["F"]["serial_field"];?></strong>
                  <h3><?php echo $stepWiseVideo[2]["F"]["title"];?> </h3>
                  <a class="watch-video-tut1" name="<?php echo $stepWiseVideo[2]["F"]["path"];?>" id="tutorial-video20" href="javascript:void(0)">Watch Video</a></div>
                <div class="white-space">
                  <h3 class="new_head"><?php echo $stepWiseVideo[2]["F"]["content_title"];?></h3>
                  <p><?php echo $stepWiseVideo[2]["E"]["content"];?></p>
                  <ul class="twitter_user">
                    <?php foreach ( $userAdverts as $key=>$val){?>
                    <li>
                      <div><a href="#"> <img width="103" height="76" src="<?php echo base_url();?>adminuploads/advert/<?php echo $userAdverts[$key]["advertImg"]?>"></a> </div>
                      <div class="tpbb"><a id="copyAdvert<?php echo $userAdverts[$key]["advertID"]?>" href="javascript:void(0)" class="">Copy</a></div>
                      <div class="tptt"><a href="<?php echo base_url();?>dashboard/downloadAdverts/?img=<?php echo $userAdverts[$key]["advertImg"]?>">Download</a></div>
                      <input type="hidden" value="<?php echo base_url();?>adminuploads/advert/<?php echo $userAdverts[$key]["advertImg"]?>" name="advertUrl<?php echo $userAdverts[$key]["advertID"]?>" id="advertUrl<?php echo $userAdverts[$key]["advertID"]?>">
                    </li>
                    <?php } ?>
                  </ul>
                </div>
                <!--<div class="white-space">
                  <div class="extra-share">
                    <div class="share-text">
                      <h3 class="new_head">Use Photos of Your Weekend To Boost Your Rave Business</h3>
                      <p><strong>When</strong> you Upload fun pictures to facebook, Instagram, Twitter and other social networks, add a message and link to your sign up page. Do the same thing again but the time use the url link to your Rave Story website.</p>
                    </div>
                    <div class="share-pic"><img src="<?php echo base_url(); ?>images/E3.jpg"></div>
                    <div class="clear"></div>
                  </div>
                </div>--> 
                <br class="clear">
                <div class="ab_inner sing"><strong><?php echo $stepWiseVideo[2]["G"]["serial_field"];?></strong>
                  <h3><?php echo $stepWiseVideo[2]["G"]["title"];?></h3>
                  <a class="watch-video-tut1" name="<?php echo $stepWiseVideo[2]["G"]["path"];?>" id="tutorial-video18" href="javascript:void(0)">Watch Video</a></div>
                <div class="white-space">
                  <div class="extra-share">
                    <div class="share-text">
                      <h3 class="new_head"><?php echo $stepWiseVideo[2]["G"]["content_title"];?></h3>
                      <p><?php echo $stepWiseVideo[2]["G"]["content"];?></p>
                      <h3 id="dwn-pdf"><a target="_blank" href="<?php echo base_url();?>dashboard/downloadAdverts/?img=ravestorysociety-chapter1.pdf">Click to Download PDF</a></h3>
                    </div>
                    <div class="share-pic"> <a target="_blank" href="#"><img class="share-none" src="<?php echo base_url(); ?>adminuploads/level_wise_images/<?php echo $stepWiseVideo[2]["G"]["content_image"];?>"></a> </div>
                    <div class="clear"></div>
                  </div>
                </div>
                <br class="clear">
                <div class="ab_inner sing"><strong><?php echo $stepWiseVideo[2]["H"]["serial_field"];?></strong>
                  <h3><?php echo $stepWiseVideo[2]["H"]["title"];?></h3>
                  <a class="watch-video-tut1" name="<?php echo $stepWiseVideo[2]["H"]["path"];?>" id="tutorial-video10" href="javascript:void(0)">Watch Video</a></div>
                <div class="white-space">
                  <div class="extra-share">
                    <div class="share-text">
                      <h3 class="new_head"><?php echo $stepWiseVideo[2]["H"]["content_title"];?></h3>
                      <p><?php echo $stepWiseVideo[2]["H"]["content"];?></p>
                    </div>
                    <div class="share-pic"> <img class="share-none" src="<?php echo base_url(); ?>adminuploads/level_wise_images/<?php echo $stepWiseVideo[2]["H"]["content_image"];?>"> </div>
                    <div class="clear"></div>
                  </div>
                </div>
                <br class="clear">
                <div class="ab_inner sing"><strong><?php echo $stepWiseVideo[2]["I"]["serial_field"];?></strong>
                  <h3><?php echo $stepWiseVideo[2]["I"]["title"];?></h3>
                  <a class="watch-video-tut1" name="<?php echo $stepWiseVideo[2]["I"]["path"];?>" id="tutorial-video11" href="javascript:void(0)">Watch Video</a></div>
                <div class="white-space">
                  <div class="extra-share">
                    <div class="share-text">
                      <h3 class="new_head"><?php echo $stepWiseVideo[2]["I"]["content_title"];?></h3>
                      <p><?php echo $stepWiseVideo[2]["I"]["content"];?></p>
                    </div>
                    <div class="share-pic"><img class="share-none" src="<?php echo base_url(); ?>adminuploads/level_wise_images/<?php echo $stepWiseVideo[2]["I"]["content_image"];?>"></div>
                    <div class="clear"></div>
                  </div>
                </div>
                <br class="clear">
                <div class="ab_inner dub"><strong><?php echo $stepWiseVideo[2]["J"]["serial_field"];?></strong>
                  <h3><?php echo $stepWiseVideo[2]["J"]["title"];?></h3>
                  <a class="watch-video-tut1" name="<?php echo $stepWiseVideo[2]["J"]["path"];?>" id="tutorial-video12" href="javascript:void(0)">Watch Video</a></div>
                <div class="ab_inner sing"><strong><?php echo $stepWiseVideo[2]["K"]["serial_field"];?></strong>
                  <h3><?php echo $stepWiseVideo[2]["K"]["title"];?></h3>
                  <span><a class="watch-video-tut1" name="<?php echo $stepWiseVideo[2]["K"]["path"];?>" id="tutorial-video13" href="javascript:void(0)">Watch Video</a></span></div>
                <div class="white-space">
                  <h3 class="new_head"><?php echo $stepWiseVideo[2]["K"]["content_title"];?></h3>
                  <p><?php echo $stepWiseVideo[2]["K"]["content"];?></p>
                  <ul class="presta_shop">
                    <?php foreach( $htmlBanners as $key=>$val){?>
                    <li>
                      <div><a href="#"><img src="<?php echo base_url();?>adminuploads/banner/<?php echo $htmlBanners[$key]["bannerImg"];?>"></a></div>
                      <div class="mbr" ><a href="javascript:void(0)" id="bannerCopy<?php echo $htmlBanners[$key]["bannerID"];?>" >Copy</a></div>
                      <input type="hidden" name="bannerUrl<?php echo $htmlBanners[$key]["bannerID"];?>" id="bannerUrl<?php echo $htmlBanners[$key]["bannerID"];?>" value="<?php echo base_url();?>adminuploads/banner/<?php echo $htmlBanners[$key]["bannerImg"];?>"/>
                    </li>
                    <?php } ?>
                  </ul>
                </div>
                <br class="clear">
                <div class="ab_inner sing"><strong><?php echo $stepWiseVideo[2]["L"]["serial_field"];?></strong>
                  <h3><?php echo $stepWiseVideo[2]["L"]["title"];?></h3>
                  <span><a class="watch-video-tut1" name="<?php echo $stepWiseVideo[2]["L"]["path"];?>" id="tutorial-video19" href="javascript:void(0)">Watch Video</a></span></div>
                <br class="clear">
                <p align="right"><a class="anchortxt" onclick="showThirdTab()" rel="tab3" href="javascript:void(0)" id="step3">Move To Step 3 &amp; 'Switch On'&gt;</a></p>
              </div>
              <?php } else { ?>
              <div class="white-bg">
                <div class="tab2-text"> 
                  <!--                  <h1>Buy Your Afrowebb Catalogue to Open Step -2</h1>-->
                  <div class="step02">
                    <h2> &#8249;&#8249;&#8249;&#8249; <a href="<?php echo base_url();?>dashboard/">Go Back To Step 1</a></h2>
                    <h4>Watch The Videos & Follow The Instructions</h4>
                    <h1>Get Your <br>
                      Afrowebb Catalogue</h1>
                    <h3>Then Complete Step 1</h3>
                    <h5>Once You Have Completed All The Instructions <br>
                      You Gain Access To The Second Step</h5>
                    <h6> &#8249; <a href="<?php echo base_url();?>dashboard/">Click Here To Go Back & Complete Step 1</a> </h6>
                  </div>
                </div>
              </div>
              <?php }?>
              <!--white-bg......... --> 
            </div>
            <!--2tab end......... -->
            
            <div id="tab3" class="tab_content hide">
              <?php 
            $viewArray = array("TEACHER","ADMIN","HEAD VOLUNTEERS","VOLUNTEERS","STUDENT");
            if(in_array($this->session->userdata('userType'), $viewArray) || ($this->session->userdata('userType') == "PAYING USER" && $userInfo[0]["afrooPaymentStatus"]=="1")){
            unset($viewArray);
            ?>
              <div class="white-bg">
                <div class="yvideo extra-pad"> <span class="watch-thisvideo">Watch This Video</span>
                  <div class="palvidd" style="width:556px; height:320px;"> <img src="http://i1.ytimg.com/vi/yrS-kiwZK8s/hqdefault.jpg" width="573" height="320" /> </div>
                  
                  <!-- <iframe id="palvidd" width="573" height="320" frameborder="0" src="http://www.youtube.com/embed/-EkL81gUe_A" allowfullscreen=""></iframe>-->
                  
                  <div class="basic-modal-content">
                    <iframe width="573" height="320" frameborder="0" src="<?php echo $stepWiseVideo[3][1]["../../fornt_end/pages/path"];?>" allowfullscreen=""></iframe>
                  </div>
                </div>
                
                <!--<div class="yvideo extra-pad"> <span class="watch-thisvideo">Watch This Video</span>
                  <iframe width="573" height="320" frameborder="0" allowfullscreen="" src="http://www.youtube.com/embed/yrS-kiwZK8s"></iframe>
                </div>-->
                <h3 class="headign-left" style="text-align:center; width:auto; float:none;">Congratulations <br />
                  You Are Now Welcome To Become </h3>
                <h3 class="heading-right" style="text-align:center; width:auto; float:none; margin-top:0px !important;">A FULL MEMBER </h3>
                <h3 class="headign-left" style="text-align:center; width:auto; float:none;">Click Switch On To Pay & Enter Members Area </h3>
                <div class="clear"></div>
                <div class="extrapara">
                  <h3>Inside You Can Enjoy</h3>
                  <ul class="list_extra">
                    <li>Powerful Marketing Tools To explode your Rave Business</li>
                    <li>Gifts, VIP &amp; Discounts to events</li>
                    <li>Personal Marketing suite.</li>
                  </ul>
                </div>
                <img src="<?php echo base_url(); ?>images/submit-paypal.png" width="424" height="81" alt="" style="cursor:pointer" onclick="window.location.href='<?php echo base_url();?>gbe_payment/swichOn'"> <br class="clear">
                <p>&nbsp;</p>
                <p>&nbsp;</p>
              </div>
              <?php } else { ?>
              <div class="white-bg">
                <div class="tab2-text"> 
                  <!-- <h1>Buy Your Afrowebb Catalogue to Open Step -3</h1>-->
                  <div class="step02">
                    <h2> &#8249;&#8249;&#8249;&#8249; <a href="<?php echo base_url();?>dashboard/">Go Back To Step 1</a></h2>
                    <h4>Watch The Videos & Follow The Instructions</h4>
                    <h1>Get Your <br>
                      Afrowebb Catalogue</h1>
                    <h3>Then Complete Step 1</h3>
                    <h5>Once You Have Completed All The Instructions <br>
                      You Gain Access To The Second Step</h5>
                    <h6> &#8249; <a href="<?php echo base_url();?>dashboard/">Click Here To Go Back & Complete Step 1</a> </h6>
                  </div>
                </div>
              </div>
              <?php } ?>
              <!--white-bg......... --> 
            </div>
            <!--3tab end......... --> 
		  <?php } else {?>
		  <div id="tab1" class="tab_content "></div>
		  <div id="tab2" class="tab_content hide"></div>
		  <div id="tab3" class="tab_content hide"></div>
		  <?php } ?>
            <!--4tab Start......... -->
            <div id="tab4" class="tab_content hide">
              <?php 
            $viewArray = array("TEACHER","ADMIN","HEAD VOLUNTEERS","VOLUNTEERS","STUDENT");
            if(in_array($this->session->userdata('userType'), $viewArray) || ($this->session->userdata('userType') == "PAYING USER" && $userInfo[0]["afrooPaymentStatus"]=="1")){
            unset($viewArray);
            ?>
              <div class="white-bg prod_uplod"> <span class="watch-thisvideo"><?php echo $stepWiseVideo[4][1]["content_title"];?><strong><?php echo $stepWiseVideo[4][1]["content"];?></strong></span>
                <div class="ab_inner clearfix"><strong><?php echo $stepWiseVideo[4]["A"]["serial_field"];?></strong>
                  <h3><?php echo $stepWiseVideo[4]["A"]["title"];?></h3>
                  <a href="javascript:void(0)" id="tutorial-video-v-add" class="watch-video-tut1" name="<?php echo $stepWiseVideo[4]["A"]["path"];?>">Watch Video</a></div>
                <div class="upl_form">
                    <form id="prd_upld" method="post" name="vendorFormAdd" action="<?php echo base_url();?>dashboard/addVendors">
                    <p>
                      <label>Sellers Name</label>
                      <input type="text" name="vendorName" id="vendorName">
                    </p>
                    <p>
                      <label>Sellers Contact No.</label>
                      <input type="tel" name="vendorNo" id="vendorNo">
                    </p>
                    <p>
                      <label>Sellers Address</label>
                      <textarea name="vendorAddr" id="vendorAddr"></textarea>
                    </p>
                    <p>
                      <label>Country</label>
                      <select id="country" name="vendorCountry">
                        <option value="">Select Country </option>
                        <?php if(count($countryList) > 0){ 
                            foreach($countryList as $cl){
                                ?>
                        <option value="<?php echo $cl->country_id;?>"><?php echo $cl->name;?></option>
                        <?php }}?>
                      </select>
                    </p>
                    <p>
                      <label>City</label>
                      <select id="city" name="vendorCity">
                        <!--<option value="">Select City </option>-->
                        <?php /* if(count($cityList) > 0){ 
                            foreach($cityList as $cl){
                                ?>
                        <option value="<?php echo $cl->id;?>" ><?php echo $cl->city;?></option>
                        <?php }} */?>
                      </select> <span class="addcityclass" ><a href="javascript:void(0)" onClick="openCityAddCityDiv();"><em>Not in List Click to Add Your City</em> </a></span>
					  <div id="newCity" style="display:none;"><input type="text" name="newVendorCity" id="newVendorCity" placeholder="Add your City"> <div class="ad" onClick="addNewCity()"> Add</div><div class="can" onClick="closeNewCityDiv()">Cancel</div></div> 
                    </p>
                    <p>
                      <label>Post/Zip Codes</label>
                      <input type="text" name="vendorZip" id="vendorZip">
                    </p>
                    
                    <p>
                      <label>Sellers Email</label>
                      <input type="email" name="vendorEmail" id="vendorEmail">
                    </p>
                    <p>
                      <label>Sellers Website</label>
                      <input type="text" name="vendorWebsite" id="vendorWebsite">
                    </p>
                    <p>
                        <input type="submit" value="Save" name="addVendors" id="addVendors"> 
                    </p>
                  </form>
                </div>
                <div class="ab_inner clearfix"><strong><?php echo $stepWiseVideo[4]["B"]["serial_field"];?></strong>
                  <h3><?php echo $stepWiseVideo[4]["B"]["title"];?></h3>
                  <a href="javascript:void(0)" id="tutorial-video-p-add" name="<?php echo $stepWiseVideo[4]["A"]["path"];?>" class="watch-video-tut1">Watch Video</a></div>
                <div class="upl_form_sec">
                    <form id="prd_upld_sec" action="<?php echo base_url();?>dashboard/addProduct" method="post" enctype="multipart/form-data">
                    <p>
                      <label>Vendors Name</label>
                      <select name="vendorID" id="vendorID">
                            <option value="">Please Select One</option>
                            <?php if(count($vendorsList) > 0){ foreach($vendorsList as $vl){?>
                            <option value="<?php echo $vl->vendorsID;?>" <?php if($vl->vendorsID == $addedVendorId){?> selected="selected"<?php }?>><?php echo $vl->vendorName;?></option>
                            <?php } }?>
                      </select>
                    </p>
					<p>
                      <label>Category</label>
                      <select name="catID" id="catID">
                            <option value="">Please Select Category</option>                            
							<?php if(count($categoryList) > 0){ 
								foreach($categoryList as $catL){
								//echo '++'.$catL->menuID."==".$catL->menuName;
								?>
								<option value="<?php echo $catL['menuID'];?>" ><?php echo $catL['menuName'];?></option>
							<?php }}?>
							
                      </select>
                    </p>
					<p>
                      <label>Articles</label>
                      <select name="articleID" id="articleID">                           
                      </select>
                    </p>
                    <p>
                      <label>Selling Category</label>
                     <select name="productTypeID" id="productTypeID">
                            <option value="">Please Select One</option>
                        <?php if(count($productCategoryList) > 0){ foreach($productCategoryList as $pcl){?>
                        <option value="<?php echo $pcl->productTypeID;?>"><?php echo $pcl->productTypeName;?></option>
                        <?php } }?>
                      </select>
                    </p>
                    <p>
                      <label>Product Name</label>
                      <input type="text" name="productName" id="productName">
                    </p>
                    <p>
                      <label>Product Category</label>
                      <select name="productOffer" id="productOffer" onClick="priceComStatus('add');">
                          <option value="0">Selling</option>
                          <option value="2">Free</option>
						  <option value="1">Collection Donate</option>
                      </select>
                    </p>
                    <p>
                      <label>Product Description</label>
                      <textarea name="productDesc" id="productDesc"></textarea>
                    </p>
                    <p>
                      <label>Selling Currency</label>
                      <select name="productCurrencyType" id="productCurrencyType">
                          <option value="USD">USD Dollar</option>
                          <option value="EUR">Euro</option>
                          <option value="GBE">Pound</option>
                      </select>
                    </p>
                    <p>
                      <label>Enter Product Price</label>
                      <input type="float" name="productPrice" id="productPrice">
                    </p>
                    
                    <div class="col_qnt">
  <div class="color_sec">
      <div class="col_tpps">
                      <label>Color Product</label>
                      <p> <input type="radio" name="RadioGroup1" value="1" id="RadioGroup1_1" class="colorRadio">
                          <strong>Yes</strong></p>
                      <p><input type="radio" name="RadioGroup1" checked="checked" value="0" id="RadioGroup1_0" class="colorRadio"> 
              <strong>No</strong></p>
                    </div>
   
      
      <div class="col_in" id="cq_1" style="display: none;">
      <?php if(count($colorList) > 0):?>
            <?php  foreach ($colorList as $cList):?>
          <p class="col_col" id="<?php echo $cList->id;?>">
              <span id="lblId_<?php echo $cList->id;?>"></span>
              <label style="background:<?php echo $cList->colorCode;?>;" ></label>
                <input type="hidden" name="color[<?php echo $cList->id;?>]" value="0" id="colorId_<?php echo $cList->id;?>">
                <input type="text" name="q[<?php echo $cList->id;?>]" value="" id="<?php echo $cList->id;?>" class="qClass">
            </p>
                  <?php endforeach;?>
      <?php endif;?>
    </div>
  </div>
</div>   
                    <p id="offQuantity">
                      <label>Quantity </label>
                      <input type="text" name="productQuantity" id="productQuantity">
                    </p>
					<!--<div class="donate_rd col_tpps" style="overflow: hidden;">
                      <label>Donate</label>
                      <p>
                          <input type="radio" name="productDonate" onClick="commissionStatusChange('productDonate_1','add');" value="1" id="productDonate_1" >
                        <strong>Yes</strong></p>
                      <p>
                        <input type="radio" name="productDonate" onClick="commissionStatusChange('productDonate_0','add');" value="0"  checked="checked" id="productDonate_0" >
                       <strong>No</strong></p>
                    </div>-->
                    <p>
                      <label>Offering commission to GBE members</label>
                      <input type="text" name="productCommission" id="productCommission">
                    </p>
                    <p>
                      <label>Product You tube video</label>
                      <input type="text" name="productYoutubeUrl" id="productYoutubeUrl">
                    </p>
                    <p>
                      <label>Product Type</label>
                      <select name="typeOfProduct" id="typeOfProduct" onClick="typeFunctionality('add');" >
					      <option value="1">Digital Upload Product</option>
                          <option value="2">Physical Sendable Product</option>
						  <option value="3">Event Ticket</option>
                      </select>
                    </p>
					<div id="digitalDiv">
                    <p>
                      <label>Upload your Digital  product   MP3/Films(< 20MB)</label>
                      <input type="file" name="productMusic" id="productMusic">
                    </p>
					</div>
					<div id="eventDiv" style="display:none;">
					<p>
                      <label>Upload Pdf File</label>
                      <input type="file" name="productEventPdf" id="productEventPdf">
                    </p>
					<p>
                      <label>End Date</label>
                      <input class="form-control datepicker" placeholder="Select date" type="text" name="productEventEndDate" id="productEventEndDate">
                    </p>
					</div>
                    <p>
                      <label>Upload the Main Image of your Product</label>
                      <input type="file" name="img_1" id="mainImageId">
                    </p>
                    <p>
                      <label>Upload the Secondary Image of your product</label>
                      <input type="file" name="img_2">
                    </p>
                    <p>
                      <label>Upload the Third Image of your product</label>
                      <input type="file" name="img_3">
                    </p>
                    <p>
                      <label>Upload the Fourth Image of your product</label>
                      <input type="file" name="img_4">
                    </p>
                    <div class="status_rd">
                      <label>Status</label>
                      <p>
                          <input type="radio" name="productStatus" value="1" checked="checked" id="productStatus_1">
                        Active</p>
                      <p>
                        <input type="radio" name="productStatus" value="0" id="productStatus_0">
                        Inactive</p>
                    </div>
                    <div class="clear"></div>
                    <p>
                        <input type="submit" value="Save" id="pUploadButton" name="pUploadButton">
                    </p>
                  </form>
                </div>
                  
                  <div class="ab_inner clearfix"><strong>C<?php //echo $stepWiseVideo[4]["B"]["serial_field"];?></strong>
                  <h3>All Product View<?php //echo $stepWiseVideo[4]["B"]["title"];?></h3>
                  <a href="javascript:void(0)" id="tutorial-video-p-view" name="<?php echo $stepWiseVideo[4]["A"]["path"];?>" class="watch-video-tut1">Watch Video</a></div>
                  <div class="upl_form">
                    
                      <div class="upl_frm_inre" style="  height: <?php echo (count($allProducts) > 6)?490:count($allProducts)*95;?>px; <?php if(count($allProducts) > 6):?>overflow-y: scroll;<?php endif;?>"><table class="ppnams" style="border: 1px;width: 100%;">
                            <tbody class="ppnams_top">
                                <!--<th>#</th>-->
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tbody>
                            <?php if(count($allProducts) > 0):?>
                            <?php   $i = 1; foreach ($allProducts as $prd):?>
                            <tr>
                                <!--<td><?php echo $i;?></td>-->
                                <td><img width="50px" height="50px" src="<?php echo base_url().'adminuploads/product_files/images/thumb/'.$prd->fileName;?>" title="<?php echo $prd->productName;?>" /></td>
                                <td><?php echo $prd->productName;?></td>
                                <td><?php echo $prd->productPrice;?></td>
                                <td><a href="<?php echo base_url().'dashboard/editProduct/'.$prd->productID;?>">Edit</a>
                                <!--<a onclick="return confirm('Are you sure to delete this product. It will delete all details of product.');" href="<?php echo base_url().'dashboard/deleteProduct/'.$prd->productID;?>">Delete</a>--></td>
                            </tr>
                            
                            
                            <?php  $i++;  endforeach;?>
                            <?php    else: ?>
                            <tr>
                                <td colspan="4">Sorry! No Product please. </td>
                            </tr>
                            <?php    endif;?>
                          </table></div>
                    
                   
                </div>
                  <?php if($productId > 0):?>
                  <script type="text/javascript">
				  		$(document).ready(function(e) {
							var scroll1 = $(window).scrollTop() + 2310 + <?php echo (count($allProducts) > 6)?490:count($allProducts)*95;?> ;
							$(window).scrollTop(scroll1);
                        });
				  </script>
                  <div id="" class="ab_inner clearfix"><strong>D<?php //echo $stepWiseVideo[4]["B"]["serial_field"];?></strong>
                  <h3>Edit Product<?php //echo $stepWiseVideo[4]["B"]["title"];?></h3>
                  <a href="javascript:void(0)" id="tutorial-video-p-edit" name="<?php echo $stepWiseVideo[4]["A"]["path"];?>" class="watch-video-tut1">Watch Video</a></div>
                  <div class="upl_form_sec">
                    <form id="prd_upld_sec" action="<?php echo base_url();?>dashboard/updateProduct" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="productId" value="<?php echo $productId;?>">
                    <p>
                      <label>Vendors Name</label>
                      <select name="vendorID" id="vendorIDEdit">
                            <option value="">Please Select One</option>
                            <?php if(count($vendorsList) > 0){ foreach($vendorsList as $vl){?>
                            <option value="<?php echo $vl->vendorsID;?>" <?php if($vl->vendorsID == $pDetails[0]->vendorID){?> selected="selected"<?php }?>><?php echo $vl->vendorName;?></option>
                            <?php } }?>
                      </select>
                    </p>
					<p>
                      <label>Category</label>
                      <select name="catIDEdit" id="catIDEdit">
                            <option value="">Please Select Category</option>                            
							<?php if(count($categoryList) > 0){ 
								foreach($categoryList as $catL){
								//echo '++'.$catL->menuID."==".$catL->menuName;
								?>
								<option value="<?php echo $catL['menuID'];?>" <?php if($catL['menuID'] == $catID){?> selected="selected"<?php }?>><?php echo $catL['menuName'];?></option>
							<?php }}?>
							
                      </select>
                    </p>
					<p>
                      <label>Articles</label>
                      <select name="articleIDEdit" id="articleIDEdit">
						<option value="">Please Select Article</option>                            
							<?php if(count($artList) > 0){ 
								foreach($artList as $artL){
								//echo '++'.$catL->menuID."==".$catL->menuName;
								?>
								<option value="<?php echo $artL['id'];?>" <?php if($artL['id'] == $artID){?> selected="selected"<?php }?>><?php echo $artL['title'];?></option>
							<?php }}?>					  
                      </select>
                    </p>
                    <p>
                      <label>Selling Category</label>
                     <select name="productTypeID" id="productTypeIDEdit">
                            <option value="">Please Select One</option>
                        <?php if(count($productCategoryList) > 0){ foreach($productCategoryList as $pcl){?>
                        <option value="<?php echo $pcl['id'];?>" <?php if($pcl['id'] == $pDetails[0]->productTypeID){?> selected="selected"<?php }?>><?php echo $pcl['title'];?></option>
                        <?php } }?>
                      </select>
                    </p>
                    <p>
                      <label>Product Name</label>
                      <input type="text" name="productName" id="productNameEdit" value="<?php echo $pDetails[0]->productName;?>">
                    </p>
                    <p>
                      <label>Product Category</label>
                      <select name="productOfferEdit" id="productOfferEdit" onClick="priceComStatus('edit');">
						  <option value="0" <?php if($pDetails[0]->productOffer == 0){?> selected="selected"<?php }?> >Selling</option>
                          <option value="2" <?php if($pDetails[0]->productOffer == 2){?> selected="selected"<?php }?> >Free</option>
						  <option value="1" <?php if($pDetails[0]->productOffer == 1){?> selected="selected"<?php }?> >Collection Donate</option>
                      </select>
                    </p>
                    <p>
                      <label>Product Description</label>
                      <textarea name="productDesc" id="productDesc"><?php echo $pDetails[0]->productDesc;?></textarea>
                    </p>
                    <p>
                      <label>Selling Currency</label>
                      <select name="productCurrencyType" id="productCurrencyTypeEdit">
                          <option value="USD" <?php if($pDetails[0]->productCurrencyType == "USD"){?> selected="selected"<?php }?>>USD Dollar</option>
                          <option value="EUR" <?php if($pDetails[0]->productCurrencyType == "EUR"){?> selected="selected"<?php }?>>Euro</option>
                          <option value="GBE" <?php if($pDetails[0]->productCurrencyType == "GBE"){?> selected="selected"<?php }?>>Pound</option>
                      </select>
                    </p>
                    <p>
                      <label>Enter Product Price</label>
                      <input type="float" name="productPrice" id="productPriceEdit" value="<?php echo $pDetails[0]->productPrice;?>">
                    </p>
                    <?php $colorExist = count($pColors['selectedColor']);?>
                    <div class="col_qnt">
  						<div class="color_sec">
      						<div class="col_tpps">
                      			<label>Color Product </label>
                      			<p> <input type="radio" name="RadioGroup1" value="1" id="RadioGroup1_1" class="colorRadioEdit" <?php if($colorExist > 0):?>checked="checked" <?php endif;?>>
                          		<strong>Yes</strong></p>
                      			<p><input type="radio" name="RadioGroup1"  value="0" id="RadioGroup1_0" class="colorRadioEdit" <?php if($colorExist <= 0):?>checked="checked" <?php endif;?>> 
              					<strong>No</strong></p>
                    		</div>
   
      
      						<div class="col_in_edit" id="cq_1_edit" <?php if($colorExist <= 0):?>style="display: none;"<?php endif;?>>
      						<?php 	if(count($colorList) > 0):?>
            				<?php 		foreach ($colorList as $cList):?>
                            <?php 			$qnty = 0;$colorClass = "";
											if(in_array($cList->id,$pColors['selectedColor'])) {  
												$qnty = $pColors['selectedColorDetails'][$cList->id];
												$colorClass = "colorActive";
											}
							?>
          						<p class="col_col" id="<?php echo $cList->id;?>">
              					<span id="lblId_edit_<?php echo $cList->id;?>" class="<?php echo $colorClass;?>"></span>
              					<label style="background:<?php echo $cList->colorCode;?>;" ></label>
                				<input type="hidden" name="color[<?php echo $cList->id;?>]" value="0" id="colorIdEdit_<?php echo $cList->id;?>">
                				<input type="text" name="q[<?php echo $cList->id;?>]" value="<?php echo $qnty;?>" id="<?php echo $cList->id;?>" class="qClassEdit">
            					</p>
                                	
                  				<?php endforeach;?>
      						<?php endif;?>
    					</div>
  					</div>
				</div>   
                    <p id="offQuantity">
                      <label>Quantity :</label>
                      <input type="text" name="productQuantity" id="productQuantityEdit" value="<?php echo $pDetails[0]->productQuantity;?>">
                    </p>
					<!--<div class="donate_rd col_tpps">
                      <label>Donate</label>
                      <p>
                          <input type="radio" name="productDonateEdit" onclick="commissionStatusChange('productDonateEdit_1','edit')" value="1" id="productDonateEdit_1" <?php if($pDetails[0]->productDonate == 1):?>checked="checked" <?php endif;?>>
                        Yes</p>
                      <p>
                        <input type="radio" name="productDonateEdit" onclick="commissionStatusChange('productDonateEdit_0','edit')" value="0"  id="productDonateEdit_0" <?php if($pDetails[0]->productDonate == 0 || $pDetails[0]->productDonate == ""):?>checked="checked" <?php endif;?>>
                        No</p>
                    </div>-->
                    <p>
                      <label>Offering commission to GBE members</label>
                      <input type="text" name="productCommissionEdit" id="productCommissionEdit" value="<?php echo $pDetails[0]->productCommission;?>" <?php if($donateStatus == 1){ echo 'disabled="disabled"';}?>>
                    </p>
                    <p>
                      <label>Product You tube video</label>
                      <input type="text" name="productYoutubeUrl" id="productYoutubeUrl" value="<?php echo $pDetails[0]->productYoutubeUrl;?>">
                    </p>
                    <p>
                      <label>Product Type</label>
                      <select name="typeOfProduct" id="typeOfProductEdit" onClick="typeFunctionality('edit');">
						  <option value="1" <?php if($pDetails[0]->typeOfProduct == 1){?> selected="selected"<?php }?>>Digital Upload Product</option>
                          <option value="2" <?php if($pDetails[0]->typeOfProduct == 2){?> selected="selected"<?php }?>>Physical Sendable Product</option>
						  <option value="3" <?php if($pDetails[0]->typeOfProduct == 3){?> selected="selected"<?php }?>>Event Ticket</option>
                      </select>
                    </p>                    
					<div id="digitalDivEdit" <?php if($pDetails[0]->typeOfProduct == 1){ echo 'style="display:block;"'; } else { echo 'style="display:none;"';} ?>>
                    <p>
                      <label>Upload your Digital  product   MP3/Films(< 20MB)</label>
                      <input type="file" name="productMusic" id="productMusic" value="">
                      <?php if($pFiles['mp3']['id'] != ''){ ?>
                      	<span><?php echo $pFiles['mp3']['fileName'];?></span>
                      	<input type="hidden" name="mp3EditId" value="<?php echo $pFiles['mp3']['id'];?>">
                      <?php }else{?>
                      	<input type="hidden" name="mp3EditId" value="0">
                      <?php }?>
                    </p>
					</div>
					<div id="eventDivEdit" <?php if($pDetails[0]->typeOfProduct == 3){ echo 'style="display:block;"'; }else { echo 'style="display:none;"';} ?>>
					<p>
                      <label>Upload Pdf File</label>
                      <input type="file" name="productEventPdf" id="productEventPdf" value="">
					  <?php if($pFiles['pdf']['id'] != ''){ ?>
                      	<span><?php echo $pFiles['pdf']['fileName'];?></span>
                      	<input type="hidden" name="pdfEditId" value="<?php echo $pFiles['pdf']['id'];?>">
                      <?php }else{?>
                      	<input type="hidden" name="pdfEditId" value="0">
                      <?php }?>
                    </p>
					<p>
                      <label>End Date</label>
                      <input type="text" class="form-control datepicker" name="productEventEndDate" id="productEventEndDateEdit" value="<?php echo $pDetails[0]->productEventDate; ?>">
                    </p>
					</div>
                    <p>
                      <label>Upload the Main Image of your Product</label>
                      <input type="file" name="img_1" id="mainImageIdEdit">
                      <?php if($pFiles['img_1']['id'] != ''){ ?>
                      	<img class="imgEdit" src="<?php echo base_url();?>adminuploads/product_files/images/thumb/<?php echo $pFiles['img_1']['fileName'];?>">
                        <input type="hidden" name="img_1_edit" value="<?php echo $pFiles['img_1']['id'];?>">
                      <?php }else{?>
                      <input type="hidden" name="img_1_edit" value="0">
                      <?php }?>
                    </p>
                    <p>
                      <label>Upload the Secondary Image of your product</label>
                      <input type="file" name="img_2">
                      <?php if($pFiles['img_2']['id'] != ''){ ?>
                      	<img class="imgEdit" src="<?php echo base_url();?>adminuploads/product_files/images/thumb/<?php echo $pFiles['img_2']['fileName'];?>">
                      <input type="hidden" name="img_2_edit" value="<?php echo $pFiles['img_2']['id'];?>">
                      <?php }else{?>
                      <input type="hidden" name="img_2_edit" value="0">
                      <?php }?>
                    </p>
                    <p>
                      <label>Upload the Third Image of your product</label>
                      <input type="file" name="img_3">
                      <?php if($pFiles['img_3']['id'] != ''){ ?>
                      	<img class="imgEdit" src="<?php echo base_url();?>adminuploads/product_files/images/thumb/<?php echo $pFiles['img_3']['fileName'];?>">
                      <input type="hidden" name="img_3_edit" value="<?php echo $pFiles['img_3']['id'];?>">
                      <?php }else{?>
                      <input type="hidden" name="img_3_edit" value="0">
                      <?php }?>
                    </p>
                    <p>
                      <label>Upload the Fourth Image of your product</label>
                      <input type="file" name="img_4">
                      <?php if($pFiles['img_4']['id'] != ''){ ?>
                      	<img class="imgEdit" src="<?php echo base_url();?>adminuploads/product_files/images/thumb/<?php echo $pFiles['img_4']['fileName'];?>">
                      <input type="hidden" name="img_4_edit" value="<?php echo $pFiles['img_4']['id'];?>">
                      <?php }else{?>
                      <input type="hidden" name="img_4_edit" value="0">
                      <?php }?>
                    </p>
                    <div class="status_rd">
                      <label>Status</label>
                      <p>
                          <input type="radio" name="productStatus" value="1" <?php if($pDetails[0]->productStatus == 1):?>checked="checked" <?php endif;?> id="productStatus_1">
                        Active</p>
                      <p>
                        <input type="radio" name="productStatus" value="0" <?php if($pDetails[0]->productStatus == 0):?>checked="checked" <?php endif;?> id="productStatus_0">
                        Inactive</p>
                    </div>
                    <div class="clear"></div>
                    <p>
                        <input type="submit" value="Update" id="pUploadButtonEdit" name="pUploadButton">
                    </p>
                  </form>
                </div>
                  
                  <?php endif;?>
              </div>
              <?php } else { ?>
              <div class="white-bg">
                <div class="tab2-text">
                  <div class="step02">
                    <h2> &#8249;&#8249;&#8249;&#8249; <a href="<?php echo base_url();?>dashboard/">Go Back To Step 1</a></h2>
                    <h4>Watch The Videos & Follow The Instructions</h4>
                    <h1>Get Your <br>
                      Afrowebb Catalogue</h1>
                    <h3>Then Complete Step 1</h3>
                    <h5>Once You Have Completed All The Instructions <br>
                      You Gain Access To The Second Step</h5>
                    <h6> &#8249; <a href="<?php echo base_url();?>dashboard/">Click Here To Go Back & Complete Step 1</a> </h6>
                  </div>
                </div>
              </div>
              <?php } ?>
            </div>
            <!--4tab end......... --> 
            
          </div>
          
          <!--all cont --> 
          <br class="clear">
        </div>
      </div>
    </div>