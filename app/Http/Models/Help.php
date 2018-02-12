<?php
/**
 * Created by PhpStorm.
 * User: N'Dalaba
 * Date: 04/08/2015
 * Time: 11:13
 */

namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Help {

    private static $key = "@Thesniper85";

    /**
     * Verifier l'existance d'un objet sur un champ
     * @param string $field
     * @param string $val
     * @param int $id
     * @return bool
     */
    public static function checkObject(Model $model, $field = '', $val = "", $id = 0) {
        if (trim($val) == '')
            return false;
        $objet = $model::where($field, $val)->first();
        if ($objet != null) {
            // S'il s'agit du mm objet alors un autre objet n'existe pas
            if ($objet->id == $id)
                return false;
            else
                return true;
        }
        else
            return false;
    }

    public static function checkElementObject($key, $value, Model $model, $field = '', $val = "", $id = 0) {
        $objet = $model::where($field, $val)->where($key, $value)->first();
        if ($objet != null) {
            // S'il s'agit du mm objet alors un autre objet n'existe pas
            if ($objet->id == $id)
                return false;
            else
                return true;
        }
        else
            return false;
    }

    /**On insiste pour attribuer une valeur au champ publie et revoie la requete
     * @param Request $request
     * @return Request
     */
    public static function publie(Request $request) {
        if (!$request->has('publie'))
            $request->merge(array('publie' => 0));
        else
            $request->merge(array('publie' => 1));
        return $request;
    }

    public static function checked(Request $request, $field) {
        if (!$request->has($field))
            $request->merge(array($field => 0));
        else
            $request->merge(array($field => 1));
        return $request;
    }

    /**
     * @param $index input file name
     * @param $destination file destination
     * @param $column column name
     * @param bool $maxsize
     * @param bool $extensions
     */
    public static function upload($index, $destination, $maxsize, $extensions = FALSE, $i = -1) {

        //Test1: fichier correctement uploadé
        if ($i != -1) {
            if ($_FILES[$index]['error'][$i] > 0)
                return null;
            //Test2: taille limite
            if ($_FILES[$index]['size'][$i] > $maxsize)
                return null;
            //Test3: extension
            $ext = substr(strrchr($_FILES[$index]['name'][$i], '.'), 1);
            if ($extensions !== FALSE AND !in_array($ext, $extensions))
                return null;

            $fileName = time() . '-' . basename($_FILES[$index]['name'][$i]);
            //Déplacement
            if (move_uploaded_file($_FILES[$index]['tmp_name'][$i], 'uploads/' . $destination . $fileName)) {
                return $fileName;
            }
        }
        else {

            if ($_FILES[$index]['error'] > 0)
                return null;
            //Test2: taille limite
            if ($_FILES[$index]['size'] > $maxsize)
                return null;
            //Test3: extension
            $ext = substr(strrchr($_FILES[$index]['name'], '.'), 1);
            if ($extensions !== FALSE AND !in_array($ext, $extensions))
                return null;

            $fileName = time() . '-' . basename($_FILES[$index]['name']);
            //Déplacement
            if (move_uploaded_file($_FILES[$index]['tmp_name'], 'uploads/' . $destination . $fileName)) {
                return $fileName;
            }
        }

        return null;
    }


    public static function basename($file) {
        $pathinfo = pathinfo($file);
        return $pathinfo['basename'];
    }

    public static function timestampToDate($value, $hour = false) {
        if ($value == "0000-00-00")
            return "";
        if (!$hour)
            return date('d/m/Y', strtotime($value));
        else
            return date('d/m/Y H:i', strtotime($value));
    }

    public static function jourMois($value, $echo = false) {
        if ($value == "0000-00-00")
            return "";
        $mois = array('01' => "Jan", "02" => "Fév", "03" => "Ma", "04" => "Avr", "05" => "Mai", "06" => "Jui", "07" => "Juil", "08" => "Aou", "09" => "Sept", "10" => "Oct", "11" => "Nov", "12" => "Déc");
        $jourMois = array('jour' => date('d', strtotime($value)), 'mois' => $mois[date('m', strtotime($value))], 'an' => date('Y', strtotime($value)));
        if ($echo)
            return $jourMois['jour'] . ' ' . $jourMois['mois'] . ' ' . $jourMois['an'];
        return $jourMois;
    }

    public static function hFileSize($bytes, $decimals = 2) {

        $size = array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        $factor = floor((strlen($bytes) - 1) / 3);

        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
    }

    public static function hide_email($email) {
        $character_set = '+-.0123456789@ABCDEFGHIJKLMNOPQRSTUVWXYZ_abcdefghijklmnopqrstuvwxyz';

        $key = str_shuffle($character_set);
        $cipher_text = '';
        $id = 'e' . rand(1, 999999999);

        for ($i = 0; $i < strlen($email); $i += 1)
            $cipher_text .= $key[strpos($character_set, $email[$i])];

        $script = 'var a="' . $key . '";var b=a.split("").sort().join("");var c="' . $cipher_text . '";var d="";';

        $script .= 'for(var e=0;e<c.length;e++)d+=b.charAt(a.indexOf(c.charAt(e)));';

        $script .= 'document.getElementById("' . $id . '").innerHTML="<a href=\\"mailto:"+d+"\\">"+d+"</a>"';

        $script = "eval(\"" . str_replace(array("\\", '"'), array("\\\\", '\"'), $script) . "\")";

        $script = '<script type="text/javascript">/*<![CDATA[*/' . $script . '/*]]>*/</script>';

        return '<span id="' . $id . '">[javascript protected email address]</span>' . $script;

    }

    public static function acronym($value) {
        $words = explode(" ", $value);
        $acronym = "";
        foreach ($words as $w) {
            $acronym .= $w[0];
        }
        return strtoupper($acronym);
    }

    public static function encode($value) {
        return base64_encode($value);
    }

    public static function decode($value) {
        return base64_decode($value);
    }
}
