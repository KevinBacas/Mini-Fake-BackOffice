<?php

/**
 * Encryption and Decryption of data
 *
 * @author Kévin BACAS
 * @copyright APLICAEN
 */

class CCrypt {

  // Algorithme utilisé pour le cryptage des blocs
  private static $cipher  = MCRYPT_RIJNDAEL_256;
  // Clé de cryptage
  private static $key = 'APLICAEN';
  // Mode opératoire (traitement des blocs)
  private static $mode = 'cbc';

  public function __construct()
  {
    // NOTHING TO DO HERE...
  }

  public static function crypt($data)
  {
    $keyHash = md5(self::$key);
    $key = substr($keyHash, 0, mcrypt_get_key_size(self::$cipher, self::$mode));
    $iv = substr($keyHash, 0, mcrypt_get_block_size(self::$cipher, self::$mode));
    $data = mcrypt_encrypt(self::$cipher, $key, $data, self::$mode, $iv);

    return trim(base64_encode($data));
  }

  public static function decrypt($data)
  {
    $keyHash = md5(self::$key);
    $key = substr($keyHash, 0, mcrypt_get_key_size(self::$cipher, self::$mode));
    $iv = substr($keyHash, 0, mcrypt_get_block_size(self::$cipher, self::$mode));
    $data = base64_decode($data);

    return trim(mcrypt_decrypt(self::$cipher, $key, $data, self::$mode, $iv));
  }
}
?>
