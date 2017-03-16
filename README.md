# Laravel 5.4.* Login with Facebook
  
This repo already installed required dependencies:
1. [Google API php client](https://github.com/google/google-api-php-client)  
2. [Guzzle](https://github.com/guzzle/guzzle)  
--------------------------------------------------
## Google Console API Configuration
Make sure you've configured ```CLIENT_ID```, ```CLIENT_SECRET```, ```API_KEY/DEVELOPER_KEY```,
and ```URI_REDIRECT```.  
Location : ```UserController.php``` and ```web.php```.
These configuration can be found at Google Console API
1. for ```API_KEY/DEVELOPER_KEY```  
![DEVELOPER_KEY](https://raw.githubusercontent.com/dhanyn10/laravel-google-login/master/api-key.png)  
2. for ```CLIENT_ID``` and ```CLIENT_SECRET```  
![Oauth](https://raw.githubusercontent.com/dhanyn10/laravel-google-login/master/client-oauth.png)  
3. for ```URI_REDIRECT```  
![Oauth](https://raw.githubusercontent.com/dhanyn10/laravel-google-login/master/uri-redirect.png)  
--------------------------------------------------
## Other Configuration  
Fix problem [cacert](http://stackoverflow.com/questions/30240840/laravel-5-socialite-curl-error-77-error-setting-certificate-verify-locations)  
1. Download file [cacert.pem](https://curl.haxx.se/ca/cacert.pem)  
2. Save as ```cacert.pem.txt``` to ```C:/xampp/php/```  
3. Open php ini  
![Oauth](https://raw.githubusercontent.com/dhanyn10/laravel-google-login/master/open-php-ini.png)  
4. Search ```php.ini Options```  add new line ```curl.cainfo = "C:\xampp\php\cacert.pem.txt"``` and save  
![Oauth](https://raw.githubusercontent.com/dhanyn10/laravel-google-login/master/php-ini-cacert.png)