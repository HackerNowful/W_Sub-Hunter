<?php
if (isset($_GET['type']) && isset($_GET['output'])) {
    $type = $_GET['type'];
    $output = urldecode($_GET['output']);    
    if ($type === 'txt') {
        // Convert the output to TXT format
        $txtData = "Attribute\tValue\n";
        preg_match_all('/\b(HostName|HostIP)\s*:\s*([^\n]+)/i', $output, $matches, PREG_SET_ORDER);
        foreach ($matches as $match) {
            $txtData .= $match[1] . "\t" . $match[2] . "\n";
        }
        header('Content-Type: text/plain');
        header('Content-Disposition: attachment; filename="scan_results.txt"');
        echo $txtData;
        exit();
    } elseif ($type === 'csv') {
        // Convert the output to CSV format
        $csvData = "Attribute,Value\n";
        preg_match_all('/\b(HostName|HostIP)\s*:\s*([^\n]+)/i', $output, $matches, PREG_SET_ORDER);
        foreach ($matches as $match) {
            $csvData .= $match[1] . "," . $match[2] . "\n";
        }
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="scan_results.csv"');
        echo $csvData;
        exit();
    } 
if (isset($_GET['type']) && isset($_GET['output'])) {
    $type = $_GET['type'];
    $output = urldecode($_GET['output']);

    if ($type === 'pdf') {
        // Generate a PDF file using TCPDF
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');
        $pdf->SetCreator('DMitry Scan');
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('Scan Results');
        $pdf->SetMargins(15, 15, 15);
        $pdf->SetAutoPageBreak(true, 15);

        $pdf->AddPage();
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Cell(0, 10, 'Scan Results', 0, 1, 'C');

        $pdf->SetFont('helvetica', '', 10);
        $pdf->SetFillColor(230, 230, 230);
        $pdf->Cell(45, 7, 'Attribute', 1, 0, 'C', 1);
        $pdf->Cell(45, 7, 'Value', 1, 1, 'C', 1);

        preg_match_all('/\b(HostName|HostIP)\s*:\s*([^\n]+)/i', $output, $matches, PREG_SET_ORDER);
        foreach ($matches as $match) {
            $pdf->Cell(45, 7, $match[1], 1, 0, 'L');
            $pdf->Cell(45, 7, $match[2], 1, 1, 'L');
        }

        $pdf->Output('scan_results.pdf', 'D');
        exit();
    }
}  
    }
}
