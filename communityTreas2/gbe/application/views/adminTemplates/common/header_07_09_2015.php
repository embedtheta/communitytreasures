<?php
$this->load->helper('admin_menu_helper');
$menus = admin_menu();
//print_r($menus);
?>
<html>
        <head>
        <meta charset="utf-8">
        <title>Admin</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>adminCss/admin.css" />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800,700' rel='stylesheet' type='text/css'>
        <script src="<?php echo base_url(); ?>adminJS/modernizr.custom.js"></script>
        <script src="<?php echo base_url(); ?>adminJS/jquery-1.10.2.min.js"></script>
        <script src="<?php echo base_url(); ?>adminJS/classie.js"></script>
        <script src="<?php echo base_url(); ?>adminJS/gnmenu.js"></script>
        <script src="<?php echo base_url(); ?>adminJS/main.js"></script>
        <SCRIPT language="javascript">
            $(function () {
                $("#selectall").click(function () {
                    var checkAll = $("#selectall").prop('checked');
                    if (checkAll) {
                        $(".msg").prop("checked", true);
                    } else {
                        $(".msg").prop("checked", false);
                    }
                });
                $(".msg").click(function () {
                    if ($(".msg").length == $(".msg:checked").length) {
                        $("#selectall").prop("checked", true);
                    } else {
                        $("#selectall").prop("checked", false);
                    }
                });
            });
        </SCRIPT>
        <script type="text/javascript">

            function delRequest(entityID) {
                var confirmationDelete = confirm("do you really want to delete this entry:");
                if (confirmationDelete == true) {
                    $.ajax({
                        type: "POST",
                        async: false,
                        url: "<?php echo base_url(); ?>index.php/homelogin/deleteEntity",
                        data: "entityID=" + entityID,
                        cache: false,
                        success:
                                function (data) {
                                    $("#successMsg").show();
                                    $("#reload").html(ajax_load).load(loadUrl);
                                }
                    });
                } else if (confirmationDelete == false) {
                    $("#successMsg").hide();
                    return false;
                }

            }

            function delElement(entityID) {
                var confirmationDelete = confirm("do you really want to delete this entry");
                if (confirmationDelete == true) {
                    //alert('<?php echo base_url(); ?>index.php/homelogin/deleteEntity/'+entityID);
                    window.location.href = '<?php echo base_url(); ?>admin/deleteEntity/' + entityID;
                } else {
                    var x = "You pressed Cancel!";
                }
            }
        </script>
        <script type="text/javascript">
            $(function () {
                //$("#successMsg").hide();
                //$("#errorMsg").hide();
                $("#warningMsg").hide();

            });
        </script>
        </head>
        <body>
