<div class="container-fluid">
    <div class="row">
        <div class="row title">
            <h3 class="text-center">
                Statistics of Fish Sold:
            </h3>
        </div>
        <div class="row justify-content-center">
            <div class="card col-md-6 col-lg-6 col-6">
                <div class="card-body">
                    <canvas id="singelBarChart"></canvas>
                </div>
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
        ctx.height = 200;
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: year,
                datasets: [
                    {
                        label: "Quantity of Fish Sold",
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
