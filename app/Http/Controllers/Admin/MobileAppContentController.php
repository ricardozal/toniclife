<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\MobileAppContent;
use App\Services\UploadFiles;
use Illuminate\Http\Request;

class MobileAppContentController extends Controller
{
    public function index(){

        return view('admin.mobile_app_content.index');

    }

    public function indexContent(){


        $query = MobileAppContent::all();

        return response()->json([
            'data' => $query
        ]);

    }

    public function update($contentId){

        $content = MobileAppContent::find($contentId);

        return view('admin.mobile_app_content.update',[
            'content' => $content
        ]);

    }

    public function updatePost(Request $request, $contentId){

        /** @var MobileAppContent $content */
        $content = MobileAppContent::find($contentId);

        $pdf = $request->file('file');
        if ($pdf != null) {
            if ($pdf->getMimeType() != 'application/pdf'){
                return response()->json([
                    'errors' => ['file' => ['Debe ingresar un archivo pdf'] ]
                ],422);
            } else {
                $url = UploadFiles::storeFile($pdf, $content->key, 'links');
                $content->url = $url;
            }
        } elseif ($content->type == 'url' && $content->key != 'WHATSAPP') {
            $content->url = $request->input('url');
        } elseif ($content->type == 'url' && $content->key == 'WHATSAPP') {
            $content->url = $request->input('phone');
        }

        if (!$content->save()) {
            return response()->json([
                'success' => false,
                'message' => 'No se pudo registrar el producto en este momento, intente más tarde.',
            ]);
        }
        return response()->json([
            'success' => true,
        ]);

    }
}
