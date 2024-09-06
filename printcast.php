<?php
// Thermal Bondpaper Size
include 'includes/session.php';
include 'includes/conn.php';
$voterID = $_SESSION['voter'];
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function generateRow($conn, $voterID)
{
    $content = ''; // Start with an empty string

    // Modify the SQL query to include a condition that matches the voter's ID
    $sql = "SELECT candidates.fullname AS canlast, positions.description AS position_desc 
            FROM votes 
            LEFT JOIN positions ON positions.id=votes.position_id 
            LEFT JOIN candidates ON candidates.id=votes.candidate_id 
            LEFT JOIN voters ON voters.id=votes.voters_id 
            WHERE voters.id = $voterID 
            ORDER BY positions.priority ASC";
    $query = $conn->query($sql);
    $current_voter = null;
    $first = true;

    while ($row = $query->fetch_assoc()) {
        $content .= "
            <tr>    
                <td style='font-size: 5px;'>" . $row['position_desc'] .  "</td>
                <td style='font-size: 5px;'>" . $row['canlast'] . "</td>
            </tr>
        ";
    }

    return $content; // Return the generated HTML content
}

require_once('tcpdf/tcpdf.php');

// Date and TIME based on the location
date_default_timezone_set('Asia/Manila');

// Extend the TCPDF class to create a custom header
class MYPDF extends TCPDF
{
    // Page header
    public function Header()
    {
        $this->SetY(-20);
        // Set font
        $this->SetFont('helvetica', 'B', 14);
        // Page number
        $this->Cell(0, 10, 'Date' . ' | ' . date('Y-m-d H:i:s'), 0, 0, 'C');
    }
}

// Set the custom size for the thermal printer (58mm width)
$pdf = new MYPDF('P', PDF_UNIT, array(110, 150), true, 'UTF-8', false); // Custom size paper: 58mm x 210mm
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle('Result: ');
$pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, 'B', 10)); // Adjusted font size for header
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', 10)); // Adjusted font size for footer
$pdf->SetDefaultMonospacedFont('helvetica');
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetMargins(1, '5', 1); // Adjusted margins for custom width
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetAutoPageBreak(TRUE, 10); // Adjust page break for custom size
$pdf->SetFont('helvetica', 'B', 16); // Adjusted font size for main content
$pdf->AddPage();

// Get the voter ID from the session
$voterID = $_SESSION['voter'];

if (!$voterID) {
    die("No voter ID found.");
}

// Add voter information at the top
$voterName = ''; // Initialize a variable to store the voter's name

$sql = "SELECT studentid FROM voters WHERE id = $voterID";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $voterName = $row['studentid'];
}

// Add voter name at the top
$content = '';
$content .= '<h4 align="center" style="font-size: 15px;">Casted Votes</h4>';
$content .= "<h5 align='left' style='font-size: 12px;'>Student ID: " . $voterName . "</h5>"; // Display voter name

// Add table with positions and candidates
$content .= '
    <table border="1" cellspacing="0" cellpadding="2" style="width: 100%;">  
        <thead>
            <tr>
                <th width="50%" style="font-size: 14px;">Positions</th>
                <th width="50%" style="font-size: 14px;">Candidates</th>
            </tr>
        </thead>
        <tbody>
';

$content .= generateRow($conn, $voterID); // Generate the rows of the table for the specified voter
$content .= '</tbody></table>';

// Output the content into the PDF
$pdf->writeHTML($content, true, false, true, false, '');

// Move down 5mm from the end of the table
$pdf->SetY($pdf->GetY() + 20);

// Set font size and bold for the signature line and text
$pdf->SetFont('helvetica', 'B', 12);

// Draw the voter's signature line
$pdf->Line(1, $pdf->GetY(), 34, $pdf->GetY()); // Line for voter's signature (half width)

// Add the voter's signature text below the line
$pdf->SetY($pdf->GetY() + 2); // Move 2mm down from the line
$pdf->Cell(37, 1, 'Voter\'s Signature', 0, 0, 'L');

// Move back up and to the right for the assessor's signature
$pdf->SetY($pdf->GetY() - 2); // Move back up 2mm
$pdf->SetX(40); // Move to the right side for the assessor's signature

// Draw the assessor's signature line
$pdf->Line(53, $pdf->GetY(), 105, $pdf->GetY()); // Line for assessor's signature (half width)

// Add the assessor's signature text below the line
$pdf->SetY($pdf->GetY() + 2); // Move 2mm down from the line
$pdf->SetX(45); // Adjust X position again
$pdf->Cell(37, 1, 'Assessor\'s Name &  Signature', 0, 0, 'L');

// Output the PDF document
$pdf->Output('election_result.pdf', 'I');
