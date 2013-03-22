openlss/func-bcrypt
===========

Blowfish Crypt helper functions for password hashing

These functions are used to aid in bcrypt hashing paswords for a more secure password hashing option

BCrypt hashed passwords are stronger and have inline salting.


Usage
====
```php
ld('func/bcrypt');

$crypted = bcrypt('password');
if(!bcrypt_check('password',$crypted)){
	echo "Authorization Denied";
	exit;
}

Reference
====

### (string) bseed($crypted='')
Returns a blowfish safe seed

### (string) bcrypt($plaintext,$seed='')
Encrypts plain text into a blowfish hash.
Pass $seed if this is an existing hash

### (bool) bcrypt_check($plaintext,$crypted)
Checks a plaintext version against the hash

