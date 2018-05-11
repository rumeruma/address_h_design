<?php

namespace App\Http\Controllers;

use App\Http\Requests\MediaRequest;
use illuminate\Http\Request;

class MediaController extends Controller
{
    public function upload(MediaRequest $mediarequest){

    		if($mediarequest->hasFile('media')){
    			$filename = $mediarequest->media->getClientOriginalName();
    			$mediarequest->media->StoreAs('public', $filename);
    			return 'true';
    		}
    		return 'done';
    }
    private function getType($media){    	
    	// $ext = $media->getClientOriginalExtension();    	
    	$ext = $media->getMimeType();
    	$type = explode('/', trim($ext));
    	return $type[0];  	
    }

    public function store(Request $request){
        $index = date('Y-M');
        $size = count($request->file('m_files'));
        foreach ($request->file('m_files') as $mfile) {
            $name = $mfile->getClientOriginalName();
            $type = $this->getType($mfile);
            $path = 'public/media/'.$index;
            $media = new Media;
            $media->name = $name;
            $media->path = $path;
            $media->type = $type;
            $media->save();
            $mfile->storeAs($path, $name);
        }

    }
}
