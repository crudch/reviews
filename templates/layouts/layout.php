<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-key" content="<?php echo csrfKey() ?>">
    <meta name="description" content="<?php echo $this->renderBlock('description'); ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="/images/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicons/favicon-16x16.png">
    <link rel="stylesheet" href="/css/app.css">
    <?php echo $this->renderBlock('style') ?>
    <title><?php echo $this->renderBlock('title'); ?></title>
</head>
<body>
<nav class="uk-navbar-container uk-margin uk-navbar">
    <div class="uk-navbar-left">

        <a class="uk-navbar-item uk-logo" href="#">Logo</a>

        <ul class="uk-navbar-nav">
            <li>
                <a href="#">
                    <span class="uk-icon uk-margin-small-right" uk-icon="icon: star"></span>
                    Features
                </a>
            </li>
        </ul>

        <div class="uk-navbar-item">
            <div>Some <a href="#">Link</a></div>
        </div>

        <div class="uk-navbar-item">
            <form action="javascript:void(0)">
                <input class="uk-input uk-form-width-small" type="text" placeholder="Input">
                <button class="uk-button uk-button-default">Button</button>
            </form>
        </div>

    </div>
</nav>

<?php echo $this->renderBlock('content'); ?>
<script src="/js/app.js"></script>
<?php echo $this->renderBlock('script'); ?>
</body>
</html>