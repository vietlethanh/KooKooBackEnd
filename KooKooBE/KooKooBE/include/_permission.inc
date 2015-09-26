<?php

if (!global_common::isCLogin())
{
	global_common::redirectByScript("login.php?r=1");
}

?>