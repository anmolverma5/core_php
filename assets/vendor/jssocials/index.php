<!DOCTYPE html>
<html>
<head>
   <!--  <link rel="stylesheet" type="text/css" href="font-awesome.css" /> -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="jssocials.css" />
    <link rel="stylesheet" type="text/css" href="jssocials-theme-flat.css" />
</head>
<body>
    <div id="share"></div>
     <script src="https://www.ayushmd.com/assets/js/jquery-min.js"></script>
    <!-- <script src="jquery.js"></script> -->
    <script src="jssocials.min.js"></script>
    <script>
        $("#share").jsSocials({
    url: "http://www.google.com",
    text: "Google Search Page",
    showLabel: false,
    showCount: "inside",
    shares: ["twitter", "facebook", "googleplus", "linkedin", "pinterest", "stumbleupon", "whatsapp"]
});
    </script>
</body>
</html>