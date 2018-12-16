<?php
        /**
         * Created by PhpStorm.
         * User: kajiva kinsley
         * Date: 11/7/2018
         * Time: 6:00 PM
         *
         *
         */


function uniqueTransactionIdGenerator():string{
        mt_srand((double)microtime()*10000);
        $charid = md5(uniqid(rand(), true));
        $c = unpack("C*",$charid);
        $c = implode("",$c);
        
        
        return get_random_string( rand(4,8)) .substr($c,0,40).'.'.time().'.'.get_random_string( rand(4,11));
}

    /**
*will validate number and will strip out + and spaces,
* expects country code hence 12 numbers are expected
**/
function isNumberValid(string $mobileNumber):bool{
        
        $stripped= str_replace( '+', '', $mobileNumber );
        $stripped= str_replace( ',', '',  $stripped );
        $stripped = trim( $stripped );
        $stripped = str_replace(' ', '', $stripped);
return  preg_match('/^[0-9]{12}+$/', $stripped );
}
	function file_size($fsizebyte) {
		if ($fsizebyte < 1024) {
			$fsize = $fsizebyte." bytes";
		}elseif (($fsizebyte >= 1024) && ($fsizebyte < 1048576)) {
			$fsize = round(($fsizebyte/1024), 2);
			$fsize = $fsize." KB";
		}elseif (($fsizebyte >= 1048576) && ($fsizebyte < 1073741824)) {
			$fsize = round(($fsizebyte/1048576), 2);
			$fsize = $fsize." MB";
		}elseif ($fsizebyte >= 1073741824) {
			$fsize = round(($fsizebyte/1073741824), 2);
			$fsize = $fsize." GB";
		};
		return $fsize;
	}
	function dirsize($dir) {
		if(is_file($dir)) return array('size'=>filesize($dir),'howmany'=>0);
		if($dh=opendir($dir)) {
			$size=0;
			$n = 0;
			while(($file=readdir($dh))!==false) {
				if($file=='.' || $file=='..') continue;
				$n++;
				$data = dirsize($dir.'/'.$file);
				$size += $data['size'];
				$n += $data['howmany'];
			}
			closedir($dh);
			return array('size'=>$size,'howmany'=>$n);
		}
		return array('size'=>0,'howmany'=>0);
	}

/**
 * gets folder folder
**/
function folderSize(string $folderDir):string{
	$size = 0 ;
	foreach ( glob(rtrim($folderDir , '/') .'/*' , GLOB_NOSORT)  as $each){
		$size += is_file($each) ? filesize($each) : folderSize($each);
	}
	/*if ( $size < 1024 ) {
		$size = $size . " Bytes";
	} else if ( ( $size < 1048576 ) && ( $size > 1023 ) ) {
		$size = round( $size / 1024 , 1 ) . " KB";
	} else if ( ( $size < 1073741824 ) && ( $size > 1048575 ) ) {
		$size = round( $size / 1048576 , 1 ) . " MB";
	} else {
		$size = round( $size / 1073741824 , 1 ) . " GB";
	}*/

	return $size;
}

function parseLoginUserEmail($user_email_name):array{
    if(empty($user_email_name)){
        return null;
    }
    $str = 'username@domain.com';
    
    $user_email_name = strip_tags(strtolower( trim($user_email_name) ) );
    $user_email_name = preg_replace('/\s+/' , '' , $user_email_name  );// remove white spaces in string

    $username = explode("@",$user_email_name)[0]; //username
    $domain = explode("@",$user_email_name)[1]; // domain.com
    $userGroup = explode("." , $domain)[0]; //domain
    return array(
        'user_name' => trim($username) ,
        'company'   => trim($userGroup)
    );
}
	function generateToken($length = 24) {
		if(function_exists('openssl_random_pseudo_bytes')) {
			$token = base64_encode(openssl_random_pseudo_bytes($length, $strong));
			if($strong == TRUE)
				return strtr(substr($token, 0, $length), '+/=', '-_,'); //base64 is about 33% longer, so we need to truncate the result
		}

		//fallback to mt_rand if php < 5.3 or no openssl available
		$characters = '0123456789';
		$characters .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz/+';
		$charactersLength = strlen($characters)-1;
		$token = '';

		//select some random characters
		for ($i = 0; $i < $length; $i++) {
			$token .= $characters[mt_rand(0, $charactersLength)];
		}

		return $token;
	}

