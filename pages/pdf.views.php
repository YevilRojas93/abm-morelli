<?php 
ob_end_clean();
require_once("php/conexion.php");
$sql = Conexion::conectar()->prepare("SELECT * FROM agencias INNER JOIN usuarios ON usuarios.idUsuario = agencias.idUsuario");
$sql->execute();
$resultado = $sql->fetchAll();
require("tcpdf/tcpdf.php");

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Yevil Rojas');
$pdf->SetTitle('TCPDF Example 001');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
/*$pdf->SetHeaderData();
$pdf->setFooterData();

// set header and footer fonts
$pdf->setHeaderFont();
$pdf->setFooterFont();*/

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(8, 5, 10, true); // set the margins 
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 12, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();


// Set some content to print
$html = '
<style>
body{
	font-family: monospace;
	padding:0px 15px;
}
p,h4,span,div{
	text-align:center;
	font-size: 12px;
}
h3{
	width:100%;
	margin:auto;
	display:block;
}
th{
	color:blue;
}
td{

}
table,section{
  width:100%;
}
table,table td,table tr,table th{
  border-width: 0px; 
}
table tr td:first-child {
  border-left: 0;
}
table tr:last-child td {
  border-bottom: 0;
}
table tr td:last-child {
  border-right: 0;
}
table tr td{
	padding: 10px 20px;
}
</style>
	<section>
	<h3>LISTA DE AGENCIAS</h3>
	</br></br>
		<table>
			<tr>
				<th>ID agencia</th>
				<th>Nombre agencia</th>
				<th>Direccion</th>
				<th>Localidad</th>
				<th>Telefono</th>
				<th>Agenciero</th>
			</tr>';
foreach ($resultado as $key => $value) {
	$html .= "
		<tr>
			<td>".$value["agencia_id"]."</td>
			<td>".$value["nombre_agencia"]."</td>
			<td>".$value["direccion"]."</td>
			<td>".$value["localidad"]."</td>
			<td>".$value["telefono"]."</td>
			<td>".$value["nombre_completo"]."</td>
		</tr>
	 ";
}

$html .= '</table>
	</section>';
// Print text using writeHTMLCell()
$pdf->writeHTML($html, true, false, true, false, '');

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
if (isset($_GET["status"]) AND $_GET["status"] == "D") {
	$pdf->Output('example_001.pdf', 'd');
}
else{
	$pdf->Output('example_001.pdf', 'I');
}

//============================================================+
// END OF FILE
//============================================================+
ob_end_flush();

 ?>