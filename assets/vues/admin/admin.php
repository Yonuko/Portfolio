<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://sacha-eghiazarian.fr/assets/style/Admin/admin.css">
    <title>Admin - accueil</title>
    <?php
        if(!isset($_SESSION["name"]) || !isset($_SESSION["id"])){
            header("location:https://sacha-eghiazarian.fr/login");
            return;
        }
    ?>
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
                        <img onclick="notificationCloseButton()" class="close" src="https://sacha-eghiazarian.fr/assets/image/closeIcon.png" alt="croix fermante">
                    </div>
                    <div class="notification-content">
                       <!--  aucune notification -->
                       <div onclick="readNotif(1)" class="notification-card" id="notification-1">
                           <div class="card-content">
                                On s'en ballance
                           </div>
                           <img onclick="removeNotif(1)" class="close" src="https://sacha-eghiazarian.fr/assets/image/closeIcon.png" alt="croix fermante">
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
                <!-- First row where there are showed the web site infos -->
                <div class="card webSite-info">
                    <div class="card-body">
                        <img src="https://sacha-eghiazarian.fr/assets/image/Messages.png" alt="Messages count icon">
                        0 nouveaux messages
                    </div>
                </div>
                <div class="card webSite-info">
                    <div class="card-body">
                        <img src="https://sacha-eghiazarian.fr/assets/image/pagesViewed.png" alt="Messages count icon">
                        <?php echo sendRequest("SELECT SUM(views) FROM utilisateurs;", [], PDO::FETCH_NUM)[0][0] ?> pages vues
                    </div>
                </div>
                <div class="card webSite-info">
                    <div class="card-body">
                        <img src="https://sacha-eghiazarian.fr/assets/image/Users.png" alt="Messages count icon">
                        <?php echo sendRequest("SELECT count(*) FROM utilisateurs;", [], PDO::FETCH_NUM)[0][0] ?> utilisateurs
                    </div>
                </div>
                <!-- Card of projects and skills -->
                <div class="card projet">
                    <div class="card-header">
                        <div class="card-title">Projets</div>
                        <div>
                            <img src="https://sacha-eghiazarian.fr/assets/image/refresh.png" alt="Refresh icon">
                            <img src="https://sacha-eghiazarian.fr/assets/image/more.png" alt="More icon"
                            onclick="location.href = 'https://sacha-eghiazarian.fr/admin/projects'">
                        </div>
                    </div>
                    <div class="card-body">
                    <?php 
                        $rqt = "SELECT * FROM projects;";
                        $projects = sendRequest($rqt, [], PDO::FETCH_ASSOC);
                        if(!is_null($projects)){  
                            foreach($projects as $project){
                                extract($project);
                                $rqt = "SELECT name FROM project_type p INNER JOIN project_types pt 
                                ON pt.project_type_id = p.project_type_id WHERE project_id = ? LIMIT 1;";
                                $type = sendRequest($rqt, [$project_id], PDO::FETCH_ASSOC)[0]["name"];
                                echo "<div class='card'>
                                <div class='card-body'>
                                    <img src='https://sacha-eghiazarian.fr/assets/image/Uploads/Projets/$logo' alt='Icon du projet $name'>
                                    <div>$name</div>
                                    <div>$type</div>
                                    <div>vues semaine: $views_semaine</div> <!-- Remplacer par le nombre de vues de cette semaine -->
                                    <div>vues totales: $views</div>
                                    <img class='edit' onclick=\"window.location = 'https://sacha-eghiazarian.fr/admin/projects/$project_id'\"
                                    src='https://sacha-eghiazarian.fr/assets/image/edit.png' alt='Edit Icon'>
                                    <img class='edit' onclick=\"window.location = 'https://sacha-eghiazarian.fr/admin/projects/$project_id/delete'\"
                                    src='https://sacha-eghiazarian.fr/assets/image/delete.png' alt='Delete Icon'>
                                </div>
                            </div>";
                            }
                        }else{
                            echo "<p style='text-align: center;'>Aucun projet disponible, veuillez en créer un</p>";
                        }
                    ?>
                    </div>
                </div>

                <div class="card blog">
                    <div class="card-header">
                        <div class="card-title">Blog</div>
                        <div>
                            <img src="https://sacha-eghiazarian.fr/assets/image/refresh.png" alt="Refresh icon">
                            <img src="https://sacha-eghiazarian.fr/assets/image/more.png" alt="More icon"
                            onclick="location.href = 'https://sacha-eghiazarian.fr/admin/blog'">
                        </div>
                    </div>
                    <div class="card-body">
                        <?php 
                            $rqt = "SELECT * FROM posts;";
                            $posts = sendRequest($rqt, [], PDO::FETCH_ASSOC);
                            if(!is_null($posts)){  
                                foreach($posts as $post){
                                    extract($post);
                                    echo "<div class='card'>
                                    <div class='card-body'>
                                        <img src='https://sacha-eghiazarian.fr/assets/image/Uploads/Blog/$logo' alt='Icon du projet $name'>
                                        <div>$name</div>
                                        <div>Dev</div>
                                        <div>vues semaine: $views_semaine</div> <!-- Remplacer par le nombre de vues de cette semaine -->
                                        <div>vues totales: $views</div>
                                        <img class='edit' onclick=\"window.location = 'https://sacha-eghiazarian.fr/admin/blog/$post_id'\"
                                        src='https://sacha-eghiazarian.fr/assets/image/edit.png' alt='Edit Icon'>
                                        <img class='edit' onclick=\"window.location = 'https://sacha-eghiazarian.fr/admin/blog/$post_id/delete'\"
                                        src='https://sacha-eghiazarian.fr/assets/image/delete.png' alt='Delete Icon'>
                                    </div>
                                </div>";
                                }
                            }else{
                                echo "<p style='text-align: center;'>Aucun projet disponible, veuillez en créer un</p>";
                            }
                        ?>
                    </div>
                </div>

                <div class="card skills">
                    <div class="card-header">
                        <div class="card-title">Competences</div>
                        <div>
                            <img src="https://sacha-eghiazarian.fr/assets/image/refresh.png" alt="Refresh icon">
                            <img src="https://sacha-eghiazarian.fr/assets/image/more.png" alt="More icon"
                            onclick="location.href = 'https://sacha-eghiazarian.fr/admin/skills'">
                        </div>
                    </div>
                    <div class="card-body">
                        <?php 
                            $rqt = "SELECT * FROM skills ORDER BY level DESC;";
                            $skills = sendRequest($rqt, [], PDO::FETCH_ASSOC);
                            if(is_null($skills)){
                                echo "<p style='text-align:center;'>Aucun skills n'est disponible pour l'instant</p>";
                            }else{
                                foreach($skills as $skill){
                                    extract($skill);
                                    echo "
                                    <div class='skill'>
                                        $name
                                        <div class='skill-bar-holder'>
                                            <span class='skill-bar' aria-valuenow='$level' aria-valuemin='1' aria-valuemax='100'></span>
                                        </div> 
                                    </div>
                                    ";
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </main>
    </header>
    <script src="https://sacha-eghiazarian.fr/assets/script/notification.js"></script>
    <script src="https://sacha-eghiazarian.fr/assets/script/Skills.js"></script>
</body>
</html>