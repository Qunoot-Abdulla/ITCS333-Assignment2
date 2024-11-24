<!--a PHP application that retrieves and displays UOB student nationality data from the Bahrain Open Data Portal using their public API.
    The PHP file is done by Qunoot Sayed Mahdi Khalil Ali Abdulla (202209102)-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/pico.css">
    <link rel="stylesheet" href="Style.css">
    <title>University of Bahrain Students Enrollment by Nationality</title>
</head>
<body>
    <h1>University of Bahrain Students Enrollment by Nationality</h1>
    <?php
    //Define the URL for the API endpoint
    $URL = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";
    // Fetch the data from the API
    $response = file_get_contents($URL);
    // Decode the JSON response into an associative array
    $result = json_decode($response, true);
    // Check if data was retrieved successfully
    if ($result) {
        // Start the HTML table
        echo '<table>';
        echo '<thead>';
        // Table headers
        echo '<tr><th>Year</th><th>Semester</th><th>The Program</th><th>Nationality</th><th>College</th><th>Number of Students</th></tr>';
        echo '</thead>';
        echo '<tbody>';
        // Iterate through each record and display the data in table rows
        foreach ($result['results'] as $record) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($record['year']) . '</td>';
            echo '<td>' . htmlspecialchars($record['semester']) . '</td>';
            echo '<td>' . htmlspecialchars($record['the_programs']) . '</td>';
            echo '<td>' . htmlspecialchars($record['nationality']) . '</td>';
            echo '<td>' . htmlspecialchars($record['colleges']) . '</td>';
            echo '<td>' . htmlspecialchars($record['number_of_students']) . '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        // End the HTML table
        echo '</table>'; 
    } else {
        // Display a message if no data is available
        echo '<p>No data available.</p>'; 
    }
    ?>
</body>
</html>