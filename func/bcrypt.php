<?php
/**
 *  OpenLSS - Lighter Smarter Simpler
 *
 *	This file is part of OpenLSS.
 *
 *	OpenLSS is free software: you can redistribute it and/or modify
 *	it under the terms of the GNU Lesser General Public License as
 *	published by the Free Software Foundation, either version 3 of
 *	the License, or (at your option) any later version.
 *
 *	OpenLSS is distributed in the hope that it will be useful,
 *	but WITHOUT ANY WARRANTY; without even the implied warranty of
 *	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *	GNU Lesser General Public License for more details.
 *
 *	You should have received a copy of the 
 *	GNU Lesser General Public License along with OpenLSS.
 *	If not, see <http://www.gnu.org/licenses/>.
*/
namespace LSS;

// Blowfish password encryption basics
define("BLOWFISH_CRYPT_PRELUDE",'$2a$12$');
define("BLOWFISH_SEED_SIZE"    ,21);
define("BLOWFISH_PRESEED_SIZE" ,29);
define("BLOWFISH_CRYPTED_SIZE" ,60);
function bseed($crypted=''){
	$m = array();
	if(preg_match('/^(\$[^$]+\$[^$]+\$)(.*)$/',$crypted,$m)){
		list(,$prelude,$remainder) = $m;
		$seed = substr($remainder,0,BLOWFISH_SEED_SIZE);
		return $prelude . $seed . '$';
	}
	// a 'simple' random seed generator
	return BLOWFISH_CRYPT_PRELUDE . substr(strtr(base64_encode(openssl_random_pseudo_bytes(128)),'+','/'),0,BLOWFISH_SEED_SIZE) . '$';
}

function bcrypt($plaintext,$seed=''){
	if(strlen($seed) != 0){
		if(strlen($seed) >= BLOWFISH_PRESEED_SIZE)
			$seed = bseed($seed);
		else
			return false;
	} else {
		$seed = bseed();
	}
	$crypted = crypt($plaintext,$seed);
	if(strlen($crypted) != BLOWFISH_CRYPTED_SIZE) return false;
	return $crypted;
}

function bcrypt_check($plaintext,$crypted){
	return ($crypted === bcrypt($plaintext,$crypted))?true:false;
}
