<?php 
        /*echo "blabla";
		echo "---".$_REQUEST["videoname"];*/
        $imgname                                   = $_REQUEST["videoname"];		
		$remoteFile                                = 'http://220.225.90.154/blacksociety/sapVideos/'.$imgname;		
		header("Pragma: public"); 
    	header("Expires: 0");
   		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    	header("Cache-Control: private",false); 
    	header("Content-Type: application/force-download");
    	header("Content-Disposition: attachment; filename=\"$imgname\";" );
   		header("Content-Transfer-Encoding: binary");
    	readfile($remoteFile);
		
		
?>		