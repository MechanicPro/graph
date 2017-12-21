var app = angular.module("myApp", []);

app.directive('file', function(){
    return {
        scope: {
            file: '='
        },
        link: function(scope, el, attrs){
            el.bind('change', function(event){
                var files = event.target.files;
                var file = files[0];
                scope.file = file ? file.name : undefined;
                scope.$apply();                 
            });
        }
    };
});

app.controller("firstCtrl", function($scope, $http)
{        
    $scope.fileJPG = "qw.png";
    $scope.param = {};      
    $scope.graphs = 
        [
            {graph : "pChart", name : "graph.php"},
            {graph : "gpGraph", name : "graphG.php"}        
        ];
    init();

    $scope.updData = function()
    {        
        localStorage.removeItem("Columns");
        localStorage.removeItem("Rows");
        if($scope.param.file)
        {
            localStorage.removeItem("fileJSON");
            $scope.fileJSON = $scope.param.file;
            localStorage.setItem('fileJSON', $scope.fileJSON);
        }             
        init();
    };
    
    $scope.readFromInput = function(selectedGraph)
    {        
        if(selectedGraph.name)
        {
            localStorage.removeItem("libGraph");
            $scope.fileGRAPH = selectedGraph.name;  
            localStorage.setItem('libGraph', $scope.fileGRAPH);
        }        
    };
   
   function init()
   {
       if(localStorage.getItem('libGraph') !== null)
       {
           $scope.fileGRAPH = localStorage.getItem('libGraph');
       }
       else
       {
           $scope.fileGRAPH = "graph.php";
           localStorage.setItem('libGraph', $scope.fileGRAPH);
       }
        
       if(localStorage.getItem('fileJSON') !== null)
       {
           $scope.fileJSON = localStorage.getItem('fileJSON');
       }
       else
       {
          $scope.fileJSON = "data_1.json";
          localStorage.setItem('fileJSON', $scope.fileJSON); 
       }
        
        $scope.listOfColumn = JSON.parse(localStorage.getItem('Columns'));
        $scope.listOfRow = JSON.parse(localStorage.getItem('Rows'));  
        //----------------------------------------------------------------------
        if (!$scope.listOfColumn && !$scope.listOfRow) 
        {
            $http.get($scope.fileJSON).success
            (
                function (data) 
                {
                    $scope.listOfColumn = data.Columns; 
                    $scope.listOfRow = data.Rows; 
                    $scope.Pr = Object.getOwnPropertyNames($scope.listOfRow);
                    localStorage.setItem( 'Columns', JSON.stringify(data.Columns));
                    localStorage.setItem( 'Rows', JSON.stringify(data.Rows));                   
                    $http.post($scope.fileGRAPH, JSON.stringify($scope.listOfRow)).success(function(response)
                    {
                        $scope.response = response;  
                        document.getElementById('grD').src = $scope.fileJPG + '?' + Math.random();
                    }); 
                    
                }
            );  
        }  
        else
        {
            $scope.Pr = Object.getOwnPropertyNames($scope.listOfRow);  
            $http.post($scope.fileGRAPH, JSON.stringify($scope.listOfRow)).success(function(response)
            {
                $scope.response = response;  
                document.getElementById('grD').src = $scope.fileJPG + '?' + Math.random();
            }); 
        }
    }
  }            
);
