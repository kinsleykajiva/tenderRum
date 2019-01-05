<?php
		/**
		 * Created by PhpStorm.
		 * User: kajiva kinsley
		 * Date: 16/12/2018
		 * Time: 11:38 AM
		 */
		session_start ();
		session_unset ();
		session_destroy ();
		header ( "location:login.php" );
		exit;