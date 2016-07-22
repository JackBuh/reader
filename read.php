<!DOCTYPE html>
<html style="background: #e5e4db;">


<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
</head>


<body style='font: 16px "Helvetica Neue",Helvetica,"Lucida Grande","Luxi Sans",Arial,"Hiragino Sans GB",STHeiti,"Microsoft YaHei","Wenquanyi Micro Hei","WenQuanYi Micro Hei Mono","WenQuanYi Zen Hei","WenQuanYi Zen Hei Mono",LiGothicMed;'>


<div style="position: relative;
width: 43.375em;
margin: 0 auto;
padding-left: 0;
overflow: hidden;">





<div style="position: relative;
float: left;
width: 34em;
padding: 5em 4.6875em 2.5em;
margin: 0;
background: #f6f4ec;
cursor: default;">


<div id="hd" style="position: absolute;
top: 36px;
width: 544px;
font-size: 14px;
color: #aaa;
padding-bottom: 8px;
border-bottom: 1px solid #e9eadf;">


<!--
序言
-->

正文

</div>


<div id="content" style="display:block;">



<?php
    
    $dir = 'books';
    $filename = rawurldecode($_REQUEST["file"]);
    
    
    if (!isset($filename) || !$filename) {
        
        /*
         if (is_dir($dir)) {
         if ($dh = opendir($dir)) {
         $i = 1;
         while (($file = readdir($dh)) !== false) {
         $filehref = '/reader/read.php?file=' . $file;
         echo '$i : <a href="' . $filehref  . '">' . $file . '</a><br />';
         $i++;
         }
         closedir($dh);
         }
         }
         */
        
        $files = array_values(array_filter(scandir($dir), function($file) {
                                           return !is_dir($file);
                                           }));
        $i = 1;
        foreach($files as $file){
            $filehref = '/reader/read.php?file=' . $file;
            echo $i . ' : <a href="' . $filehref  . '">' . $file . '</a><br />';
            $i++;
        }
    }
    
    else {
        
        /*
         $myFile = "jiuzhou.txt";
         $fh = fopen($myFile, 'r');
         $theData = fread($fh, filesize($myFile));
         fclose($fh);
         print $theData;
         */
        
        /*
         $fh = fopen($dir . '/' . $filename,'r');
         //$fh = fopen('donate list.txt','r');
         
         $i = 0;
         while (($line = fgets($fh)) && $i<300) {
         // <... Do your work with the line ...>
         echo $line;
         echo '<br>';
         
         $i++;
         }
         
         fclose($fh);
         */
        
        $index_start = 0;
        $offset = rawurldecode($_REQUEST["offset"]);
        if (isset($offset)) {
            if (intval($offset) > 0) {
                $index_start = $offset;
            }
        }
        
        $original_uri = $_SERVER[REQUEST_URI];
        $original_uri = explode("&offset=", $original_uri)[0];
        
        $lines = file($dir . '/' . $filename);
        $lines_count = count($lines);
        $interval = 50;
        $index_end = $index_start + $interval;
        
        for ($i=$index_start; $i<$index_end; $i++) {
            
            if ($i >= $lines_count) {
                break;
            }
            
            echo $lines[$i];
            echo '<br><br>';
        }
        
        
        if ($index_start > 0) {
            
            $index_prev = 0;
            if ($index_start > $interval) {
                $index_prev = $index_start - $interval;
            }
            
            echo '<a style="float:left" href="' . $original_uri . '&offset=' . $index_prev . '">Prev</a>';
        }
        
        
        if ($index_end < $lines_count) {
            echo '<a style="float:right" href="' . $original_uri . '&offset=' . $index_end . '">Next</a><br/>';
        }
        
    }
    
    
    ?>

<!--

<p style="text-indent: 2em;
line-height: 2;
min-height: 2em;
text-align: justify;
word-wrap: break-word;
">

对于我们内在的想象力，我们是怎么个样子，人从永恒方面看来又是怎么的一个样子，那可只能通过神话的方式来加以表达。神话是*嘟嘟嘟*于个人性的并可比科学还要精确地表现生活。科学以平均性的概念来进行工作，这样的概念太过于普通化，因而无法给个人生活上主观的五花八门性作出公正的决断。

</p>



<p style="text-indent: 2em;
line-height: 2;
min-height: 2em;
text-align: justify;
word-wrap: break-word;
">

对于我们内在的想象力，我们是怎么个样子，人从永恒方面看来又是怎么的一个样子，那可只能通过神话的方式来加以表达。神话是*嘟嘟嘟*于个人性的并可比科学还要精确地表现生活。科学以平均性的概念来进行工作，这样的概念太过于普通化，因而无法给个人生活上主观的五花八门性作出公正的决断。

</p>

-->


</div>


<div style='position: absolute;
color: #999;
bottom: 2em;
left: 2em;
font: .75em Georgia;'>

60

</div>



</div>

</div>

</body>



</html>