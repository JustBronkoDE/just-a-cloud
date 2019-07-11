<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;

class File extends Model
{

	/**
     * The attributes that are mass assignable.
     * @var array
     */
	protected $fillable = [
		'user_id',
		'name', 
		'path', 
		'type', 
		'public',
	];

	/**
	 * Saves an instance of File
	 * @param File $file
	 * @return bool 
	 */
	public function addFile(File $file)
	{
		return $file->save();
	}

	/**
	 * Removes a file from the database and the file-system
	 * @param  File $file
	 * @return bool
	 */
	public function removeFile(File $file)
	{
		Storage::delete($file->path);

		return $file->delete();
	}

	/**
	 * Relationship between File and User
	 * @return User [Owner of file]
	 */
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
