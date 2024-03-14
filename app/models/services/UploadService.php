<?php
namespace app\models\services;

use app\config\Settings;
use app\models\entity\Multimedia;
use app\models\Upload;
use app\models\Service;
use app\core\DateTime;
use \getID3;

class UploadService extends Service {

    const ALLOWED_TYPES = ["image/png","image/jpeg","video/mp4"];
    const REQIRED_WIDTH = 1920;
	const REQIRED_HEIGHT = 1080;

	protected $getID3;

    function __construct($entityManager) {
        parent::__construct($entityManager);
        $this->getID3 = new getID3();
    }

    public function uploadAuthorImage(array $file) {
        if(empty($file)) {
            return [false, 'Es wurde kein Bild ausgewählt'];
        }
        if(!in_array($file["type"], self::ALLOWED_TYPES)) {
            return [false, 'Es wurde ein falsches Format ausgesucht, lediglich JPEG und PNG erlaubt.'];
        }
        $upload =  new Upload(
            $file["name"],
            $file["type"],
            $file["tmp_name"],
            $file["error"],
            $file["size"]
        );
        if (!$upload->moveUploadedFile()) {
            return [false, 'Bild konnte nicht hochgeladen werden.'];
        }else{
            return [true, $file["name"]];
        }
    }



    public function upload(array $files,array $post) {
        $i = 0;
        if(isset($files) && !empty($files)) {
            for($i=0;$i<=count($_FILES['files']['name'])-1;$i++) {
                if(in_array($files["files"]["type"][$i], self::ALLOWED_TYPES)) {
                    $upload =  new Upload(
                        $files["files"]["name"][$i],
                        $files["files"]["type"][$i],
                        $files["files"]["tmp_name"][$i],
                        $files["files"]["error"][$i],
                        $files["files"]["size"][$i]
                    );
                    $fileMeta = $this->getID3->analyze($files["files"]["tmp_name"][0]);
					if($fileMeta["video"]["resolution_x"] == self::REQIRED_WIDTH && $fileMeta["video"]["resolution_y"]) {
						if ($upload->moveUploadedFile() === true) {
							if (DateTime::getFormatDate($post["start_date"]) !== false && DateTime::getFormatDate($post["end_date"]) !== false) {
								$date1 = DateTime::getFormatDate($post["start_date"]);
								$date2 = DateTime::getFormatDate($post["end_date"]);
								$pic = new Multimedia($files["files"]["name"][$i], Settings::UPLOAD_PATH . $files["files"]["name"][$i], DateTime::getFormatDate($post["start_date"]), DateTime::getFormatDate($post["end_date"]), $files["files"]["type"][$i]);
								if (is_object($pic)) {
									if (self::save($pic)) {
										$data = $this->message->setMessage('success', 'Der Upload wurde erfolgreich ausgeführt');
									} else {
										$data = $this->message->setMessage('error', 'Beim Upload ist ein Fehler aufgetreten');
									}
								} else {
									$data = $this->message->setMessage('error', 'Beim Upload ist ein Fehler aufgetreten');
								}
							}
						} else {
							$data = $this->message->setMessage('error', 'Beim Upload ist ein Fehler aufgetreten');
						}
					}else {
                        $data = $this->message->setMessage('error', 'Bitte laden sie das Bild im richtigen Format hoch.');
                    }

                    //nurmal schauen, nur wenn object erstellung und Upload true warrn ist alles gut sonst muss ggf. alles wieder gelöscht werden
                } else {
                    $data = $this->message->setMessage('error', 'Das Bildformat ist nicht erlaubt');
                }
            }
            return $data;
        }
    }

}