<?php

namespace App\Http\Controllers;

use Exception;
use App\Jobs\ProcessForm;
use App\Form;
use App\FormFoto;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ApiFormController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function create(Request $request)
    {
        $dados = $request->all();

        $form = new Form();

        $form->status = 'CREATED';
        $form->usuario_id = $dados['usuario_id'];
        $form->device_id = $dados['device_id'] ?? '';

        $form->data_atividade = substr($dados['data_atividade'], 0, 10);
        $form->hora_inicio = substr($dados['hora_inicio'], 11, 8);
        $form->hora_fim = substr($dados['hora_fim'], 11, 8);
        $form->descricao_atividade = $dados['descricao_atividade'] ?? '';
        $form->numero_os = $dados['numero_os'] ?? '';
        $form->avaliacao_riscos = $dados['avaliacao_riscos'];
        $form->medidas_controle = $dados['medidas_controle'];

        $form->save();

        if (isset($dados['fotos'])) {
            $fotos = json_decode($dados['fotos']);

            foreach ($fotos as $index => $foto) {
                if (!$foto->value) {
                    continue;
                }

                $caminho = 'fotos' . DIRECTORY_SEPARATOR . date('Y') . DIRECTORY_SEPARATOR . date('m') . DIRECTORY_SEPARATOR . 'photo_' . $form->id . '_' . $index . '.jpeg';

                try {
                    Storage::put(
                        $caminho, 
                        base64_decode($foto->value->base64)
                    );
                } catch (Exception $e) {
                    \Log::info("Nao foi possível salvar a imagem");
                }

                FormFoto::create([
                    'form_id' => $form->id, 
                    'descricao' => $foto->text, 
                    'caminho_foto' => $caminho, 
                    'geolocalizacao' => json_encode($foto->value->location), 
                    // 'exif' => json_encode($foto->value->exif), 
                ]);
            }
        }


        ProcessForm::dispatch($form);

        return $form;
    }
}
