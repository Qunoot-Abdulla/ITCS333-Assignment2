<!--a PHP application that retrieves and displays UOB student nationality data from the Bahrain Open Data Portal using their public API.-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/pico.css">
    <title>UOB Student Nationality Data</title>
</head>
<body>
    <h1>UOB Student Nationality Data</h1>
    <?php
    // PHP code to retrieve and process data
    $URL = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";
    $response = file_get_contents($URL);
    $result = json_decode($response, true);
    if ($result) {
        // Start the table
        echo '<table>';
        echo '<thead>';
        echo '<tr><th>Year</th><th>Semester</th><th>Nationality</th><th>Number of Students</th></tr>';
        echo '</thead>';
        echo '<tbody>';

        // Loop through the results and output each record
        foreach ($result['results'] as $record) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($record['year']) . '</td>';
            echo '<td>' . htmlspecialchars($record['semester']) . '</td>';
            echo '<td>' . htmlspecialchars($record['nationality']) . '</td>';
            echo '<td>' . htmlspecialchars($record['number_of_students']) . '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>'; // End the table
    } else {
        echo '<p>No data available.</p>'; // Handle case where no data is returned
    }
    ?>
</body>
</html>