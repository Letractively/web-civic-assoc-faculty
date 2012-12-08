<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| BBCODE
| -------------------------------------------------------------------
| This file contains two arrays of bbcode for use with the bbcode helper.
| The first array is for buttons and the second is for parsing.
|
*/

$bbcode = array(

//    name                onClick	 
	"b"            =>        "insert_bbcode('[b]', '[/b]')",
	"i"            =>        "insert_bbcode('[i]', '[/i]')",
    "u"            =>        "insert_bbcode('[u]', '[/u]')",
	"hr"		   =>        "insert_bbcode('[hr]', '')",
    "quote"        =>        "insert_bbcode('[q]', '[/q]')",
	"size"         =>        "insert_bbcode('[size=]','[/size]')",
	"color"        =>        "insert_bbcode('[color=]','[/color]')",
    "url"          =>        "insert_bbcode('[url=http://]', '[/url]')",
    "email"        =>        "insert_bbcode('[email=]', '')"
        );


 
$bbcode_to_parse = array(

//    regex                                            replacement                                    clean            loop    

    "#\[base_url\]#i"                        =>        array(base_url(),                                    base_url(),        1),
    "#\[hr\]#i"                            =>        array("<hr width=\"100%\" size=\"1\" />",                "",                1),
    "#\[b\](.+)\[/b\]#isU"                    =>        array("<strong>$1</strong>",                            "",                1),
    "#\[i\](.+)\[/i\]#isU"                    =>        array("<em>$1</em>",                                "",                1),
    "#\[u\](.+)\[/u\]#isU"                    =>        array("<u>$1</u>",                                    "",                1),
    "#\[color=(.+)\](.+)\[/color\]#isU"        =>        array("<span style=\"color:$1\">$2</span>",                "",                1),
    "#\[size=([0-9]+)\](.+)\[/size\]#isU"        =>        array("<span style=\"font-size:$1px\">$2</span>",            "",                1),
    "#\[email=(.+)\]#isU"                     =>        array("<a href=\"mailto:$1\" >$1</a>",                    "",        1),
    "#\[url=(.+)\](.+)\[/url\]#isU"            =>        array("<a href=\"$1\" >$2</a>",            "$1 ($2)",        1),
    "#\[q\](.+)\[/q\]#isU"                    =>        array("<blockquote>$1</blockquote>",                    "\"$1\"",            5),
        );
?>