<?php 

namespace FcmFirebase\Firebase;

interface Firebase 
{

    public function setTitle($title);

    public function setBody($text);

    public function setImage($url);

    public function setData($params);

    public function condition($topic);

    public function send($params = []);

}