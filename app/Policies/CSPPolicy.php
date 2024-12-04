<?php

namespace App\Policies;

use Spatie\Csp\Policies\Policy;
use Spatie\Csp\Directive;
use Spatie\Csp\Keyword;
use Illuminate\Support\Facades\App;

class CSPPolicy extends Policy
{
    public function configure()
    {
        if (!App::isProduction()) {
            return;
        }

        $this->addDirective(Directive::BASE, Keyword::SELF)
            ->addDirective(Directive::BASE, Keyword::SELF)
            ->addDirective(Directive::CONNECT, Keyword::SELF)
            ->addDirective(Directive::DEFAULT, Keyword::SELF)
            ->addDirective(Directive::FORM_ACTION, Keyword::SELF)
            ->addDirective(Directive::IMG, Keyword::SELF)
            ->addDirective(Directive::MEDIA, Keyword::SELF)
            ->addDirective(Directive::OBJECT, Keyword::NONE);

        // In production, we only allow scripts and styles/inline styles from the same origin
        $this->addDirective(Directive::SCRIPT, Keyword::SELF)
            ->addDirective(Directive::STYLE, [Keyword::SELF, Keyword::UNSAFE_INLINE])
            ->addNonceForDirective(Directive::SCRIPT);
    }
}
