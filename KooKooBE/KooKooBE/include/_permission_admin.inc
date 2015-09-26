<?php

if (!global_common::isAdmin())
{
	global_common::redirectByScript("../login.php?r=1");
}

?>