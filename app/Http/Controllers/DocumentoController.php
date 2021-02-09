<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClienteModel;
use App\ProductoModel;
use App\Mail\MensajeRecibido;
use App\RegionModel;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class DocumentoController extends Controller
{
  
    public function index()
    {
        return view('documento')
        ->with("clientes", ClienteModel::all())
        ->with("productos", ProductoModel::listProductos())
        ->with("regiones", RegionModel::all());
    }

    public function enviarPropuesta(Request $request){        
        $destinatario = $request["destinatario"];
        $nombre_doc = $request["nombre_doc"];
        $contenido = $request["contenido"];
        $folletos = $request["folletos"];
        Mail::to($destinatario)->send( new MensajeRecibido($nombre_doc, $contenido, $folletos));        
        return 'Mensaje enviado';
    }

    public function guardarPDF(Request $request){
        $bpdf = $request["pdf"];
        $nombre_doc = $request["nombre_doc"];
        file_put_contents('./documentos/'.$nombre_doc, base64_decode($bpdf));
        return "OK";

    }

    public function guardarPDFProducto(Request $request){
        
        $bpdf = $request["pdf"];
        $nombre_doc = $request["nombre_doc"];
        file_put_contents('./productos/'.$nombre_doc, base64_decode($bpdf));
        return "OK";

    }
}
