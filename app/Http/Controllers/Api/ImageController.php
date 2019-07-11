<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\File;

class ImageController extends Controller
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

	/**
	 * Gets multiple image information, to display/download them.
	 * @return array [JSON with multiple image information]
	 */
	public function getImages($user_id = null) {
		
		if ($user_id !== null) {
			$images = File::where('user_id', $user_id)->where('type', 'image')->where('public', true)->get();
		} else {
			$images = File::where('type', 'image')->where('public', true)->get();
		}

		$imageInfos = array();
		foreach ($images as $images => $image) {
			$info = array(
				'path' => 'https://www.cloud.productive-music.de/cloud/download/' . $image->id,
				'id' => $image->id,
				'name' => $image->name,
				);
			array_push($imageInfos, $info);
		}
		return $imageInfos;
	}

	/**
	 * Gets a single Files information of type image, to display/download them.
	 * @param  File   $file [Should be type image]
	 * @return array [JSON with single image information]
	 */
    public function getImage(File $file) {
    	
    	if ($file->type === 'image') {

    		$image = $file;

    		$imageInfo = array(
    			'path' => 'https://www.cloud.productive-music.de/cloud/download/' . $image->id,
    			'id' => $image->id,
    			'name' => $image->name,
			);
				
    		return $imageInfo;
    	} else {
    		return []; //if not type image
    	}
    }
}
