var app = angular.module('myApp', ['nvd3']);
app.controller('myCtrl', function($scope,$http){

    $http.get("index.php/list2016")
        .then(
            function(response){

                $scope.data=[];
                $scope.data.push({key: "2016",values:[]});
                if(response.data && response.data.length){
                    for(i=0;i<response.data.length;i++){
                        $scope.data[0]["values"].push({
                            label:response.data[i]["Economy"],
                            value:parseFloat(response.data[i]["Total"])
                        });
                    }
                }

            },
            function(response){
                // failure call back
                console.log(response);
            }
        );
    $scope.options = {
        chart: {
            type: 'discreteBarChart',
            height: 500,
            margin : {
                top: 20,
                right: 20,
                bottom: 50,
                left: 55
            },
            x: function(d){return d.label;},
            y: function(d){return d.value + (1e-10);},
            showValues: false,
            valueFormat: function(d){
                return d3.format(',.4f')(d);
            },
            duration: 500,
            xAxis: {
                axisLabel: '2016'
            },
            yAxis: {
                axisLabel: '',
                axisLabelDistance: -10
            }
            ,
            zoom: {
                enabled: true,
                scaleExtent: [1, 10],
                useFixedDomain: false,
                useNiceScale: false,
                horizontalOff: false,
                verticalOff: true,
                unzoomEventType: 'dblclick.zoom'
            }
        }
    };


    })