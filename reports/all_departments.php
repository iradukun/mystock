<?php
require_once '../bootstrap.php';
//authentication
LogInCheck();

function generateRow(){
    $contents = '';
    include_once('../db.php');
    $sql = "SELECT * FROM `department`";
    $query = $conn->query($sql);
    $i = 1;
    while($row = $query->fetch_assoc()){
        $contents .= "
			<tr><td>".$i."</td>
				<td>".$row['dept_id']."</td>
				<td>".$row['dept_name']."</td>
				<td>".$row['dept_details']."</td>
				<td>".$row['added_at']."</td>
			</tr>
			";
        $i++;
    }

    return $contents;
}

require_once('../lib/tcpdf/tcpdf.php');
$pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle("dept list");
$pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont('helvetica');
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetAutoPageBreak(TRUE, 10);
$pdf->SetFont('helvetica', '', 10);
$pdf->AddPage();
$content = '';
$content .= '
        <div>
      	<h2 align="center">ALL DEPARTMENTS IN THE SYSTEM</h2>
      	<h4>GENERATED BY admin</h4>
      	<h4>'. date('d-m-y H:i:s') .'</h4>
      	<table border="1" cellspacing="0" cellpadding="3">  
           <tr> 
                <th width="10%"><i>SLNO</i></th> 
                <th width="10%"><i>ID</i></th>
				<th width="30%"><i>DEPT NAME</i></th>
				<th width="30%"><i>DETAILS</i></th>
				<th width="20%"><i>ADDED AT</i></th>
           </tr>
           
            
      ';
$content .= generateRow();
$content .= '</table>';
$pdf->writeHTML($content);
$pdf->Output('dept_list.pdf', 'I');
$conn->close();
$_SESSION['success'] = 'Report generated successfully';
header('location: ../items.php');
