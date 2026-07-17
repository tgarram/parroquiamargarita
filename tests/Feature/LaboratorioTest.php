<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class LaboratorioTest extends TestCase
{
    public function test_laboratorio_page_loads(): void
    {
        $response = $this->get('/laboratorio');

        $response->assertStatus(200);
    }

    public function test_laboratorio_contains_design_tokens_section(): void
    {
        $response = $this->get('/laboratorio');

        $response->assertSee('Laboratorio de diseño');
        $response->assertSee('Tipografía');
        $response->assertSee('Paleta de colores');
        $response->assertSee('WCAG');
    }

    public function test_laboratorio_references_google_fonts(): void
    {
        $response = $this->get('/laboratorio');

        $response->assertSee('fonts.googleapis.com', false);
        $response->assertSee('Playfair+Display', false);
        $response->assertSee('Inter', false);
    }
}
