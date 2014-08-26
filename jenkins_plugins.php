<?php
/*
 * Jenkins plugins information retriever.
 * Use as is or include this script in any php weebsite or page.
 * Author: Pedro Paulo <ficcionista@gmail.com>
 */

//This function
function objectToArray($d) {
    if (is_object($d)) {
      // Gets the properties of the given object
      $d = get_object_vars($d);
    }
    if (is_array($d)) {
      return array_map(__FUNCTION__, $d);
    }
    else {
      // Return array
      return $d;
    }
}
//set POST variables
$url = 'http://<jenkins_server>:8080/pluginManager/api/json?depth=1&xpath=/*/*/shortName|/*/*/version&wrapper=plugins';
//open connection
$ch = curl_init();

$post = 'depth=1';
//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

//execute post
$result = curl_exec($ch);
$result = json_decode($result);
$result = objectToArray($result);

curl_close($ch);
//This will print out the result in a neat human readable form.
echo "<pre>";
print_r($result);
echo "</pre>";
?>
