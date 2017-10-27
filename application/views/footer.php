<?php
		//print_r($result['RANDOMUSER']);
	?>
<div class="main_content">	
        <div class="clear"></div>
        <!-- side bar [tallent for hire] start -->
  		<div class="sidebar fltright">
        	<h5>Rave Direct Talent for Hire</h5>
            <ul class="list_of_tallent" style="padding-bottom:66px;">
			<?php for($i=0;$i<count($result['RANDOMUSER']);$i++){ ?>
                	<li>
						<a href="<?php echo BASE_PATH_DIRECT; ?>/raversdirect/ravetalent/?UID=<?php echo $result['RANDOMUSER'][$i]['UID']; ?>" target="_blank">
                        <?php if(file_exists('upload/profile/'.$result['RANDOMUSER'][$i]['ProfileImage'])){ ?>
							<img src="<?php echo BASE_PATH; ?>/upload/profile/<?php echo $result['RANDOMUSER'][$i]['ProfileImage'] ?>" alt="" width="55" height="120">
                            <?php } else { ?>
                            <img src="<?php echo BASE_PATH_RAVE; ?>/upload/profile/<?php echo $result['RANDOMUSER'][$i]['ProfileImage'] ?>" alt="" width="55" height="120">
                            <?php } ?>
							<p><?php echo $result['RANDOMUSER'][$i]['UserID']; ?>  </p>
						</a>
					</li>
			<?php } ?>                    
                </ul>
     	</div>
        <!-- side bar [tallent for hire] start -->
        
        <!-- rav adv box start -->
	  	<div class="rav_adv_box fltleft">
  		<div class="left_side">
        		<img src="<?php echo BASE_PATH; ?>/Application/content/member/images/ravestory.png" alt="">
				
                <div class="youtube2">
            		<?php echo $result['chapter_box']['script'];?>
                </div>
                <center><a href="<?php echo BASE_PATH; ?>/ravestorysociety/cart?action=add&id=<?php echo $result['chapter_box']['id'];?>&name=CHAPTER BOX" class="buy_now1">buy now</a></center>
            </div>
            <div class="right_side">
            	<span class="e_book">Get your E-Book copy now!</span>
            	<img src="<?php echo BASE_PATH; ?>/Application/content/member/images/anv_ban.jpg" alt="">
				<form action="" method="post" onsubmit="return freeChapter();">            	
                	<p>Unlock your free chapter today</p>
					<P style="color:red;"><?php //echo $result['FREECHAPTER']?></P>
				<!--<?php if(isset($_REQUEST['chapter']) && ($_REQUEST['chapter'] == 1)){?><div style="color:#FF0000">Send Success</div><?php } ?>
				<?php if(isset($_REQUEST['chapter']) && ($_REQUEST['chapter'] == 0)){?><div style="color:#FF0000">Falure</div><?php } ?>-->
                	<p><label>First Name</label><input name="fname" id="fname" type="text" value=""></p>
                	<p><label>E-mail Id</label><input name="email" id="email" type="text" value=""></p>
                    <p class="fltright"><input name="chabutton" type="submit" value=""></p>
                </form>
				
            </div>
            <div class="clear"></div>
	  </div>
        <!-- rav adv box end -->
        <?php if(isset($_SESSION['UserID'])){ ?>
       
        <div class="main_pannel fltleft" style="background:none;border:none;">
        	<div class="movie_wrap"> 
                                            
                                <div class="movie_text_warp">
                                	<div class="movie_head_warp">
                                        <span class="music_style3">
                                        Vote below for the actors you want to see featured in the Rave Story movie - </span>
                                    </div>
                                    <div class="movie_img_warp">
                                     <?php 
									 
											for($i=0;$i<count($result['ACTOR']);$i++){
										?>
                                        <div class="movie_img_box">
                                    	<div class="movie_img_box_inq">
                              <img width="100" height="110" alt="images" src="<?php echo BASE_PATH_RAVE.'/'.UPLOAD_PATH.'actor/'.$result['ACTOR'][$i]['ActorImage']; ?>">
                                       
                                        </div>
                                        <div class="movie_img_box_text">
                                        	<span class="movie_style1"><?php echo $result['ACTOR'][$i]['ActorName']; ?> </span><br><span class="movie_style2"> </span>
                                        </div>  
                                        
                                         <div class="movie_img_box_text">
                                        	<span class="movie_style1">Like : (<?php echo $result['ACTOR'][$i]['ActorVote']; ?>)</span><br><span class="movie_style2"> </span>
                                        </div>                                       

                                        <div class="movie_img_box_text">
                                        <span class="movie_style1">
                                          <a href="#<?php /*echo BASE_PATH.'/ravestorysociety/voting?targetid='.$result['ACTOR'][$i]['ACID'].'&amp;targetname=ACTOR';*/?>" class="voting" style="color:white;" id="actor<?php echo $i;?>">VOTE</a>
                                       </span><br><span class="movie_style2"> </span></div>
                                </div>
                                <?php } ?>
                               </div>
                                </div>
                                
                                <div class="movie_text_warp">
                                	<div class="movie_head_warp">
                                    <span class="music_style3">
                                    Vote below for the actress you want to see featured in the Rave Story movie - </span></div>
                                    <div class="movie_img_warp">
                                                 <?php 
									// print_r($result['ACTRESS']);
											for($i=0;$i<count($result['ACTRESS']);$i++){
										?>  
                                         <div class="movie_img_box">
                                        <div class="movie_img_box_inq">
                                        <img width="100" height="110" alt="images" src="<?php echo BASE_PATH_RAVE.'/'.UPLOAD_PATH.'actoress/'.$result['ACTRESS'][$i]['ActressImage']; ?>">
                                        </div>
                                       
                                        <div class="movie_img_box_text">
                                            <span class="movie_style1"><?php echo $result['ACTRESS'][$i]['ActressName']; ?></span>
                                            <br><span class="movie_style2"> </span>
                                        </div>  
                                        <div class="movie_img_box_text">
                                            <span class="movie_style1">Like : (<?php echo $result['ACTRESS'][$i]['ActressVote']; ?>)</span>
                                            <br><span class="movie_style2"> </span>
                                        </div>                                    

                                        <div class="movie_img_box_text"><span class="movie_style1">
                                            <a href="#<?php /*echo BASE_PATH.'/ravestorysociety/voting?targetid='.$result['ACTRESS'][$i]['AID'].'&amp;targetname=ACTORESS';*/ ?>" class="voting" style="color:white;" id="actress<?php echo $i;?>">VOTE</a>
                                         </span><br><span class="movie_style2"> </span>
                                         </div>
                                </div>                                                                 
                                	
                                    <?php } ?>
                                    </div>
                                </div>                               
                              </div>
       					 </div>
                         <?php   }?>
        <!-- new music start -->
        <div class="main_pannel fltleft">
        	<div class="con">
            	<div class="con-left">
            	<h5>New Music - Have it First</h5>
                <ul class="new_music">
				<?php for($j=0;$j<count($result['MUSIC']);$j++){?>
                	<li>
                		<div class="album_photo fltleft">
                    		<img src="<?php echo BASE_PATH; ?>/upload/audio/<?php echo $result['MUSIC'][$j]['musicimage']; ?>" alt="">
                            <a href="<?php echo BASE_PATH; ?>/ravestorysociety/cart?action=add&id=<?php echo $result['MUSIC'][$j]['MID'];?>&name=MUSIC" class="buy_now2">&nbsp;</a>
                        </div>
                      	<div class="album_details fltleft">
                            <p><!--<span>Music For</span>--> <?php echo $result['MUSIC'][$j]['MGenre']; ?></p>
                            <p><!--<span>Music Title</span>--> <?php echo $result['MUSIC'][$j]['MTitle']; ?></p>
                            <p><!--<span>Start Date</span>--> <?php echo $result['MUSIC'][$j]['MUploadDate']; ?></p>
                            <p><!--<span>End Date</span>--> <?php echo $result['MUSIC'][$j]['MReleaseDate']; ?></p>
                            <p><!--<span>Cost</span>--> <?php echo $result['MUSIC'][$j]['MCost']; ?></p>
                        	<p><!--<span>Description</span>--> <?php echo substr($result['MUSIC'][$j]['MDescription'],0,50);?></p>
                            <p>&nbsp;</p>
                          	<p><!--<span>&nbsp;</span>--> <?php echo $result['MUSIC'][$j]['MUploadScript']; ?></p>
                        </div>
                    </li>
					<?php } ?>                    
                </ul>
                </div>
                
                <div class="con-right">
                <h5>Events Tickets</h5>
                <ul class="event_tickets">
				<?php 
				//echo "<pre>";print_r($result['TICKETS']); echo "</pre>";
				for($i=0;$i<count($result['TICKETS']);$i++){?>
                	<li>
                    	<div class="two fltleft">
                        <img src="<?php echo BASE_PATH; ?>/upload/ticket/<?php echo $result['TICKETS'][$i]['ticketimage']?>" alt="" width="102" height="110">
                    </div>
                    	<div class="four fltright">
                        <p><strong><?php echo $result['TICKETS'][$i]['targetname'];?></strong></p>
                        <p><?php echo substr($result['TICKETS'][$i]['description'],0,20);?></p>
<?php /*?>                        <p><a href="<?php echo BASE_PATH; ?>/member/cart?action=add&id=<?php echo $row["TID"]; ?>&name=TICKET"" class="buy_now"></a></p>
<?php */?>                    
								 <p><a href="<?php echo BASE_PATH; ?>/ravestorysociety/cart?action=add&id=<?php echo $result['TICKETS'][$i]['TID']?>&name=TICKET" class="buy_now"></a></p>

						</div>
                    </li>
					<?php }?>
                  
                </ul>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <!-- new music end -->
        
        <!-- events tickets start -->
       <div class="main_pannel fltleft">
        	<div class="con">
            	<h5>Events Tickets</h5>
                <ul class="event_tickets">
				<?php 
				//echo "<pre>";print_r($result['TICKETS']); echo "</pre>";
				for($i=0;$i<count($result['TICKETS']);$i++){?>
                	<li>
                    	<div class="two fltleft">
                        <img src="<?php echo BASE_PATH; ?>/upload/ticket/<?php echo $result['TICKETS'][$i]['ticketimage']?>" alt="" width="102" height="110">
                    </div>
                    	<div class="four fltright">
                        <p><strong><?php echo $result['TICKETS'][$i]['targetname'];?></strong></p>
                        <p style="height:40px;"><?php echo substr($result['TICKETS'][$i]['description'],0,49);?></p>
<?php /*?>                        <p><a href="<?php echo BASE_PATH; ?>/member/cart?action=add&id=<?php echo $row["TID"]; ?>&name=TICKET"" class="buy_now"></a></p>
<?php */?>                    
								 <p><a href="<?php echo BASE_PATH; ?>/ravestorysociety/cart?action=add&id=<?php echo $result['TICKETS'][$i]['TID']?>&name=TICKET" class="buy_now"></a></p>

						</div>
                    </li>
					<?php }?>
                  
                </ul>
            </div>
        </div>
        <!-- events tickets end -->
        
        <!-- rav day start -->
        <div class="fltleft">
        	<img src="<?php echo BASE_PATH; ?>/Application/content/member/images/rave_day.png" alt="">
        </div>

        <!-- rav day start -->
        <div class="clear"></div>
  </div>
   <!-- main content end -->

</div>
  
<script type="text/javascript">
function freeChapter(){
	var fname = $("#fname").val();
	var email = $("#email").val();
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	if(fname == '') {
		alert('Please enter First Name');
		return false;
	}
	if(email == '') {
		alert('Please enter Email Address');
		return false;
	}
	if(!emailReg.test(email)){
		alert('Please enter Valid Email Address');
		return false;
	}
	return true;
}
</script>
<!-- wrapper end -->
</body>
</html>
