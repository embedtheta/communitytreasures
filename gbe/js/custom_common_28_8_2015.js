/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() {
    
     /*menu message*/
    $(".levelClass").click(function(){
        var id = $(this).attr("id");
        var msg = "";
        if(id == 1 && userLevel == 0){
            return true;
            msg = " <h2>Go Back To Step 1</h2> <h4>Watch The Videos & Follow The Instructions</h4>";
            msg = '<div class="step02"><h2> &#8249;&#8249;&#8249;&#8249; Please Complete Level 1<span>Which is the first part of Your GBE Business</span></h2><h4>Watch The Videos & Follow The Instructions</h4><h1>Get Your <br>Afrowebb Catalogue</h1><h3>Then Complete Step 1</h3><h5>Once You Have Completed All The Instructions <br>You Gain Access To The Second Step</h5><h6> &#8249; <a href="#">Click Here To Go Back & Complete Step 1</a> </h6></div>';
        }else if(id == 1 && userLevel > 0){
            return true;
             msg = "";//" You have already completed this level.<br/>Thank you.";
        }
        if(id == 2 && userLevel == 1){
            return true;
            msg = " Coming soon<br/>Thank you";
        }else if(id == 2 && userLevel > 1){
            return true;
            msg = "";//" You have already completed this level.<br/>Thank you.";
        }else if(id == 2 && userLevel < 1){
            msg = " Please complete the Level 1.<br/>Thank you.";
        }
        if(id == 3 && userLevel == 2){
            return true;
            msg = " Coming soon<br/>Thank you";
        }else if(id == 3 && userLevel > 2){
            return true;
            msg = "";//" You have already completed this level.<br/>Thank you.";
        }else if(id == 3 && userLevel < 2){
            msg = " Please complete the Level 1,2.<br/>Thank you.";
        }
        if(id == 4 && userLevel == 3){
            return true;
            msg = " Coming soon<br/>Thank you";
        }else if(id == 4 && userLevel > 3){
            return true;
            msg = "";//" You have already completed this level.<br/>Thank you.";
        }else if(id == 4 && userLevel < 3){
            msg = " Please complete the Level 1,2,3.<br/>Thank you.";
        }
        if(id == 5 && userLevel == 4){
            return true;
            msg = " Coming soon<br/> Thank you";
        }else if(id == 5 && userLevel < 4){
            msg = " Please complete the previous Level.<br/>Thank you.";
        }
        if(msg != ""){
            $.fancybox.open(msg);
            return true;
        }else{
            return false;
        }
    });
    /*end menu message*/
    
    
    /*Afroweb listing message*/
    $("#freeListingId").click(function(){
        var lName = $("#listingName").val();
        var lEmail = $("#listingEmail").val();
        var lUrl = $("#lisUrl").val();
        if(lName == ""){
            $.fancybox.open("Please enter the Name.");
            $("#listingName").focus();
            return false;
        }
        var retEmail = emailValidation(lEmail);
        if(retEmail != ""){
            $.fancybox.open(retEmail);
            $("#listingEmail").focus();
            return false;
        }
        
        if(lUrl == ""){
            $.fancybox.open("Please enter the Url.");
            $("#lisUrl").focus();
            return false;
        }
        return true;
    });
    /*end this section*/
    /*Vendor add section*/
    $("#addVendors").click(function(){
        var vName = $("#vendorName").val();
        var vContactNo = $("#vendorNo").val();
        var vAdd = $("#vendorAddr").val();
        var vEmail = $("#vendorEmail").val();
        
        if(vName == ""){
            $.fancybox.open("Please enter the Vendor Name.");
            $("#vendorName").focus();
            return false;
        }
        if(vContactNo == ""){
            $.fancybox.open("Please enter the Vendor Contact No.");
            $("#vendorNo").focus();
            return false;
        }
        
        if(vAdd == ""){
            $.fancybox.open("Please enter the Vendor Address.");
            $("#vendorAddr").focus();
            return false;
        }
        
        var retEmail = emailValidation(vEmail);
        if(retEmail != ""){
            $.fancybox.open(retEmail);
            $("#vendorEmail").focus();
            return false;
        }
       
        return true;
    });
    /*end this section*/
    
     /*Product upload add section*/
    $("#pUploadButton").click(function(){
        var vName = $("#vendorID").val();
        var vContactNo = $("#productTypeID").val();
        var vAdd = $("#productName").val();
        var vEmail = $("#productPrice").val();
        var vQuantity = $("#productQuantity").val();
        var mainImg = $("#mainImageId").val();
		var prodType = $("#typeOfProduct").val();
		
		
        if(vName == ""){
            $.fancybox.open("Please select Vendor Name.");
            $("#vendorID").focus();
            return false;
        }
        if(vContactNo == ""){
            $.fancybox.open("Please select Product Type.");
            $("#productTypeID").focus();
            return false;
        }
        
        if(vAdd == ""){
            $.fancybox.open("Please enter the Name of your Product.");
            $("#productName").focus();
            return false;
        }
        
        if(vEmail == ""){
            $.fancybox.open("Please enter the Price of your Product.");
            $("#productPrice").focus();
            return false;
        }
        
        if(prodType =="2")    
        {
			if(vQuantity == "" ||  vQuantity == 0 ){
				$.fancybox.open("Please enter the Quantity of your Product.");
				$("#productQuantity").focus();
				return false;
			}
        }    
       
        
        if(mainImg == ""){
            $.fancybox.open("Please upload main Image of your Product.");
            $("#mainImageId").focus();
            return false;
        }
       
        return true;
    });
    /*end this section*/
    /* custom color with quantity*/
    $("#cq_1").hide();
    //$(".qClass").hide();
    $('.colorRadio').click(function() {
        var colorValue = $(this).val();
        if(colorValue == 1){
            $("#cq_1").show();
        }else if(colorValue == 0){
            $("#cq_1").hide();
            $("#productQuantity").val('');
            $(".qClass").each(function(){
                var id = Number($(this).attr('id'));
                $(".qClass").val(0); 
                $("#lblId_"+id).removeClass("colorActive");
            });
        }
     });
     
    $('.col_col_1').click(function() {
        var cId = $(this).attr("id");
        $("#lblId_"+cId).toggleClass("colorActive");
        var cValue = $("#lblId_"+cId).attr("class");
        if(cValue == "colorActive"){
            $("#colorId_"+cId).val(cId);
            //$("#qId_"+cId).val('');
            //$("#qId_"+cId).show();
        }else{
            $("#colorId_"+cId).val(0); 
            //$("#qId_"+cId).val('');
            //$("#qId_"+cId).hide();
        }
       
     });
     
    $(".qClass").change(function(){
         var sumQuantity = 0;
         $(".qClass").each(function(){
            var vl = Number($(this).attr('value'));
            var id = Number($(this).attr('id'));
            if(vl > 0){
                sumQuantity = sumQuantity + vl;
                $("#lblId_"+id).addClass("colorActive");
                $("#colorId_"+id).val(id);
            }else{
                $("#colorId_"+id).val(0); 
                $("#lblId_"+id).removeClass("colorActive");
            }
        });
        $("#productQuantity").val(sumQuantity);
     });
    /* end */
	
	
	  /*Product upload edit section*/
    $("#pUploadButtonEdit").click(function(){
        var vName = $("#vendorIDEdit").val();
        var vContactNo = $("#productTypeIDEdit").val();
        var vAdd = $("#productNameEdit").val();
        var vEmail = $("#productPriceEdit").val();
        var vQuantity = $("#productQuantityEdit").val();
        var mainImg = $("#mainImageIdEdit").val();
		var prodType = $("#typeOfProductEdit").val();
        if(vName == ""){
            $.fancybox.open("Please select Vendor Name.");
            $("#vendorIDEdit").focus();
            return false;
        }
        if(vContactNo == ""){
            $.fancybox.open("Please select Product Type.");
            $("#productTypeIDEdit").focus();
            return false;
        }
        
        if(vAdd == ""){
            $.fancybox.open("Please enter the Name of your Product.");
            $("#productNameEdit").focus();
            return false;
        }
        
        if(vEmail == ""){
            $.fancybox.open("Please enter the Price of your Product.");
            $("#productPriceEdit").focus();
            return false;
        }
        if(prodType == "2")
        {    
			if(vQuantity == "" ||  vQuantity == 0 ){
				$.fancybox.open("Please enter the Quantity of your Product.");
				$("#productQuantityEdit").focus();
				return false;
			}
		}   
       
        
        /*if(mainImg == ""){
            $.fancybox.open("Please upload main Image of your Product.");
            $("#mainImageIdEdit").focus();
            return false;
        }*/
       
        return true;
    });
    /*end this section*/
    /* custom color with quantity*/
    //$("#cq_1_edit").hide();
    //$(".qClass").hide();
    $('.colorRadioEdit').click(function() {
        var colorValue = $(this).val();
        if(colorValue == 1){
            $("#cq_1_edit").show();
        }else if(colorValue == 0){
            $("#cq_1_edit").hide();
            $("#productQuantityEdit").val('');
            $(".qClassEdit").each(function(){
                var id = Number($(this).attr('id'));
                $(".qClassEdit").val(0); 
                $("#lblId_edit_"+id).removeClass("colorActive");
            });
        }
     });
     
     
     $(".qClassEdit").change(function(){
         var sumQuantity = 0;
         $(".qClassEdit").each(function(){
            var vl = Number($(this).attr('value'));
            var id = Number($(this).attr('id'));
            if(vl > 0){
                sumQuantity = sumQuantity + vl;
                $("#lblId_edit_"+id).addClass("colorActive");
                $("#colorIdEdit_"+id).val(id);
            }else{
                $("#colorIdEdit_"+id).val(0); 
                $("#lblId_edit_"+id).removeClass("colorActive");
            }
        });
        $("#productQuantityEdit").val(sumQuantity);
     });
    /* end */
    
    /*password section */
    $('#passwordUpdate').click(function(){
        var retVal = passwordCheck();
        if(retVal === true){
            return true;
        }else{
            return false;
        }
    });
    /*end*/
    /* form submit message of customer service,tech support, advertise service*/
    if(formSubmitMsg != "" && (formSubmitType == "customer" || formSubmitType == "tech" ||formSubmitType == "advertise" ||formSubmitType == "country" ||formSubmitType == "paypal" || formSubmitType == "image" || formSubmitType == "inviteGmailFriend" || formSubmitType == "inviteYahooFriend" || formSubmitType == "changePassword" || formSubmitType == "pUpload" || formSubmitType == "vUpload" ||formSubmitType == "fListing" || formSubmitType == "deleteUser" ||formSubmitType == "pUploadUpdate" || formSubmitType == "STEP3POSTADD" || formSubmitType == "STEP3POSTCOPY" || formSubmitType == "STEP1A")){ 
        $.fancybox.open(formSubmitMsg);
        return true;
    }
    
    
});
function funToggleSupport(id){
    //$(".list_service").hide();
    var myArray = id.split('_');
    $("#slist_"+myArray[1]).slideToggle();
    
}
/*checking blank*/
function checkEmailMessage(emailID,msgID){
    var formMsg = "";
    var emailReg = 2;
    var toFocus = 1;
    var sEmail = $("#"+emailID).val();
    var sMsg = $("#"+msgID).val();
    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    if (filter.test(sEmail)) {
         emailReg = 1;
    }
    if(sEmail == "" && sMsg == ""){
        formMsg = "Please enter the Email and Message.";
        toFocus = 1;
    }else if(sEmail != "" && sMsg == ""){
        formMsg = "Please enter the Message.";
        toFocus = 2;
    }else if(sEmail == "" && sMsg != ""){
        formMsg = "Please enter the Email.";
        toFocus = 1;
    }else if(emailReg == 2){
        formMsg = "Please enter the correct Email.";
        toFocus = 1;
    }
    if(formMsg == ""){
        return true;
    }else{
        $.fancybox.open(formMsg);
        if(toFocus == 1){
            $("#"+emailID).focus();
        }else if(toFocus == 2){
            $("#"+msgID).focus();
        }
        return false;
    }
    
}
/* checking blank end*/
/*checking Email*/
function emailValidation(email){
    var emailReg = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    var error = "";
    if(email == ""){
        error = "Please enter the Email.";
    }else if(!emailReg.test(email) && email != ""){
        error = "Please enter the valid Email.";
    }
    return error;
}
/* checking Email end*/

/*Password Matching*/
function passwordCheck(){
    var opassword = $.trim($("#oldpassword").val());
    var pppp = $.trim($("#pppp").val());
    var password = $.trim($("#password").val());
    var cpassword = $.trim($("#cpassword").val());
    if(opassword == ""){
        $.fancybox.open("Please enter Old password.");
        $("#opassword").focus();
        return false;
    }else if(opassword != pppp){
        $.fancybox.open("Please enter correct Old password.");
        $("#opassword").focus();
        return false;
    }else if(password == ""){
        $.fancybox.open("Please enter new password .");
        $("#password").focus();
        return false;
    }else if(cpassword == ""){
        $.fancybox.open("Please enter confirm password .");
        $("#cpassword").focus();
        return false;
    }else if(password != cpassword){
        $.fancybox.open("Password field does not match to confirm password .");
        $("#cpassword").focus();
        return false;
    }else{
        return true;
    }
}
/*end  of this section*/

