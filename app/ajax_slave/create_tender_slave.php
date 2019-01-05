<?php
		/**
		 * Created by PhpStorm.
		 * User: kajiva kinsley
		 * Date: 18/12/2018
		 * Time: 5:17 AM
		 */
		
		if(isset($_POST['data_tender_c'])){
			//var_dump ($_POST);exit;
			$tenderNumber = $_POST['tenderNumber'];
			$tendertitle = $_POST['tendertitle'];
			$tenderCategory = $_POST['tenderCategory'];
			$editor2 = $_POST['editor2'];
			$compJson = $_POST['compJson'];
			$compJsonSelect = $_POST['compJsonSelect'];
			$ux_i = $_POST['ux'];
			$due_date = $_POST['due_date'];
			
			require_once "../DBClass/DBTender.php";
			$DBTender = new DBTender();
			
			print $DBTender->saveTender ( $tenderNumber ,  $tendertitle , (int  ) $tenderCategory ,  $editor2 ,
				                            $compJson ,  $compJsonSelect , (int  )  $ux_i  , $due_date);
			
		}