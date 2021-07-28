<div class="site-index">

    <div class="body-content">
<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
foreach($articles as $article) {
    $genres = [];
    foreach($article->theGenres as $item){
        $genres[] = $item->name;
    }

    $cast = [];
    foreach($article->theCast as $item) {
        $cast[] = $item->name;
    }

    $directors = [];
    foreach($article->theDirectors as $item) {
        $directors[] = $item->name;
    }

    $videos = [];
     if(count($article->theVideos) > 0) { 
         foreach($article->theVideos as $video){
            if(count($video->theAlternatives) > 0) { 
                foreach($video->theAlternatives as $item){
                    $videos[$video->title][$item->quality] = $item->url; 
                }
            } 
        }
     } 
    
?>


        <div class="row" style="padding-top:20px">
            <div class="col-lg-4">
            <h3><?=$article->headline?></h3>
                <h6>Class: <?=$article->class?> - Genres: <?=implode(', ', $genres);?> <br>
                Cert: <?=$article->cert?><br>
                Duration: <?=((int)$article->duration / 60)?> min <br>
                </h6>

                <img src="<?=$article->theArtImages[0]->url?>" style="height: 400px">

                <p><a class="btn btn-default" href="<?=$article->url?>">Review Page &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>About</h2>

                <p><?=$article->body?></p>

                <?php if(strlen($article->quote) > 1) {?>
                    <b>Quote:</b> <p><?=$article->quote?></p>
                <?php } ?>
            </div>
            <div class="col-lg-4">
                <h4>Cast:  <?=implode(', ', $cast);?></h4>
                <h4>Directors:  <?=implode(', ', $directors);?></h4>
                <h6>Year: <?=$article->year?> </h6>
                <h6>Last Updated: <?=$article->lastUpdated?> </h6>
                <?php if(strlen($article->rating) > 0) {?>
                    <h6>Rating: <?=$article->rating?> </h6>
                <?php } ?>
                <?php if(strlen($article->skyGoId) > 0) {?>
                    <h6>Sky Go Id: <?=$article->skyGoId?> </h6>
                <?php } ?>
                <?php if(strlen($article->skyGoUrl) > 0) {?>
                    <h6>Sky Go Url: <?=$article->skyGoUrl?> </h6>
                <?php } ?>

                <img src="<?=$article->theCardImages[0]->url?>" style="height: 400px">
            </div>
        </div>
       
        <div class="row" style="padding-top:20px">
            <h2>Synopsis:</h2> <h5><?=$article->synopsis?></h5>
           
        </div>
        <?php if(count($article->theWindow) > 0) { ?>
            <div class="row" style="padding-top:20px">
                <h2>Viewing Window: </h2> <h5>Start Date: <?= $article->theWindow[0]->startDate;?>  End Date: <?= $article->theWindow[0]->endDate;?></h5>
                <h5>Way To Watch: <?= $article->theWindow[0]->wayToWatch;?></h5>
                
            </div>
        <?php } ?>
        <?php if(count($videos) > 0) { 
            foreach($videos as $key => $video) { ?>
            <?= $key ?>
                <video
                id="my-video"
                class="video-js"
                controls
                preload="auto"
                width="640"
                height="264"
                poster="MY_VIDEO_POSTER.jpg"
                data-setup="{}"
                >
                    <source src="<?=$video['Low']?>" type="video/mp4" />
                   
                    <p class="vjs-no-js">
                    To view this video please enable JavaScript, and consider upgrading to a
                    web browser that
                    <a href="https://videojs.com/html5-video-support/" target="_blank"
                        >supports HTML5 video</a
                    >
                    </p>
                </video>
        <?php } ?>
        <?php } ?>
        

  

 
<?php } ?>
   </div>
</div>
<script src="https://vjs.zencdn.net/7.11.4/video.min.js"></script>