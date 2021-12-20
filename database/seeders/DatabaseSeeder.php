<?php

namespace Database\Seeders;

use App\Models\clienteModelo;
use App\Models\direccionModelo;
use App\Models\productosModelo;
use App\Models\proveedorModelo;
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

        //Guardamos un cliente de prueba.
        $cliente = new clienteModelo();
        $cliente->idcliente = 'cl-avuz';
        $cliente->nombre='Dafene xd';
        $cliente->apellidoPaterno='Solano';
        $cliente->apellidoMaterno='Solano xd';
        $cliente->telefono='9512364567';
        $cliente->save();

        //Cargamos los estado, municipios y colonias
        $this->call([
            estadosSeeder::class,
            municipiosSeeder::class,
            coloniasSeeder::class,]);

        //Direccion del proveedor
        $direccion = new direccionModelo();
        $direccion->iddireccion='DIC-12Jk-In';
        $direccion->calle='mdeeo';
        $direccion->numero=122;
        $direccion->idcoldirec=1;
        $direccion->save();

        //Agregamos un proveedor de prueba
        $proveedor = new proveedorModelo();
        $proveedor->idproveedor='PROV-Jk-In12'; 
        $proveedor->nombre='Roberto'; 
        $proveedor->apellidopaterno='Jknkn';
        $proveedor->apellidomaterno='Innmlm';
        $proveedor->correo='corroe@corrreo.com';
        $proveedor->iddirecproveedor='DIC-12Jk-In';
        $proveedor->save();
        
        //Agregamos un prodcuto de prueba.
        $producto = new productosModelo();
        $producto->clave_producto = 'YUJJ';
        $producto->nombre_producto = 'LLave';
        $producto->clasificacion = 'Llave';
        $producto->precio_producto = 50.0;
        $producto->cantidad_existencia = 51;
        $producto->idproveedor = 'PROV-Jk-In12';
        $producto->save();

        $this->call([
            ventasSeeder::class,
            detalleVentaSeeder::class,
        ]);

        //\App\Models\User::factory(10)->create();
        //usuariosModel::factory(50)->create();
    }
}
