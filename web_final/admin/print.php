<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2018-11-25
 * Time: 01:11 AM
 */
include ('datafetching.php');
include ('../connection.php');

if(isset($_POST["pdf_Person"]))
{
    $id = $_POST['id'];
    require_once('tcpdf/tcpdf.php');
    $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $obj_pdf->SetCreator(PDF_CREATOR);
    $obj_pdf->SetTitle("APPlY Data FOR ID");
    $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
    $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    $obj_pdf->SetDefaultMonospacedFont('helvetica');
    $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);
    $obj_pdf->setPrintHeader(false);
    $obj_pdf->setPrintFooter(false);
    $obj_pdf->SetAutoPageBreak(TRUE, 10);
    $obj_pdf->SetFont('helvetica', '', 10);
    $obj_pdf->AddPage();
    $content = '';
    $content .= '  
      <h3 align="center">APPlY Data FOR ID :'.$id.'</h3><br /><br />  
      <table border="1" cellspacing="0" cellpadding="5">  
           <tr>  
                <th width="15%">JobCode</th>  
                <th width="25%">Position</th>  
                <th width="25%">ClosingDate</th>  
                <th width="35%">Description</th>   
           </tr>  
      ';
    $content .= data_fetch2($db,$id);
    $content .= '</table>';
    $obj_pdf->writeHTML($content);
    $obj_pdf->Output('PersonData.pdf', 'I');
}
if(isset($_POST["pdf_Job"]))
{
    $JobCode = $_POST['JobCode'];
    require_once('tcpdf/tcpdf.php');
    $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $obj_pdf->SetCreator(PDF_CREATOR);
    $obj_pdf->SetTitle("Person Data FOR JobCode");
    $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
    $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    $obj_pdf->SetDefaultMonospacedFont('helvetica');
    $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);
    $obj_pdf->setPrintHeader(false);
    $obj_pdf->setPrintFooter(false);
    $obj_pdf->SetAutoPageBreak(TRUE, 10);
    $obj_pdf->SetFont('helvetica', '', 10);
    $obj_pdf->AddPage();
    $content = '';
    $content .= '  
      <h3 align="center">Person Data FOR JobCode :'.$JobCode.'</h3><br /><br />  
      <table border="1" cellspacing="0" cellpadding="5">  
           <tr>  
                <th width="10%">ID</th>  
                <th width="20%">Name</th>  
                <th width="20%">E-Mail</th>  
                <th width="10%">Gender</th>   
                <th width="15%">Contact</th> 
                <th width="25%">Address</th> 
           </tr>  
      ';
    $content .= data_fetch($db,$JobCode);
    $content .= '</table>';
    $obj_pdf->writeHTML($content);
    $obj_pdf->Output('JobData.pdf', 'I');
}