function mail_attachment($files, $path, $mailto, $from_mail, $from_name, $replyto, $subject, $message) {
    $uid = md5(uniqid(time()));

    $header = "From: ".$from_name." <".$from_mail.">\r\n";
    $header .= "Reply-To: ".$replyto."\r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
    $header .= "This is a multi-part message in MIME format.\r\n";
    $header .= "--".$uid."\r\n";
    $header .= "Content-type:text/html; charset=iso-8859-1\r\n";
    $header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $header .= $message."\r\n\r\n";

        foreach ($files as $filename) { 

            $file = $path.$filename;

            $file_size = filesize($file);
            $handle = fopen($file, "r");
            $content = fread($handle, $file_size);
            fclose($handle);
            $content = chunk_split(base64_encode($content));

            $header .= "--".$uid."\r\n";
            $header .= "Content-Type: application/octet-stream; name=\"".$filename."\"\r\n"; // use different content types here
            $header .= "Content-Transfer-Encoding: base64\r\n";
            $header .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
            $header .= $content."\r\n\r\n";
        }

    $header .= "--".$uid."--";
    return mail($mailto, $subject, "", $header);
}

function downloadFile(string $filepath){
    if(file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        flush(); // Flush system output buffer
        readfile($filepath);
        exit;
    }
}


	function relative_date($time) {

		$today = strtotime(date('M j, Y'));

		$reldays = ($time - $today)/86400;

		if ($reldays >= 0 && $reldays < 1) {

			return 'Today';

		} else if ($reldays >= 1 && $reldays < 2) {

			return 'Tomorrow';

		} else if ($reldays >= -1 && $reldays < 0) {

			return 'Yesterday';

		}

		if (abs($reldays) < 7) {

			if ($reldays > 0) {

				$reldays = floor($reldays);

				return 'In ' . $reldays . ' day' . ($reldays != 1 ? 's' : '');

			} else {

				$reldays = abs(floor($reldays));

				return $reldays . ' day' . ($reldays != 1 ? 's' : '') . ' ago';

			}

		}

		if (abs($reldays) < 182) {

			return date('l, j F',$time ? $time : time());

		} else {

			return date('l, j F, Y',$time ? $time : time());

		}

	}



	function isTodayTomorrowPast($date_year_month_day):string{
    //$yourdate = "2016-01-26";
    if(strtotime($date_year_month_day) < strtotime(date('Y-m-d')))
    {
        return "past date";
    }
    else if (strtotime($date_year_month_day) == strtotime(date('Y-m-d'))){
        return "today date";
    }
    else if (strtotime($date_year_month_day) > strtotime(date('Y-m-d'))){
        return "tomorrow date";
    }
}

function openNewBlankTab(String $link_href , string $title):string {
    $string = "<a href='$link_href'> $title </a> ";
    $string = preg_replace("/<a(.*?)>/", "<a$1 target='_blank'>", $string);
    return $string;
}
//echo openNewBlankTab("rwere","44");
function generateCsv($data, $delimiter = ',', $enclosure = '"') {
    $contents="";
    $handle = fopen('php://temp', 'r+');
    foreach ($data as $line) {
        fputcsv($handle, $line, $delimiter, $enclosure);
    }
    rewind($handle);
    while (!feof($handle)) {
        $contents .= fread($handle, 8192);
    }
    fclose($handle);
    return $contents;
}
function copyright_text($year_one, $website_name) {
    $year = date('Y');
    echo "&copy; Copyright ";
    echo $year_one;
    if($year_one != $year) {
        echo "-$year";
    }
    echo ", $website_name, All Rights Reserved Worldwide.";
}
//echo copyright_text(2014, "Your Website Name");
/**
 * Returns the number of seconds/minutes/hour/days/weeks/months/year ago
 *
 * @param string $time_1 The datetime to parse
 * @param string $time_2 The datetime to parse
 * @param boolean $complete Whether to return the full time ago. Default is false.
 * @param boolean $past Whether to return time ago or remaining time. Default is true.
 *
 * @return string    The time difference
 *
 * @since 1.0
 */
function time_difference($time_1, $time_2, $complete = false, $past = true)
{
    $time_1 = new DateTime($time_1); // Initiate the DateInterval Class

    $time_2 = new DateTime($time_2); // Initiate the DateInterval Class

    $diff = $time_1->diff($time_2);

    $diff->w = floor($diff->d / 7);

    $diff->d -= $diff->w * 7;

    $args = [
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    ];

    foreach ($args as $key => &$value) {

        if ($diff->$key)
            $value = $diff->$key . ' ' . $value . ($diff->$key > 1 ? 's' : '');
        else
            unset($args[$key]);
    }

    if (!$complete) $args = array_slice($args, 0, 1);

    if ($past === true)
        $return = ($args) ? implode(', ', $args) . ' ago' : 'just now';
    else
        $return = ($args) ? implode(', ', $args) : 'a moment';

    return $return;
}

