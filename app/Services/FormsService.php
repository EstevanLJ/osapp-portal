<?php

namespace App\Services;

use PDF;
use App\Form;
use App\FormFoto;
use Exception;
use Storage;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

class FormsService
{

  public static function generatePdf(Form $form)
  {

    $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor($form->usuario->name);
    $pdf->SetTitle('APR ' . $form->id);
    $pdf->SetSubject('ANÁLISE PRELIMINAR DE RISCO');
    $pdf->SetKeywords('ANÁLISE PRELIMINAR DE RISCO');
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
   
    $pdf->SetFont('helvetica', '', 12);
    $pdf->AddPage();

    // print a line of text
    $fotos = [];
    foreach ($form->fotos as $foto) {

        try {
          $file = Storage::get($foto->caminho_foto);
        } catch (Exception $e) {}

        $fotos[] = [
            'conteudo' => isset($file) ? $file : null,
            'descricao' => $foto->descricao,
            'location' => $foto->location,
            'horario' => $foto->horario,
        ];
    }
    // $html = view('forms.impressao', compact('form', 'fotos'))->render();
    // \Log::info($html);
    // $pdf->writeHTML($html, true, 0, true, 0);

    $text = '<h1 style="text-align: center;">APR - ANÁLISE PRELIMINAR DE RISCO</h1>';
    $pdf->writeHTML($text, true, 0, true, 0);

    $text = '<p>Usuario: ' . $form->usuario->name . '</p>';
    $pdf->writeHTML($text, true, 0, true, 0);
    $text = '<p>ID do dispositivo: ' . $form->device_id . '</p>';
    $pdf->writeHTML($text, true, 0, true, 0);
    $text = '<p>Horário: ' . $form->envio_formatado . '</p>';
    $pdf->writeHTML($text, true, 0, true, 0);

    $text = '<hr>';
    $pdf->writeHTML($text, true, 0, true, 0);


    $text = '<h3 style="text-align: center;">INFORMAÇÕES GERAIS</h3>';
    $pdf->writeHTML($text, true, 0, true, 0);
    
    $text = '<p>Número da OS: ' . $form->numero_os . '</p>';
    $pdf->writeHTML($text, true, 0, true, 0);
    $text = '<p>Data da Atividade: ' . $form->dataAtividadeFormatada . '</p>';
    $pdf->writeHTML($text, true, 0, true, 0);
    $text = '<p>Horário de início: ' . $form->hora_inicio_formatada . '</p>';
    $pdf->writeHTML($text, true, 0, true, 0);
    $text = '<p>Horário de término: ' . $form->hora_fim_formatada . '</p>';
    $pdf->writeHTML($text, true, 0, true, 0);
    $text = '<p>Descrição da atividade: ' . $form->descricao_atividade . '</p><br>';
    $pdf->writeHTML($text, true, 0, true, 0);

    $text = '<hr><h3 style="text-align: center;">AVALIAÇÃO DOS RISCOS</h3><br>';
    $pdf->writeHTML($text, true, 0, true, 0);

    foreach (json_decode($form->avaliacao_riscos) as $index => $item) {
      $text = '<p>[' . ($item->checked ? 'X' : '_') . '] ' . $item->text . '</p>';
      $pdf->writeHTML($text, true, 0, true, 0);
    }

    $text = '<br><hr><h3 style="text-align: center;">MEDIDAS DE SEGURANÇA</h3><br>';
    $pdf->writeHTML($text, true, 0, true, 0);

    foreach (json_decode($form->medidas_controle) as $index => $item) {
      $text = '<p>[' . ($item->checked ? 'X' : '_') . '] ' . $item->text . '</p>';
      $pdf->writeHTML($text, true, 0, true, 0);
    }

    $text = '<br pagebreak="true"><hr><h3 style="text-align: center;">FOTOS</h3><br>';
    $pdf->writeHTML($text, true, 0, true, 0);
    foreach ($fotos as $index => $foto) {
      $text = '<p>Descrição: ' . $foto['descricao'] . '</p>';
      $pdf->writeHTML($text, true, 0, true, 0);
      $text = '<p>Horário: ' . $foto['horario'] . '</p>';
      $pdf->writeHTML($text, true, 0, true, 0);
      $text = '<p>Latitude: ' . $foto['location']->coords->latitude . '</p>';
      $pdf->writeHTML($text, true, 0, true, 0);
      $text = '<p>Longitude: ' . $foto['location']->coords->longitude . '</p>';
      $pdf->writeHTML($text, true, 0, true, 0);
      $text = '<p>Altitude: ' . number_format($foto['location']->coords->altitude, 2) . ' m' . '</p><br>';
      $pdf->writeHTML($text, true, 0, true, 0);

      $pdf->Image('@'.$foto['conteudo'], 10, 65, 130);

      if ($index != sizeof($fotos)-1) {
        $text = '<br pagebreak="true">';
        $pdf->writeHTML($text, true, 0, true, 0);
      }

    }

    $certificate = $form->usuario->certificate;
    $pkey = $form->usuario->private_key;

    if ($certificate != null && $pkey != null) {
      $info = array(
        'Name' => $form->usuario->name,
        'Location' => '',
        'Reason' => '',
        'ContactInfo' => $form->usuario->email
      );
  
      $pdf->setSignature($certificate, $pkey, '', '', 2, $info);
      $pdf->Image(storage_path('') . DIRECTORY_SEPARATOR . 'signed.png', 175, 240, 25, 30, 'PNG');
      $pdf->setSignatureAppearance(175, 240, 25, 30, 1);
    }

    $path = storage_path('app') . DIRECTORY_SEPARATOR . 'forms' . DIRECTORY_SEPARATOR . $form->id . '.pdf';
    $pdf->Output($path, 'F');

    return $path;
  }

