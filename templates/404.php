<?php

/**
 * @var View $this
 * @var NotFoundException $e
 */

use System\View\View;
use System\Http\Exceptions\NotFoundException;

?>
<?php $this->extend('layouts/layout') ?>

<?php $this->start('content'); ?>
<section class="uk-container">
    <h1 class="uk-text-center"><?php echo e($e->getMessage()); ?></h1>
</section>
<?php $this->stop(); ?>