/**
 * Get IP Address
 *
 * @return string|void   IP Address if found and void otherwise
 */
function real_ip()
{
    $header_checks = [
        'HTTP_CLIENT_IP',
        'HTTP_PRAGMA',
        'HTTP_XONNECTION',
        'HTTP_CACHE_INFO',
        'HTTP_XPROXY',
        'HTTP_PROXY',
        'HTTP_PROXY_CONNECTION',
        'HTTP_VIA',
        'HTTP_X_COMING_FROM',
        'HTTP_COMING_FROM',
        'HTTP_X_FORWARDED_FOR',
        'HTTP_X_FORWARDED',
        'HTTP_X_CLUSTER_CLIENT_IP',
        'HTTP_FORWARDED_FOR',
        'HTTP_FORWARDED',
        'ZHTTP_CACHE_CONTROL',
        'REMOTE_ADDR'
    ];

    foreach ($header_checks as $key) {

        if (array_key_exists($key, $_SERVER) === false) continue;

        foreach (explode(',', $_SERVER[$key]) as $ip) {

            $ip = trim($ip);

            // Filter the ip with filter functions
            return filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) !== false ? $ip : '127.0.0.1';
        }
    }

}

/**
 * Check if 2 arrays are equal
 *
 * @param array $array1
 * @param array $array2
 *
 * @return boolean   true if equal and false otherwise
 */
function is_array_equal($array1, $array2)
{
    if (!is_array($array1) || !is_array($array2)) return false;
    if (empty($array1) && empty($array2)) return true;
    if ((empty($array1) && !empty($array2)) || (!empty($array1) && empty($array2))) return false;

    // Check if arrays are too deep.
    $array1_keys = array_keys($array1);
    $array2_keys = array_keys($array2);

    if (is_array($array1[$array1_keys[0]]) || is_array($array2[$array2_keys[0]])) {
        function array_recursive_diff($array1, $array2)
        {
            $a_return = [];

            foreach ($array1 as $m_key => $m_value) {
                if (array_key_exists($m_key, $array2)) {
                    if (is_array($m_value)) {
                        $a_recursive_diff = array_recursive_diff($m_value, $array2[$m_key]);

                        if (count($a_recursive_diff)) $a_return[$m_key] = $a_recursive_diff;

                    } else {
                        if ($m_value == $array2[$m_key]) continue;

                        $a_return[$m_key] = $m_value;
                    }
                } else {
                    $a_return[$m_key] = $m_value;
                }
            }

            return $a_return;
        }

        return empty(array_recursive_diff($array1, $array2)) ? true : false;

    } else {

        if (array_diff_assoc($array1, $array2) === array_diff_assoc($array2, $array1))
            return true;
        else
            return false;
    }
}

/**
 * Handles PHP start session
 * @return boolean|void
 */
function start_session()
{
    if (php_sapi_name() === 'cli') return false;

    if (version_compare(phpversion(), '5.4.0', '>='))
        $started = session_status() === PHP_SESSION_ACTIVE ? true : false;
    else
        // This will eventually not run,
        // because the library requires PHP >= 5.6
        $started = session_id() === '' ? false : true;

    if ($started === false) {
        ob_start();
        session_start();
    }
}

/**
 * Create random string
 *
 * @param int $length The length of string to get. Default is 20
 * @return string    The string generated.
 */
function get_random_string($length = 20):string{
    $chars = '56789abcdefghijklmABCDEFGHIJKLM01234nopqrstuvwxyzNOPQRSTUVWXYZ';

    $s = '';

    for ($i = 0; $i < $length; $i++)
        $s .= $chars[rand(0, strlen($chars) - 1)];

    return $s;
}
/**
 * Returns string separated by comma
 * @param array $simpleArray
 * @return string
 */
function convertArrayToString (array $simpleArray):string{

		return rtrim(implode(',', $simpleArray), ',');
}
/**
 * Returns Supported currencies
 * @param string $currency Optional currency data to retrieve.
 * @return object
 */