<div class="container">
<ul id="i2i-menu" class="i2i-menu-main">
          <li class="i2i-trigger"> <a class="i2i-icon i2i-icon-menu i2i-selected"><i class="fa fa-bars"></i> <span>Menu</span></a>
    <nav class="i2i-menu-wrapper i2i-open-all i2i-open-part">
              <div class="i2i-scroller">
        <ul class="i2i-menu">
                  <li><a class="i2i-icon" ><i class="fa fa-dashboard"></i> Dashboard</a></li>
                  <li><a class="i2i-icon" href="<?php echo base_url(); ?>admin/afroCatalogueList"><i class="fa fa-picture-o"></i> View Afro Catalogue List</a></li>
                  <li><a class="i2i-icon" href="<?php echo base_url(); ?>cp/gbeLevelWiseVideoList"><i class="fa fa-picture-o"></i> View GBE Level Wise Details</a></li>
                  <li><a class="i2i-icon" href="<?php echo base_url(); ?>cp/viewStep2UrlList"><i class="fa fa-picture-o"></i>View Step-2 Url</a></li>
                  <li><a class="i2i-icon" href="<?php echo base_url(); ?>cp/viewSignupPages"><i class="fa fa-picture-o"></i>View Sign up Page details</a></li>
                  <li><a class="i2i-icon" href="<?php echo base_url(); ?>cp/listingBlogPost"><i class="fa fa-picture-o"></i> Listing Blog Post</a></li> 
                  <li><a class="i2i-icon" href="<?php echo base_url(); ?>cp/listingBrochure"><i class="fa fa-picture-o"></i> Listing Brochure </a></li>
                  <li><a class="i2i-icon" href="<?php echo base_url(); ?>cp/listingVCards"><i class="fa fa-picture-o"></i> Listing V Cards</a></li>
                  <li><a class="i2i-icon" href="<?php echo base_url(); ?>cp/listingL2S2Youtube"><i class="fa fa-picture-o"></i> Level-2 Step-2 Youtube </a></li>
                  <!--<li><a class="i2i-icon" href="<?php echo base_url(); ?>cp/allTypeUser"><i class="fa fa-picture-o"></i> User Management</a>-->
                  <li><a class="i2i-icon" href="#"><i class="fa fa-picture-o"></i> User Management</a>
            <ul class="i2i-submenu">
                      <li><a href="<?php echo base_url(); ?>cp/viewExpellUser" class="i2i-icon"><i class="fa fa-eye"></i>Expell Users</a></li>
                      <li><a href="<?php echo base_url(); ?>cp/viewPayingUser" class="i2i-icon"><i class="fa fa-eye"></i>Users</a></li>
                      <li><a href="<?php echo base_url(); ?>cp/viewTeacher" class="i2i-icon"><i class="fa fa-eye"></i>Teachers</a></li>
                      <li><a href="<?php echo base_url(); ?>cp/viewStudent" class="i2i-icon"><i class="fa fa-eye"></i>Students</a></li>
                      <li><a href="<?php echo base_url(); ?>cp/viewHeadVolunteer" class="i2i-icon"><i class="fa fa-eye"></i>Head Volunteers</a></li>
                      <li><a href="<?php echo base_url(); ?>cp/viewVolunteer" class="i2i-icon"><i class="fa fa-eye"></i>Volunteers</a></li>
                    </ul>
          </li>
                  <li><a class="i2i-icon" href="<?php echo base_url(); ?>admin/viewMenu"><i class="fa fa-picture-o"></i>Menu Management</a></li>
                  <li><a class="i2i-icon" href="<?php echo base_url(); ?>admin/user_youtube"><i class="fa fa-video-camera"></i>Level 1-Step 2-panel C</a></li>
                 <!-- <li><a class="i2i-icon" href="<?php echo base_url(); ?>admin/user_advert"><i class="fa fa-picture-o"></i>Advert Management</a></li>-->
                 <li><a class="i2i-icon" href="<?php echo base_url(); ?>admin/user_advert_view"><i class="fa fa-picture-o"></i>Level 1-Step 2-panel F</a></li>
                  <li><a class="i2i-icon" href="<?php echo base_url(); ?>admin/user_banner"><i class="fa fa-picture-o"></i> Banner Management</a> </li>
                  <li><a class="i2i-icon" href="javascript:viod(0);"><i class="fa fa-picture-o"></i> Article Management</a>
            <ul class="i2i-submenu">
                      <!--<li><a href="<?php echo base_url(); ?>admin/viewCreative" class="i2i-icon"><i class="fa fa-eye"></i>Creative</a></li>
                                      <li><a href="<?php echo base_url(); ?>admin/viewEventsCelebrations" class="i2i-icon"><i class="fa fa-eye"></i>Events & Celebrations</a></li>
                                      <li><a href="<?php echo base_url(); ?>admin/viewTripsHolidays" class="i2i-icon"><i class="fa fa-eye"></i>Trips & Holidays</a></li>
                                      <li><a href="<?php echo base_url(); ?>admin/viewLatestFashionStyle" class="i2i-icon"><i class="fa fa-eye"></i>Latest Fashion Style</a></li>
                                      <li><a href="<?php echo base_url(); ?>admin/viewLatestFashionBanner" class="i2i-icon"><i class="fa fa-eye"></i>Latest Fashion Banner</a></li>
                                      <li><a href="<?php echo base_url(); ?>admin/viewNewsZone" class="i2i-icon"><i class="fa fa-eye"></i>News Zone</a></li>
                                      <li><a href="<?php echo base_url(); ?>admin/viewMentorship" class="i2i-icon"><i class="fa fa-eye"></i>Mentorship</a></li>
                                      <li><a href="<?php echo base_url(); ?>admin/viewBusinessConsultants" class="i2i-icon"><i class="fa fa-eye"></i>Business Consultants </a></li>
                                      <li><a href="<?php echo base_url(); ?>admin/viewArticleZone" class="i2i-icon"><i class="fa fa-eye"></i>Article Zone</a></li>
                                      <li><a href="<?php echo base_url(); ?>admin/viewWebBuilder" class="i2i-icon"><i class="fa fa-eye"></i>Website Builders</a></li>
                                      <li><a href="<?php echo base_url(); ?>admin/viewResidential" class="i2i-icon"><i class="fa fa-eye"></i>Residential</a></li>
                                      <li><a href="<?php echo base_url(); ?>admin/viewSecurity" class="i2i-icon"><i class="fa fa-eye"></i>Security</a></li>
                                      <li><a href="<?php echo base_url(); ?>admin/viewAdvertisement" class="i2i-icon"><i class="fa fa-eye"></i>Advertisement</a></li>-->
                      <?php
                                        if (isset($navMenu)) {
                                            foreach ($navMenu as $navMenuItem) {

                                                $menuUrl = base_url() . 'admin/viewArticles/' . $navMenuItem['menuID'];
                                                ?>
                      <li><a href="<?php echo $menuUrl; ?>"  class="i2i-icon"><i class="fa fa-eye"></i><?php echo $navMenuItem['menuName']; ?></a></li>
                      <?php
                                            }
                                        }
                                        ?>
                    </ul>
          </li>
                  <li><a class="i2i-icon" href="<?php echo base_url(); ?>admin/viewArticleZone"><i class="fa fa-picture-o"></i>Article Zone</a></li>
                  <li><a class="i2i-icon" href="<?php echo base_url(); ?>admin/viewProduct"><i class="fa fa-picture-o"></i>Product Management</a></li>
                  <li><a class="i2i-icon" href="<?php echo base_url(); ?>admin/productArticleMapNew"><i class="fa fa-picture-o"></i> Product Article Mapping</a></li>
                  <li><a class="i2i-icon" href="<?php echo base_url(); ?>admin/viewAdvert"><i class="fa fa-picture-o"></i>Advertisement Management</a></li>
                  <li><a class="i2i-icon" href="<?php echo base_url(); ?>admin/viewGbeTv"><i class="fa fa-picture-o"></i>GBE TV</a></li>
                  <li><a class="i2i-icon" href="<?php echo base_url(); ?>admin/viewGbeTvChannel"><i class="fa fa-picture-o"></i>GBE TV Channels</a></li>
                  <li><a class="i2i-icon" href="<?php echo base_url(); ?>admin/viewAssistants"><i class="fa fa-picture-o"></i>Virtual Assistants</a></li>
                  <li><a class="i2i-icon" href="<?php echo base_url(); ?>admin/ownedBusiness"><i class="fa fa-picture-o"></i>Black Owned Business</a></li>
                  <li><a class="i2i-icon" href="<?php echo base_url(); ?>admin/security"><i class="fa fa-picture-o"></i>Security</a></li>
				  <li><a class="i2i-icon" href="#"><i class="fa fa-picture-o"></i> Current Account </a>
						<ul class="i2i-submenu">
						 <li><a href="<?php echo base_url(); ?>admin/notifications" class="i2i-icon"><i class="fa fa-eye"></i>Notifications</a></li>
						  <li><a href="<?php echo base_url(); ?>admin/withdrawalDetail" class="i2i-icon"><i class="fa fa-eye"></i>Withdrawal Request</a></li>                      
						</ul>
          </li>
                </ul>
      </div>
              <!-- /i2i-scroller --> 
            </nav>
  </li>

          <li class="i2i-logo"><img src="<?php echo base_url(); ?>images/admin-logo-inner.png" alt=""></li>
          
          <li class="i2i-welcome"><p><strong>Welcome <?php echo trim($this->session->userdata('userName')); ?></strong>
		  You are in <?php if(trim($this->session->userdata('forWebsite'))==1){echo "GBE";}else if(trim($this->session->userdata('forWebsite'))==2){ echo "Community Treasure";} else { echo "Rave Business";} ?> Admin</p></li>
        
		  <li class="i2i-settings top-menu-trigger"><i class="fa fa-gear"></i>
    <div class="top-menu">
              <ul>
        <li><a href="#"><i class="fa fa-key"></i> Change Password</a></li>
        <li><a href="#"><i class="fa fa-user"></i> Account setting</a></li>
      </ul>
            </div>
  </li>
  <li class="i2i-logout"><a href="<?php echo base_url(); ?>admin/logout"><i class="fa fa-power-off"></i> <span>Log out</span></a></li>
          </ul>
