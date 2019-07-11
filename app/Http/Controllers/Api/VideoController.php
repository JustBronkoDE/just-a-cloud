<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\File;

class VideoController extends Controller
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
	 * Gets multiple video information, to display/download them.
	 * @return array [JSON with multiple video information]
	 */
	public function getVideos($user_id = null) {
		
		if ($user_id !== null) {
			$videos = File::where('user_id' , $user_id)->where('type', 'video')->where('public', true)->get();
		} else {
			$videos = File::where('type', 'video')->where('public', true)->get();
		}

		$videoInfos = array();
		foreach ($videos as $videos => $video) {
			$info = array(
				'path' => 'https://www.cloud.productive-music.de/cloud/download/' . $video->id,
				'id' => $video->id,
				'name' => $video->name,
				);
			array_push($videoInfos, $info);
		}
		return $videoInfos;
	}

	/**
	 * Gets a single Files information of type video, to display/download them.
	 * @param  File   $file [Should be type video]
	 * @return array [JSON with single video information]
	 */
    public function getVideo(File $file) {
    	
    	if ($file->type === 'video') {

    		$video = $file;

    		$videoInfo = array(
    			'path' => 'https://www.cloud.productive-music.de/cloud/download/' . $video->id,
    			'id' => $video->id,
    			'name' => $video->name,
			);
				
    		return $videoInfo;
    	} else {
    		return []; //if not type video
    	}
    }
}