<?php

namespace DroidInfotech\DroidBundle\Service;


class Utility {

   /** Function to get latitude and longitude for given location
    * @param string $address address which is to be geocoded
    * @return array
    * * */
   public function geocodeLocation($address) {
      $curlCh = curl_init();
      $encodedAddress = urlencode($address);
      $googleApiUrl = "http://maps.google.com/maps/api/geocode/json?address={$encodedAddress}&sensor=false";
      curl_setopt($curlCh, CURLOPT_URL, $googleApiUrl);
      curl_setopt($curlCh, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curlCh, CURLOPT_SSL_VERIFYHOST, FALSE);
      curl_setopt($curlCh, CURLOPT_SSL_VERIFYPEER, FALSE);
      $serviceResponse = curl_exec($curlCh);
      if (curl_errno($curlCh) == 0) {
         $jsonDecodedResult = json_decode($serviceResponse, true);
         if (($jsonDecodedResult['status'] == 'OK')) {
            return $jsonDecodedResult['results'][0]['geometry']['location'];
         }
      }
      return array();
   }

}