function currencies($currency = null)
{
    /**
     * List of support currencies for
     * 1 - This type of currency does not support decimals.
     *
     * @var object
     */
    $currencies = json_decode(json_encode([
        'AUD' => [
            'name' => 'Australian Dollar',
            'major' => 'dollar',
            'minor' => 'cent',
            'symbol' => '$',
            'decimals' => 2,
            'decimal_sep' => '.',
            'thousand_sep' => ' ',
        ],

        'BRL' => [
            'name' => 'Brazilian Real',
            'major' => 'real',
            'minor' => 'centavo',
            'symbol' => 'R$',
            'decimals' => 2,
            'decimal_sep' => ',',
            'thousand_sep' => '.',
        ],

        'CAD' => [
            'name' => 'Canadian Dollar',
            'major' => 'dollar',
            'minor' => 'cent',
            'symbol' => '$',
            'decimals' => 2,
            'decimal_sep' => '.',
            'thousand_sep' => ',',
        ],

        'CNY' => [
            'name' => 'Chinese Yuan Renminbi',
            'major' => 'yuan renminbi',
            'minor' => 'jiao',
            'symbol' => '¥',
            'decimals' => 2,
            'decimal_sep' => '.',
            'thousand_sep' => ',',
        ],

        'CZK' => [
            'name' => 'Czech Koruna',
            'major' => 'koruna',
            'minor' => 'haler',
            'symbol' => 'Kč',
            'decimals' => 2,
            'decimal_sep' => ',',
            'thousand_sep' => '.',
        ],

        'DKK' => [
            'name' => 'Danish Krone',
            'major' => 'krone',
            'minor' => 'øre',
            'symbol' => 'kr',
            'decimals' => 2,
            'decimal_sep' => ',',
            'thousand_sep' => '.',
        ],

        'EUR' => [
            'name' => 'Euro',
            'major' => 'euro',
            'minor' => 'cent',
            'symbol' => '€',
            'decimals' => 2,
            'decimal_sep' => '.',
            'thousand_sep' => ',',
        ],

        'HKD' => [
            'name' => 'Hong Kong Dollar',
            'major' => 'dollar',
            'minor' => 'cent',
            'symbol' => '$',
            'decimals' => 2,
            'decimal_sep' => '.',
            'thousand_sep' => ',',
        ],

        'HUF' => [
            'name' => 'Hungarian Forint',
            'major' => 'forint',
            'minor' => '',
            'symbol' => 'Ft',
            'decimals' => 0,
            'decimal_sep' => '',
            'thousand_sep' => '.',
        ], // 1

        'ILS' => [
            'name' => 'Israeli New Shekel',
            'major' => 'new shekel',
            'minor' => 'agora',
            'symbol' => '₪',
            'decimals' => 2,
            'decimal_sep' => '.',
            'thousand_sep' => ',',
        ],

        'JPY' => [
            'name' => 'Japanese Yen',
            'major' => 'yen',
            'minor' => 'sen',
            'symbol' => '¥',
            'decimals' => 0,
            'decimal_sep' => '',
            'thousand_sep' => ',',
        ], // 1

        'MYR' => [
            'name' => 'Malaysian Ringgit',
            'major' => 'ringgit',
            'minor' => 'sen',
            'symbol' => 'RM',
            'decimals' => 2,
            'decimal_sep' => '.',
            'thousand_sep' => ',',
        ],

        'MXN' => [
            'name' => 'Mexican Peso',
            'major' => 'peso',
            'minor' => 'centavo',
            'symbol' => '$',
            'decimals' => 2,
            'decimal_sep' => '.',
            'thousand_sep' => ',',
        ],

        'NGN' => [
            'name' => 'Nigerian Naira',
            'major' => 'naira',
            'minor' => 'kobo',
            'symbol' => '₦',
            'decimals' => 2,
            'decimal_sep' => '.',
            'thousand_sep' => ',',
        ],

        'NZD' => [
            'name' => 'New Zealand Dollar',
            'major' => 'dollar',
            'minor' => 'cent',
            'symbol' => '$',
            'decimals' => 2,
            'decimal_sep' => '.',
            'thousand_sep' => ',',
        ],

        'NOK' => [
            'name' => 'Norwegian Krone',
            'major' => 'krone',
            'minor' => 'øre',
            'symbol' => 'kr',
            'decimals' => 2,
            'decimal_sep' => ',',
            'thousand_sep' => '.',
        ],

        'PHP' => [
            'name' => 'Philippine Peso',
            'major' => 'peso',
            'minor' => 'centavo',
            'symbol' => '₱',
            'decimals' => 2,
            'decimal_sep' => '.',
            'thousand_sep' => ',',
        ],

        'PLN' => [
            'name' => 'Polish Zloty',
            'major' => 'zloty',
            'minor' => 'grosz',
            'symbol' => 'zł',
            'decimals' => 2,
            'decimal_sep' => ',',
            'thousand_sep' => ' ',
        ],

        'GBP' => [
            'name' => 'Pound Sterling',
            'major' => 'pound',
            'minor' => 'pence',
            'symbol' => '£',
            'decimals' => 2,
            'decimal_sep' => '.',
            'thousand_sep' => ',',
        ],

        'RUB' => [
            'name' => 'Russian Ruble',
            'major' => 'ruble',
            'minor' => 'kopeck',
            'symbol' => '₽',
            'decimals' => 2,
            'decimal_sep' => ',',
            'thousand_sep' => '.',
        ],

        'SGD' => [
            'name' => 'Singapore Dollar',
            'major' => 'dollar',
            'minor' => 'cent',
            'symbol' => '$',
            'decimals' => 2,
            'decimal_sep' => '.',
            'thousand_sep' => ',',
        ],

        'SEK' => [
            'name' => 'Swedish Krona',
            'major' => 'krona',
            'minor' => 'öre',
            'symbol' => 'kr',
            'decimals' => 2,
            'decimal_sep' => ',',
            'thousand_sep' => ' ',
        ],

        'CHF' => [
            'name' => 'Swiss Franc',
            'major' => 'franken',
            'minor' => 'rappen',
            'symbol' => 'CHF',
            'decimals' => 2,
            'decimal_sep' => '.',
            'thousand_sep' => "'",
        ],

        'TWD' => [
            'name' => 'Taiwan New Dollar',
            'major' => 'new dollar',
            'minor' => 'cent',
            'symbol' => 'NT$',
            'decimals' => 0,
            'decimal_sep' => '',
            'thousand_sep' => ',',
        ], // 1

        'THB' => [
            'name' => 'Thai baht',
            'major' => 'baht',
            'minor' => 'satang',
            'symbol' => '฿',
            'decimals' => 2,
            'decimal_sep' => '.',
            'thousand_sep' => ',',
        ],

        'USD' => [
            'name' => 'United States Dollar',
            'major' => 'dollar',
            'minor' => 'cent',
            'symbol' => '$',
            'decimals' => 2,
            'decimal_sep' => '.',
            'thousand_sep' => ',',
        ],
    ]));

    if (!empty($currency) && isset($currencies->$currency)) {
        return $currencies->$currency;
    }

    return $currencies;
}


