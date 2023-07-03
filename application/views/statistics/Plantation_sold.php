<div class="container-fluid">
    <div class="row">
        <div class="row title">
            <h3 class="text-center">
                Statistics of Plant Sold:
            </h3>
        </div>
    </div>
    <div class="row m-auto w-50">
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
    var ctx = document.getElementById("singelBarChart");
        ctx.height = 400;
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: year,
                datasets: [
                    {
                        label: "Quantity of Plant Sold",
                        data: sold,
                        borderColor: "rgba(117, 113, 249, 0.9)",
                        borderWidth: "0",
                        backgroundColor: "rgba(117, 113, 249, 0.5)"
                    }
                ]
            },
            options: {
                scales: {
                    yAxis: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
</script>
