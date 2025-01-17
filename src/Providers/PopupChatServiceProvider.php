<?php

namespace ACTCMS\PopupChat\Providers;

use ACTCMS\Base\Supports\ServiceProvider;
use ACTCMS\Base\Traits\LoadAndPublishDataTrait;
use ACTCMS\Theme\Facades\Theme;

class PopupChatServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function boot(): void
    {
        $this
            ->setNamespace('plugins/popup-chat')
            ->loadHelpers()
            ->loadAndPublishViews();

        $this->app->register(HookServiceProvider::class);

        Theme::asset()
            ->usePath(false)
            ->add(
                'popup-chat-css',
                asset('vendor/core/plugins/popup-chat/css/popup-chat.min.css')
            );

        add_filter(THEME_FRONT_FOOTER, function (string|null $data): string {
            return $data . view('plugins/popup-chat::show');
        });
    }
}
