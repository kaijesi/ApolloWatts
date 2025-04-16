// Function to post a the PVGIS form to the PvgisController
function getPvgisResults(form, callback) {
    $.ajax({
        url: '/pvgis-results', // The Laravel route
        method: 'POST',
        data: $(form).serialize(), // Serialize the form data
        success: function (response) {
            callback($.parseJSON(response));
        }
    });
}

// Function to render a bar chart with projected energy production
function renderBarChart(data) {

    // Month names
    const monthNames = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];

    // Extract the month labels and E_m data
    const months = data.map(item => monthNames[item.month - 1]); // x axis
    const energyProduction = data.map(item => item.E_m); // y axis
    console.log(months, energyProduction);

    // Create the chart
    const ctx = document.getElementById('pvgisMonthlyChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: months,
            datasets: [{
                label: 'Energy Production (kWh)',
                data: energyProduction,
                backgroundColor: '#0C6DFD'
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Energy Production (kWh)'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Month'
                    }
                }
            },
            responsive: false,
            maintainAspectRatio: false
        }
    });

}

// Execute when document is loaded
$(document).ready(function () {
    $("#pvgis-form").submit(function (event) {

        // Show the charts canvas and scroll to it
        $('#pvgisMonthlyChart').show();
        $('#pvgisMonthlyChart').get(0).scrollIntoView();

        event.preventDefault(); // Prevents the default form submission action

        // Get the PVGIS data for the given installation
        let pvgisResults;
        getPvgisResults(this, function (results) { // Using callback here so that execution waits for results to be received
            if (results) {
                console.log(results);
                pvgisResults = results;
                // Render the bar chart for monthly production
                console.log(pvgisResults['outputs']['monthly']['fixed']);
                renderBarChart(pvgisResults['outputs']['monthly']['fixed']);
            }
            else {
                $('#results-container').html('<div class="alert alert-warning my-4" role="alert">Error fetching results.</div>');
            }
        });
    });
});