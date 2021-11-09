<?php
// Include autoloader
// require_once 'dompdf/autoload.inc.php';
require_once 'ImageBase64.php';

// Reference the DOM Namespace
use Dompdf\Dompdf;

class GenerateTicket {

    private Dompdf $dompdf;
    private ImageBase64 $imageBase64;

    function __construct()
    {
        $this->dompdf = new Dompdf();

        $this->imageBase64 = new ImageBase64();
        
    }

    function run() {

        $logo = __DIR__ . '/../assets/img/macon-logo.png';

        // Later create a separate function to return session values
        $seats = isset($_SESSION['seats']) ? $_SESSION['seats'] : '0';
        $origin = isset($_SESSION['origin']) ? $_SESSION['origin'] : '-------';
        $destination = isset($_SESSION['destination']) ? $_SESSION['destination'] : '-------';
        $departureDate = isset($_SESSION['departure']) ? $_SESSION['departure'] : '-------';
        $reservationCode = isset($_SESSION['reservationCode']) ? $_SESSION['reservationCode'] : '-------';
        $price = isset($_SESSION['price']) ? $_SESSION['price'] : '0Kzs';

        $htmlData = <<<HTML
            <div style="text-align:center;">
                <img src="data:image/png;base64,{$this->imageBase64->generateBase64($logo)}" />
            </div>
            <h1 style="
                text-align: center; 
                color: #172b4d; 
                font-size: 25; 
                font-family: Arial, Helvetica, sans-serif;
                padding-top: 30px;
                ">
                TICKET PARA VIAGEM
            </h1>

            <div>
                <div style="padding-bottom: 10px; font-size: 20px;">
                    <strong>Reserva efectuada de</strong> 
                        {$seats} 
                    <strong>lugares.</strong>
                </div>

                <div style="padding-bottom: 10px; font-size: 20px;">
                    <strong>Trajecto</strong> {$origin} - {$destination}. 
                </div>

                <div style="padding-bottom: 10px; font-size: 20px;">
                    <strong>Data De Partida:</strong> {$departureDate}. 
                </div>

                <div style="padding-bottom: 10px; font-size: 20px;">
                    <strong>Custo:</strong> {$price}
                </div>

                <div style="padding-bottom: 10px; font-size: 20px;">
                    <strong>Código da reserva:</strong> {$reservationCode}
                </div>
            </div>
        HTML;

        $this->dompdf->loadHtml($htmlData);

        // (Optional) Setup the paper size and orientation
        $this->dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $this->dompdf->render();

        // Output the generated PDF to Browser and open in browser tab
        $this->dompdf->stream('ticket.pdf', array("Attachment" => false));

        session_destroy();
    }
}