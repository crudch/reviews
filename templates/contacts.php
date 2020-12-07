<?php

/**
 * @var View $this
 * @var array $contacts
 */

use System\View\View;
?>

<?php $this->extend('layouts/layout'); ?>

<?php $this->start('title'); ?>Контакты<?php $this->stop(); ?>
<?php $this->start('description'); ?>Контакты<?php $this->stop(); ?>

<?php $this->start('content'); ?>
    <h1>Контакты</h1>

<?php var_dump($contacts); ?>
<?php $this->stop(); ?>