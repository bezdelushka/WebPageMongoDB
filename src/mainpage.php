<?php
require 'connect.php';
require 'YouTube.php';

//$imageClass = new Image();
$youtubeClass = new YouTube();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['ytvid']) && !empty($_POST['ytvid'])) {
        $youtube_link = $_POST['ytvid'];
        $_SESSION['youtube_link'] = $youtube_link;
    }
}

//     if (count($_FILES) > 0) {
//         $imageClass->uploadImage($_FILES['pfp']);
//         $_SESSION['image_uploaded'] = true;
//     }
// }

function getYouTubeVideoID($url) {
    global $youtubeClass;
    return $youtubeClass->getVideoID($url);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Ta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div class="left">
    <div class="center">
        <p>Salut! 
        </p>
        <a href="Galerie.php" class="btn btn-secondary">Galeria Ta</a>
        <br>
        <br>
        <audio controls src="Avril14th.mp3"></audio>
       
    </div>
    <div class="center">
        <iframe style="overflow: hidden;"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2712.1251547878137!2d27.57142097624409!3d47.17498611768316!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40cafb61af5ef507%3A0x95f1e37c73c23e74!2sAlexandru%20Ioan%20Cuza%20University!5e0!3m2!1sen!2sro!4v1713551134533!5m2!1sen!2sro"
            width="250" height="350" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade" class="inframe"></iframe>
            <div class="center">
        <canvas id="starCanvas" width="250" height="230"></canvas>
        <script>
            const canvas = document.getElementById('starCanvas');
            const ctx = canvas.getContext('2d');

            const gradient = ctx.createRadialGradient(100, 100, 10, 100, 100, 100);
            gradient.addColorStop(0, 'rgb(8, 55, 61)');
            gradient.addColorStop(1, 'yellow');

            ctx.translate(canvas.width / 2, canvas.height / 2);
            ctx.rotate(Math.PI / 4);
            ctx.translate(-canvas.width / 2, -canvas.height / 2);

            ctx.beginPath();
            ctx.moveTo(100, 0);
            ctx.lineTo(120, 70);
            ctx.lineTo(200, 80);
            ctx.lineTo(140, 130);
            ctx.lineTo(160, 200);
            ctx.lineTo(100, 160);
            ctx.lineTo(40, 200);
            ctx.lineTo(60, 130);
            ctx.lineTo(0, 80);
            ctx.lineTo(80, 70);
            ctx.closePath();

            ctx.fillStyle = gradient;
            ctx.fill();
        </script>
    </div>
    <button width="10" class="btn btn-primary" id="likeBtn"><i class="fa fa-thumbs-up"></i> Like <span id="likeCount">0</span></button>
     <button class="btn btn-primary" id="shareBtn"><i class="fa fa-facebook"></i> Share</button>
    </div>
    

</div>

<div class="right">
    <div class="center">
        <h2>Adauga video?</h2>
        <form method="post" action="" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="ytvid" class="form-label">YT link</label>
                <input type="text" id="ytvid" name="ytvid" class="form-control" required>
            </div>
            <div class="mb-3">
                <input type="submit" value="Submit" class="btn btn-primary">
            </div>
        </form>

        <div class="mt-3">
            <?php
            if (isset($_SESSION['youtube_link'])) {
                $youtube_link = $_SESSION['youtube_link'];
                $video_id = getYouTubeVideoID($youtube_link);
                $embedded_video = '<iframe style="overflow: hidden;" width="560" height="315" src="https://www.youtube.com/embed/' . $video_id . '" frameborder="0" allowfullscreen class="inframe"></iframe>';
                echo $embedded_video;
            }
            ?>
        </div>
        
        <video width="560" height="315" controls>
        <source src="CarmenMiranda.mp4" type="video/webm" />
        </video>

    </div>
</div>

<div id="signuplogin" class="bottom">
    <a href="logout.php">L O G O U T</a>
</div>

<script>
    document.getElementById('likeBtn').addEventListener('click', function() {
        let likeCountElem = document.getElementById('likeCount');
        let currentCount = parseInt(likeCountElem.textContent);
        likeCountElem.textContent = currentCount + 1;
    });

    document.getElementById('shareBtn').addEventListener('click', function() {
        let url = window.location.href;
        let facebookShareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`;
        window.open(facebookShareUrl, '_blank');
    });
</script>

</body>
</html>