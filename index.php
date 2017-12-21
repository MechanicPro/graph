<!DOCTYPE html>
<html ng-app ="myApp">
<head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">    
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.7/angular.min.js"></script>
    <script src="js/app_test.js"></script>
    <title>Schedule for enrollment</title>
</head>
<body ng-controller="firstCtrl">
    <div class="panel panel-success">
        <div class="panel-heading">Schedule for enrollment</div>
            <div class="panel-body">                
                <nav class="navbar navbar-inverse">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="#">HOME</a>                            
                        </div>                        
                    </div>
                </nav>                  
                <h2>Graph</h2>
                <div>                    
                    <div>
                         <div class="panel panel-info">
                            <div class="panel-heading">Downloading the data source</div>
                            <div class="panel-body">The downloaded file must be in the format JSON</div>                            
                            <input type="file" data-file="param.file"> 
                            <label class="label label-info"><b>File name</b></label>: {{param.file}}   
                        </div> 
                        
                        <div class="panel panel-success">
                            <div class="panel-heading">Select schedule</div>
                            <select ng-model="selectedGraph" ng-options="x.graph for x in graphs" ng-change="readFromInput(selectedGraph)" class="form-control" id="sel1">                                
                            </select>
                            <label class="label label-success">Selected graph:</label> {{selectedGraph.graph}}
                        </div>                       
                    </div>
                    <div  class="panel panel-default">
                        <button type="button" class="btn btn-primary btn-lg btn-block" ng-click="updData()">Update data</button> 
                    </div>
                </div>
                <br>
                <div>			
                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>
                                <th class="info" ng-repeat="col in listOfColumn">{{col}}</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="info" ng-repeat="pr in Pr">
                                    <td>{{pr}}</td> 
                                    <td class="info" ng-repeat="coli in listOfColumn" ng-bind="listOfRow.{{pr}}[$index]"></td>
                            </tr>
                        </tbody>                            
                    </table>			
                </div> 
                <div id="img" >                    
                      <img id="grD" data-ng-src="{{fileJPG}}" alt="{{fileJPG}}" class="img-thumbnail"/>                      
                </div>         
        </div>       
    </div>
</body>
</html>