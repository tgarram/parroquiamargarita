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
