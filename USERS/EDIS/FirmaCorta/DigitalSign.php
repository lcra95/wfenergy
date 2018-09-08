<?php 

	class DigitalSign
	{

		private $pubKey;
		private $privKey;
		private $firma;
		private $datos;

		public function __construct($config, $datos)
		{
			$this->pubKey = file_get_contents($config['public_key']);
			$prk = file_get_contents($config['private_key']);
			$this->privKey = openssl_pkey_get_private($prk);
			$this->datos = $datos;
		}

		public function getFirma()
		{
			return base64_encode($this->firma);
		}

		public function sign()
		{
			if (!openssl_sign($this->datos, $this->firma, $this->privKey, OPENSSL_ALGO_SHA1))
			{
				echo openssl_error_string();
				return false;
			}

			return true;
		}

		public function verifySign()
		{
			if (openssl_verify($this->datos, $this->firma, $this->pubKey, OPENSSL_ALGO_SHA1) === 1) {
				
				return true;
			} else {
				echo 'la firma es invalida y/o los datos fueron alterados';
				return false;
			}
		}

	}

?>