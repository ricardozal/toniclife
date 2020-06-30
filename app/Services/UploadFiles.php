<?php


namespace App\Services;


class UploadFiles
{
    public static function storeFile($file, $id, $pathType = '')
    {
        $path = '/uploads/'.$pathType;
        $name = 'tonic_life_fenix_' . str_replace('.', '',
                (string)microtime(true)) . '_' . $id . '.' . $file->extension();

        // Create path if does not exists
        if (!file_exists(public_path() . $path)) {
            mkdir(
                public_path() . $path,
                0777,
                true
            );
        }

        // Move image to corresponding directory
        $file->move(public_path() . $path, $name);
        return $path . '/' . $name;
    }
}
