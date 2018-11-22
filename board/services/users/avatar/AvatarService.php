<?php

namespace board\services\users\avatar;

use board\forms\profile\UploadAvatarForm;

class AvatarService
{
    public function upload(UploadAvatarForm $form){
        if($form->validate()){
            $form->image->saveAs('../uploads/' . $form->image->baseName . '.' . $form->image->extension);
            return true;
        }else{
            return false;
        }
    }
}