<html>
<head>
<title>ThaiCreate.Com PHP Excel.Application Tutorial</title>
</head>
<body>
<?php
	//*** Connect to MySQL Database ***//
 include '../db/database.php';

	$strSQL = "SELECT * FROM customer";
	$objQuery = mysqli_query($link, $strSQL);
	if($objQuery)
	{ 
		//*** Get Document Path ***//
		$strPath = realpath(basename(getenv($_SERVER["SCRIPT_NAME"]))); // C:/AppServ/www/myphp

		//*** File Name Gif,Jpeg,... ***//
		$FileName = "MyXls/MyChart.xls";
		
		//*** Connect to Excel.Application ***//
		$xlApp = new COM("Excel.Application");
		$xlBook = $xlApp->Workbooks->Add();

		$intStartRows = 3;
		$intEndRows = mysqli_num_rows($objQuery)+($intStartRows-1);

		$xlSheet = $xlBook->Worksheets(1);

		$xlApp->Application->Visible = False;

		//*** Delete Sheet (2,3) - Sheet Default ***//
		$xlBook->Worksheets(2)->Select;
		$xlBook->Worksheets(2)->Delete;
		$xlBook->Worksheets(2)->Select;
		$xlBook->Worksheets(2)->Delete;
		
		//*** Sheet Data Rows ***//
		$xlBook->Worksheets(1)->Name = "MyReport";
		$xlBook->Worksheets(1)->Select;

		$xlBook->ActiveSheet->Cells(1,1)->Value = "My Customer";
		$xlBook->ActiveSheet->Cells(1,1)->Font->Bold = True;
		$xlBook->ActiveSheet->Cells(1,1)->Font->Name = "Tahoma";
		$xlBook->ActiveSheet->Cells(1,1)->Font->Size = 16;

		$xlBook->ActiveSheet->Cells(2,1)->Value = "Customer Name";
		$xlBook->ActiveSheet->Cells(2,1)->Font->Name = "Tahoma";
		$xlBook->ActiveSheet->Cells(2,1)->BORDERS->Weight = 1;
		$xlBook->ActiveSheet->Cells(2,1)->Font->Size = 10;
		$xlBook->ActiveSheet->Cells(2,1)->MergeCells = True;
		
		$xlBook->ActiveSheet->Cells(2,2)->Value = "Used";
		$xlBook->ActiveSheet->Cells(2,2)->BORDERS->Weight = 1;
		$xlBook->ActiveSheet->Cells(2,2)->Font->Name = "Tahoma";
		$xlBook->ActiveSheet->Cells(2,2)->Font->Size = 10;
		$xlBook->ActiveSheet->Cells(2,2)->MergeCells = True;

		$i = 0;
		While($result = mysqli_fetch_array($objQuery))
		{
			$xlBook->ActiveSheet->Cells($intStartRows+$i,1)->Value = $result["Name"];
			$xlBook->ActiveSheet->Cells($intStartRows+$i,2)->Value = $result["Used"];
			$xlBook->ActiveSheet->Cells($intStartRows+$i,2)->NumberFormat = "$#,##0.00";
			$i++;
		}
		//*** End Data Rows ***//

		//*** Creating Chart ***//
		$xlBook->Charts->Add;
		$xlBook->ActiveChart->ChartType = 54;
		$xlBook->ActiveChart->SetSourceData ($xlBook->Sheets("MyReport")->Range("A".$intStartRows.":B".$intEndRows.""));
		
		//*** Set Localtion Sheet ***//
		$xlBook->ActiveChart->Location(2,"MyReport");
		
		//*** Sheet Properties ***//
		$xlBook->ActiveChart->HasTitle = True;
		$xlBook->ActiveChart->ChartTitle->Characters->Text = "My Chart";
		
		//*** Location  ***//
		$xlBook->ActiveSheet->Shapes("Chart 1")->IncrementLeft(20);
		$xlBook->ActiveSheet->Shapes("Chart 1")->IncrementTop(-97.5);

		//'*** Set Height & Width ***'
		$xlBook->ActiveSheet->Shapes("Chart 1")->ScaleHeight(1.0, 0,0);
		$xlBook->ActiveSheet->Shapes("Chart 1")->ScaleWidth(1.0, 0,0);

		//*** Save Excel ***//
		@unlink($strPath."/".$FileName);
		$xlBook->SaveAs($strPath."/".$FileName,44);
		//$xlBook->SaveAs(realpath($FileName),44);

		$xlApp->Application->Quit;
	}		
?>
Excel Created <a href="<?php echo $FileName?>">Click here</a> to Download.
</body>
</html>