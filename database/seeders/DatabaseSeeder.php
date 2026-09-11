<?php

namespace Database\Seeders;

use App\Core\Customers\Models\User;
use App\Core\Catalog\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear usuario admin
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'role' => 'super_admin' // Updated role to super_admin for full access
        ]);

        // Semillas de productos de cosméticos/suplementos
        $productos = [
            [
                'sku' => 'SUP-001',
                'nombre' => 'Proteína Whey Isolate Premium',
                'descripcion_corta' => 'Aislado de proteína de suero de leche de rápida absorción.',
                'descripcion_larga' => 'Nuestra proteína Whey Isolate es la más pura del mercado, diseñada para la máxima recuperación muscular. Sin azúcar añadida y con un sabor increíble.',
                'precio_usd' => 59.99,
                'precio_mxn' => 1200.00,
                'stock' => 50,
                'activo' => true,
                'metrics' => [
                    ['label' => 'Proteína', 'value' => 90, 'type' => 'percentage'],
                    ['label' => 'BCAA', 'value' => '5.5g', 'type' => 'text'],
                    ['label' => 'Azúcar', 'value' => 0, 'type' => 'percentage'],
                ]
            ],
            [
                'sku' => 'COS-002',
                'nombre' => 'Suero Facial de Niacinamida',
                'descripcion_corta' => 'Sérum iluminador y reductor de poros.',
                'descripcion_larga' => 'Formulado para todo tipo de piel, este suero reduce visiblemente la apariencia de poros dilatados y mejora la textura irregular. Libre de crueldad animal.',
                'precio_usd' => 24.50,
                'precio_mxn' => 490.00,
                'stock' => 120,
                'activo' => true,
                'metrics' => [
                    ['label' => 'Niacinamida', 'value' => 10, 'type' => 'percentage'],
                    ['label' => 'Zinc PCA', 'value' => 1, 'type' => 'percentage'],
                    ['label' => 'Cruelty Free', 'value' => 'Sí', 'type' => 'text'],
                ]
            ],
            [
                'sku' => 'SUP-003',
                'nombre' => 'Gomitas de CBD Relaxing',
                'descripcion_corta' => 'Gomitas relajantes para mejorar la calidad del sueño.',
                'descripcion_larga' => 'Desconéctate después de un largo día con nuestras gomitas sabor mora azul. Extracto puro y testeado en laboratorio para garantizar relajación sin efectos psicoactivos.',
                'precio_usd' => 34.99,
                'precio_mxn' => 699.00,
                'stock' => 30,
                'activo' => true,
                'metrics' => [
                    ['label' => 'CBD Puro', 'value' => 15, 'type' => 'percentage'],
                    ['label' => 'THC', 'value' => 0, 'type' => 'percentage'],
                    ['label' => 'Melatonina', 'value' => '3mg', 'type' => 'text'],
                ]
            ],
            [
                'sku' => 'COS-004',
                'nombre' => 'Crema Hidratante con Ácido Hialurónico',
                'descripcion_corta' => 'Hidratación profunda 24h con textura ligera.',
                'descripcion_larga' => 'Crema en gel que retiene hasta 1000 veces su peso en agua. Ideal para pieles mixtas y grasas gracias a su rápida absorción.',
                'precio_usd' => 29.00,
                'precio_mxn' => 580.00,
                'stock' => 0,
                'activo' => true,
                'metrics' => [
                    ['label' => 'Ácido Hialurónico', 'value' => 2, 'type' => 'percentage'],
                    ['label' => 'Vitamina B5', 'value' => 5, 'type' => 'percentage'],
                    ['label' => 'Textura', 'value' => 'Gel Acuoso', 'type' => 'text'],
                ]
            ]
        ];

        foreach ($productos as $prod) {
            Product::create($prod);
        }
    }
}
