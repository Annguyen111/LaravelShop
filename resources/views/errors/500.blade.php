<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>500</title>
    <link rel="stylesheet" href="{{ asset('public/style.css') }}">
</head>

<body>
    <div class="full-screen">
        <div class='container'>
          <span class="error-num">5</span>
          <div class='eye'></div>
          <div class='eye'></div>
  
          <p class="sub-text">Oh eyeballs! Something went wrong. We're <span class="italic">looking</span> to see what happened.</p>
          <a href="">Go back</a>
        </div>
      </div>
</body>
<script>
    $(".full-screen").mousemove(function(event) {
  var eye = $(".eye");
  var x = (eye.offset().left) + (eye.width() / 2);
  var y = (eye.offset().top) + (eye.height() / 2);
  var rad = Math.atan2(event.pageX - x, event.pageY - y);
  var rot = (rad * (180 / Math.PI) * -1) + 180;
  eye.css({
    '-webkit-transform': 'rotate(' + rot + 'deg)',
    '-moz-transform': 'rotate(' + rot + 'deg)',
    '-ms-transform': 'rotate(' + rot + 'deg)',
    'transform': 'rotate(' + rot + 'deg)'
  });
});

</script>
</html>