<?php

namespace App\Http\Controllers;
 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use App\Http\Controllers\Controller;
//use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\Validator;
use App\Helpers\FileHandler;
use App\User;
use App\Attachment;
use DB;


class DocumentController extends Controller
{
    private $user;
    private $thumbGroup = 'document';
    private $folder = 'documents';

    public function index(Request $request){
         $breadcrumbs = [
            // ['url' => route('vendor.complaints'), 'label' => 'All Documents'],
         ];
        $lists =\App\Document::with('attachments')->where(['status' => 1])->orderBy('id', 'desc')->paginate(10);
        return view('documents.index' ,compact('breadcrumbs','lists'));
    }

    public function documentUpload(Request $request){
   
         $breadcrumbs = [
            // ['url' => route('vendor.document.list'), 'label' => 'All Documents'],
            // ['url' => route('vendor.complaints'), 'label' => 'Upload document'],
          ];

          if($request->isMethod('post')){
           //  return  $request->all();
         
            $this->validate($request, [
              'description' => 'required|max:199|regex:/^[\pL\s\-]+$/u',
            // 'status' => 'required',
              'image.*' => 'required|mimes:pdf|max:2048'
            // 'image' => 'mimes:jpg,png',
              ], ['image.*.mimes' => 'Image should be only in pdf','image.*.max' => 'Max image size, upto  2 mb.']);

            $document = \App\Document::create([
                'description' => $request->description, 
                'status' => 1,
                'user_id' => 1,
              ] );
                               
            
            // if( {
               if($input = $request->file('image')){
               // return count($input);
                foreach($input as $photo){
                   $path = FileHandler::mediaUpload($photo, $this->thumbGroup, $this->folder);

                    $media = \App\Media::create([
                            'name'      =>  $path['name'],
                            'path'      =>  $path['path'],
                            'mime'      =>  $path['ext'],
                        ]);
            
                
                 $attachment = \App\DocumentAttachment::create([
                        'name'  =>  'document'.time(),
                        'slug'  =>  'document'.time(),
                        'media_id'  =>  $media->id ,
                        'user_id' => 1,
                        'document_id' =>$document->id,
                        'status' =>1,
                    ]); 
                  } 
               }  
                $request->session()->flash('message', 'Document  new uploaded successfully.');
               return redirect(route('employee.document.list'));
             }
       return view('documents.document_upload' ,compact('breadcrumbs'));
    }
    public function attachmentLists(Request $request, $id){
    //  return $request->all();
       $breadcrumbs = [
            // ['url' => route('vendor.document.list'), 'label' => 'All Documents'],
            // ['url' => route('vendor.complaints'), 'label' => 'Upload document'],
          ];
            $list =\App\Document::with('attachments')->where(['status' => 1, 'id' =>$id])->first();
      //  return view('panel.vendor_panel.document_list' ,compact('breadcrumbs','lists'));
      return view('documents.document_attachments' ,compact('breadcrumbs','list'));
    }

    public function documentDelete(Request $request, $id){
        try {
			$document = \App\DocumentAttachment::find($id);
			$document_id = $document->document_id ;
			// dd($document->media);
			$document->media()->delete();
			$document->document()->delete();
			$document->delete();
			$request->session()->flash('message', 'Document deleted successfully.');
			return redirect(route('employee.document.list'));

		} catch (\Throwable $th) {
			info("Document not deleted: ".$th->getMessage());
		}
    }

}
