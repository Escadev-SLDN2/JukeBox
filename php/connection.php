<?php
	if( (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) === true)
	{
		header("location: ../");
		exit;
	}
    require_once "users.php";