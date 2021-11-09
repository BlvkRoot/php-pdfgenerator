<?php

class ImageBase64 {
   
    function generateBase64(string $filePath): string 
    {
        $fileContent = file_get_contents($filePath);

        return base64_encode($fileContent);
    }
}