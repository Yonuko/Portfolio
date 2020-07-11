<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/portfolio/assets/style/Site/main.css">
    <link rel="stylesheet" href="http://localhost/portfolio/assets/style/Site/post.css">
    <title>Portfolio Sacha EGHIAZARIAN - Post</title>
</head>
<body>
    <header>
        <div class="menu">
            <a href="http://localhost/portfolio">Accueil</a>
            <a href="http://localhost/portfolio/blog">Blog</a>
            <a href="http://localhost/portfolio/projects">Mes projets</a>
            <a href="http://localhost/portfolio/skills">Mes compétences</a>
            <a href="http://localhost/portfolio/contact">Contact</a>
            <?php 
                if(isset($_SESSION["name"]) && isset($_SESSION["id"])){
                    echo("<a href='http://localhost/portfolio/admin'>Admin</a>");
                }
            ?>
        </div>
        <div class="burger">
            <div class="hamburger hamburger-one"></div>
        </div>
    </header>
    <main>
        <section class="post-title">
            Titre de l'article
        </section>
        <section class="Paragraphe">
            <img src="http://localhost/portfolio/assets/image/Uploads/Blog/project.jpg" alt="Les pires niveaux">
            <div class="text">
                <h1 class="title">Sous titre</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis sed nesciunt saepe libero, pariatur numquam rem. Consequuntur, quibusdam! Eaque voluptate, dolore temporibus debitis libero ea porro enim soluta quibusdam quae.</p>
            </div>
        </section>
        <section class="Paragraphe secondary">
            <div class="text">
                <h2 class="title">Sous titre</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis sed nesciunt saepe libero, pariatur numquam rem. Consequuntur, quibusdam! Eaque voluptate, dolore temporibus debitis libero ea porro enim soluta quibusdam quae.</p>
            </div>
        </section>
        <section class="Paragraphe tiercary">
            <div class="text">
                <h2 class="title">Sous titre</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis sed nesciunt saepe libero, pariatur numquam rem. Consequuntur, quibusdam! Eaque voluptate, dolore temporibus debitis libero ea porro enim soluta quibusdam quae.</p>
            </div>
        </section>
        <section class="Paragraphe quad">
            <div class="text">
                <h2 class="title">Sous titre</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis sed nesciunt saepe libero, pariatur numquam rem. Consequuntur, quibusdam! Eaque voluptate, dolore temporibus debitis libero ea porro enim soluta quibusdam quae.</p>
            </div>
        </section>
        <section class="posts">
            <h2>Mes articles</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi vel cumque iusto consectetur natus nostrum provident voluptatem, saepe fugit sit laboriosam consequuntur possimus doloremque fuga sed architecto, voluptatum rem ullam!</p>
            <a class="button" href="http://localhost/portfolio/projects">Mon blog</a>
            <div class="posts-list">
                <?php 
                    $rqt = "SELECT * from projects WHERE isShown = 1 LIMIT 3;";
                    $projects = sendRequest($rqt, [], PDO::FETCH_ASSOC);
                    foreach($projects as $project){
                        extract($project);
                        echo "
                        <div class='posts-item' onclick=\"location.href = 'http://localhost/portfolio/projects/$project_id'\">
                            <span class='image' 
                            style=\"background-image: url('http://localhost/portfolio/assets/image/Uploads/Projets/$logo');\"></span>
                            <p>$name</p>
                        </div>
                        ";
                    }
                ?>
            </div>
        </section>
    </main>
    <footer>
        <div class="menu">
            <a href="http://localhost/portfolio">Accueil</a>
            <a href="http://localhost/portfolio/blog">Blog</a>
            <a href="http://localhost/portfolio/projects">Mes projets</a>
            <a href="http://localhost/portfolio/skills">Mes compétences</a>
            <a href="http://localhost/portfolio/contact">Contact</a>
            <?php 
                if(isset($_SESSION["name"]) && isset($_SESSION["id"])){
                    echo("<a href='http://localhost/portfolio/admin'>Admin</a>");
                }
            ?>
        </div>
    </footer>
    <script src="http://localhost/portfolio/assets/script/burger.js"></script>
</body>
</html>