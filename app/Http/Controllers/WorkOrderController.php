<?php

namespace App\Http\Controllers;

use App\WorkOrder;
use Illuminate\Http\Request;
use App\Http\Requests\WorkOrderRequest;
use App\Http\Resources\WorkOrder\WorkOrderResource;
use App\Services\WorkOrderService;
use App\Filters\WorkOrderSearch\WorkOrderSearch;
use App\Http\Resources\WorkOrder\WorkOrderCollection;

class WorkOrderController extends ApiController
{
    private $workOrder;
    protected $service;

    public function __construct(WorkOrder $workOrder, WorkOrderService $service)
    {
        $this->workOrder = $workOrder;
        $this->service = $service;
    }

    public function index(Request $request)
    {
        if ($request->filled('filter.filters')) {
            return new WorkOrderCollection(WorkOrderSearch::apply($request, $this->workOrder));
        }

        $workOrders = WorkOrderSearch::checkSortFilter($request, $this->workOrder->newQuery());

        return new WorkOrderCollection($workOrders->paginate($request->take));
    }

    public function store(WorkOrderRequest $request)
    {
        try {
            $workOrder = $this->workOrder->create($request->all());
            $workOrder->employees()->attach($request->employees);
        } catch (\Exception $e) {
            return $this->respondInternalError();
        }
        return $this->respondCreated(new WorkOrderResource($workOrder->refresh()));
    }

    public function update(WorkOrderRequest $request, WorkOrder $workOrder)
    {
        try {
            $workOrder->update($request->all());
            $workOrder->employees()->sync($request->employees);
        } catch (\Exception $e) {
            return $this->respondInternalError();
        }
        return $this->respondUpdated(new WorkOrderResource($workOrder));
    }

    public function workOrderPdf(Request $request)
    {
        return $this->service->singlePdfDownload($request);
    }

    public function listPdf(Request $request)
    {
        return $this->service->manyPdfDownload($request);
    }
    
    public function listExcel(Request $request) 
    {
        return $this->service->manyExcelDownload($request);
    }

    public function finishWorkOrder(WorkOrder $workOrder) 
    {
        try {
            $tasks = collect($workOrder->tasks)->filter(function ($value, $key) {
                return $value->completed === 0;
            });

            if($tasks->count()) {
                return $this->respond(message('MSG016'), 406);
            } else {
                $workOrder->update(['closing_date' => date("Y-m-d")]);
                $workOrder->quotation->update(['state_id' => 3]);
            }
        } catch (\Exception $e) {
            return $this->respondInternalError();
        }
        return $this->respondUpdated(new WorkOrderResource($workOrder));
    }
}

-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         5.7.24 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para imagen
CREATE DATABASE IF NOT EXISTS `imagen` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `imagen`;

