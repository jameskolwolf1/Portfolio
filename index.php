<?php

$randomNumber = rand(0, 2);

$mobileQuotes = array(


    array(
        "./images/logo/appleLogo.png",
        "Every time I think about buying an iphone I think about buying an art piece then a smartphone"
    ),
    array(
        "./images/logo/appleLogo.png",
        "I only got an iphone because of FaceTime"
    ),
    array(
        "./images/logo/androidLogo.png",
        "I love android and I love Java but we can do better"
    )
);
$desktopQuotes = array();



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cool Profile, I mean I think it is who knows</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <div class="mobile">
        <div class="mobile__container">
            <div class="mobile__loadingScreen">
                <img src=<?php echo $mobileQuotes[$randomNumber][0] ?> alt="">
                <div class="mobile__loader" id="loader-container">
                    <div class="mobile__bar" id="loader-bar"></div>
                </div>

                <script>
                    const loader = document.getElementById('loader-bar');
                    let progress = 0;

                    function easeOutRate(p) {
                        return 1 - Math.pow(1 - p, 1);
                    }

                    function updateBar() {
                        if (progress >= 100) return;
                        progress += 0.1;
                        let easedProgress = easeOutRate(progress / 100) * 100;
                        loader.style.width = `${easedProgress}%`;
                        requestAnimationFrame(updateBar);
                    }
                    updateBar();
                </script>

                <p class="mobile__loadingScreen--quote">
                    <?php echo $mobileQuotes[$randomNumber][1] ?>
                </p>
            </div>

        </div>
    </div>
    <div class="desktop">
    </div>
</body>

</html>