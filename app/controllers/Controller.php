<?php
namespace App\Controllers;
use \App\Libs\Factory;
use \App\Libs\ImageResize;
use \App\Libs\Upload;

abstract class Controller {
	/**
	 * @param string $view
	 * @param array $arr
	 * @param string $folder
	 * @param bool $autoload
	 * @return bool
	 */
	protected function getView($view,
								$arr = [],
								$folder = 'index',
								$autoload = true) {
		$file = Factory::$app_path.DS.'views'.DS.strtolower($folder).DS.$view.'.php';
		if(file_exists($file)) {
			if($autoload)
				include $file;
			return true;
		}
		return false;
	}
	
	/**
	 * @param string $template
	 * @param bool $autoload
	 * @return bool
	 */
	protected function getTemplate($template, $autoload = true) {
		$file = Factory::$app_path.DS.'templates'.DS.strtolower($template).'.php';
		if(file_exists($file)) {
			if($autoload)
				require_once $file;
			return true;
		}
		return false;
	}
    protected function upload_image($image, $path='') {
        try {
            $target_dir = '../../images/uploads/'.$path;
            $filename = $image['name'];

            $u = Upload::factory($target_dir);
            $u->file($image);
            $u->set_max_file_size(4);
            $u->set_allowed_mime_types([
                                           'image/jpg',
                                           'image/jpeg',
                                           'image/gif',
                                           'image/png',
                                       ]);

            $u->set_filename($filename);

            $results = $u->upload();

            $image_path = $target_dir . '/'. $filename;
            if(count($results['errors']) < 1) {
                $image = new ImageResize($results['full_path']);
                $image->resizeToWidth(1200);
                $image->save($results['full_path']);
                $path_parts = pathinfo($results['full_path']);

                $image = new ImageResize($results['full_path']);
                $image->resizeToWidth(600);
                $thumbnail_name = substr($results['full_path'], 0 , (strrpos($results['full_path'], ".")));
                $image->save($thumbnail_name . '-sm.' . $path_parts['extension']);
                global $r;
                return [
                    'large' =>$r->url('images/uploads/'.$path.$filename),
                    'small' => $r->url('images/uploads/'.$path.substr($filename, 0, (strrpos($filename,"."))) . '-sm.' . $path_parts['extension'])
                ];
            }
        } catch(\Exception $ex) {
            return null;
        }
        return null;
    }

	/**
	 * @param \App\Libs\Resource $r
	 * @param string $title
	 * @param string $og_image
	 * @param string $description
	 * @param string $keywords
	 */
	protected function metaData($r,
							$title = DEFAULT_TITLE,
							$og_image = OG_IMAGE,
							$description = DESCRIPTION,
							$keywords = KEYWORDS) {
		$r->set('author', AUTHOR);
		$r->set('title', $title);
		$r->set('og_image', $og_image);
		$r->set('description', $description);
		$r->set('keywords', $keywords);
	}

	/**
	 * @param string $from
	 * @param string $to
	 * @param string $subject
	 * @param string $message
	 * @param string $reply_to
	 */
	protected function sendMail($from, $to, $subject, $message, $reply_to) {
		include_once __DIR__.'/../libs/phpmailer/class.phpmailer.php';
		include_once __DIR__.'/../libs/phpmailer/class.smtp.php';

		$mail = new \PHPMailer();
		$mail->SMTPOptions = array(
			SMTP_SECURE => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			)
		);

		$mail->ClearReplyTos();
		$mail->AddReplyTo($reply_to);
		$mail->AddAddress($to);
        $mail->Username = SMTP_USERNAME;
        $mail->Password = SMTP_PASSWORD;
		$mail->From = $mail->Username;
		$mail->FromName = $from;
		$mail->Subject = $subject;
		$mail->Body = $message;
		$mail->WordWrap = 50;
		$mail->IsHTML(true);
		$mail->SMTPAuth = true; //server zahteva password
		$mail->SMTPSecure = SMTP_SECURE;
		$mail->Port = SMTP_PORT;
		$mail->Host = SMTP_HOST; //podesavanje servera
		$mail->AltBody = strip_tags(str_replace("<br />", "\n", $message));
		$mail->CharSet = "utf-8";
		$mail->IsSMTP();
		$mail->Send();
	}

	/**
	 * @param string $resp;
	 * @return bool;
	 */
	protected function googleRecaptcha($resp) {
		$ip = $_SERVER['REMOTE_ADDR'];
		$url = "https://www.google.com/recaptcha/api/siteverify?secret="."6Ldgjb0ZAAAAACyT0jxBZ2QhqhNAiDVuTvvFcvK0"."&response=".$resp."&remoteip=".$ip;
		$ch = curl_init();
		curl_setopt ($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
		$contents = curl_exec($ch);
		if(curl_errno($ch)) {
			echo curl_error($ch);
			echo "\n<br />";
			$contents = '';
			die();
		} else {
			curl_close($ch);
		}

		if(!is_string($contents) || !strlen($contents)) {
			echo "Failed to get contents.";
			$contents = '';
			die();
		}

		$response=$contents;
		$responseKeys = json_decode($response,true);
		if(intval($responseKeys["success"]) !== 1) {
			return false;
		}
		return true;
	}

	/**
	 * @param \App\Libs\Resource $resource;
	 */
	public function error($resource) {
		$resource->set('main', __DIR__.'/../views/error/index.php');
		return $this->getTemplate('default');
	}

	abstract public function main($resource);
}