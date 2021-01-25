<?php
/**
 * Adasi Express
 * Utilities package used in Adasi Software's CodeIgniter 4 projects
 * 
 * Helpers
 * 
 * @author Adasi Software <ricardo@adasi.com.br>
 * @link https://www.adasi.com.br
 */

if (!function_exists('hashEncode')) {
    /**
     * Codifica uma string em base64 de forma legível ao browser.
     *
     * @param string $data
     * @return string
     */
    function hashEncode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }
}

if (!function_exists('hashDecode')) {
    /**
     * Decodifica uma string codificada com base64url_encode.
     *
     * @param string $data
     * @return string
     */
    function hashDecode($data)
    {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }
}

if (! function_exists('maskCpfCnpj')) {

    /**
     * Coloca uma máscara em um cpf ou cpnj
     * 
     * @param string $val
     * @return string
     */
    function maskCpfCnpj($val) {
        return strlen($val) == 11 ? 
            preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", '${1}.${2}.${3}-${4}', $val) : 
            preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", '${1}.${2}.${3}/${4}-${5}', $val);
    }
}