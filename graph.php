<?php 
include("pChart/pData.class");   
include("pChart/pChart.class");
header('Content-Type: application/json; charset=UTF-8');
header('Content-Type: image/png; charset=UTF-8');
$answer = json_decode(file_get_contents('php://input'), true);

$DataSet = new pData;  

$i = 0;
foreach($answer AS $key => $value)
{   
    $DataSet->AddPoint($answer[$key], ("Serie".$i)); 
    $DataSet->SetSerieName($key,("Serie".$i));
    $i++;
}      

$DataSet->AddPoint(array("Jan","Feb","Mar","Apr","May", "June", "July", "August", "September", "October", "November", "December"),"Serie777");
$DataSet->AddAllSeries();
$DataSet->SetAbsciseLabelSerie("Serie777");
$DataSet->SetYAxisName("Subject");
$DataSet->SetXAxisName("Month");
  
$Test = new pChart(700,230);
$Test->reportWarnings("GD");
$Test->setFixedScale(-12,160);
$Test->setFontProperties("Fonts/tahoma.ttf",8);   
$Test->setGraphArea(65,30,570,185);   
$Test->drawFilledRoundedRectangle(7,7,693,223,5,240,240,240);   
$Test->drawRoundedRectangle(5,5,695,225,5,230,230,230);   
$Test->drawGraphArea(255,255,255,TRUE);
$Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_NORMAL,150,150,150,TRUE,0,2,TRUE,3);   
$Test->drawGrid(4,TRUE,230,230,230,50);
  
$Test->setFontProperties("Fonts/tahoma.ttf",6);   
$Test->drawTreshold(0,143,55,72,TRUE,TRUE);   

$DataSet->RemoveSerie("Serie777");
$Test->drawArea($DataSet->GetData(),"Serie1","Serie2",239,238,227,50);
$DataSet->RemoveSerie("Serie3");
$Test->drawLineGraph($DataSet->GetData(),$DataSet->GetDataDescription());   

$Test->setLineStyle(1,6);
$DataSet->RemoveAllSeries();
$DataSet->AddSerie("Serie3");
$Test->drawLineGraph($DataSet->GetData(),$DataSet->GetDataDescription());   
$Test->drawPlotGraph($DataSet->GetData(),$DataSet->GetDataDescription(),3,2,255,255,255);   

$Test->setFontProperties("Fonts/tahoma.ttf",8);   
$Test->writeValues($DataSet->GetData(),$DataSet->GetDataDescription(),"Serie3");   
   
$Test->setFontProperties("Fonts/tahoma.ttf",8);   
$Test->drawLegend(590,90,$DataSet->GetDataDescription(),255,255,255);   
$Test->setFontProperties("Fonts/tahoma.ttf",10);   
$Test->drawTitle(60,22,"Graph",50,50,50,585);

$Test->drawFromPNG("Sample/logo.png",584,35);
$Test->Render("qw.png");  
?>