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
    $sql = "SELECT voters.fullname AS votlast, candidates.fullname AS canlast, positions.description AS position_desc 
            FROM votes 
            LEFT JOIN positions ON positions.id=votes.position_id 
            LEFT JOIN candidates ON candidates.id=votes.candidate_id 
            LEFT JOIN voters ON voters.id=votes.voters_id 
            WHERE voters.id = $voterID 
            ORDER BY voters.fullname, positions.priority ASC";
    $query = $conn->query($sql);
    $current_voter = null;
    $first = true;
    while ($row = $query->fetch_assoc()) {
        if ($row['votlast'] != $current_voter) {
            if (!$first) {
                $content .= "</tbody>"; // Close the previous voter's candidate rows
            }
            $current_voter = $row['votlast'];
            $first = false;
            $content .= "
                <tr class='voter-row'>
                    <td colspan='3'><strong>" . $row['votlast'] . "</strong></td>
                </tr>
                <tbody class='candidate-rows'>
            ";
        }
        $content .= "
            <tr>
                <td></td> <!-- Empty cell under voter name -->
                <td>" . $row['canlast'] . "</td>
                <td>" . $row['position_desc'] . "</td>
            </tr>
        ";
    }
    $content .= "</tbody>"; // Close the last voter's candidate rows

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
        if ($this->getPage() == 1) {
            // Set font
            $this->SetFont('helvetica', 'I', 6); // Smaller font size for header
            // Title
            $this->Cell(0, 10, date('Y-m-d H:i:s'), 0, 1, 'L');
        }
    }
}

// Set the custom size for the thermal printer (58mm width)
$pdf = new MYPDF('P', PDF_UNIT, array(58, 200), true, 'UTF-8', false); // 200mm is an arbitrary height; adjust as needed
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle('Result: ');
$pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', 6)); // Smaller font size for header
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', 6)); // Smaller font size for footer
$pdf->SetDefaultMonospacedFont('helvetica');
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT); // Reduced margins for thermal printing
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetAutoPageBreak(TRUE, 10);
$pdf->SetFont('helvetica', '', 7); // Smaller font size for main content
$pdf->AddPage();

// Get the voter ID from the session
$voterID = $_SESSION['voter'];

if (!$voterID) {
    die("No voter ID found in session.");
}

$content = '';
$content .= '
    <h2 align="center" style="font-size: 8px;">Cast Results</h2> <!-- Smaller font size for the title -->
    <h4 align="center" style="font-size: 5px;">Casted Votes</h4> <!-- Smaller font size for the subtitle -->
    <table border="1" cellspacing="0" cellpadding="2">  
        <thead>
            <tr>
                <th width="33.3%" style="font-size: 5px;">Voter</th> <!-- Smaller font size for table headers -->
                <th width="33.3%" style="font-size: 4px;">Candidate</th>
                <th width="33.3%" style="font-size: 4px;">Position</th>
            </tr>
        </thead>
        <tbody>
';

$content .= generateRow($conn, $voterID); // Generate the rows of the table for the specified voter
$content .= '</tbody></table>';

// Output the content into the PDF
$pdf->writeHTML($content, true, false, true, false, '');

// Add the signature line and text at the bottom of the page
$pdf->SetY(-40); // Position the line 40mm from the bottom of the page
$pdf->SetFont('helvetica', '', 6); // Smaller font size for signature line and text

// Draw the line
$pdf->Line(10, $pdf->GetY(), 48, $pdf->GetY()); // Adjusted for 58mm width

// Add the text below the line
$pdf->SetY($pdf->GetY() + 5); // Move 5mm down from the line
$pdf->Cell(0, 10, 'Name & Signature of the Accesstor', 0, 1, 'L');

$pdf->Output('election_result.pdf', 'I');


// Normal Bond Paper Size 

// include 'includes/session.php';
// include 'includes/conn.php';
// $voterID = $_SESSION['voter'];
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


