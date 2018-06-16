<?php

namespace AppBundle\Lib;

/**
 * Encripta en md5
 *
 * @author Luis Arcos
 */
class Crypt {

    public $key = NULL;

    function Crypt() {
        
    }

    function AES_Encode($plain_text) {

        return base64_encode(openssl_encrypt($plain_text, "aes-256-cbc", $this->key, true, str_repeat(chr(0), 16)));
    }

    function AES_Decode($base64_text) {

        return openssl_decrypt(base64_decode($base64_text), "aes-256-cbc", $this->key, true, str_repeat(chr(0), 16));
    }

}
