<?php
$projet = $_GET['title'];

if(empty ($projet)){
  $projet= 'home';
}
?>
  <html>
        <head lang="fr-FR">
        <meta charset="UTF-8">
        <title><?php echo $projet; ?></title>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.js"></script>
        <link type="text/css" rel="stylesheet" href="style.css" />
        <style>
        <?php ?>
        </style>
  </head>

  <body>
    <!--On affiche en titre le nom du pad-->
      <div style="position:fixed; bottom:10px; left:10px;" >
        <a  href="index.php">⇽</a>
        <?php echo $projet ?>
      </div>


    <?php
    //mettre ici le mot de passe que vous voulez.
    $motdepass= "mdp";
    //si le mot de passe est vide alors ça affiche le formulaire pour le passe
    if (empty($_POST['motdepass'])){
    ?>


    <form class="form-mdp" action="index.php?title=<?php echo $projet; ?>" method="post">
    <input type="text" name="motdepass"/>
    <input type="submit" value="ok"/>
    </form>

    <?php
    }

    else{
      if($_POST['motdepass'] == $motdepass) {
        ?>
        <div class="box-pad" id="resizeDiv">
          <a class="btn-files">Files</a>//<a class="btn-images">Images</a>
          <iframe src="https://lite6.framapad.org/p/GetSiteWithPad-<?php echo $projet; ?>"></iframe>
          </div>
        <div class="box-images">Images<a class="btn-images">X</a>
          <?php include('formUp-images.php'); ?>
        </div>
        <div class="box-files">Images<a class="btn-files">X</a>
          <?php include('formUp-files.php'); ?>
        </div>
    <?php
      }
      else{
    ?>
    Mauvais mot de passe.
    <?php
      }
    }

    //récupérer le contenu du pad
    //mettre le pad
    $padUrl = 'https://lite6.framapad.org/p/GetSiteWithPad-'.$projet;
    $datas = file_get_contents($padUrl.'/export/html');
    $pregEnter = array();
    $pregExit = array();
    $strEnter = array();
    $strExit = array();


    //Titre- h1//
    $pregEnter[0] = '/<a href="(.*?)">(.*?)<\/a>/';
    $pregExit[0] = '$1';


    //Titre- h1//
    $pregEnter[1] = '/\[t\](.*?)\[(.*?)\]/';
    $pregExit[1] = '<h1>$1</h1>';

    //Doc - invisible//
    $pregEnter[2] = '/\[doc\](.*?)\[doc\]/';
    $pregExit[2] = '<div style="display:none" >$1</div>';

    //image- h1//
    $pregEnter[3] = '/\[img\](.*?)\[img\]/';
    $pregExit[3] = '<img src="$1" />';

    $pregEnter[4] = '/\[page(.*?)\](.*?)\[page\]/';
    $pregExit[4] = '<div class="page" id="page$1">$2</div>';

    $pregEnter[5] = '/\[projet\](.*?)\[projet\]/';
    $pregExit[5] = '<div class="projet" id="$1"><a href="index.php?title=$1" >-> $1</a></div>';

    $pregEnter[6] = '/\[code\](.*?)\[code\]/';
    $pregExit[6] = '<code>$1</code>';

    $pregEnter[7] = '/\[h(.*?)\](.*?)\[h(.*?)\]/';
    $pregExit[7] = '<h$1>$2</h$3  >';

    $pregEnter[8] = '@<head[^>]*?>.*?</head>@si';
    $pregExit[8] = '';

    $pregEnter[9] = '@<body[^>]*?>@si';
    $pregExit[9] = ' ';

    $pregEnter[10] = '@</body>@si';
    $pregExit[10] = ' ';

    $pregEnter[11] = '/\[col2\](.*?)\[col2\]/';
    $pregExit[11] = '<div class="col2">$1</div>';

    $pregEnter[12] = '/\[n\](.*?)\[n\]/';
    $pregExit[12] = '<span class="ap-note" id="$1" > $1 </span>';

    $pregEnter[13] = '/\[demi\](.*?)\[demi\]/';
    $pregExit[13] = '<div class="demi" > $1 </div>';

    $pregEnter[14] = '/\[nt:(.*?)\](.*?)\[nt:(.*?)\]/';
    $pregExit[14] = '<div class="note" id="note-$1" >-------<br>$1 — $2</div>';

    $pregEnter[15] = '/\[cont-right\](.*?)\[cont-right\]/';
    $pregExit[15] = '<div class="cont-right" >$1</div>';

    //$pregEnter[16] = '/\[projet:(.*?)\](.*?)\[projet:(.*?)\]/';
    //$pregExit[16] = '<div class="note" id="note-$1" >-------<br>$1 — $2</div>';


    $datasEnd = preg_replace($pregEnter, $pregExit, $datas);

    echo '<div class="container"><br>'.$datasEnd.'</div>';

  ?>
</body>
<script>
    $('.box-images') .hide();
    $('.btn-images') .click(function() {
      $('.box-images') .toggle();
    });

    $('.box-files') .hide();
    $('.btn-files') .click(function() {
      $('.box-files') .toggle();
    });

    //$('.box-note') .hide();

    $(".ap-note").mouseover(function(){
        var nmbId = '#note-'+this.id;
        $(nmbId) .toggleClass('notehover');
    });

    $(".ap-note").mouseout(function(){
        var nmbId = '#note-'+this.id;
        $(nmbId) .toggleClass('notehover');
    });

    $(".projet").mouseover(function(){
        var nmbId = '#note-'+this.id;
        $(nmbId) .toggleClass('notehover');
    });

    $(".projet").mouseout(function(){
        var nmbId = '#note-'+this.id;
        $(nmbId) .toggleClass('notehover');
    });
</script>

  </html>
