<div class="container-fluid mb-5">
    <div class="row">
        <div class="row title">
            <h3 class="text-center">
                Statistics of Fish Sold:
                <?php if(isset($_GET['id_fish'])){
                    echo $_GET['id_fish'];
                } ?>
            </h3>
        </div>
    </div>
    <div class="row m-auto">
        <div class="row m-auto">
            <div class="col-5 offset-1">
                <div class="card">
                    <div class="card-body">
                        <canvas id="singelBarChart" width="750" height="500"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="card">
                    <div class="card-body">
                        <canvas id="monthly" width="750" height="500"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row m-auto mt-5">
            <div class="col-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <canvas id="monthly_this_year" width="750" height="300"></canvas>
                    </div> 
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
    var month = <?=json_encode($month)?>;

    var quantity_sold = <?=json_encode($quantity_sold)?>;
    console.log(month);
    console.log(quantity_sold);

    var year = <?php echo json_encode($year); ?>;
    var sold = <?php echo json_encode($sold); ?>;
    var color = ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"];
    var ctx = document.getElementById("singelBarChart");

    var ctx = document.getElementById("singelBarChart");

    ctx.height = 500;
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: year,
            datasets: [
                {
                    data: sold,
                    borderWidth: "0",
                    backgroundColor: color
                }
            ]
        },
        options: {
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // Monthly
    var monthly = document.getElementById("monthly");

    monthly.height = 500;
    var myChart = new Chart(monthly, {
        type: 'line',
        data: {
            labels: month_identifier,
            datasets: [
                {
                    label: "Quantity of Fish Sold by month",
                    data: month_value,
                    borderWidth: "0",
                    backgroundColor: color[2],
                    spanGaps: true
                }
            ]
        },
        options: {

        }
    });

        // Monthly
    var monthly_this_year = document.getElementById("monthly_this_year");

    monthly.height = 500;
    var myChart = new Chart(monthly_this_year, {
        type: 'bar',
        data: {
            labels: month,
            datasets: [
                {
                    label: "Quantity of Fish Sold by month this year",
                    data: quantity_sold,
                    borderWidth: "0",
                    backgroundColor: color[1],
                    spanGaps: true
                }
            ]
        },
        options: {

        }
    });

</script>
