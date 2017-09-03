<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Informasi;
use App\Model\Kategori;
use App\Model\Foto;
use App\Services\DataTableService;
use App\Repositories\InformationRepository;
class InformationController extends Controller
{
	protected $dataTableService;
	protected $informasi;
	protected $kategori;
    protected $foto;
	protected $informationRepository;
	public function __construct(
                                    DataTableService $dataTableService, 
                                    Informasi $informasi,
                                    Kategori $kategori,
                                    InformationRepository $informationRepository,
                                    Foto $foto
                                )
	{

        $this->dataTableService     = $dataTableService;
        $this->informasi  = $informasi;
        $this->kategori = $kategori;
        $this->foto = $foto;
        $this->informationRepository = $informationRepository;

    }

    public function index(){
    	return view('backend.kategoriInformasi.index');
    }

    public function data(Request $request){
    	$kategori = $this->informationRepository->getKategori();
    	return $this->dataTableService->generate($kategori, 'nodelete');
    }

    public function create(Request $request){
    	$data = $this->informationRepository->store($request->all());
    	return response()->json($data);
    }

    public function detail(Request $request,$id){
    	$data = $this->informationRepository->detail($id);
    	return response()->json($data);
    }

    public function update(Request $request,$id){
    	$data = $this->informationRepository->update($request->all(),$id);
    	return response()->json($data);
    }

    public function informationIndex($id){
    	return view('backend.informasi.index', compact('id'));
    }

    public function informationData(Request $request,$id){
    	$informasi = $this->informationRepository->getInformasi($id);
    	return $this->dataTableService->generate($informasi, 'nodelete');
    }

    public function informationDetail(Request $request,$id){
    	$data = $this->informationRepository->detailInformasi($id);
    	return response()->json($data);
    }

    public function informationUpdate(Request $request,$id){
        dd($request->all());
        $data = $this->informationRepository->informationUpdate($request->all(),$id);
        return response()->json($data);
    }

    public function informationCreate(Request $request,$id){
    	$data = $this->informationRepository->informationCreate($request->all(),$id);
    	return response()->json($data);
    }

    public function fotoIndex($id1,$id2){
        $kat = $this->kategori->find($id1);
        $informasi = $this->informasi->find($id2);
        // if(isWisata($kat->nama)){
        //     $parents = $this->informationRepository->getParent($id2);
        // }
        return (isWisata($kat->nama)) ?  view('backend.foto.indexWisata', compact('id1','id2','parents','informasi')) :  view('backend.foto.index', compact('id1','id2','informasi'));
    	
    }

    public function fotoData(Request $request,$id1,$id2){
        $kat = $this->kategori->find($id1);
    	$informasi = $this->informationRepository->getFoto($id2,$id1);
        if(isWisata($kat->nama)) return $this->dataTableService->generate($informasi, 'full');
        else return $this->dataTableService->generate($informasi, 'nodetail');
    }

    public function fotoDetail(Request $request,$id1,$id2,$id3){
    	$data = $this->informationRepository->detailFoto($id3);
    	return response()->json($data);
    }

    public function fotoUpdate(Request $request,$id1,$id2,$id3){
    	$data = $this->informationRepository->fotoUpdate($request->all(),$id3,$id2,$id1);
    	return response()->json($data);
    }

    public function fotoCreate(Request $request,$id1,$id2){
    	$data = $this->informationRepository->fotoCreate($request->all(),$id2,$id1);
    	return response()->json($data);
    }

    public function fotoDelete(Request $request,$id1,$id2,$id3){
        $data = $this->informationRepository->fotoDelete($request->all(),$id3);
        return response()->json($data);
    }

    public function getParent(Request $request,$idfoto){
        $data = $this->informationRepository->getParent($idfoto);
        return apiArrayResponseBuilder(200, 'success', $data);
    }

    public function getParentAll(Request $request,$idinformasi){
        $data = $this->informationRepository->getParentAll($idinformasi);
        return apiArrayResponseBuilder(200, 'success', $data);
    }

    public function getChild(Request $request,$idfoto){
        $data = $this->informationRepository->getChild($idfoto);
        return apiArrayResponseBuilder(200, 'success', $data);
    }

    public function getChildAll(Request $request,$idfoto){
        $data = $this->informationRepository->getChildAll($idfoto);
        return apiArrayResponseBuilder(200, 'success', $data);
    }

    public function relasiIndex($id1,$id2,$idFoto){
        $foto = $this->foto->find($idFoto);
        return view('backend.relasi.index', compact('id1','id2','idFoto','foto'));
    }

    public function relasiData(Request $request,$id1,$id2,$idFoto){
        $child = $this->informationRepository->getRelasi($idFoto);
        return $this->dataTableService->generate($child, 'nodetailrelasi');
    }

    public function relasiCreate(Request $request,$id1,$id2,$idFoto){
        $data = $this->informationRepository->relasiCreate($request->all(),$id1,$id2,$idFoto);
        return response()->json($data);
    }

    public function relasiDetail(Request $request,$id1,$id2,$idFoto,$idRelasi){
        $data = $this->informationRepository->detailRelasi($idRelasi);
        return response()->json($data);
    }

    public function relasiUpdate(Request $request,$id1,$id2,$idFoto,$idRelasi){
        $data = $this->informationRepository->relasiUpdate($request->all(),$id1,$id2,$idFoto,$idRelasi);
        return response()->json($data);
    }

    public function relasiDelete(Request $request,$id1,$id2,$idFoto,$idRelasi){
        $data = $this->informationRepository->relasiDelete($request->all(),$id1,$id2,$idFoto,$idRelasi);
        return response()->json($data);
    }
}
