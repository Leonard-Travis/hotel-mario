<html>
<head>
<title></title>
</head>
<body>
<h1></h1>
	
<h3>TEST</h3>	

<ul>
<?php 
foreach ($query as $item){
	echo ($item['name'].'<br>');
	echo ($item['lastname'].'<br><br>');
}

?>

</ul>
	
</body>
</html>