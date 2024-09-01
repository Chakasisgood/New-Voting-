<?php
include 'includes/session.php';
include 'includes/conn.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function generateRow($conn)
{
    $contents = '';
    $sql = "SELECT * FROM positions ORDER BY priority ASC";
    $query = $conn->query($sql);

    while ($row = $query->fetch_assoc()) {
        $id = $row['id'];
        $contents .= '
            <tr>
                <td colspan="2" align="center" style="font-size:15px;"><b>' . $row['description'] . '</b></td>
            </tr>
            <tr>
                <td width="80%"><b>Candidates</b></td>
                <td width="20%"><b>Votes</b></td>
            </tr>
        ';

        $sql = "SELECT * FROM candidates WHERE position_id = '$id' ORDER BY fullname ASC";
        $cquery = $conn->query($sql);

        while ($crow = $cquery->fetch_assoc()) {
            $sql = "SELECT * FROM votes WHERE candidate_id = '" . $crow['id'] . "'";
            $vquery = $conn->query($sql);
            $votes = $vquery->num_rows;

            $contents .= '
                <tr>
                    <td>' . $crow['fullname'] .  '</td>
                    <td>' . $votes . '</td>
                </tr>
            ';
        }
    }

    return $contents;
}

$parse = parse_ini_file('config.ini', FALSE, INI_SCANNER_RAW);
$title = $parse['election_title'];

require_once('../tcpdf/tcpdf.php');

// Date and Time Based on the Location
date_default_timezone_set('Asia/Manila');


// Extend the TCPDF class to create a custom header
class MYPDF extends TCPDF
{
    // Page header
    public function Header()
    {
        if ($this->getPage() == 1) {
            // Set image file path
            $image_file = '../images/header.png'; // Assuming the image is stored in the images directory of TCPDF

            // Add the image as a header
            $this->Image($image_file, 10, 10, 190, '', 'PNG', '', 'T', false, 500, '', false, false, 0, false, false, false);

            // Set font
            $this->SetFont('helvetica', 'I', 8);

            // Add date on the header
            $this->SetY(30); // Adjust based on your header height
            $this->Cell(0, 30, date('Y-m-d H:i:s'), 0, 1, 'L');
        }
    }
}

// Create new PDF document
$pdf = new MYPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle('Result: ' . $title);
$pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont('helvetica');
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetMargins(PDF_MARGIN_LEFT, '50', PDF_MARGIN_RIGHT); // Adjust top margin to avoid overlap with header image
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetAutoPageBreak(TRUE, 10);
$pdf->SetFont('helvetica', '', 11);
$pdf->AddPage();

$content = '';
$content .= '
    <h2 align="center">' . $title . '</h2>
    <h4 align="center">Tally Result</h4>
    <table border="1" cellspacing="0" cellpadding="3">  
';
$content .= generateRow($conn);
$content .= '</table>';

// Output the content into the PDF
$pdf->writeHTML($content);

// Add the signature line and text at the bottom of the page
$pdf->SetY(-50); // Position the line 50mm from the bottom of the page
$pdf->SetFont('helvetica', '', 11);

// Draw the line
$pdf->Line(15, $pdf->GetY(), 80, $pdf->GetY()); // X1, Y1, X2, Y2

// Add the text below the line
$pdf->SetY($pdf->GetY() + 5); // Move 5mm down from the line
$pdf->Cell(0, 10, 'Name & Signature of SSG Adviser', 0, 1, 'L');

$pdf->Output('election_result.pdf', 'I');
