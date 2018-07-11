<?php 
//phpinfo();
$url = "https://ajax.googleapis.com/ajax/services/feed/find?" .
       "v=1.0&q=Sports&userip=INSERT-USER-IP";
$url2 = "https://ajax.googleapis.com/ajax/services/feed/load?v=1.0&q=http//www.digg.com/rss/index.xml";

// sendRequest


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, true);

 
$body = curl_exec($ch);
curl_close($ch);

// now, process the JSON string
//print_r($body);
$json = json_decode($body);

echo "<pre>";
print_r($json);
echo "</pre>";
$data = $json->responseData;

$categoryName = $data->query;
$results = $data->entries;
foreach($results as $result)
{
	
	echo $result->title."<br>";
	echo $result->link."<br>";
	
}

// now have some fun with the results...
 ?>