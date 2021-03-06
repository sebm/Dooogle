<?
extract($_GET);
////////////////////////////////////////////////////////////
// This is example code of how to query the Google API using
// Web Services, SOAP, and PHP.
//
// Author: Geoff Peters, January 6th 2004.  
//
// To run this script you need to obtain the Pear::SOAP package.
// You can obtain it from http://pear.php.net.
// The example shown uses Pear::SOAP version 0.7.5.
//
// If you don't have administrative access to you web server,
// you can place the SOAP directory that contains the Pear::SOAP
// source files somewhere on your server, and then modify the
// PHP include path using ini_set to include this directory.
//
// For example: 
/*

// set the include path to use the new pear stuff
ini_set( 'include_path', '.:/home/user/pearstuff:/usr/local/lib/php');

*/
// Note that Pear::SOAP has several dependencies on other Pear packages,
// which you should also install on your web server.
/////////////////////////////////////////////////////////////

//
// Initialize SOAP web services
//

ini_set("include_path", join(":", array(dirname(__FILE__)."/PEAR",    ini_get("include_path"))));


include("SOAP/Client.php");

$soapclient = new SOAP_Client('http://api.google.com/search/beta2');
$soapoptions = array('namespace' => 'urn:GoogleSearch',
                 'trace' => 0);


?>


