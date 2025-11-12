<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\TemplateImage;
use App\Models\Tools;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            KategoriSeeder::class,
            RoleAISeeder::class,
            RolePermissionSeeder::class,
        ]);

        TemplateImage::create([
            'name' => 'Photorealistic scenes',
            'template' => 'A photorealistic [shot type] of [subject], [action or expression], set in
[environment]. The scene is illuminated by [lighting description], creating
a [mood] atmosphere. Captured with a [camera/lens details], emphasizing
[key textures and details]. The image should be in a [aspect ratio] format.',
        ]);

        TemplateImage::create([
            'name' => 'Stylized illustrations & stickers',
            'template' => 'A [style] sticker of a [subject], featuring [key characteristics] and a
[color palette]. The design should have [line style] and [shading style].
The background must be transparent.',
        ]);

        TemplateImage::create([
            'name' => 'Accurate text in images',
            'template' => 'Create a [image type] for [brand/concept] with the text "[text to render]"
in a [font style]. The design should be [style description], with a
[color scheme].',
        ]);

        TemplateImage::create([
            'name' => 'Product mockups & commercial photography',
            'template' => 'A high-resolution, studio-lit product photograph of a [product description]
on a [background surface/description]. The lighting is a [lighting setup,
e.g., three-point softbox setup] to [lighting purpose]. The camera angle is
a [angle type] to showcase [specific feature]. Ultra-realistic, with sharp
focus on [key detail]. [Aspect ratio].',
        ]);
        TemplateImage::create([
            'name' => 'Sequential art (Comic panel / Storyboard)',
            'template' => 'A single comic book panel in a [art style] style. In the foreground,
[character description and action]. In the background, [setting details].
The panel has a [dialogue/caption box] with the text "[Text]". The lighting
creates a [mood] mood. [Aspect ratio].',
        ]);


        Tools::create([
            'name' => 'QRCODE Generator',
            'slug' => 'qrcode-generator',
            'description' => 'Membantu membuat QR Code dengan mudah hanya dengan memasukkan URL yang diinginkan.',
            'status' => 'active',
        ]);
        Tools::create([
            'name' => 'Image To PDF Generator',
            'slug' => 'image-to-pdf-generator',
            'description' => 'Membantu mengubah gambar menjadi file PDF dengan mudah.',
            'status' => 'active',
        ]);
    }
}
