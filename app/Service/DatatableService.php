<?php namespace App\Services;

use Yajra\Datatables\Facades\Datatables;

class DataTableService {

	public function generate($data, $action = 'true'){

		if( $action == 'editonly'){
			return Datatables::of($data)->addColumn('action', function ($data) {
	                return '<center>
	                		<a data-toggle="modal" href="#modal-edit" onClick="prepareEdit('.$data->id.');loaddata('.$data->id.');" class="btn btn-xs btn-info	"><i class="fa fa-edit"></i>
	                		</a> 
	                </center>';
				})->escapeColumns(['action'])->make();	

		}
		if( $action == 'readonly'){
			
			return Datatables::of($data)->addColumn('action', function ($data) {

	                return '
	                	<center>
	                		<a data-toggle="modal" href="#modal-edit" onClick="prepareEdit('.$data->id.');loaddata('.$data->id.');" class="btn btn-xs btn-info"><i class="fa fa-info"></i>
	                		</a> 
	                </center>';
				})->removeColumn('id')->editColumn('id', 'ID: @{{$id}}')->make();	

		}
		if( $action == 'gotodetail'){
			
			return Datatables::of($data)->addColumn('action', function ($data) {

	                return '
	                	<center>
	                		<a data-toggle="modal" onClick="gotoDetail('.$data->id.');loaddata('.$data->id.');" class="btn btn-xs btn-info"><i class="fa fa-info"></i>
	                		</a> 
	                </center>';
				})->removeColumn('id')->editColumn('id', 'ID: @{{$id}}')->make();	

		}
		if( $action == 'nodelete'){
			
			return Datatables::of($data)->addColumn('action', function ($data) {

	                return '
	                	<center>
	                		<a data-toggle="modal" onClick="gotoDetail('.$data->id.');" class="btn btn-xs btn-info"><i class="fa fa-list"></i>
	                		</a> 
	                		<a data-toggle="modal" href="#modal-edit" onClick="prepareEdit('.$data->id.');loaddata('.$data->id.');" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i>
	                		</a> 
		                </center>';
				})->escapeColumns(['action'])->make();	

		}
		if( $action == 'nodetail'){
			
			return Datatables::of($data)->addColumn('action', function ($data) {

	                return '
	                	<center>
	                		<a data-toggle="modal" href="#modal-edit" onClick="prepareEdit('.$data->id.');loaddata('.$data->id.');" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i>
	                		</a> 
	                		<a onClick="deleteData('.$data->id.')" class="btn btn-xs btn-danger" id="delete"><i class="fa fa-trash-o"></i></a>
		                </center>';
				})->escapeColumns(['action'])->make();	

		}
		if( $action == 'noaction'){
			
			return Datatables::of($data)->removeColumn('id')->editColumn('id', 'ID: @{{$id}}')->make();	

		}

	}
}