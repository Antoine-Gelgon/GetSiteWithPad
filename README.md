# GetSiteWithPad
Import the contents of a pad in a web page with php

This projet is a fork of [padList2htmlList](https://github.com/Interstices-/padList2htmlList) of Interstices.

GetSiteWithPad generates the content of a html site on a framapad.

![GetSiteWithPad](https://github.com/Antoine-Gelgon/GetSiteWithPad/raw/master/screenshot_GSWP-2.png)

###Add Pad
The pad is injected with php.

    $padUrl = 'Url/Pad';
    $datas = file_get_contents($padUrl.'/export/html');

###Create marks
With function php preg_replace

    $datasEnd = preg_replace($pregEnter, $pregExit, $datas);

$pregEnter, $pregExit are array. To add or modify marks 

    $pregEnter[3] = '/\[img\](.*?)\[img\]/';
    $pregExit[3] = '<img src="$1" />';

Example : to display a picture:
  Write this on the pad:

    [img]url/picture[img]

will be translated on the site:

    <img scr="url/picture" />

###Change PassWord
To access the pad directly trough the site with a password.

Change de password in index.php line 30.

    $motdepass = "mdp";

###Add Files on The Server
You can upload files directly with form :
    
    formUp-files.php -> all formats
    formUp-images.php -> jpg svg png gif

### License
GNU GENERAL PUBLIC LICENSE

####Contact
Antoine Gelgon antoine.gelgon@gmail.com
