<!DOCYTYPE>
<html>
<head>
	<meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/imgareaselect-default.css" />
    <link rel="stylesheet" type="text/css" href="css/avatar.css" />
    <script type="text/javascript" src="scripts/jquery.min.js"></script>
    <script type="text/javascript" src="scripts/jquery.imgareaselect.pack.js"></script>
</head>

<body>


<?php
    define('APPLICATION_PATH', dirname(__FILE__));
    
    if (isset($_GET['fselector']) && !empty($_GET['fselector'])) {
        include(APPLICATION_PATH . '/fselector.php');
    } else {
        include(APPLICATION_PATH . '/favatar.php');
    }
?>

</body>
</html>
