<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@ViewBag.Title -RITA ONLINE APPLICATION</title>
    <link type="text/css" rel="stylesheet" href="/Content/resource/theme.css" />
    <link type="text/css" rel="stylesheet" href="/Content/resource/css/font-icon-layout.css" />
    <link type="text/css" rel="stylesheet" href="/Content/resource/css/sentinel-layout.css" />
    <link type="text/css" rel="stylesheet" href="/Content/resource/css/core-layout.css" />
    <link type="text/css" rel="stylesheet" href="/Content/resource/ritaLoginStyles.css" />
    <link type="text/css" rel="stylesheet" href="/Content/resource/primefaces.css" />
    <script type="text/javascript" src="/Content/resource/jquery/jquery.js"></script>
    <script type="text/javascript" src="/Content/resource/primefaces.js"></script>
    <script type="text/javascript" src="/Content/resource/jquery/jquery-plugins.js"></script>


    @Styles.Render("~/Content/css")
    @Scripts.Render("~/bundles/modernizr")
</head>
<body  class="fontRegular custom-background">

<div class="container body-content">
    @RenderBody()
    <hr />
    <footer>
        <p>&copy; @DateTime.Now.Year -RITA Online Application</p>
    </footer>
</div>

@Scripts.Render("~/bundles/jquery")
@Scripts.Render("~/bundles/bootstrap")
@RenderSection("scripts", required: false)
</body>
</html>
