<?php

namespace PhotoLoader\Classes;

/**
 * Created by PhpStorm.
 * User: ellsha
 * Date: 04.08.16
 * Time: 14:50
 */
class Photo
{
    private $uploadPath;
    private $uploadDirection;
    private $fileName;
    private $tmpPath;

    public function __construct($uploadPath, $uploadDirection, $fileName, $tmlPath = null)
    {
        $this->fileName = $fileName;
        $this->tmpPath = $tmlPath;
        $this->uploadPath = $uploadPath;
        $this->uploadDirection = $uploadDirection;
    }

    public function getImageUrl()
    {
        return $this->fileName;
    }

    /**
     * @return string
     */
    private function getFileType()
    {
        return pathinfo($this->fileName, PATHINFO_EXTENSION);;
    }

    /**
     * @return int
     */
    private function getImageType()
    {
        return exif_imagetype($this->getLocalPath());
    }

    /**
     * @return string
     */
    private function getLocalPath()
    {
        return $this->uploadPath . "/" . $this->fileName;
    }

    /**
     * @return string
     */
    private function getServerPath()
    {
        return $this->uploadDirection . "/" . $this->fileName;
    }

    /**
     * @return null|string
     */
    private function getTmpPath()
    {
        return $this->tmpPath;
    }

    /**
     * @return int
     */
    private function getWidth()
    {
        return getimagesize($this->getLocalPath())[0];
    }

    /**
     * @return int
     */
    private function getHeight()
    {
        return getimagesize($this->getLocalPath())[1];
    }

    /**
     * @param resource $image
     */
    private function saveImage($image)
    {
        $newFileName = $this->generateName();
        $newFilePath = $this->uploadPath . "/" . $newFileName;

        switch($this->getImageType()) {
            case IMAGETYPE_JPEG:
                imagejpeg($image, $newFilePath);
                break;
            case IMAGETYPE_PNG:
                imagepng($image, $newFilePath);
                break;
        }

        $this->fileName = $newFileName;
    }

    /**
     * @return null|resource
     */
    private function createImage()
    {
        $image = null;
        $filePath = $this->getLocalPath();

        switch($this->getImageType()) {
            case IMAGETYPE_JPEG:
                $image = imagecreatefromjpeg($filePath);
                break;
            case IMAGETYPE_PNG:
                $image = imagecreatefrompng($filePath);
                break;
        }

        return $image;
    }

    public function resize($width, $height)
    {
        $image = $this->createImage();
        $resized = imagecreatetruecolor($width, $height);
        imagecopyresampled($resized, $image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
        $this->saveImage($resized);
    }

    private function generateName()
    {
        return uniqid() . "." . $this->getFileType();
    }

    public function rename()
    {
        $newFileName = $this->generateName();
        $newFilePath = $this->uploadPath . "/" . $newFileName;
        rename($this->getLocalPath(), $newFilePath);
        $this->fileName = $newFileName;
    }

    public function upload()
    {
        if(!file_exists($this->getLocalPath()))
        {
            move_uploaded_file($this->getTmpPath(), $this->getLocalPath());
            $this->rename();
        }
        if(!$this->check()) {
            throw new \Exception("File isn't an image");
        }
    }

    /**
     * @return bool
     */
    private function check()
    {
        $imageTypes = [IMAGETYPE_JPEG, IMAGETYPE_PNG];

        return in_array($this->getImageType(), $imageTypes);
    }

    public function show()
    {
        echo '<img src="' . $this->getServerPath() . '"/>';
    }
}


















