<?php
ini_set('max_execution_time', '300');
include_once("connection.php");
// Include the main TCPDF library (search for installation path).
require_once('tcpdf/tcpdf.php');

class CustomTCPDF extends TCPDF {
    //Page header
public function Header() {
        $this->SetY(16);
        $image_file = K_PATH_IMAGES.'logo_example.jpg';
        $this->Image($image_file, 10, 10, 16, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $this->SetFont('helvetica', 'B', 20);
        $this->SetFont('helvetica', '', 12);
        $this->Cell(0, 10, 'SUNLIGHT ENERGY', 'B', 0, 'L', 0, '', 0, false, 'M', 'M');
        $this->Ln(6); 
        


    }

    // Page footer
    public function Footer() {
        // Position at 16 mm from bottom
        $this->SetY(-16);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Foglio '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

$pdf = new CustomTCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);



// set document information
$pdf->SetCreator('SUNLIGHT ENERGY');
$pdf->SetAuthor('');
$pdf->SetTitle('rapporto di intervento');
$pdf->SetSubject('');
$pdf->SetKeywords('');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
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




$pdf->SetFont('helvetica', '', 13);

// add a page
$pdf->AddPage();

$pdf->Ln(17);
// set cell margins
$pdf->setCellMargins(1, 1, 1, 1);
$pdf->Cell(180, 6, 'rapporto di intervento', 0, 1, 'C', 0);
$pdf->Ln(16);


$pdf->setCellMargins(0, 0, 0, 0);


if (isset($_POST['id'])) {
    $id_desejado = $_POST['id'];
    $respostas = "SELECT * FROM tabela WHERE chave = $id_desejado";
    $res = mysqli_query($conexao, $respostas);

    if ($res) {
        while ($row_res = mysqli_fetch_assoc($res)) {
            // Restante do código do PDF para esse ID específico

// Linha 1
$pdf->SetFillColor(255,242,204);
            $pdf->MultiCell(45, 8, "Intervento n.:", 0, 'L', 0, 0, '', '', true);
            $pdf->MultiCell(45, 8, $row_res['chave'], 0, 'L', 0, 0, '', '', true);
            $pdf->Ln(6); 
            $pdf->MultiCell(45, 8, "Impianto:", 0, 'L', 0, 0, '', '', true);
            $pdf->MultiCell(45, 8, "Spirano", 0, 'L', 0, 0, '', '', true);
            $pdf->Ln(6);
 

// Linha 2
$pdf->MultiCell(45, 8, "Manutenzione:", 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(45, 8, "Straordinaria", 0, 'L', 0, 0, '', '', true);
$pdf->Ln(6);
//$pdf->MultiCell(45, 8, "Inverter:", 0, 'L', 0, 0, '', '', true);
//$pdf->MultiCell(45, 8, "2", 0, 'L', 0, 0, '', '', true);
//$pdf->Ln(6);
$pdf->MultiCell(45, 8, "Girassole:", 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(45, 8, $row_res['id'], 0, 'L', 0, 0, '', '', true);
$pdf->Ln(6);

$re = $row_res['data_hora'];
$timestamp = strtotime($re);
$new_datetime = date("d-m-Y H:i", $timestamp);
$new_date_finale = date("d-m-Y", $timestamp);
$pdf->MultiCell(45, 8, "Inizio data/ore :", 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(45, 8,"$new_datetime", 0, 'L', 0, 0, '', '', true);
$pdf->Ln(6);
$pdf->MultiCell(45, 8, "Fine data/ore :", 0, 'L', 0, 0, '', '', true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($row_res['risultato_finale'] === 'Riparato - Servizo chiuso') {
        $pdf->MultiCell(45, 8, "$new_date_finale", 0, 'L', 0, 0, '', '', true);}
 else 
{
    $pdf->MultiCell(65, 8,$row_res['risultato_finale'], 0, 'L', 0, 0, '', '', true);
}}
$pdf->Ln(26);

$pdf->SetFillColor(192,192,192); // Define a cor de fundo como (255, 255, 238)
$pdf->MultiCell(180, 6, 'descrizione del problema', 0, 'C', 1);
$pdf->Ln(0); 
$pdf->SetFillColor(255, 255, 255); // Cor de fundo branca

$pdf->MultiCell(180, 16, "\n".$row_res['problema'], 0, 'L', 0, 0, '', '', true, 0, false, true, 16, 'T', 'M');
$pdf->Ln(40); // Adicione uma margem após a célula


//Linha 8
$pdf->SetFillColor(192,192,192); // Define a gray background color (you can adjust the RGB values as needed)
$pdf->MultiCell(180, 6, 'descrizione di Lavoro', 0, 'C', 1);
$pdf->Ln(0);
$pdf->SetFillColor(255, 255, 255); // Volta para a cor de fundo branca
$pdf->MultiCell(180, 16, "\n".$row_res['solucao'], 0, 'L', 0, 0, '', '', true);
$pdf->Ln(40);





}
}
}


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// move pointer to last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_006.pdf', 'I');


//============================================================+
// END OF FILE
//============================================================+
