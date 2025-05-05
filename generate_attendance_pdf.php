<?php
require_once 'db_connection.php';
require('fpdf/fpdf.php'); // Include FPDF Library

// Fetch attendance data
$query = "SELECT * FROM teacher_attendance ORDER BY date DESC";
$result = $con->query($query);

// Generate PDF
if (isset($_POST['download_pdf'])) {
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(190, 10, 'Teacher Attendance Report', 1, 1, 'C');

    // Table Header
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(20, 10, 'ID', 1);
    $pdf->Cell(50, 10, 'Name', 1);
    $pdf->Cell(30, 10, 'In Time', 1);
    $pdf->Cell(30, 10, 'Out Time', 1);
    $pdf->Cell(30, 10, 'Date', 1);
    $pdf->Cell(30, 10, 'Status', 1);
    $pdf->Ln();

    // Fetch and display data
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(20, 10, $row['teacher_id'], 1);
        $pdf->Cell(50, 10, $row['name'], 1);
        $pdf->Cell(30, 10, $row['intime'], 1);
        $pdf->Cell(30, 10, $row['outtime'], 1);
        $pdf->Cell(30, 10, $row['date'], 1);
        $pdf->Cell(30, 10, $row['status'], 1);
        $pdf->Ln();
    }

    $pdf->Output('D', 'Teacher_Attendance_Report.pdf'); // Download PDF
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Attendance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Teacher Attendance Records</h2>
        <form method="POST">
            <button type="submit" name="download_pdf" class="btn btn-danger mb-3">Download PDF</button>
        </form>

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>In Time</th>
                    <th>Out Time</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $row['teacher_id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['intime']; ?></td>
                        <td><?php echo $row['outtime']; ?></td>
                        <td><?php echo $row['date']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
