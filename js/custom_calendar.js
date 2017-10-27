/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() { 
	$('#cal_current_month').addClass('active');
	var d = new Date();
   	var m = d.getMonth() + 1;
   
    $('.cal_event_tab').unbind().bind("click",function(){
		$('.cal_event_tab').removeClass('active');
		$(this).addClass('active');
		$('.monthlyClass').hide();
        var id = $(this).attr('name');
		if(id == 1){
			$('#month_id').show();
			$('#qtrly_id').hide();
			$('#all_month_id').hide();
			$('#monthlyId_'+m).hide();
			$('#all_month_id_'+m).removeClass('selectedMonth');
		}else if(id == 2){
			$('#month_id').hide();
			$('#qtrly_id').show();
			$('#all_month_id').hide();
			$('#monthlyId_'+m).hide();
			$('#all_month_id_'+m).removeClass('selectedMonth');
		}else if(id == 3){
			$('#month_id').hide();
			$('#qtrly_id').hide();
			$('#all_month_id').show();
			$('#monthlyId_'+m).show();
			$('#all_month_id_'+m).addClass('selectedMonth');
		}
    });
	
	$('.singleMonth').unbind().bind("click",function(){
		var id = $(this).attr('name');
		$('.monthlyClass').hide();
		$('.singleMonth').removeClass('selectedMonth');
		$('#all_month_id_'+id).addClass('selectedMonth');
		$('#monthlyId_'+id).show();
	});
	 
	$('.clkPopup').unbind().bind("click",function(){
		var eId = $(this).parent().attr('id'); 
		$('#toltip_event_'+eId).show();
	})
	
	$('.close').unbind().bind("click",function(){
		var spanId = $(this).attr('name');
		$('#toltip_event_'+spanId).hide();
	});
	
});

/*end  of this section*/

