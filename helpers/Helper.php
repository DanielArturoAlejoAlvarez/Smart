<?php  

    class Helper{
        
        private function __construct(){
            
        }
       
        public static function truncate($str) {
            $chars = 30;
            if (strlen($str) <= $chars) {
                return $str;
            }
            $str = $str." ";
            $str = substr($str,0,$chars);
            $str = substr($str,0,strrpos($str,' '));
            $str = $str."...";
            return $str;
        }

        public static function dateTime($date){
            $today= date('l jS \of F Y h:i:s', strtotime($date));
            return $today;
        }

        public static function slugify($text){
            // replace non letter or digits by -
            $text = preg_replace('~[^\pL\d]+~u', '-', $text);

            // transliterate
            $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

            // remove unwanted characters
            $text = preg_replace('~[^-\w]+~', '', $text);

            // trim
            $text = trim($text, '-');

            // remove duplicate -
            $text = preg_replace('~-+~', '-', $text);

            // lowercase
            $text = strtolower($text);

            if (empty($text)) {
                return 'n-a';
            }

            return $text;
            }

        }

        
    