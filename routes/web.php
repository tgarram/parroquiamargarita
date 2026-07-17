<?php

declare(strict_types=1);

use Parroquia\Http\Request;
use Parroquia\Http\Response;
use Parroquia\Http\Router;
use Parroquia\View\Renderer;

return function (Router $router, Renderer $renderer): void {

    // Root → default locale
    $router->get('/', fn (Request $r) => Response::redirect(base_path('/es/')));

    foreach (['es', 'ca', 'en'] as $locale) {
        $router->group('/'.$locale, function (Router $r) use ($renderer, $locale): void {

            $r->get('/', fn (Request $req) => new Response(
                $renderer->renderInLayout('layouts.base', 'pages.home', [
                    'title' => __('general.home_title'),
                    'description' => __('general.meta_home_description'),
                    'locale' => $locale,
                    'path' => '/',
                ])
            ));

            $r->get('/noticias', function (Request $req) use ($renderer, $locale): Response {
                $noticias = content()->findAll('noticias', 'published');

                return new Response(
                    $renderer->renderInLayout('layouts.base', 'pages.noticias.index', [
                        'title' => __('general.news_title'),
                        'description' => __('general.meta_news_description'),
                        'locale' => $locale,
                        'path' => '/noticias',
                        'noticias' => $noticias,
                    ])
                );
            });

            $r->get('/noticias/{slug}', function (Request $req, string $slug) use ($renderer, $locale): Response {
                $noticia = content()->find('noticias', $slug, 'published');

                if ($noticia === null) {
                    return Response::notFound();
                }

                $appUrl = config('app.url', '');
                $pageUrl = $appUrl.'/'.$locale.'/noticias/'.$slug;
                $jsonLd = [
                    '@context' => 'https://schema.org',
                    '@type' => 'NewsArticle',
                    'headline' => $noticia->trans('title', $locale) ?? '',
                    'description' => $noticia->trans('excerpt', $locale) ?? '',
                    'url' => $pageUrl,
                    'inLanguage' => $locale,
                    'publisher' => [
                        '@type' => 'Organization',
                        'name' => config('app.name', ''),
                        'url' => $appUrl,
                    ],
                ];

                return new Response(
                    $renderer->renderInLayout('layouts.base', 'pages.noticias.show', [
                        'title' => $noticia->trans('title', $locale),
                        'description' => $noticia->trans('excerpt', $locale) ?? __('general.meta_news_description'),
                        'locale' => $locale,
                        'path' => '/noticias/'.$slug,
                        'noticia' => $noticia,
                        'jsonLd' => $jsonLd,
                    ])
                );
            });

            $r->get('/horarios', function (Request $req) use ($renderer, $locale): Response {
                $horarios = content()->findAll('horarios', 'published');

                return new Response(
                    $renderer->renderInLayout('layouts.base', 'pages.horarios', [
                        'title' => __('general.schedules_title'),
                        'description' => __('general.meta_schedules_description'),
                        'locale' => $locale,
                        'path' => '/horarios',
                        'horarios' => $horarios,
                    ])
                );
            });

            $r->get('/sobre', function (Request $req) use ($renderer, $locale): Response {
                $sobre = content()->find('paginas', 'sobre-la-parroquia', '*');

                return new Response(
                    $renderer->renderInLayout('layouts.base', 'pages.sobre', [
                        'title' => __('general.about_title'),
                        'description' => __('general.meta_about_description'),
                        'locale' => $locale,
                        'path' => '/sobre',
                        'sobre' => $sobre,
                    ])
                );
            });

            $r->get('/contacto', function (Request $req) use ($renderer, $locale): Response {
                $contacto = content()->find('paginas', 'contacto', '*');

                return new Response(
                    $renderer->renderInLayout('layouts.base', 'pages.contacto', [
                        'title' => __('general.contact_title'),
                        'description' => __('general.meta_contact_description'),
                        'locale' => $locale,
                        'path' => '/contacto',
                        'contacto' => $contacto,
                    ])
                );
            });

            $r->get('/aviso-legal', function (Request $req) use ($renderer, $locale): Response {
                return new Response(
                    $renderer->renderInLayout('layouts.base', 'pages.legal', [
                        'title' => __('general.legal_title'),
                        'description' => __('general.meta_legal_description'),
                        'locale' => $locale,
                        'path' => '/aviso-legal',
                        'page' => content()->find('paginas', 'aviso-legal', '*'),
                        'titleKey' => 'general.legal_title',
                        'subtitleKey' => 'general.legal_subtitle',
                        'pendingKey' => 'general.legal_pending',
                        'headingId' => 'legal-title',
                    ])
                );
            });

            $r->get('/privacidad', function (Request $req) use ($renderer, $locale): Response {
                return new Response(
                    $renderer->renderInLayout('layouts.base', 'pages.legal', [
                        'title' => __('general.privacy_title'),
                        'description' => __('general.meta_privacy_description'),
                        'locale' => $locale,
                        'path' => '/privacidad',
                        'page' => content()->find('paginas', 'privacidad', '*'),
                        'titleKey' => 'general.privacy_title',
                        'subtitleKey' => 'general.privacy_subtitle',
                        'pendingKey' => 'general.privacy_pending',
                        'headingId' => 'privacy-title',
                    ])
                );
            });

            $r->get('/accesibilidad', function (Request $req) use ($renderer, $locale): Response {
                return new Response(
                    $renderer->renderInLayout('layouts.base', 'pages.legal', [
                        'title' => __('general.accessibility_title'),
                        'description' => __('general.meta_accessibility_description'),
                        'locale' => $locale,
                        'path' => '/accesibilidad',
                        'page' => content()->find('paginas', 'accesibilidad', '*'),
                        'titleKey' => 'general.accessibility_title',
                        'subtitleKey' => 'general.accessibility_subtitle',
                        'pendingKey' => 'general.accessibility_pending',
                        'headingId' => 'accessibility-title',
                    ])
                );
            });

            $r->get('/laboratorio', fn (Request $req) => new Response(
                $renderer->renderInLayout('layouts.base', 'pages.laboratorio', [
                    'title' => __('general.lab_title'),
                    'locale' => $locale,
                    'path' => '/laboratorio',
                ])
            ));
        });
    }

};
