<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            background-color: black;
            width: 1910px;
            height: 1054px;
        }
        #frame-0 {
            display: block;
            float: left;
            width: 49%;
            height: 49%;
            margin: 0.4%;
        }
        #frame-1 {
            display: block;
            float: left;
            width: 49%;
            height: 49%;
            margin: 0.4%;
        }
        #frame-2 {
            display: block;
            float: left;
            width: 49%;
            height: 49%;
            margin: 0.4%;
        }
        #frame-3 {
            display: block;
            float: left;
            width: 49%;
            height: 49%;
            margin: 0.4%;
        }
        video {
            object-fit: fill;
        }
    </style>
</head>
<body>

        <div id='frame-0'>
        <?php
            $files = array_slice(scandir('videos/1/'), 2);
            $images = preg_grep('~\.(jpeg|jpg|png)$~', $files);
            $videos = preg_grep('~\.(mp4)$~', $files);

            $img_i = 0;
            foreach($images as $img) {
                echo "<img id='image-0-$img_i' src='videos/1/$img' height='100%' width='100%' style='display: none;'>";
                $img_i++;
            }
            $vid_i = 0;
            foreach($videos as $vid) {
                echo "<video muted id='video-0-$vid_i' width='100%' height='100%' style='display: none;'><source src='videos/1/$vid' type='video/mp4'></video>";
                $vid_i++;
            }
        ?>
        </div>
        <div id='frame-1'>
        <?php
            $files = array_slice(scandir('videos/2/'), 2);
            $images = preg_grep('~\.(jpeg|jpg|png)$~', $files);
            $videos = preg_grep('~\.(mp4)$~', $files);

            $img_i = 0;
            foreach($images as $img) {
                echo "<img id='image-1-$img_i' src='videos/2/$img' height='100%' width='100%' style='display: none;'>";
                $img_i++;
            }
            $vid_i = 0;
            foreach($videos as $vid) {
                echo "<video muted id='video-1-$vid_i' width='100%' height='100%' style='display: none;'><source src='videos/2/$vid' type='video/mp4'></video>";
                $vid_i++;
            }
        ?>
        </div>
        <div id='frame-2'>
        <?php
            $files = array_slice(scandir('videos/3/'), 2);
            $images = preg_grep('~\.(jpeg|jpg|png)$~', $files);
            $videos = preg_grep('~\.(mp4)$~', $files);

            $img_i = 0;
            foreach($images as $img) {
                echo "<img id='image-2-$img_i' src='videos/3/$img' height='100%' width='100%' style='display: none;'>";
                $img_i++;
            }
            $vid_i = 0;
            foreach($videos as $vid) {
                echo "<video muted id='video-2-$vid_i' width='100%' height='100%' style='display: none;'><source src='videos/3/$vid' type='video/mp4'></video>";
                $vid_i++;
            }
        ?>
        </div>
        <div id='frame-3'>
        <?php
            $files = array_slice(scandir('videos/4/'), 2);
            $images = preg_grep('~\.(jpeg|jpg|png)$~', $files);
            $videos = preg_grep('~\.(mp4)$~', $files);

            $img_i = 0;
            foreach($images as $img) {
                echo "<img id='image-3-$img_i' src='videos/4/$img' height='100%' width='100%' style='display: none;'>";
                $img_i++;
            }
            $vid_i = 0;
            foreach($videos as $vid) {
                echo "<video muted id='video-3-$vid_i' width='100%' height='100%' style='display: none;'><source src='videos/4/$vid' type='video/mp4'></video>";
                $vid_i++;
            }
        ?>
        </div>

<script src="js/jquery-3.4.1.min.js"></script>
<script>
    function check(id) {
        var status = 0;
        var images = $('#frame-'+ id +' img').map(function () {
            return this.id;
        }).get();
        var videos = $('#frame-'+ id +' video').map(function () {
            return this.id;
        }).get();

        function next_video(i) {
            if(i<videos.length) {
                $('#'+videos[i]).show();
                $('#'+videos[i])[0].play();
                status = $('#'+videos[i]);

                $('#'+videos[i]).on('ended',function(){
                    if(status != 0) {
                        status[0].pause();
                        status[0].currentTime = 1;
                        status.hide();
                        status = 0;

                        $('#'+videos[i]).unbind();
                        i++;
                        if(i<videos.length) {
                            next_video(i);
                        }
                        else {
                            next_video(0);
                        }
                    }
                });
            }
            else if(images.length > 0) {
                next_image(0);
            }
            else {
                next_video(0);
            }
        }
        function next_image(i) {
            if(i<images.length) {
                $('#'+images[i]).show();
                setTimeout(function(){
                    $('#'+images[i]).hide();
                    i++;
                    next_image(i);
                }, 15000);
            }
            else {
                $('#'+images[i]).hide();

                if(videos.length > 0) {
                    next_video(0);
                }
                else if(images.length > 0) {
                    next_image(0);
                }
            }
        }

        if(videos.length > 0) {
            next_video(0);
        }
        else {
            next_image(0);
        }
    }
    $( document ).ready(function() {
        check(0);
        check(1);
        check(2);
        check(3);
    });
</script>
</body>
</html>