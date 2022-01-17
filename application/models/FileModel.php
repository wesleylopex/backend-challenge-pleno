<?php

class FileModel extends CI_Model {
  public function __construct () {
    parent::__construct();
  }
  
  function removeFile (string $folderName, string $fileName, string $fileType) {
    $basePath = 'assets/uploads/'.$fileType.'s/';
    $filePath = $basePath . $folderName . $fileName;
    $this->unlinkFile($filePath);
  }

  private function unlinkFile ($filePath) {
    if (!is_file($filePath)) {
      return false;
    }

    @unlink($filePath);
    return true;
  }

  public function uploadFile (string $folderName, string $fileName, string $fieldName, string $fileType) {
    $allowedTypeByFileType = [
      'video' => 'mp4',
      'file' => 'pdf|docx',
      'image' => 'gif|jpeg|jpg|png'
    ];

    if (!array_key_exists($fileType, $allowedTypeByFileType)) {
      return false;
    }

    $settings = [];
    $settings['upload_path'] = 'assets/uploads/'. $fileType . 's/' . $folderName;
    $settings['allowed_types'] = $allowedTypeByFileType[$fileType];

    $settings['file_name'] = setFileName($fileName);
    
    $this->load->library('upload', $settings);
    if (!$this->upload->do_upload($fieldName)) {
      echo $this->upload->display_errors();
      return false;
    }
    
    $file = ['upload_data' => $this->upload->data()];
    chmod($file['upload_data']['full_path'], 0777);
    return $file;
  }
}
