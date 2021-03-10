<?php

use App\Action;
use Illuminate\Database\Seeder;

class ActionsTableSeeder extends Seeder
{
    public function run()
    {
        Action::create(['name' => 'Acesso total al sistema', 'method' => '*', 'order' => 1, 'title' => 'Sistema']);

        //Cotizaciones
        Action::create(['name' => 'Ver Lista Completa', 'method' => 'quotations.index|quotations.pending|quotations.approved|quotations.executed', 'order' => 2, 'title' => 'Cotizaciones']);
        Action::create(['name' => 'Ver Pendientes', 'method' => 'quotations.pending', 'order' => 3, 'title' => 'Cotizaciones']);
        Action::create(['name' => 'Ver Aprobadas', 'method' => 'quotations.approved', 'order' => 4, 'title' => 'Cotizaciones']);
        Action::create(['name' => 'Ver Ejecutadas', 'method' => 'quotations.executed', 'order' => 5, 'title' => 'Cotizaciones']);
        Action::create(['name' => 'Ver Lista Sucursal', 'method' => 'quotations.single', 'order' => 6, 'title' => 'Cotizaciones']);
        Action::create(['name' => 'Ver Lista Todos', 'method' => 'quotations.all', 'order' => 7, 'title' => 'Cotizaciones']);
        Action::create(['name' => 'Ver Detalle', 'method' => 'quotations.show', 'order' => 8, 'title' => 'Cotizaciones']);
        Action::create(['name' => 'Ver Detalle Todos', 'method' => 'quotations.show|quotations.showall', 'order' => 9, 'title' => 'Cotizaciones']);
        Action::create(['name' => 'Registrar', 'method' => 'quotations.create', 'order' => 10, 'title' => 'Cotizaciones']);
        Action::create(['name' => 'Actualizar', 'method' => 'quotations.update', 'order' => 11, 'title' => 'Cotizaciones']);
        Action::create(['name' => 'Eliminar', 'method' => 'quotations.destroy', 'order' => 12, 'title' => 'Cotizaciones']);

        //Arte guia
        Action::create(['name' => 'Registrar', 'method' => 'designs.create', 'order' => 13, 'title' => 'Arte guía']);
        Action::create(['name' => 'Actualizar', 'method' => 'designs.update', 'order' => 14, 'title' => 'Arte guía']);

        //Orden de trabajo
        Action::create(['name' => 'Ver Lista', 'method' => 'workorders.index', 'order' => 15, 'title' => 'Orden de trabajo']);
        Action::create(['name' => 'Registrar', 'method' => 'workorders.create', 'order' => 16, 'title' => 'Orden de trabajo']);
        Action::create(['name' => 'Actualizar', 'method' => 'workorders.update', 'order' => 17, 'title' => 'Orden de trabajo']);

        //Productos
        Action::create(['name' => 'Ver Lista', 'method' => 'products.index', 'order' => 18, 'title' => 'Productos']);
        Action::create(['name' => 'Registrar', 'method' => 'products.create', 'order' => 19, 'title' => 'Productos']);
        Action::create(['name' => 'Ver Detalle', 'method' => 'products.show', 'order' => 20, 'title' => 'Productos']);
        Action::create(['name' => 'Actualizar', 'method' => 'products.update', 'order' => 21, 'title' => 'Productos']);
        Action::create(['name' => 'Eliminar', 'method' => 'products.destroy', 'order' => 22, 'title' => 'Productos']);

        //Costos
        Action::create(['name' => 'Ver Lista', 'method' => 'costs.index', 'order' => 23, 'title' => 'Costos']);
        Action::create(['name' => 'Registrar', 'method' => 'costs.create', 'order' => 24, 'title' => 'Costos']);
        Action::create(['name' => 'Actualizar', 'method' => 'costs.update', 'order' => 25, 'title' => 'Costos']);

        //Clientes
        Action::create(['name' => 'Ver Lista', 'method' => 'customers.index', 'order' => 26, 'title' => 'Clientes']);
        Action::create(['name' => 'Registrar', 'method' => 'customers.create', 'order' => 27, 'title' => 'Clientes']);
        Action::create(['name' => 'Ver Detalle', 'method' => 'customers.show', 'order' => 28, 'title' => 'Clientes']);
        Action::create(['name' => 'Actualizar', 'method' => 'customers.update', 'order' => 29, 'title' => 'Clientes']);
        Action::create(['name' => 'Eliminar', 'method' => 'customers.destroy', 'order' => 30, 'title' => 'Clientes']);

        //Empleados
        Action::create(['name' => 'Ver Lista', 'method' => 'employees.index', 'order' => 31, 'title' => 'Empleados']);
        Action::create(['name' => 'Registrar', 'method' => 'employees.create', 'order' => 32, 'title' => 'Empleados']);
        Action::create(['name' => 'Actualizar', 'method' => 'employees.show|employees.update', 'order' => 33, 'title' => 'Empleados']);
        Action::create(['name' => 'Eliminar', 'method' => 'employees.destroy', 'order' => 34, 'title' => 'Empleados']);

        //Perfiles
        Action::create(['name' => 'Ver Lista', 'method' => 'profiles.index', 'order' => 35, 'title' => 'Perfiles']);
        Action::create(['name' => 'Registrar', 'method' => 'profiles.create', 'order' => 36, 'title' => 'Perfiles']);
        Action::create(['name' => 'Actualizar', 'method' => 'profiles.show|profiles.update', 'order' => 37, 'title' => 'Perfiles']);
        Action::create(['name' => 'Eliminar', 'method' => 'profiles.destroy', 'order' => 38, 'title' => 'Perfiles']);

        //Usuarios
        Action::create(['name' => 'Ver Lista', 'method' => 'users.index', 'order' => 39, 'title' => 'Usuarios']);
        Action::create(['name' => 'Registrar', 'method' => 'users.create', 'order' => 40, 'title' => 'Usuarios']);
        Action::create(['name' => 'Actualizar', 'method' => 'users.show|users.update', 'order' => 41, 'title' => 'Usuarios']);
        Action::create(['name' => 'Eliminar', 'method' => 'users.destroy', 'order' => 42, 'title' => 'Usuarios']);

        //Informes
        Action::create(['name' => 'Ver Todos', 'method' => 'reports.index', 'order' => 43, 'title' => 'Informes']);

        //Facturas
        Action::create(['name' => 'Ver Lista', 'method' => 'invoices.index', 'order' => 44, 'title' => 'Facturas']);
        Action::create(['name' => 'Ver Lista Sucursal', 'method' => 'invoices.single', 'order' => 45, 'title' => 'Facturas']);
        Action::create(['name' => 'Var Lista Todos', 'method' => 'invoices.all', 'order' => 46, 'title' => 'Facturas']);
        Action::create(['name' => 'Registrar', 'method' => 'invoices.create', 'order' => 47, 'title' => 'Facturas']);
        Action::create(['name' => 'Anular', 'method' => 'invoices.cancel', 'order' => 48, 'title' => 'Facturas']);

        //Informes
        Action::create(['name' => 'Ver Todos', 'method' => 'reports.index', 'order' => 41, 'title' => 'Informes']);
    }
}