<html><head>
<LINK REL="SHORTCUT ICON" HREF="http://www.dooogle.com/dooogle.ico">
<meta http-equiv="content-type" content="text/html; charset=UTF-8"><title>Dooogle Search: Doogie Howser</title><style><!--
body,td,div,.p,a{font-family:arial,sans-serif }
div,td{color:#000}
.f,.fl:link{color:#6f6f6f}
a:link,.w,a.w:link,.w a:link{color:#00c}
a:visited,.fl:visited{color:#551a8b}
a:active,.fl:active{color:#f00}
.t a:link,.t a:active,.t a:visited,.t{color:#000}
.t{background-color:#e5ecf9}
.k{background-color:#36c}
.j{width:34em}
.h{color:#36c}
.i,.i:link{color:#a90a08}
.a,.a:link{color:#008000}
.z{display:none}
div.n {margin-top: 1ex}
.n a{font-size:10pt; color:#000}
.n .i{font-size:10pt; font-weight:bold}
.q a:visited,.q a:link,.q a:active,.q {color: #00c; }
.b{font-size: 12pt; color:#00c; font-weight:bold}
.ch{cursor:pointer;cursor:hand}
.e{margin-top: .75em; margin-bottom: .75em}
.g{margin-top: 1em; margin-bottom: 1em}
//-->
</style>
<script>
<!--
function ss(w){window.status=w;return true;}
function cs(){window.status='';}
function ga(o,e){if (document.getElementById){a=o.id.substring(1); p = "";r = "";g = e.target;if (g) { t = g.id;f = g.parentNode;if (f) {p = f.id;h = f.parentNode;if (h) r = h.id;}} else{h = e.srcElement;f = h.parentNode;if (f) p = f.id;t = h.id;}if (t==a || p==a || r==a) return true;location.href=document.getElementById(a).href}}
//-->
</script>
<style><!--
.fl:link{color:#7777CC}
-->
</style></head><body onload="document.gs.reset()" topmargin="2" bgcolor="#ffffff" marginheight="2"><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td valign="top"><a href="http://www.dooogle.com/webhp?hl=en"><img src="logo_sm.gif" alt="Go to Dooogle Home" border="0" vspace="12"></a></td><td>  </td><td valign="top"><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td height="14" valign="bottom"><script><!--
function qs(el) {if (window.RegExp && window.encodeURIComponent) {var qe=encodeURIComponent(document.gs.q.value);if (el.href.indexOf("q=")!=-1) {el.href=el.href.replace(new RegExp("q=[^&$]*"),"q="+qe);} else {el.href+="&q="+qe;}}return 1;}
// -->
</script><table border="0" cellpadding="4" cellspacing="0"><tbody><tr>
                <td class="q"><font size="-1"><font color="#000000"><b>Web</b></font></font></td>
              </tr></tbody></table></td></tr><tr><td><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td nowrap><form name="gs" method="get" action="doogle.php"><input name="query" value="whatever" type="hidden"><input name="start" value="0" type="hidden"><input name="q" size="41" maxlength="2048" value="Doogie Howser" type="text"><font size="-1"> <input name="btnG" value="Search" type="submit"><span id="hf"></span></font></form></td>
                <td nowrap>&nbsp;</td>
              </tr></tbody></table></td></tr></tbody></table><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td><font size="-1"></font></td></tr><tr><td height="7"><img alt="" height="1" width="1"></td></tr></tbody></table></td></tr></tbody></table>



<?php




if ( $key == "" )
{
	/*
	You get a developer's key when you register to use Google's API.
	A developer's key is a unique string that identifies you to Google.
	You get a maximum of 1000 searches per day using your developer's key.
	*/
	$key = 'Your Key Here'; // put your developer's key here.
}

if( $query != "" )
{
	// remove the slashes that are automatically added by PHP before each quotation mark
	$query = stripslashes($query);

	if( $ret = search( $query, $key, $num) )
	{
		$results = $ret->resultElements;

?>


<table border="0" cellpadding="0" cellspacing="0" width="100%"><tbody><tr><td bgcolor="#3366cc"><img alt="" height="1" width="1"></td></tr></tbody></table><table bgcolor="#e5ecf9" border="0" cellpadding="0" cellspacing="0" width="100%"><tbody><tr><td bgcolor="#e5ecf9" nowrap><font size="+1"> <b>Web</b></font> </td><td align="right" bgcolor="#e5ecf9" nowrap><font color="" size="-1">Results <b><?php print $ret->startIndex;?></b> - <b><?php print $ret->endIndex;?></b> of about <b><?php print $ret->estimatedTotalResultsCount;?></b> for <b>Doogie Howser</b>.  (<b><?php print $ret->searchTime;?></b> seconds) </font></td></tr></tbody></table><!--a-->



<?php



		foreach($results as $res) {

	if(empty($res->title)) {
?><p class="g"><!--m--><a href="<?php print $res->URL;?>">
<?php print $res->URL;?> <!--n-->
</p><?php
	}else{
		
?><p class="g"><!--m--><a href="<?php print $res->URL;?>">
<?php print $res->title;?></a><br><font size="-1">
<?php print $res->snippet;?>
<br><font color="#008000"><?php print $res->URL;?> -  <?php print $res->cachedSize;?> </font> </font><!--n-->
</p><?php
	
	}
	
		  }		   
	}
}
		
?>

<br clear="all"><div class="n"><table align="center" border="0" cellpadding="0" cellspacing="0" width="1%"><tbody><tr align="center" valign="top"><td nowrap valign="bottom"><font size="-1">Result Page: </font></td><td>



<?php

	$length = 10;
	$lenght2 = 20;
	
	$ii2 = ($start / 10) + 1;
	$ii3 = $ii2;
	
	// if ($ii2 > 10){$ii2 = $ii2 - 10;}
	$ii2 = $ii2 - 10;
	if ($ii2 < 0){$ii2 = 1;}
			
	global $flag_end;
	$flag_end = 0;


if ($ii3 > 1){
?>
<a href="doogle.php?query=whatever&start=<?php echo $start - 10;?>"><img src="nav_previous.gif" alt="" border="0"><br><span class=b>Previous</span></a></td><td>
<?php
}
else{
?>
<img src="nav_first.gif" alt="" height="26" width="18"><br></td><td>
<?php
}


for ($ii = $ii2; $ii < $length + $ii3; $ii++)
{

if ($ii >= 99){$flag_end = 1; break; }

if ($ii3 == $ii){
?>
<img src=nav_current.gif width=16 height=26 alt=""><br><span class=i><?php echo $ii ?></span></td><td>
<?php
}

else{
?>
<a href="doogle.php?query=whatever&start=<?php echo ($ii-1)*10?>"><img src="nav_page.gif" alt="" border="0" height="26" width="16"><br><?php echo $ii ?></a></td><td>
<?php
}

}

if ($flag_end == 0){
?>
<a href="doogle.php?query=whatever&start=<?php echo $start + 20;?>"><img src=nav_next.gif width=100 height=26 alt="" border=0><br><span class=b>Next</span></a></td></tr>
<?php
}else{
?>
<a href="doogle.php?q=whatever&start=<?php echo $start + 20;?>"><img src=nav_next_end.gif width=100 height=26 alt="" border=0><br><span class=b></span></a></td></tr>
<?php
}
?>
</tbody></table></div><center>
<br clear="all"><br><table border="0" cellpadding="0" cellspacing="0" width="100%"><tbody><tr><td class="k"><img alt="" height="1" width="1"></td></tr><tr><td align="center" bgcolor="#e5ecf9"> <br><table align="center" border="0" cellpadding="0" cellspacing="0"><form method="get" action="/search"></form><tbody><tr><td nowrap>
<font size="-1"><input name="q" size="31" maxlength="2048" value="Doogie Howser" type="text"> <input name="btnG" value="Search" type="submit"><input name="hl" value="en" type="hidden"><input name="lr" value="" type="hidden"></font></td></tr></tbody></table>
        <br>
      </td></tr><tr><td class="k"><img alt="" height="1" width="1"></td></tr></tbody></table></center><center><p></p><hr class="z"><table border="0" cellpadding="2" cellspacing="0" width="100%"><tbody><tr>
      <td align="center">&nbsp;</td>
    </tr></tbody></table><br><font class="p" size="-1">©2009 Dooogle</font></center>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-12213123-1");
pageTracker._setDomainName(".coryarcangel.com");
pageTracker._trackPageview();
} catch(err) {}</script>
</body></html> 


<?php
		


////////////////////////////////////////////////
// Does Google search with retry. 
// Retry is useful because sometimes the connection will
// fail for some reason but will succeed when retried.
function search( $query, $key, &$num )
{
	$result = false;
	$max_retries = 5;
	$retry_count = 0;

	while( !$result && $retry_count < $max_retries )
	{
  		$result = do_search( $start, $query, $key, $num );	
	        if( !$result )
		{
			print( "Attempt $retry_count failed.<br>\n");
		}	
		$retry_count++;
	}
	if( !$result )
	{
		print("<br>Sorry, connection to Google failed after retrying several times. Please check that the Google Developer's Key you entered was correct. To obtain a developer's key or for more information on the Google API, visit <a href=\"http://www.google.com/apis/\">Google API home page</a>.<br>\n");
	}
	return $result;
}

////////////////////////////////////////////////////////////
// Calls the Google API and retrieves the estimated number of 
// search results for that query into $num.
function do_search( $start, $query, $key, &$num )
{
	global $soapclient;
	global $soapoptions;

	// Note that we pass in an array of parameters into the Google search.
	// The parameters array has to be passed by reference.
	// The parameters are well documented in the developer's kit on the
	// Google site http://www.google.com/apis

	$query = "Doogie Howser";   // Wasss up
	$start = $_GET['start'];
	// $start = 10;
	// $start = stripslashes($start);


	//print "START IS: $start<BR><BR>\n";
	
	global $_GET;
	global $start;
	$start = $_GET['start'];
	//print "START IS NOW: $start<BR><BR>";
	$start2 = $start;
	
	$length = 1000;
	$i = 0;
	for ($ii = 0; $ii < $length; $ii++)
	{
	if ($start == $ii) {$start = $i;}
	$i = $i + 1;
	}

	if(empty($start)) {
	  $start =  0;
	}

	//print "START IS FINALLY: $start<BR><BR>\n";


	$params = array(
                'key' => $key, // the Developer's key
                'q' => $query, // the search query
                'start' => $start,      // the point in the search results should Google start
                'maxResults' => 10, // the number of search results (max 10)
                'filter' => false, // should the results be filtered?
                'restrict' => '',
                'safeSearch' => false,
                'lr' => '',
                'ie' => '',
                'oe' => ''
        );

	// Here's where we actually call Google using SOAP.
        // doGoogleSearch is the name of the remote procedure call.

	$ret = $soapclient->call('doGoogleSearch', $params, 
				  $soapoptions);

	if (PEAR::isError($ret))
	{
		print("<br>An error #" . $ret->getCode() . " occurred!<br>");
		print(" Error: " . $ret->getMessage() . "<br>\n");
		return false;
	}
	else // We have proper search results
	{
		// Results from the Google search are stored in the object $ret.
		// The following block of code prints
		// out the structure and contents of the object to the screen:
		// print("\n<br><pre>");
		$num = $ret->estimatedTotalResultsCount;
	}

	return $ret;
}

?>
