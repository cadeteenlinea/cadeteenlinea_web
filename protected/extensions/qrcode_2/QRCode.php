<?php
class QRCode extends CWidget
{
	/**
	 * Width of Qrcode image
	 *
	 * @var string
	 */
	public $width;
	/**
	 * Height of Qrcode image
	 *
	 * @var unknown_type
	 */
	public $height;
	/**
	 * Error correction level of Qrcode
	 *
	 * @var string
	 */
	public $correction;
	/**
	 * @var string
	 *
	 */
	public $encoding;
	/**
	 * @var string
	 *
	 */
	public $watermark;
    
    /** Qrcode data content
     * 
	 * @var string
	 *
	 */
	public $content;
    /**
	 * the image filename for the qrcode
	 * default filename is $this->data property
	 */
    public $filename = null;
	
	/**
	 * the physical path of the file
	 * default to Yii::app()->getBasePath().'../uploads'
	 * make sure you have uploads folder and it is writable
 	 */
    public $filePath;
	
	/**
	 * the file url of the file
	 * default to Yii::app()->baseUrl.'images/uploads'
	 * make sure you have uploads folder and it is writable
	 */
    public $fileUrl;
	
    public function init()
	{
		// initiliaze parameters. set default values
		if (empty($this->width)) $this->width = 150;
        if (empty($this->height)) $this->height = 150;
        if (empty($this->correction)) $this->correction = 'L';
        if (empty($this->encoding)) $this->encoding = 'UTF-8';
        if (empty($this->watermark)) $this->watermark = 'No';
        if (empty($this->content)) $this->content = '';
        
        // set Qrcode image file path
        if (!$this->filePath){
            $this->filePath = realpath(Yii::app()->getBasePath().'/../images/qrcodes');
        }
        
        // set Qrcode image file url
        if (!isset($this->fileUrl)){
            $this->fileUrl = Yii::app()->baseUrl . '/images/qrcodes/';
        }
        
        // set Qrcode image file name
        if (is_null($this->filename)){
			$this->filename = 'qrimage-1.png'; // default image name
		}
	}
    
	public function run()
	{
		$this->content = urlencode($this->content);
        // call Google API to generate QRCode
        $rootUrl = "https://chart.googleapis.com/chart?cht=qr&chs={$this->width}x{$this->height}&chl=$this->content&choe=$this->encoding&chld=$this->correction|1";
        $qr = file_get_contents($rootUrl);
        
        $image = $this->filePath.'/'.$this->filename; // image path
        file_put_contents($image , $qr);
        chmod($image , 0777);
        
        if ($this->watermark == 'Yes') {
            // Watermark image: Starts
            $stamp = imagecreatefrompng($this->filePath.'/'.'icon.png'); // default watermark image path. You can change image path it from here
            $im = imagecreatefrompng($image);

            // Set the margins for the stamp and get the height/width of the stamp image
            $marge_right = ($this->width / 2) - 20; // you can change this value as per your requirement 
            $marge_bottom = ($this->height / 2) - 15; // you can change this value as per your requirement 
            $sx = imagesx($stamp);
            $sy = imagesy($stamp);

            // Copy the stamp image onto our photo using the margin offsets and the photo 
            // width to calculate positioning of the stamp. 
            imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));
            // Output and free memory

            imagepng($im, $image);
            imagedestroy($im);
            // Watermark image: Ends
        }
        
        echo '<img src="'.$this->fileUrl.$this->filename.'" />';
	}
	
}
?>