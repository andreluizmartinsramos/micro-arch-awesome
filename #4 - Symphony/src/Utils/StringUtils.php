<?php
/**
 * Created by PhpStorm.
 * User: rafael.s.ribeiro
 * Date: 27/02/2018
 * Time: 14:07
 */

namespace App\Utils;


use App\Exception\DominioException;

class StringUtils
{
    public static function titleCase($string, $delimiters = array(" ", "-", ".", "'", "O'", "Mc"), $exceptions = array("de", "da", "dos", "das", "do", "I", "II", "III", "IV", "V", "VI")) {
        $string = mb_convert_case($string, MB_CASE_TITLE, "UTF-8");
        foreach ($delimiters as $dlnr => $delimiter) {
            $words = explode($delimiter, $string);
            $newwords = array();
            foreach ($words as $wordnr => $word) {
                if (in_array(mb_strtoupper($word, "UTF-8"), $exceptions)) {
                    // check exceptions list for any words that should be in upper case
                    $word = mb_strtoupper($word, "UTF-8");
                } elseif (in_array(mb_strtolower($word, "UTF-8"), $exceptions)) {
                    // check exceptions list for any words that should be in upper case
                    $word = mb_strtolower($word, "UTF-8");
                } elseif (!in_array($word, $exceptions)) {
                    // convert to uppercase (non-utf8 only)
                    $word = ucfirst($word);
                }
                array_push($newwords, $word);
            }
            $string = join($delimiter, $newwords);
        }//foreach
        return $string;
    }

    public static function extractDominioFromEmail(string $email) {
        $isPossuiArroba = strpos($email, '@');
        if ($isPossuiArroba) {
            $palavras = explode('@', $email);
            $dominio = $palavras[1];
            return $dominio;
        }

        return $email;
    }

    public static function primeiroNome(string $nome): string {
        $nomes = explode(' ', $nome);
        return $nomes[0];
    }

    public static function sobreNome(string $nome): string {
        $nomes = explode(' ', $nome);
        $sobrenome = '';
        foreach ($nomes as $key => $nome)
            if ($key > 0)
                $sobrenome .= ' ' . $nome;
        return trim($sobrenome);
    }

    public static function convertParam(string $param) {
        $params = explode('_', $param);
        $newParam = '';
        for ($i = 0; $i < count($params); $i++) {
            if ($i > 0)
                $newParam .= ucwords($params[$i]);
            else
                $newParam .= $params[$i];
        }
        return $newParam;
    }

    /**
     * Nivel 1 = nome
     * Nivel 2 = nome.sobrenome
     * Nivel 3 = nome.s
     * Nivel 4 = n.sobrenome
     * Nivel 5 = nome.s.sobrenome
     *
     * @param string $nome
     * @param int $nivel
     * @return string
     */
    public static function geraEmailUsuario(string $nome, $dominio, $nivel = 1) {
        $nomeUsuario = null;
        $nomes = explode(' ', self::removeAcentos($nome));
        $primeiroNome = $nomes[0];
        $ultimoNome = $nomes[count($nomes) - 1];

        if ($nomes[1] !== $ultimoNome)
            $nomeMeio = $nomes[1];

        if ($nivel == 1) {
            $nomeUsuario = mb_strtolower($primeiroNome);
        } else if ($nivel == 2) {
            $nomeUsuario = mb_strtolower(implode('.', [$primeiroNome => $primeiroNome, $ultimoNome => $ultimoNome]));
        } else if ($nivel == 3) {
            $ultimaLetraNome = substr($ultimoNome, 0, 1);
            $nomeUsuario = mb_strtolower(implode('.', [$primeiroNome => $primeiroNome, $ultimaLetraNome => $ultimaLetraNome]));
        } else if ($nivel == 4) {
            $primeiraLetraNome = substr($primeiroNome, 0, 1);
            $nomeUsuario = mb_strtolower(implode('.', [$primeiroNome => $primeiroNome, $primeiraLetraNome => $primeiraLetraNome]));
        } else {
            if ($nomeMeio) {
                $nomeUsuario = mb_strtolower(implode('.', [$primeiroNome => $primeiroNome, $nomeMeio => $nomeMeio, $ultimoNome => $ultimoNome]));
            }
        }
        return $nomeUsuario . '@' . $dominio;
    }

    /**
     * @param $string
     * @param bool $slug
     * @return null|string|string[]
     */
    function removeAcentos($string, $slug = false) {

        $string = strtolower(utf8_decode($string));
        // Código ASCII das vogais
        $ascii['a'] = range(224, 230);
        $ascii['e'] = range(232, 235);
        $ascii['i'] = range(236, 239);
        $ascii['o'] = array_merge(range(242, 246), array(240, 248));
        $ascii['u'] = range(249, 252);
        // Código ASCII dos outros caracteres
        $ascii['b'] = array(223);
        $ascii['c'] = array(231);
        $ascii['d'] = array(208);
        $ascii['n'] = array(241);
        $ascii['y'] = array(253, 255);
        foreach ($ascii as $key=>$item) {
            $acentos = '';
            foreach ($item AS $codigo) $acentos .= chr($codigo);
            $troca[$key] = '/['.$acentos.']/i';
        }
        $string = preg_replace(array_values($troca), array_keys($troca), $string);
        // Slug?
        if ($slug) {
            // Troca tudo que não for letra ou número por um caractere ($slug)
            $string = preg_replace('/[^a-z0-9]/i', $slug, $string);
            // Tira os caracteres ($slug) repetidos
            $string = preg_replace('/' . $slug . '{2,}/i', $slug, $string);
            $string = trim($string, $slug);
        }
        return $string;
    }

}