// function generateRow($conn, $voterID)
// {
//     $content = ''; // Start with an empty string

//     // Modify the SQL query to include a condition that matches the voter's ID
//     $sql = "SELECT voters.fullname AS votlast, candidates.fullname AS canlast, positions.description AS position_desc 
//             FROM votes 
//             LEFT JOIN positions ON positions.id=votes.position_id 
//             LEFT JOIN candidates ON candidates.id=votes.candidate_id 
//             LEFT JOIN voters ON voters.id=votes.voters_id 
//             WHERE voters.id = $voterID 
//             ORDER BY voters.fullname, positions.priority ASC";
//     $query = $conn->query($sql);
//     $current_voter = null;
//     $first = true;
//     while ($row = $query->fetch_assoc()) {
//         if ($row['votlast'] != $current_voter) {
//             if (!$first) {
//                 $content .= "</tbody>"; // Close the previous voter's candidate rows
//             }
//             $current_voter = $row['votlast'];
//             $first = false;
//             $content .= "
//                 <tr class='voter-row'>
//                     <td colspan='3'><strong>" . $row['votlast'] . "</strong></td>
//                 </tr>
//                 <tbody class='candidate-rows'>
//             ";
//         }
//         $content .= "
//             <tr>
//                 <td></td> <!-- Empty cell under voter name -->
//                 <td>" . $row['canlast'] . "</td>
//                 <td>" . $row['position_desc'] . "</td>
//             </tr>
//         ";
//     }
//     $content .= "</tbody>"; // Close the last voter's candidate rows

//     return $content; // Return the generated HTML content
// }

// require_once('tcpdf/tcpdf.php');

// // Date and tIME bASED ON THE LOCATION
// date_default_timezone_set('Asia/Manila');

// // Extend the TCPDF class to create a custom header
// class MYPDF extends TCPDF
// {
//     // Page header
//     public function Header()
//     {
//         if ($this->getPage() == 1) {
//             // Set font
//             $this->SetFont('helvetica', 'I', 10);
//             // Title
//             $this->Cell(0, 10, date('Y-m-d H:i:s'), 0, 1, 'L');
//         }
//     }
// }

// $pdf = new MYPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// $pdf->SetCreator(PDF_CREATOR);
// $pdf->SetTitle('Result: ');
// $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
// $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
// $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// $pdf->SetDefaultMonospacedFont('helvetica');
// $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
// $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);
// $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
// $pdf->SetAutoPageBreak(TRUE, 10);
// $pdf->SetFont('helvetica', '', 11);
// $pdf->AddPage();

// // Get the voter ID from the session
// $voterID = $_SESSION['voter'];

// if (!$voterID) {
//     die("No voter ID found in session.");
// }

// $content = '';
// $content .= '
//     <h2 align="center">Cast Results</h2>
//     <h4 align="center">Casted Votes</h4>
//     <table border="1" cellspacing="0" cellpadding="3">  
//         <thead>
//             <tr>
//                 <th width="33.3%">Voter</th>
//                 <th width="33.3%">Candidate</th>
//                 <th width="33.3%">Position</th>
//             </tr>
//         </thead>
//         <tbody>
// ';

// $content .= generateRow($conn, $voterID); // Generate the rows of the table for the specified voter
// $content .= '</tbody></table>';

// // Output the content into the PDF
// $pdf->writeHTML($content, true, false, true, false, '');

// // Add the signature line and text at the bottom of the page
// $pdf->SetY(-50); // Position the line 50mm from the bottom of the page
// $pdf->SetFont('helvetica', '', 11);

// // Draw the line
// $pdf->Line(15, $pdf->GetY(), 80, $pdf->GetY()); // X1, Y1, X2, Y2

// // Add the text below the line
// $pdf->SetY($pdf->GetY() + 5); // Move 5mm down from the line
// $pdf->Cell(0, 10, 'Name & Signature of the Accesstor', 0, 1, 'L');

// $pdf->Output('election_result.pdf', 'I');