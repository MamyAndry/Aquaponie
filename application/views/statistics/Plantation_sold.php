<div class="container-fluid">
    <div class="row">
        <div class="row title">
            <h3 class="text-center">
                Statistics of Plant Sold:
            </h3>
        </div>
    </div>
    <div class="row m-auto col-lg-7">
        <div class="card">
            <div class="card-body">
                <canvas id="singelBarChart" width="750" height="500"></canvas>
            </div>
        </div>
    </div>
</div>
<script src=<?php echo base_url("assets/js/Chart.js"); ?>></script>
<script src=<?php echo base_url("assets/js/chart.min.js"); ?>></script>
<script>
    var year = <?php echo json_encode($year); ?>;
    var sold = <?php echo json_encode($sold); ?>;
    var color = ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"];
    var ctx = document.getElementById("singelBarChart");
        ctx.height = 400;   
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: year,
                datasets: [
                    {
                        label: "Quantity of Plant Sold",
                        data: sold,
                        borderColor: "rgba(117, 113, 249, 0.9)",
                        borderWidth: "0",
                        backgroundColor: color
                    }
                ]
            },
            options: {
                scales: {
                    yAxis: [{
                        ticks: {
                            min:0,
                            max:40000000,
                            beginAtZero: true
                        },
                        gridLines: {
                            display: true,
                            color: color
                        }
                    }]
                }
            }
        });
</script>
