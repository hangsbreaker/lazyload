<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lazyload</title>
    <style>
        .blur-div {
            position: relative;
            display: inline-flex;
            background-repeat: no-repeat;
            background-size: cover;
            width: fit-content;
            height: fit-content;
        }

        .blur-div img {
            opacity: 0;
            transition: opacity 250ms ease-in-out;
        }

        .blur-div::before {
            content: "";
            position: absolute;
            inset: 0;
            opacity: 0;
            animation: pulse 2.5s infinite;
            background-color: #aaa;
        }

        .blur-div.loaded::before {
            animation: none;
            content: none;
        }

        .blur-div.loaded img {
            opacity: 1;
        }

        @keyframes pulse {
            0% {
                opacity: 0;
            }

            50% {
                opacity: 0.5;
            }

            100% {
                opacity: 0;
            }
        }
    </style>
</head>

<body>

    <div class="blur-div"
        style="background-image: url(resize.php?image=https://images.pexels.com/photos/326807/pexels-photo-326807.jpeg);">
        <img src="https://images.pexels.com/photos/326807/pexels-photo-326807.jpeg" loading="lazy" width="300px" />
    </div>
    <script>
        const blurDivs = document.querySelectorAll(".blur-div");
        blurDivs.forEach(div => {
            const img = div.querySelector("img");
            function loaded() {
                div.classList.add("loaded");
            }
            if (img.complete) {
                loaded();
            } else {
                img.addEventListener("load", loaded);
            }
        });
    </script>

</body>

</html>