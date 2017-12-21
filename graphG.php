<?php    
    require_once('jpgraph/src/jpgraph.php');  
    require_once('jpgraph/src/jpgraph_line.php');  

    $answer = json_decode(file_get_contents('php://input'), true);   
 
    $graph = new Graph(1000, 300, 'auto', 10, true);  
    $graph->SetScale('textlin');
    
    foreach($answer AS $key => $value)
    {      
       $lineplot = new LinePlot($answer[$key]);
       $lineplot->SetColor('forestgreen');
       $graph->Add($lineplot);  
       $lineplot->SetWeight(10); 
       $lineplot->mark->SetType(MARK_FILLEDCIRCLE);
       $lineplot->value->Show();
    }      
   
    $graph->title->Set('Graph');       
      
    $graph->yaxis->title->Set('Subject');  
    $graph->xaxis->title->Set('Month');       
  
    $graph->xaxis->SetColor('#ff0000');  
    $graph->yaxis->SetColor('#ff0000');    
   
    $graph->SetBackgroundGradient('ivory', 'blue');      
   
    $graph->SetShadow(4);  
    
     @unlink("qw.png");
    $graph->Stroke("qw.png"); 
    ?>