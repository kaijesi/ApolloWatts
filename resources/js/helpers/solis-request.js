// Function to post a the PVGIS form to the PvgisController
function getSolisResults(form, callback) {
    $.ajax({
        url: '/solis-results',
        method: 'POST',
        data: $(form).serialize(),
        success: function (response) {
            callback($.parseJSON(response));
        }
    });
}

// Function to generate a gauge chart
function generateGauge(userStation) {
    // Gauge Chart
    const ctx = document.getElementById('gaugeChart').getContext('2d');

    const capacity = userStation['capacity'];
    const power = userStation['power'];

    // Calculate the percentage
    const percentage = (power / capacity) * 100;

    const data = {
        datasets: [{
            data: [power, capacity - power],
            backgroundColor: [
                '#0C6DFD',
                '#c8c8c8'
            ],
            borderWidth: 0,
            circumference: 180,
            rotation: 270,
        }]
    };

    const config = {
        type: 'doughnut',
        data: data,
        options: {
            responsive: false,
            maintainAspectRatio: false,
            cutout: '80%', // Size of the hole
            plugins: {
                tooltip: {
                    enabled: true
                },
                legend: {
                    display: true
                }
            }
        }
    };

    const myGaugeChart = new Chart(ctx, config);
}

// Execute when document is loaded
$(document).ready(function () {
    // Execute on form submission
    $("#solis-form").submit(function (event) {

        event.preventDefault(); // Prevents the default form submission action

        // Get the solis data for the given installation
        let solisResults;
        getSolisResults(this, function (results) { // Using callback here so that execution waits for results to be received
            if (results) {
                solisResults = results['data']['page']['records']; // all Stations
                console.log(solisResults);
                // Find the user's station based on the name of the installation between ApolloWatts and Solis
                let nameValue = $("#installation-name").text();
                let userStation;
                for (const item of solisResults) {
                    if (item['stationName'] === nameValue) {
                        userStation = item;

                    }
                }

                // Generate Analytics
                // Gauge Chart
                generateGauge(userStation);
                $('#gauge-center-text').html(`<p><b>Current Power Generation: ${userStation['power']} kW </b></p>`);
                // KPIs
                const kpisContainer = $("#kpis");
                let kpisHTML = `
                <p><b>Station Name:</b> ${userStation['stationName']}</p>
                <p><b>Total Energy:</b> <b>${userStation['allEnergy']}</b> kWh</p>
                <p><b>Today's Energy:</b> <b>${userStation['dayEnergy']}</b> kWh</p>
                <p><b>Max Power:</b> <b>${userStation['capacity']}</b> kWp</p>
                <p><b>Current Weather:</b> <b>${userStation['condTxtD']}</b></p>
                `;
                kpisContainer.html(kpisHTML);


                // Show the charts canvas and scroll to it
                $('#solis-analytics').show();
                $('#solis-analytics').get(0).scrollIntoView();


            }
            else {
                $('#results-container').html('<div class="alert alert-warning my-4" role="alert">Error fetching results.</div>');
            }
        });
    });
});