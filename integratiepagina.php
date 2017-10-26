<html>
<head>
<title>Integratiepagina</title>
</head>
<body>

<?php 

/*
Test php-page for testing 'integratiepagina'
For more informatie, see:
https://kb.afas.nl/index.php#Add an integration page in InSite and OutSite
https://kb.afas.nl/index.php#Integratiepagina toevoegen in InSite en OutSite
© JVM (johananvm.nl)
*/

// write a text to the page
echo "Dit is een testintegratiepagina <br /><br />";
// parse the query string
parse_str($_SERVER['QUERY_STRING']);

// echo the data from the querystring in de body
echo "dataurl: " . $dataurl . "<br />";
echo "tokenurl: " . $tokenurl . "<br />";
echo "code: " . $code . "<br />";
echo "publickey: " . $publickey . "<br />";
echo "sessionid: " . $sessionid . "<br />";

// you should enter your secret here (see documentation)
$secret = "PASTEYOURSECRETHERE";

// put the data in an array
$data = array('secret' => $secret, 'code' => $code);

// create a post object with the data in it
$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);

// create a context
$context = stream_context_create($options);
// do the post, and store results in the result object
$result = file_get_contents($tokenurl, false, $context);
// decode the json-data from the result and put it in de data object
$data = json_decode($result);

// echo the results from the data object to the page
echo "<br />environmentId: " . $data->environmentId;
echo "<br />sessionId: " . $data->sessionId;
echo "<br />userId: " . $data->userId;
echo "<br />personCode: " . $data->personCode;
echo "<br />contactId: " . $data->contactId;
echo "<br />organizationCode: " . $data->organizationCode;
echo "<br />employeeId: " . $data->employeeId;
echo "<br />cssUrl: " . $data->cssUrl;
echo "<br />scriptUrl: " . $data->scriptUrl;
?>

</body>
</html>
