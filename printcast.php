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
                <td style='font-size: 5px;'>" . $row['canlast'] . "</td>
                <td style='font-size: 5px;'>" . $row['position_desc'] . "</td>
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

// Add time and Cast Results header
$content = '';
$content .= '
    <h4 align="center" style="font-size: 15px;">Casted Votes</h4> <!-- Smaller font size for the subtitle -->
    <table border="1" cellspacing="0" cellpadding="2" style="width: 100%;">  
        <thead>
            <tr>
                <th width="33.3%" style="font-size: 14px;">Voter</th> <!-- Adjusted font size for table headers -->
                <th width="33.3%" style="font-size: 14px;">Candidate</th>
                <th width="33.3%" style="font-size: 14px;">Position</th>
            </tr>
        </thead>
        <tbody>
';

$content .= generateRow($conn, $voterID); // Generate the rows of the table for the specified voter
$content .= '</tbody></table>';

// Output the content into the PDF
// Write the HTML content
// Write the HTML content
$pdf->writeHTML($content, true, false, true, false, '');

// Move down 5mm from the end of the table
$pdf->SetY($pdf->GetY() + 5);

// Set font size and bold for the signature line and text
$pdf->SetFont('helvetica', 'B', 10);

// Draw the voter's signature line
$pdf->Line(1, $pdf->GetY(), 34, $pdf->GetY()); // Line for assessor's signature (half width)

// Add the voter's signature text below the line
$pdf->SetY($pdf->GetY() + 2); // Move 2mm down from the line
$pdf->Cell(37, 1, 'Voter\'s Signature', 0, 0, 'L');

// Move back up and to the right for the voter's signature
$pdf->SetY($pdf->GetY() - 2); // Move back up 2mm
$pdf->SetX(40); // Move to the right side for the assesor's signature

// Draw the assesor's signature line
$pdf->Line(53, $pdf->GetY(), 105, $pdf->GetY()); // Line for assesor's signature (half width)

// Add the assesor's signature text below the line
$pdf->SetY($pdf->GetY() + 2); // Move 2mm down from the line
$pdf->SetX(53); // Adjust X position again
$pdf->Cell(37, 1, 'Assessor\'s Name &  Signature', 0, 0, 'L');

// Output the PDF document
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