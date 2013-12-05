
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >

<head>
<title> Calendrier  </title>
<meta http-equiv="Content-Type" content="text/html; charset='iso9859-1'" />
<style>

/* Calendar */
table.calendar {
    width: 100%;
}

table.calendar td {
    text-align: center;
}

table.calendar td a {
    display: block;
}

table.calendar td a:hover {
    background-color: #99CCFF;
}

table.calendar td a:visited{
    color: #000000;
}

table.calendar td a:link{
    color: #000000;
}

table.calendar th {
	background-color: #a5daf5;
}

table.calendar td.selected {
    background-color: #99CCFF;
}

img.calendar {
    border: none;
}

form.clock {
    text-align: center;
}

.nowrap {
    white-space: nowrap;
}

div.nowrap {
    margin: 0px;
    padding: 0px;
}

li {
    padding-bottom: 1em;
}

li form {
    display: inline;
}

ul.main {
    margin: 0px;
    padding-left:2em;
    padding-right:2em;
}


button {
    /* buttons in some browsers (eg. Konqueror) are block elements, this breaks design */
    display: inline;
}

/* Tabs */

/* For both light and non light */
.tab {
    white-space: nowrap;
    font-weight: bolder;
}

/* For non light */
td.tab {
    width: 64px;
    text-align: center;
    background-color: #dfdfdf;
}

td.tab a {
    display: block;
}

/* For light */
div.tab { }

/* Highlight active tab */
td.activetab {
    background-color: silver;
}

/* Textarea */

textarea {
    overflow: auto;
}

.nospace {
    margin: 0px;
    padding: 0px;
}


</style>
<?php 
	$month = array('Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre','Octobre', 'Novembre', 'Decembre');
	$day_of_week = array( 'Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi');
?>
<noscript>
    <link rel="stylesheet" type="text/css" href="css/calendar.css" />
</noscript>
<script type="text/javascript" src="libraries/tbl_change.js"></script>
<script type="text/javascript">
<!--
var month_names = new Array("<?php echo implode('","', $month); ?>");
var day_names = new Array("<?php echo implode('","', $day_of_week); ?>");
//-->
</script>
</head>
<body onload="initCalendar();">
<div id="calendar_data"></div>
<div id="clock_data"></div>
</body>
</html>
