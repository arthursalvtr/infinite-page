<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Hot News - {{ title }}</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" media="screen,projection" type="text/css" href="./public/assets/css/main.css" />
    <link rel="stylesheet" media="screen,projection" type="text/css" href="./public/assets/css/skin.css" />
</head>
<body>
<!-- START PAGE SOURCE -->
<div class="main">
    <div id="header" class="box">
        <h1 id="logo"><a href="/">Hot<span>News</span></a></h1>
    </div>
    <div id="section" class="box">
        <div id="content">
            <h1>{{ title }}</h1>
            <div class="article-info box">
                <p class="f-right">Comments disabled</p>
                <p class="f-left">
                    October 27, 2011 | Posted by
                    {{ author }} |
                    Filed under <a href="#">templates</a>, <a href="#">webdesign</a>, <a href="#">internet</a></p>
            </div>

            <p>{{ text }}</p>
            <p>{{ text }}</p>
            <p>{{ text }}</p>
            <p>{{ text }}</p>
            <p>{{ text }}</p>
        </div>
        <div id="aside">
            <h3>Hottest News</h3>
            <ul class="menu">
                {% for hot in hotArticles %}
                <li>
                    <a href="{{ hot|replace({' ': '-'}) }}">{{ hot }}</a>
                </li>
                {% endfor %}
            </ul>
            <h3>About Us</h3>
            <p class="box">
                <img src="tmp/about-01.jpg" alt="" class="f-left" />
                My name is Jessie Doe. I´m 26 years old and I´m living in the New York City.<br />
            </p>
            <h3 class="nomb">Sponsors</h3>
            <ul class="sponsors">
                <li>
                    <a href="#">
                        Lorem ipsum dolor
                    </a><br />
                    Donec libero. Suspendisse bibendum
                </li>
            </ul>
        </div>
    </div>
</div>
<div id="footer">
    <div class="main box">
      <p class="f-left">Copyright &copy;&nbsp;2010 <a href="#">Hot News</a></p>
    </div>
</div>
<!-- END PAGE SOURCE -->
</body>
</html>
