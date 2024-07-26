<?php

namespace App\Http\Controllers;

use App\Services\FormsService;
use App\Form;
use App\FormFoto;
use Storage;
use Illuminate\Http\Request;

class FormsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'canViewForms']);
    }

    public function index(Request $request)
    {
        $forms = Form::with('usuario')
            ->orderBy('created_at', 'desc');

        $os = $request->input('os', '');

        if ($os != '') {
            $forms->where('numero_os', 'like', '%' . $os . '%');
        }
            
        $forms = $forms->get();

        return view('forms.list', compact('forms', 'os'));
    }

    public function show($id, Request $request)
    {
        $form = Form::findOrFail($id);

        return view('forms.show', compact('form'));
    }

    public function pdf($id, Request $request)
    {
        $form = Form::findOrFail($id);
        $path = 'forms' . DIRECTORY_SEPARATOR . $id . '.pdf';

        $remake = $request->input('remake', false);

        if (!Storage::exists($path) || $remake) {
            FormsService::generatePdf($form);
        }

        return Storage::download(
            $path, 
            'apr_' . $id . '.pdf', 
            ['Content-Disposition' => 'inline; filename="' . 'apr_' . $id . '.pdf' . '"']
        );
    }

    public function foto($id)
    {
        $foto = FormFoto::findOrFail($id);
        return Storage::download($foto->caminho_foto);
    }
}
