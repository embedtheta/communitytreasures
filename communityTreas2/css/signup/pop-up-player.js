/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*jquery.simplemodal.js
<p class="clikbox">Watch Video<img src="<?php bloginfo( 'template_url' ); ?>/images/play2.png" alt="" /></p>
<div id="basic-modal-content"> </div>*/

$(document).ready(function(){
    $('.vdos_o').click(function (e) {
        $(".vdos_o").css('display','none');
        $("#vedo_iframe").attr('src',youtube_url); 
        $(".vdos").show();
     });
 })
 
 

