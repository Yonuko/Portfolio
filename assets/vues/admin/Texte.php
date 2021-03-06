<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style/Admin/admin.css">
    <script src="https://sacha-eghiazarian.fr/assets/ckeditor5-build-classic-20.0.0/ckeditor5-build-classic/ckeditor.js" charset="utf-8"></script>
    <title>Admin - texte</title>
    <?php
        if(!isset($_SESSION["name"]) || !isset($_SESSION["id"])){
            header("location:https://sacha-eghiazarian.fr/login");
            return;
        }
    ?>
    <style>

        main .body-content form{
            width: 90%;
            display: flex;
            flex-direction: column;
        }

        main .body-content .skills{
            flex-basis: 100%;
        }
    </style>
</head>
<body>
    <header>
        <div class="menu">
            <div class="login">
                Bienvenue,<br>
                <?php echo $_SESSION["name"]; ?> <!-- Afficher name de l'utilisateur connecté -->
            </div>
            <div class="menu-button">
                <a href="https://sacha-eghiazarian.fr/admin" class="element">
                    <img src="https://sacha-eghiazarian.fr/assets/image/homeIcon.png" alt="home icon"> Accueil
                </a>
                <a href="https://sacha-eghiazarian.fr/admin/blog" class="element">
                    <img src="https://sacha-eghiazarian.fr/assets/image/blogIcon.png" alt="blog icon"> Blog
                </a>
                <a href="https://sacha-eghiazarian.fr/admin/texte" class="element">
                    <img src="https://sacha-eghiazarian.fr/assets/image/textIcon.png" alt="Text icon"> Texte
                </a>
                <a href="https://sacha-eghiazarian.fr/admin/skills" class="element">
                    <img src="https://sacha-eghiazarian.fr/assets/image/skillsIcon.png" alt="skills icon"> Competences
                </a>
                <a href="https://sacha-eghiazarian.fr/admin/projects" class="element">
                    <img src="https://sacha-eghiazarian.fr/assets/image/projectIcon.png" alt="project icon"> Projets
                </a>
                <a href="https://sacha-eghiazarian.fr/admin/CV" class="element">
                    <img src="https://sacha-eghiazarian.fr/assets/image/cvIcon.png" alt="cv icon"> CV
                </a>
            </div>
        </div>

        <div class="secondary-menu">
            <div class="notification">
                <button id="bell" class="logo"></button>
                <span id="num" class="num">0</span>
                <div id="notif-content" class="content">
                    <div class="header">
                        Notifications
                        <img onclick="notificationCloseButton()" class="close" src="../assets/image/closeIcon.png" alt="croix fermante">
                    </div>
                    <div class="notification-content">
                       <!--  aucune notification -->
                       <div onclick="readNotif(1)" class="notification-card" id="notification-1">
                           <div class="card-content">
                                On s'en ballance
                           </div>
                           <img onclick="removeNotif(1)" class="close" src="../assets/image/closeIcon.png" alt="croix fermante">
                       </div>
                    </div>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbtn"><?php echo $_SESSION["name"]; ?></button> <!-- Afficher name de l'utilisateur connecté -->
                <div class="dropdown-content">
                    <a href="https://sacha-eghiazarian.fr/">Retour au site</a>
                    <a href="https://sacha-eghiazarian.fr/blog">Retour au blog</a>
                    <a href="#">Messages</a>
                    <form action="https://sacha-eghiazarian.fr/logout" method="POST">
                        <input type="submit" value="Deconnexion">
                    </form>
                </div>
            </div>
        </div>
        <main>
            <div class="body-content">
                <form action="https://sacha-eghiazarian.fr/admin/texte" method="post">
                <input style="align-self: center; margin: 20px 0;" class="button" type="submit" value="Actualiser">
                <?php 
                    $rqt = "SELECT * FROM dinamictexts ORDER BY id;";
                    $textes = sendRequest($rqt, [], PDO::FETCH_ASSOC);
                    $i = 1;
                    foreach($textes as $text){
                        echo "
                            <div class='card skills'>
                                <div class='card-header'>
                                    " . $text["type"] . "
                                </div>
                                <div class='card-body'>
                                    <textarea name='text-$i' id='text-$i'></textarea>
                                </div>
                                <script>
                                    ClassicEditor
                                    .create( document.querySelector( '#text-$i' ) )
                                    .then( editor => {
                                        editor.setData(\"" . html_entity_decode($text["text"]) . "\");
                                    })
                                    .catch( error => {
                                        console.error( error );
                                    });
                                </script>
                            </div>
                        ";
                        $i++;
                    }
                ?>
                <input style="align-self: center;" class="button" type="submit" value="Actualiser">
                </form>
            </div>
        </main>
    </header>
    <script src="../assets/script/notification.js"></script>
</body>
</html>