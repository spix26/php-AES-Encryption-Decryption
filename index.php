<?php

define('ENCRYPTION_KEY', 'XWpAWRF1fZlcaFvFOR1Otip2ihDHdQ');
define('ENCRYPTION_ALGORITHM', 'AES-256-CBC');

 class ElFawwaz {

    public static function ElFawwaz_Encrypt($ClearTextData) {
      $EncryptionKey = base64_decode(ENCRYPTION_KEY);
      $InitializationVector  = openssl_random_pseudo_bytes(openssl_cipher_iv_length(ENCRYPTION_ALGORITHM));
      $EncryptedText = openssl_encrypt($ClearTextData, ENCRYPTION_ALGORITHM, $EncryptionKey, 0, $InitializationVector);
      return base64_encode($EncryptedText . '::' . $InitializationVector);
    }

    public static function ElFawwaz_Decrypt($CipherData) {
      $EncryptionKey = base64_decode(ENCRYPTION_KEY);
      list($Encrypted_Data, $InitializationVector ) = array_pad(explode('::', base64_decode($CipherData), 2), 2, null);
      return openssl_decrypt($Encrypted_Data, ENCRYPTION_ALGORITHM, $EncryptionKey, 0, $InitializationVector);
    }

}

$DoElfawwaz = new ElFawwaz;
$encrypt = $DoElfawwaz->ElFawwaz_Encrypt('Testing');
$decrypt = $DoElfawwaz->ElFawwaz_Decrypt($encrypt);
echo $encrypt;
echo"<hr>";
echo $decrypt;
