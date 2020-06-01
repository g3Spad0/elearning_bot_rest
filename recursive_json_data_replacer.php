<?php
echo "<pre>";
$dir = "/home/max/ftp/elearning_bot/files/files_1/"; //это путь для тестов. Там целиком копии всех файлов сервера лежат



$rdir = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir), TRUE);

foreach ($rdir as $file)
{

    if(preg_match("/\.(json)$/", $file))
    {
        echo str_repeat('',$rdir->getDepth()).$file;    // это путь до json, его можно пихать в функцию
        echo '<br>';
    }

}



function replacer ($path)
{
    $oldstr = "http://83.220.170.194:8070";
    $oldstr2 = "http://83.220.170.194:8080";
    $newstr = "https://elearningbots.ru/";

    $str = file_get_contents($path);
    if (strpos($str, $oldstr)) {
        $str = str_ireplace($oldstr, $newstr, $str);
        file_put_contents($path, $str);
    }

    if (strpos($str, $oldstr2)) {
        $str = str_ireplace($oldstr2, $newstr, $str);
        file_put_contents($path, $str);
    }
}