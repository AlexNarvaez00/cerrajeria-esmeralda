<?php

namespace Database\Seeders;

use App\Models\direccionModelo;
use App\Models\productosDescripcionModelo;
use App\Models\productosModelo;
use App\Models\proveedorModelo;
use App\Models\servicioModelo;
use App\Models\telefonoModelo;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Guardamos al usuarios principal
        $admin = new User();
        $admin->id = 'USU-ADAD-181221';
        $admin->name = 'Adminstrador ROOT ';
        $admin->email = 'correo@correo.com';
        $admin->password = Hash::make('12345678');
        $admin->rol = 'Administrador'; 
        $admin->save();

        //Creamos a los clientes.
        

        //Cargamos los estado, municipios y colonias
        $this->call([
            //ClienteSeeder::class,
            estadosSeeder::class,
            municipiosSeeder::class,
            coloniasSeeder::class,
            //DireccionSeeder::class,
            //ProveedorSeeder::class,
            //ProductoSeeder::class,
            //ServicioSeeder::class,
            //DetalleServicioSeeder::class,
            //ventasSeeder::class,
            //detalleVentaSeeder::class,
            //ProductoDescrcipcionSeeder::class,
            //PagoModeloSeeder::class
        ]);

        //telefonoModelo::factory(10)->create();
            

        //Agregamos un prodcuto de prueba.
        // $producto = new productosModelo();
        // $producto->clave_producto = 'YUJJ';
        // $producto->nombre_producto = 'LLave';
        // $producto->clasificacion = 'Llave';
        // $producto->precio_producto = 50.0;
        // $producto->precio_compra = 25.0;
        // $producto->cantidad_existencia = 51;
        // $producto->cantidad_stock = 5;
        // $producto->idproveedor = 'PROV-Jk-In12';
        // $producto->save();

        // $productoDescripcion = new productosDescripcionModelo();
        // $productoDescripcion->descripcion = "Es una llave color rojo marca phillips";
        // $productoDescripcion->clave_producto= 'YUJJ';
        // $productoDescripcion->save();
        // $this->call([
        //     ventasSeeder::class,
        //     detalleVentaSeeder::class,
        // ]);


        //\App\Models\User::factory(10)->create();
        //usuariosModel::factory(50)->create();
    }
}
