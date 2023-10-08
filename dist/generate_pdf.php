<?php
require('fpdf181/fpdf.php'); // Inclure la bibliothèque FPDF

// Créer une instance de la classe FPDF
$pdf = new FPDF();
$pdf->AddPage();

// Ajouter du contenu au PDF
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'Nom', 1);
$pdf->Cell(40, 10, 'Prénom', 1);
$pdf->Cell(40, 10, 'Numéro de carte d\'identité', 1);

// Remplacez ceci par votre boucle pour afficher les enregistrements
$enregistrements = [
    ["Nom1", "Prénom1", "12345"],
    ["Nom2", "Prénom2", "67890"],
    // Ajoutez d'autres enregistrements ici
];

foreach ($enregistrements as $enregistrement) {
    $pdf->Ln();
    foreach ($enregistrement as $colonne) {
        $pdf->Cell(40, 10, $colonne, 1);
    }
}

// Sortie du PDF en tant que fichier
$pdf->Output('D', 'liste_enregistrements.pdf'); // Téléchargez le PDF
?>
