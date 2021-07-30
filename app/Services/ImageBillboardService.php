<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use App\Services\Contracts\FileInterface;

class ImageBillboardService implements FileInterface
{
    public function getNameFile($image): string
    {
    	//TODO: posiblemente cambiar por uniqid()
    	$image_name  = uniqid(time()) . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
    	return $image_name;
    }

    public function getPathFile($name): string
    {
    	$image_path = public_path('img/billboards/') . $name;
    	return $image_path;
    }

    public function checkExistsFile($name): bool
    {
        return File::exists($this->getPathFile($name));
    }

    public function deleteFile($name): bool
    {
    	if ($this->checkExistsFile($name)) {
    		return File::delete($this->getPathFile($name));
    	}
    	
    	return false;
    }

    public function saveFile($image, $name): bool
    {
    	$saved = false;
    	\Image::make($image)->save($this->getPathFile($name), 50, 'jpg');
    	if ($this->checkExistsFile($name)) {
    		$saved = true;
    	}

    	return $saved; 	
    }
}
