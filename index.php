
<!DOCTYPE html>
<html>
<head>


  <meta name='viewport' content='width=device-width; initial-scale=1.0;' />
  <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js'></script>
  <script type="text/javascript" src="instafeed.min.js"></script>

  
<link rel="stylesheet" type="text/css" media="screen" href="css/index1.css" />
  


  

</head>

<body>
  

<div id="global">
    </div>
  <div id="instafeed"></div>
 <div class="controls">
  <div class="prev entypo-left-open-big"></div>
  <div class="next entypo-right-open-big"></div>

 
  <script type="text/javascript">


feed = new Instafeed({
   get: 'tagged',
        tagName: 'slefie',
        accessToken: '141970.467ede5.edbc9c37472d41b790e1db8948793f11',
        sortby: 'random',
        resolution: 'standard_resolution',
        links: 'false',
        limit: '50',
        template: '<div id="caption">{{caption}} <br>{{likes}} likes on my <a href="http://instagram.com/victorbaissait" class="sky">instagram</a></div><div id="bg"><img src="{{image}}" /></div>',
  mock: true,
  custom: {
    images: [],
    currentImage: 0,
    showImage: function () {
      var result, image;
      image = this.options.custom.images[this.options.custom.currentImage];
      result = this._makeTemplate(this.options.template, {
        model: image,
        id: image.id,
        link: image.link,
        image: image.images[this.options.resolution].url,
        caption: this._getObjectProperty(image, 'caption.text'),
        likes: image.likes.count,
        comments: image.comments.count,
        location: this._getObjectProperty(image, 'location.name')
      });
      $("#instafeed").html(result);
    }
  },
  success: function (data) {
    this.options.custom.images = data.data; 
    this.options.custom.showImage.call(this);
  }
});
feed.run();

$(".next").click(function () {
  var length, current;
  current = feed.options.custom.currentImage;
  length = feed.options.custom.images.length;
  if (current < length - 1) {
    feed.options.custom.currentImage++;
    feed.options.custom.showImage.call(feed);
  }
});

$(".prev").click(function () {
  var length, current;
  current = feed.options.custom.currentImage;
  length = feed.options.custom.images.length;
  if (current > 0) {
    feed.options.custom.currentImage--
    feed.options.custom.showImage.call(feed);
  }
});
  </script>


</body>
</html>
