<?php

function parseToXML($htmlStr)
{
$xmlStr=str_replace('<','&lt;',$htmlStr);
$xmlStr=str_replace('>','&gt;',$xmlStr);
$xmlStr=str_replace('"','&quot;',$xmlStr);
$xmlStr=str_replace("'",'&#39;',$xmlStr);
$xmlStr=str_replace("&",'&amp;',$xmlStr);
return $xmlStr;
}


$attractions = DB::table('attractions')->distinct()->get();
if($result){
	$attractions = DB::table('attractions')->where('title','like',"%$keyword%")->get();
}


// Start XML file, echo parent node
echo '<markers>';

// Iterate through the rows, printing XML nodes for each
foreach ($attractions as $attraction) {
  // Add to XML document node
  echo '<marker ';
  echo 'id="' . $attraction->id . '" ';
  echo 'name="' . parseToXML($attraction->title) . '" ';
  echo 'address="' . parseToXML($attraction->address) . '" ';
  echo 'lat="' . $attraction->latitude . '" ';
  echo 'lng="' . $attraction->longitude . '" ';
  echo '/>';
}

// End XML file
echo '</markers>';
?>