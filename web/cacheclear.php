<?php
//ini_set("display_errors",1);
if(exec("php /Web/OpiAide/app/console cache:clear --env=prod")){
	echo "cache cleared";
	//mail("ashwani.sharma@mobileprogramming.net","Cache clear OpiAide","http://64.150.183.17:1005/web/ working......");
}else{
   mail("ashwani.sharma@mobileprogramming.net","OpiAide Server Stuck","http://64.150.183.17:1005/web/ not working......");
   mail("itdesk@mobileprogrammingllc.com","OpiAide Server Stuck","http://64.150.183.17:1005/web/ not working......");
}
?>