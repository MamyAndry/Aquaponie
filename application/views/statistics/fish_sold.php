<div class="container-fluid mt-5">
    <div class="row">
        <div class="row title">
            <h3 class="text-center">
                Statistics of Fish Sold:
            </h3>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        <div class="col-sm-12 col-lg-5 my-5">
            <div class="card">
                <div class="card-header">
                    <label for="type" class="form-label col-lg-2 col-sm-3 mx-2">Type:</label>
                    <select id="type" name="type" class="form-select col-9">
                        <option value="">Fish</option>
                        <option value="">Plant</option>
                    </select>
                </div>
                <div class="card-body">
                    <canvas id="singelBarChart" width="750" height="500"></canvas>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-5 my-5">
            <div class="card">
                <div class="card-header">
                    <label for="year" class="form-label col-sm-3 col-lg-1">Year:</label>
                    <input id="year" type="text" name="year" placeholder="year" class="form-control col-sm-7 col-lg-12">
                </div>
                <div class="card-body">
                    <canvas id="monthly" width="750" height="500"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<script src=<?php echo base_url("assets/js/Chart.js"); ?>></script>
<script src=<?php echo base_url("assets/js/chart.min.js"); ?>></script>
<script>
    var month_identifier = <?php echo json_encode($monthly_identifier) ?>;
    var month_value = <?php echo json_encode($monthly_value) ?>;

    var year = <?php echo json_encode($year); ?>;
    var sold = <?php echo json_encode($sold); ?>;
    var color = ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"];
    var ctx = document.getElementById("singelBarChart");

    ctx.height = 500;
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: year,
            datasets: [
                {
                    label: "Quantity of Fish Sold",
                    data: sold,
                    borderWidth: "0",
                    backgroundColor: color
                }
            ]
        },
        options: {
            scales: {
                yAxis: [{
                    ticks: {
                        beginAtZero: true
                    }
                }],
            }
        }
    });

    // Monthly
    var monthly = document.getElementById("monthly");

    monthly.height = 500;
    var myChart = new Chart(monthly, {
        type: 'bar',
        data: {
            labels: month_identifier,
            datasets: [
                {
                    label: "Quantity of Fish Sold by month",
                    data: month_value,
                    borderWidth: "0",
                    backgroundColor: color[2]
                }
            ]
        },
        options: {
            scales: {
                yAxis: [{
                    ticks: {
                        beginAtZero: true
                    }
                }],
            }
        }
    });

</script>