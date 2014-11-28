<?php

include_once "org_netbeans_saas/RestConnection.php";
include_once "AmazonS3ServiceAuthenticator.php";

class AmazonS3Service {

    public function AmazonS3Service() {
        
    }

    /*
      @return an instance of RestResponse */

    public static function getBuckets() {

        $pathParams = array();
        $queryParams = array();
        $conn = new RestConnection("http://s3.amazonaws.com/", $pathParams, $queryParams);
        $hTTPVerb = "GET";
        $date = $conn->getDate();
        $hTTPRequestURI = null;
        $bucket = "";

        $sign_params = array();
        $sign_params["HTTP-Verb"] = $hTTPVerb;
        $sign_params["Date"] = $date;
        $sign_params["HTTP-Request-URI"] = $hTTPRequestURI;
        $sign_params["Bucket"] = $bucket;
        $authorization = AmazonS3ServiceAuthenticator::sign($sign_params);

        $headerParams = array();
        $headerParams["Date"] = $date;
        $headerParams["Authorization"] = $authorization;

        $conn->setHeaders($headerParams);
        sleep(1);
        return $conn->get();
    }

}

?>
