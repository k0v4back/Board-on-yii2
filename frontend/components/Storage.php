<?php

namespace frontend\components;

use Yii;
use yii\base\Component;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

class Storage extends Component
{
    private $fileName;

    /**
     * @param UploadedFile $file
     * @return mixed
     */
    public function saveUploadedFile(UploadedFile $file)
    {
        $path = $this->preparePath($file);
        if ($path && $file->saveAs($path)) {
            return $this->fileName;
        }
    }

    protected function preparePath(UploadedFile $file)
    {
        $this->fileName = $this->getFileName($file);
        $path = $this->getStoragePath() . $this->fileName;
        $path = FileHelper::normalizePath($path);
        if (FileHelper::createDirectory(dirname($path))) {
            return $path;
        }
    }

    /**
     * @param UploadedFile $file
     * @return string
     */
    protected function getFilename(UploadedFile $file)
    {
        $hash = sha1_file($file->tempName);
        $name = substr_replace($hash, '/', 2, 0);
        $name = substr_replace($hash, '/', 5, 0);
        return $name . '.' . $file->extension;
    }

    /**
     * @return bool|string
     */
    protected function getStoragePath()
    {
        return Yii::getAlias(Yii::$app->params['storagePath']);
    }

    /**
     * @param string $filename
     * @return string
     */
    public function getFile(string $filename)
    {
        return Yii::$app->params['storageUri'] . $filename;
    }
}