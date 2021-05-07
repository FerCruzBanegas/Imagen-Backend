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
        Action::create(['name' => 'Listar Datos (Sucursal)', 'method' => 'quotations.single', 'order' => 6, 'title' => 'Cotizaciones']);
        Action::create(['name' => 'Listar Datos (Todos)', 'method' => 'quotations.all', 'order' => 7, 'title' => 'Cotizaciones']);
        Action::create(['name' => 'Ver Detalle (Sucursal)', 'method' => 'quotations.show', 'order' => 8, 'title' => 'Cotizaciones']);
        Action::create(['name' => 'Ver Detalle (Todos)', 'method' => 'quotations.show|quotations.showall', 'order' => 9, 'title' => 'Cotizaciones']);
        Action::create(['name' => 'Registrar', 'method' => 'quotations.create', 'order' => 10, 'title' => 'Cotizaciones']);
        Action::create(['name' => 'Modificar', 'method' => 'quotations.update', 'order' => 11, 'title' => 'Cotizaciones']);
        Action::create(['name' => 'Eliminar', 'method' => 'quotations.destroy', 'order' => 12, 'title' => 'Cotizaciones']);

        //Arte guia
        Action::create(['name' => 'Registrar', 'method' => 'designs.create', 'order' => 13, 'title' => 'Arte guía']);
        Action::create(['name' => 'Modificar', 'method' => 'designs.update', 'order' => 14, 'title' => 'Arte guía']);

        //Orden de trabajo
        Action::create(['name' => 'Ver Lista', 'method' => 'workorders.index', 'order' => 15, 'title' => 'Orden de trabajo']);
        Action::create(['name' => 'Registrar', 'method' => 'workorders.create', 'order' => 16, 'title' => 'Orden de trabajo']);
        Action::create(['name' => 'Modificar', 'method' => 'workorders.update', 'order' => 17, 'title' => 'Orden de trabajo']);

        //Tareas
        Action::create(['name' => 'Registrar', 'method' => 'tasks.create', 'order' => 18, 'title' => 'Tareas']);
        Action::create(['name' => 'Cerrar', 'method' => 'tasks.close', 'order' => 19, 'title' => 'Tareas']);

        //Productos
        Action::create(['name' => 'Ver Lista', 'method' => 'products.index', 'order' => 20, 'title' => 'Productos']);
        Action::create(['name' => 'Registrar', 'method' => 'products.create', 'order' => 21, 'title' => 'Productos']);
        Action::create(['name' => 'Ver Detalle', 'method' => 'products.show', 'order' => 22, 'title' => 'Productos']);
        Action::create(['name' => 'Modificar', 'method' => 'products.update', 'order' => 23, 'title' => 'Productos']);
        Action::create(['name' => 'Eliminar', 'method' => 'products.destroy', 'order' => 24, 'title' => 'Productos']);

        //Costos
        Action::create(['name' => 'Ver Lista', 'method' => 'costs.index', 'order' => 25, 'title' => 'Costos']);
        Action::create(['name' => 'Registrar', 'method' => 'costs.create', 'order' => 26, 'title' => 'Costos']);
        Action::create(['name' => 'Modificar', 'method' => 'costs.update', 'order' => 27, 'title' => 'Costos']);

        //Clientes
        Action::create(['name' => 'Ver Lista', 'method' => 'customers.index', 'order' => 28, 'title' => 'Clientes']);
        Action::create(['name' => 'Registrar', 'method' => 'customers.create', 'order' => 29, 'title' => 'Clientes']);
        Action::create(['name' => 'Ver Detalle', 'method' => 'customers.show', 'order' => 30, 'title' => 'Clientes']);
        Action::create(['name' => 'Modificar', 'method' => 'customers.update', 'order' => 31, 'title' => 'Clientes']);
        Action::create(['name' => 'Eliminar', 'method' => 'customers.destroy', 'order' => 32, 'title' => 'Clientes']);

        //Empleados
        Action::create(['name' => 'Ver Lista', 'method' => 'employees.index', 'order' => 33, 'title' => 'Empleados']);
        Action::create(['name' => 'Registrar', 'method' => 'employees.create', 'order' => 34, 'title' => 'Empleados']);
        Action::create(['name' => 'Modificar', 'method' => 'employees.show|employees.update', 'order' => 35, 'title' => 'Empleados']);
        Action::create(['name' => 'Eliminar', 'method' => 'employees.destroy', 'order' => 36, 'title' => 'Empleados']);

        //Perfiles
        Action::create(['name' => 'Ver Lista', 'method' => 'profiles.index', 'order' => 37, 'title' => 'Perfiles']);
        Action::create(['name' => 'Registrar', 'method' => 'profiles.create', 'order' => 38, 'title' => 'Perfiles']);
        Action::create(['name' => 'Modificar', 'method' => 'profiles.show|profiles.update', 'order' => 39, 'title' => 'Perfiles']);
        Action::create(['name' => 'Eliminar', 'method' => 'profiles.destroy', 'order' => 40, 'title' => 'Perfiles']);

        //Usuarios
        Action::create(['name' => 'Ver Lista', 'method' => 'users.index', 'order' => 41, 'title' => 'Usuarios']);
        Action::create(['name' => 'Registrar', 'method' => 'users.create', 'order' => 42, 'title' => 'Usuarios']);
        Action::create(['name' => 'Modificar', 'method' => 'users.show|users.update', 'order' => 43, 'title' => 'Usuarios']);
        Action::create(['name' => 'Eliminar', 'method' => 'users.destroy', 'order' => 44, 'title' => 'Usuarios']);

        //Facturas
        Action::create(['name' => 'Ver Lista', 'method' => 'invoices.index', 'order' => 45, 'title' => 'Facturas']);
        Action::create(['name' => 'Listar Datos (Sucursal)', 'method' => 'invoices.single', 'order' => 46, 'title' => 'Facturas']);
        Action::create(['name' => 'Listar Datos (Todos)', 'method' => 'invoices.all', 'order' => 47, 'title' => 'Facturas']);
        Action::create(['name' => 'Registrar', 'method' => 'invoices.create', 'order' => 48, 'title' => 'Facturas']);
        Action::create(['name' => 'Modificar', 'method' => 'invoices.update', 'order' => 49, 'title' => 'Facturas']);
        Action::create(['name' => 'Anular', 'method' => 'invoices.cancel', 'order' => 50, 'title' => 'Facturas']);
        
        //Notas de Remision
        Action::create(['name' => 'Ver Lista', 'method' => 'notes.index', 'order' => 51, 'title' => 'Notas de Remision']);
        Action::create(['name' => 'Listar Datos (Sucursal)', 'method' => 'notes.single', 'order' => 52, 'title' => 'Notas de Remision']);
        Action::create(['name' => 'Listar Datos (Todos)', 'method' => 'notes.all', 'order' => 53, 'title' => 'Notas de Remision']);
        Action::create(['name' => 'Registrar', 'method' => 'notes.create', 'order' => 54, 'title' => 'Notas de Remision']);
        Action::create(['name' => 'Modificar', 'method' => 'notes.update', 'order' => 55, 'title' => 'Notas de Remision']);
        Action::create(['name' => 'Eliminar', 'method' => 'notes.destroy', 'order' => 56, 'title' => 'Notas de Remision']);

        //Cuentas
        Action::create(['name' => 'Ver Lista', 'method' => 'accounts.index', 'order' => 57, 'title' => 'Cuentas']);
        Action::create(['name' => 'Cerrar Cuenta', 'method' => 'accounts.close', 'order' => 58, 'title' => 'Cuentas']);

        //Informes
        Action::create(['name' => 'Ver Todos', 'method' => 'reports.index', 'order' => 59, 'title' => 'Informes']);
    }
}
