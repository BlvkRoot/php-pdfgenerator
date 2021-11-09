<?php
    // Composer autoloader
    require_once 'vendor/autoload.php';

    // Include autoloader
    // require_once 'dompdf/autoload.inc.php';

    // Reference the DOM Namespace
    use Dompdf\Dompdf;


    $dompdf = new Dompdf();

    $logo = __DIR__ . '/macon-logo.png';

    $htmlData = <<<HTML
        <h1 style="
            text-align: center; 
            color: #172b4d; 
            font-size: 25; 
            font-family: Arial, Helvetica, sans-serif;">
            TICKET PARA VIAGEM
        </h1>

        <div>
            <div style="padding-bottom: 10px;">
                Reserva efectuada de 2 lugares.
            </div>

            <div style="padding-bottom: 10px;">
                Trajecto LUANDA - BIÉ. 
            </div>

            <div style="padding-bottom: 10px;">
                Data De Partida: 2021-11-09. 
            </div>

            <div style="padding-bottom: 10px;">
                Custo: 520.235.00Kzs 
            </div>

            <div style="padding-bottom: 10px;">
                Código da reseva: macon-abd9038-00
            </div>
        </div>
    HTML;

    $dompdf->loadHtml($htmlData);

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'landscape');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser and open in browser tab
    $dompdf->stream('ticket.pdf', array("Attachment" => false));

