
<?php 


// 공통 사용하는 문서의 src, href경로 변경
function includeHelper($path){
       ob_start();
       include $path;
       $includeText = ob_get_contents();
       ob_end_clean();
       
       $patterns = array();
       $patterns[0] = '#src="#';
       $patterns[1] = '#href="#';
       $patterns[2] = '#action="#';
       
       $replacements = array();
       $replacements[0]= 'src="../../';
       $replacements[1]= 'href="../../';
       $replacements[2]= 'action="../../';
       
       return preg_replace($patterns,$replacements, $includeText);
}


?>