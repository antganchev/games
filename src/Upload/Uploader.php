<?php

namespace Upload;

/**
 * Upload handler
 */

class Uploader
{

    /**
     * Upload a file from POST form to a directory. If upload is successfull, it is returning the filename
     *
     * @param array $file
     * @param string $directory
     * 
     * @return string
     */
    public static function upload(array $file, string $directory): string
    {
        if (!is_dir($directory)) {
            if (!mkdir($directory, 0775, true)) {
                throw new \Exception ("You are trying to upload a file in not existing directory: ". $directory. " and system is unable to create the folder.");
            }
        }

        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);

        $new_name = uniqid() . ".{$ext}";

        if (!move_uploaded_file($file['tmp_name'], $directory . DIRECTORY_SEPARATOR . $new_name)) {
            throw new \Exception ("Unable to upload the file to: " . $directory);
        }

        return $new_name;
    }

    /**
     * Generate HTML image tag
     * 
     * @param string $imageName
     * @param string $urlToImage
     * 
     * @return string
     */
    public function renderImage(string $imageName, string $urlToImage): string
    {
        return "<img src='{$urlToImage}" . DIRECTORY_SEPARATOR . "{$imageName}' />";
    }
}