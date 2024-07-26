<?php

namespace App\Console\Commands;

use TPDF as PDF;
use Storage;
use App\Form;
use App\Jobs\ProcessForm;
use Illuminate\Console\Command;

class SignPdf extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sign:pdf';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

      /* 
      Run the following command to export the private key: openssl pkcs12 -in certname.pfx -nocerts -out key.pem -nodes
      Run the following command to export the certificate: openssl pkcs12 -in certname.pfx -nokeys -out cert.pem
      */
      
      $form = Form::find(1);


      $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

      // set document information
      $pdf->SetCreator(PDF_CREATOR);
      $pdf->SetAuthor('Decor Empreendimentos');
      $pdf->SetTitle('APR ' . $form->id);
      $pdf->SetSubject('Avaliação e Prevenção de Riscos');
      $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

      // set default header data
      // $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 052', PDF_HEADER_STRING);

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

      // ---------------------------------------------------------

      /*
      NOTES:
      - To create self-signed signature: openssl req -x509 -nodes -days 365000 -newkey rsa:1024 -keyout tcpdf.crt -out tcpdf.crt
      - To export crt to p12: openssl pkcs12 -export -in tcpdf.crt -out tcpdf.p12
      - To convert pfx certificate to pem: openssl pkcs12 -in tcpdf.pfx -out tcpdf.crt -nodes
      */

      // set certificate file
      $certificate = 'file://' . storage_path() . DIRECTORY_SEPARATOR . 'certificados' . DIRECTORY_SEPARATOR . 'cert.pem';
      $pkey = 'file://' . storage_path() . DIRECTORY_SEPARATOR . 'certificados' . DIRECTORY_SEPARATOR . 'karine.pem';


      // set additional information
      $info = array(
        'Name' => $form->usuario->name,
        'Location' => 'Office',
        'Reason' => 'Testing TCPDF',
        'ContactInfo' => $form->usuario->email
      );

      // set document signature
      $pdf->setSignature($certificate, $pkey, '', '', 2, $info);
      // $pdf->setSignatureAppearance(0, 0, 100, 100, 1, 'SIGN');

      // set font
      $pdf->SetFont('helvetica', '', 12);

      // add a page
      $pdf->AddPage();

      // print a line of text
      $fotos = [];
      foreach ($form->fotos as $foto) {
  
          try {
            $file = Storage::get($foto->caminho_foto);
          } catch (Exception $e) {}
  
          $fotos[] = [
              'conteudo' => isset($file) ? base64_encode($file) : null,
              'descricao' => $foto->descricao,
              'location' => $foto->location,
              'horario' => $foto->horario,
          ];
      }
      $html = view('forms.impressao', compact('form', 'fotos'))->render();
      $pdf->writeHTML($html, true, 0, true, 0);

      // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
      // *** set signature appearance ***

      // create content for signature (image and/or text)
      // $pdf->Image('images/tcpdf_signature.png', 180, 60, 15, 15, 'PNG');

      // define active area for signature appearance
      $pdf->setSignatureAppearance(180, 60, 15, 15);

      // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

      // *** set an empty signature appearance ***
      // $pdf->addEmptySignatureAppearance(180, 80, 15, 15);

      // ---------------------------------------------------------

      //Close and output PDF document
      $q = $pdf->Output('/tmp/example_052.pdf', 'F');
      return;

      // $pdf = Storage::get('forms/34.pdf');
      // $signature = '';

      // $pemPath = 'file://' . storage_path() . DIRECTORY_SEPARATOR . 'certificados' . DIRECTORY_SEPARATOR . 'karine.pem';

      // $pkeyid = openssl_pkey_get_private($pemPath);

      // openssl_sign($pdf, $signature, $pkeyid);
      // openssl_free_key($pkeyid);

      // $this->info($signature);
    }
}
