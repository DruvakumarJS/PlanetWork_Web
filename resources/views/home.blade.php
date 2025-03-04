@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        
     <div class="row text-center">
        <div class="col">
            <h4 class="font-numbers">32</h4>
            <label>Total Customer</label>
        </div>

        <div class="col border-start border-black">
            <h4 class="font-numbers">183</h4>
            <label>Total Location</label>
        </div>

        <div class="col border-start border-black">
            <h4 class="font-numbers">82</h4>
            <label>Total Employees</label>
        </div>

        <div class="col border-start border-black">
            <h4 class="font-numbers">182</h4>
            <label>Opened Tickets</label>
        </div>

        <div class="col border-start border-black">
            <h4 class="font-numbers">309</h4>
            <label>Closed Tickets</label>
        </div>
    </div>

    
    <div class="row py-4 mt-5">
        <div class="col m-3">
            <div class="card bg-white p-2">
                <label class="label">Tickets Statics</label> 
                <div class="p-3" id="tickets_chart"></div> 
            </div>
          
        </div>

        <div class="col m-3">
            <div class="card bg-white">
                <div class="row mt-4 p-4">
                     <label class="label">Attendance</label> 

                    <div class="col mt-2">
                        <h4 class="font-numbers">82</h4>
                        <label>Total Employees</label>
                    </div>

                    <div class="col mt-2">
                        <h4 class="font-numbers">78</h4>
                        <label>Logged In Today</label>
                    </div>

                    <div class="col mt-2">
                        <h4 class="font-numbers">04</h4>
                        <label>Today Leave</label>
                    </div>
                </div>
            </div>
            
            <div class="card bg-white mt-4 p-4">
                <label class="mt-3">Inventory</label>

               <div class="p-3" id="inventory_chart"></div>
            </div>
            
            
        </div>
    </div>

    <div class="py-4">
        <label class="label">Employees</label>
    </div>

    </div>
</div>

<script type="text/javascript">
    var options = {
          series: [{
          name: 'Total Spares',
          data: [44, 55]
        }, {
          name: 'Pending Spares',
          data: [53, 32]
        },],
          chart: {
          type: 'bar',
          height: 100,
          stacked: true,
          border: false,
          toolbar :{
            show:false,
          },
          zoom: {
            enabled: false // Disable zoom functionality
          },
        },
        plotOptions: {
          bar: {
            horizontal: true,
           
            dataLabels: {
              total: {
                enabled: true,
                offsetX: 0,
                style: {
                  fontSize: '7px',
                  fontWeight: 10
                }
              }
            }
          },
        },
        colors : ['#4635B1','#FF7EE2'],
        stroke: {
          width: 1,
          colors: ['#fff']
        },
        title: {
          text: ''
        },
        xaxis: {
          categories: [],

          labels: {
            show:false,
            formatter: function (val) {
              return val + "K"
            }
          }
        },
        yaxis: {
          title: {
            text: undefined
          },
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return val + "K"
            }
          }
        },
        fill: {
          opacity: 1
        },
        legend: {
          position: 'bottom',
          horizontalAlign: 'left',
          offsetX: 40
        }
        };

        var chart = new ApexCharts(document.querySelector("#inventory_chart"), options);
        chart.render();


        var options2 = {
          series: [{
          name: 'New Tickets',
          data: [44, 55, 41, 67, 22, 43,20,85,34,66,40, 50]
        }, {
          name: 'Closed Tickets',
          data: [13, 80, 20, 8, 13, 27 , 82 , 55, 66, 33, 9, 55]
        },],
          chart: {
          type: 'bar',
          height: 350,
          stacked: true,
          toolbar: {
            show: false
          },
          zoom: {
            enabled: false
          }
        },
        responsive: [{
          breakpoint: 480,
          options: {
            legend: {
              position: 'bottom',
              offsetX: -10,
              offsetY: 0
            }
          }
        }],
        colors : ['#4635B1','#FF7EE2'],
        plotOptions: {
          bar: {
            horizontal: false,
           // borderRadius: 10,
           // borderRadiusApplication: 'end', // 'around', 'end'
           // borderRadiusWhenStacked: 'last', // 'all', 'last'
            dataLabels: {
              total: {
                enabled: true,
                style: {
                  fontSize: '13px',
                  fontWeight: 900
                }
              }
            }
          },
        },
        xaxis: {
          type: 'datetime',
          categories: ['01/01/2011 GMT', '01/02/2011 GMT', '01/03/2011 GMT', '01/04/2011 GMT',
            '01/05/2011 GMT', '01/06/2011 GMT','01/07/2011 GMT','01/08/2011 GMT','01/09/2011 GMT','01/10/2011 GMT','01/11/2011 GMT','01/12/2011 GMT'
          ],
        },
        legend: {
          position: 'bottom',
         
        },
        fill: {
          opacity: 1
        }
        };

        var chart2 = new ApexCharts(document.querySelector("#tickets_chart"), options2);
        chart2.render();
</script>
@endsection
