<div class="box-body">
    @editor('description', trans('links::links.description'), old("{$lang}.description"), $lang)

    <?php if (config('asgard.links.config.partials.translatable.create') !== []): ?>
        <?php foreach (config('asgard.links.config.partials.translatable.create') as $partial): ?>
            @include($partial)
        <?php endforeach; ?>
    <?php endif; ?>
</div>