-- Volcando estructura para tabla imagen.actions
CREATE TABLE IF NOT EXISTS `actions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  `method` varchar(120) NOT NULL,
  `title` varchar(120) NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla imagen.actions: ~55 rows (aproximadamente)
/*!40000 ALTER TABLE `actions` DISABLE KEYS */;
INSERT INTO `actions` (`id`, `name`, `method`, `title`, `order`) VALUES
	(1, 'Acesso total al sistema', '*', 'Sistema', 1),
	(2, 'Ver Todos', 'quotations.index|quotations.pending|quotations.approved|quotations.executed', 'Cotizaciones', 2),
	(3, 'Ver Pendientes', 'quotations.pending', 'Cotizaciones', 3),
	(4, 'Ver Aprobadas', 'quotations.approved', 'Cotizaciones', 4),
	(5, 'Ver Ejecutadas', 'quotations.executed', 'Cotizaciones', 5),
	(6, 'Registrar', 'quotations.create', 'Cotizaciones', 6),
	(7, 'Ver Detalle Sucursal', 'quotations.show', 'Cotizaciones', 7),
	(8, 'Ver Detalle Todos', 'quotations.show|quotations.showall', 'Cotizaciones', 8),
	(9, 'Actualizar', 'quotations.update', 'Cotizaciones', 9),
	(10, 'Eliminar', 'quotations.destroy', 'Cotizaciones', 10),
	(11, 'Registrar', 'designs.create', 'Arte guía', 11),
	(12, 'Actualizar', 'designs.update', 'Arte guía', 12),
	(13, 'Ver Lista', 'workorders.index', 'Orden de trabajo', 13),
	(14, 'Registrar', 'workorders.create', 'Orden de trabajo', 14),
	(15, 'Actualizar', 'workorders.update', 'Orden de trabajo', 15),
	(16, 'Ver Lista', 'products.index', 'Productos', 16),
	(17, 'Registrar', 'products.create', 'Productos', 17),
	(18, 'Ver Detalle', 'products.show', 'Productos', 18),
	(19, 'Actualizar', 'products.update', 'Productos', 19),
	(20, 'Eliminar', 'products.destroy', 'Productos', 20),
	(21, 'Ver Lista', 'costs.index', 'Costos', 21),
	(22, 'Registrar', 'costs.create', 'Costos', 22),
	(23, 'Actualizar', 'costs.update', 'Costos', 23),
	(24, 'Ver Lista', 'customers.index', 'Clientes', 24),
	(25, 'Registrar', 'customers.create', 'Clientes', 25),
	(26, 'Ver Detalle', 'customers.show', 'Clientes', 26),
	(27, 'Actualizar', 'customers.update', 'Clientes', 27),
	(28, 'Eliminar', 'customers.destroy', 'Clientes', 28),
	(29, 'Ver Lista', 'employees.index', 'Empleados', 29),
	(30, 'Registrar', 'employees.create', 'Empleados', 30),
	(31, 'Actualizar', 'employees.show|employees.update', 'Empleados', 31),
	(32, 'Eliminar', 'employees.destroy', 'Empleados', 32),
	(33, 'Ver Lista', 'profiles.index', 'Perfiles', 33),
	(34, 'Registrar', 'profiles.create', 'Perfiles', 34),
	(35, 'Actualizar', 'profiles.show|profiles.update', 'Perfiles', 35),
	(36, 'Eliminar', 'profiles.destroy', 'Perfiles', 36),
	(37, 'Ver Lista', 'users.index', 'Usuarios', 37),
	(38, 'Registrar', 'users.create', 'Usuarios', 38),
	(39, 'Actualizar', 'users.show|users.update', 'Usuarios', 39),
	(40, 'Eliminar', 'users.destroy', 'Usuarios', 40),
	(41, 'Ver Todos', 'reports.index', 'Informes', 41),
	(42, 'Ver Lista', 'invoices.index', 'Facturas', 42),
	(43, 'Registrar', 'invoices.create', 'Facturas', 43),
	(44, 'Anular', 'invoices.cancel', 'Facturas', 44),
	(45, 'Ver Lista', 'notes.index', 'Notas de Remision', 45),
	(46, 'Registrar', 'notes.create', 'Notas de Remision', 46),
	(47, 'Actualizar', 'notes.update', 'Notas de Remision', 47),
	(48, 'Ver Lista', 'accounts.index', 'Cuentas', 48),
	(49, 'Cerrar Cuenta', 'accounts.close', 'Cuentas', 49),
	(50, 'Ver Lista Sucursal', 'quotations.single', 'Cotizaciones', 50),
	(51, 'Ver Lista Todos', 'quotations.all', 'Cotizaciones', 51),
	(52, 'Ver Lista Sucursal', 'invoices.single', 'Facturas', 52),
	(53, 'Var Lista Todos', 'invoices.all', 'Facturas', 53),
	(54, 'Ver Lista Sucursal', 'notes.single', 'Notas de Remision', 54),
	(55, 'Ver Lista Todos', 'notes.all', 'Notas de Remision', 55);
/*!40000 ALTER TABLE `actions` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