  public static function process(Form $form)
  {

    if ($form->status !== 'CREATED') {
      return;
    }

    $form->status = 'PROCESSING';
    $form->status_message = null;
    $form->save();

    try {

      $authResponse = Http::asForm()->post(config('bry.auth_endpoint'), [
        'grant_type' => 'client_credentials',
        'client_id' => config('bry.client_id'),
        'client_secret' => config('bry.client_secret'),
      ]);

      if (!$authResponse->ok()) {
        $form->status = 'ERROR';
        $form->status_message = 'Erro ao autenticar na API de carimbo de tempo: ' . $authResponse->body();
        $form->save();
        return;
      }

      $token = $authResponse->json()['access_token'];

      $stampRequestData = [
        [
          'name' => 'nonce',
          'contents' => $form->id
        ],
        [
          'name' => 'hashAlgorithm',
          'contents' => 'SHA256'
        ],
        [
          'name' => 'format',
          'contents' => 'FILE'
        ]
      ];
      $stampRequestAttachments = [];

      $documentsIndex = 0;

      foreach ($form->fotos as $foto) {
        $file = Storage::get($foto->caminho_foto);
        $a = explode('/', $foto->caminho_foto);
        $stampRequestData[] = [
          'name' => 'documents[' . $documentsIndex . '][nonce]',
          'contents' => $foto->id
        ];
        $stampRequestData[] = [
          'name' => 'documents[' . $documentsIndex . '][content]',
          'contents' => $file,
          'filename' => $a[sizeof($a)-1]
        ];
        $documentsIndex++;
      }

      $client = new Client();
      $stampResponse = $client->request('POST', config('bry.endpoint'), [
        'headers' => [
          'Authorization' => 'Bearer ' . $token
        ],
        'multipart' => $stampRequestData,
      ]);

      if ($stampResponse->getStatusCode() !== 200) {
        $form->status = 'ERROR';
        $form->status_message = 'Erro ao realizar carimbo de tempo: ' . $stampResponse->getBody();
        $form->save();
        return;
      }

      $response = json_decode($stampResponse->getBody());

      foreach ($response->timeStamps as $stamp) {
        $foto = FormFoto::find($stamp->nonce);
        $foto->carimbo_tempo = $stamp->content;
        $foto->save();
      }

      $form->status = 'PROCESSED';
      $form->status_message = null;
      $form->save();

    } catch (RequestException $e) {

      if ($e->hasResponse()) {
        $form->status_message = $e->getResponse()->getBody();
      }

      $form->status = 'ERROR';
      $form->save();

    } catch (Exception $e) {

      $form->status = 'ERROR';
      $form->status_message = $e->getMessage();
      $form->save();

    }

  }

}