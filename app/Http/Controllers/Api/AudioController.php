<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\File;

class AudioController extends Controller
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
	 * Gets multiple audio information, to display/download them.
	 * @return array [JSON with multiple audio information]
	 */
	public function getAudios($user_id = null) {

		if ($user_id !== null) {
			$audios = File::where('user_id', $user_id)->where('type', 'audio')->where('public', true)->get();
		} else {
			$audios = File::where('type', 'audio')->where('public', true)->get();
		}

		$audioInfos = array();
		foreach ($audios as $audios => $audio) {
			$info = array(
				'path' => 'https://www.cloud.productive-music.de/cloud/download/' . $audio->id,
				'id' => $audio->id,
				'name' => $audio->name,
				);
			array_push($audioInfos, $info);
		}
		return $audioInfos;
	}

	/**
	 * Gets a single Files information of type audio, to display/download them.
	 * @param  File   $file [Should be type audio]
	 * @return array [JSON with single audio information]
	 */
    public function getAudio(File $file) {

    	if ($file->type === 'audio') {

    		$audio = $file

    		$audioInfo = array(
    			'path' => 'https://www.cloud.productive-music.de/cloud/download/' . $audio->id,
    			'id' => $audio->id,
    			'name' => $audio->name,
			);
				
    		return $audioInfo;
    	} else {
    		return []; //if not type audio
    	}
    }
}