/**
 * Formats a number as a currency string
 *
 * @param int|float(double) $number The number to be formatted
 * @param string $code Currency to use(Alpha ISO 4217 Code) , will be replaced with symbol if symbol is true. Defaults to usd
 * @param bool $symbol Whether to use the currency symbol or not
 * @param string $position Where to place the currency/symbol. Accepts 'left', 'right', 'left_space', 'right_space'. Default 'left_space'
 * @return string Returns the formatted string or false if $code is not a string
 */
function money_form($number, $code = 'usd', $symbol = false, $position = 'left_space')
{
    $code = empty($code) ? 'usd' : $code;
    $position = empty($position) ? 'left_space' : $position;

    $currency = currencies(strtoupper($code));
    $number = empty($number) ? 0.00 : floatval($number);
    $symbol = $symbol ? $currency->symbol : $code;

    $decimals = $currency->decimals;
    $decimal_sep = $currency->decimal_sep;
    $thousand_sep = $currency->thousand_sep;
    $number = number_format($number, $decimals, $decimal_sep, $thousand_sep);

    switch ($position) {
        case 'left' :
            $money = "$symbol$number";
            break;
        case 'left_space' :
            $money = "$symbol $number";
            break;
        case 'right' :
            $money = "$number$symbol";
            break;
        case 'right_space' :
            $money = "$number $symbol";
            break;
        default :
            $money = "$symbol$number";
            break;
    }

    return $money;
}

/**
 * Converts a HEX value to RGB.
 *
 * @since 1.0
 *
 * @param string $hex The 3- or 6-digit hexadecimal value.
 * @param int $opacity The opacity to use for alpha. Default is 1
 * @return string String containing RGBA (red, green, blue and alpha) values for the given
 *               HEX code, original hex value otherwise.
 */
function hex2rgb($hex, $opacity = 1)
{
    if (!is_numeric($opacity)) return $hex;

    $hex = str_replace('#', '', $hex);
    $opacity = ($opacity > 1) ? 1 : (($opacity < 0) ? 0 : $opacity);

    if (strlen($hex) === 3) {
        $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
        $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
        $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
    } elseif (strlen($hex) === 6) {
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
    } else {
        return $hex;
    }

    return "rgba( $r, $g, $b, $opacity )";
}