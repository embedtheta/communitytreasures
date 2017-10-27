<?php
$fileName = '24_08_2015';
$logPath ='http://www.globalblackenterprises.com/dbadmin/paypal_update_' . $fileName . '.txt';
        if (file_exists($logPath)) {
            unlink($logPath);
        }
        $myfile = fopen($logPath, "w") or die("Unable to open file!");
        $fileData = 'Here are all details ...';
        if (count($_POST) > 0) {
            foreach ($_POST as $k => $v) {
                $fileData .= "\r\n";
                if (is_array($_POST[$k])) {
                    $fileData .= "\r\n";
                    $fileData .= $k . " ==>Start";
                    foreach ($_POST[$k] as $kk => $vv) {
                        $fileData .= "\r\n";
                        $fileData .= $kk . " ==>" . $vv;
                    }
                    $fileData .= "\r\n";
                    $fileData .= $k . " ==>End";
                } else {
                    $fileData .= "\r\n";
                    $fileData .= $k . " ==>" . $v;
                }
            }
        } else {
            $fileData .= "\r\n";
            $fileData .= "Sorry! No Data Please. ";
        }
        fwrite($myfile, $fileData);
        fclose($myfile);
	echo "Success ";	
		?>