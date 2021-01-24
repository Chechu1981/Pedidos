<?php

// Get this by installing Crypt_HMAC using
//      pear install Crypt_HMAC
require_once "Crypt/HMAC.php";
include_once "org_netbeans_saas/RestConnection.php";
include_once "AmazonS3ServiceAuthenticatorProfile.php";

class AmazonS3ServiceAuthenticator {

    public static function getAccessKey() {
        $accessKey = AmazonS3ServiceAuthenticatorProfile::getAccessKey();
        if ($accessKey == null || $accessKey == "") {
            throw new Exception("Please specify your access key in the Profile file.");
        }
        return $accessKey;
    }

    public static function getSecret() {
        $secret = AmazonS3ServiceAuthenticatorProfile::getSecret();
        if ($secret == null || $secret == "") {
            throw new Exception("Please specify your secret key in the Profile file.");
        }
        return $secret;
    }

    public static function sign($headers) {
        $accessKey = self::getAccessKey();
        $secret = self::getSecret();
        if ($accessKey == null || $accessKey == "" ||
                $secret == null || $secret == "") {
            throw new Exception("Please specify your access key and secret in the Profile file.");
        }

        if ($headers == null)
            return "";

        $hasher = & new Crypt_HMAC($secret, "sha1");
        $signature = self::hex2b64($hasher->hash(self::getStringToSign($headers)));
        return "AWS " . $accessKey . ":" . $signature;
    }

    public static function getStringToSign($headers) {
        $httpVerb = $headers["HTTP-Verb"];
        if ($httpVerb == null)
            $httpVerb = "";

        $contentMD5 = $headers["Content-MD5"];
        if ($contentMD5 == null)
            $contentMD5 = "";

        $contentType = $headers["Content-Type"];
        if ($contentType == null)
            $contentType = "";

        $date = $headers["Date"];
        if ($date == null)
            $date = "";

        $stringToSign = $httpVerb . "\n" .
                $contentMD5 . "\n" .
                $contentType . "\n" .
                $date . "\n" .
                self::getCanonicalAmazonHeaders($headers) .
                self::getCanonicalResource($headers);

        return $stringToSign;
    }

    private static function getCanonicalAmazonHeaders($headers) {
        return "";
    }

    private static function getCanonicalResource($headers) {
        $prefix = "";
        $bucket = $headers["Bucket"];
        if ($bucket != null && strlen($bucket) > 0) {
            $prefix = "/" . $bucket;
        }

        $suffix = "";
        $uri = $headers["HTTP-Request-URI"];

        if ($uri == null || $uri == "") {
            $uri = "/";
        }

        if (strpos($uri, "?") !== false) {
            $index = strpos($uri, "?");
            $suffix .= substr($uri, 0, $index);

            $query = substr($uri, $index);

            if (strpos($query, "?acl") !== false) {
                $suffix .= "?acl";
            } else if (strpos($query, "?location") !== false) {
                $suffix .= "?location";
            } else if (strpos($query, "?logging") !== false) {
                $suffix .= "?logging";
            } else if (strpos($query, "?torrent") !== false) {
                $suffix .= "?torrent";
            }
        } else {
            $suffix .= $uri;
        }

        return $prefix . $suffix;
    }

    private static function hex2b64($str) {
        $raw = '';
        for ($i = 0; $i < strlen($str); $i+=2) {
            $raw .= chr(hexdec(substr($str, $i, 2)));
        }
        return base64_encode($raw);
    }

}

?>
