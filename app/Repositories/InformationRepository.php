<?php 
namespace App\Repositories;

use App\Model\Kategori;
use App\Model\Informasi;
use App\Model\Foto;
use App\Model\Relasi;
class InformationRepository {

	protected $kategori;
	protected $informasi;
	protected $foto;
	function __construct(
		Kategori $kategori,
		Informasi $informasi,
		Foto $foto,
		Relasi $relasi
	){
		$this->kategori = $kategori;
		$this->informasi = $informasi;
		$this->foto 	= $foto;
		$this->relasi 	= $relasi;
	}

	function getKategori(){
		$data = $this->kategori->orderBy('id');
        return $data;
	}

	function store($request){
		$data = $this->kategori->create(array(
    		'nama'	=> $request['nama']
    	));
    	return $data;
	}

	function detail($id){
		$data = $this->kategori->find($id);
		return $data;
	}

	function update($request,$id){
		$data = $this->kategori->where('id',$id)->update(array(
    		'nama'	=> $request['nama']
    	));
    	return $data;
	}

	function getInformasi($id){
		$data = $this->informasi->select('id','nama','kategori_id','alamat','latitude','longitude','email','website','telp','data')->where('kategori_id',$id)->orderBy('id');
        return $data;
	}

	function detailInformasi($id){
		$data = $this->informasi->find($id);
		return $data;
	}

	function informationUpdate($request,$id){
		$data = $this->informasi->where('id',$id)->update(array(
    		'nama'		=> $request['nama'],
    		'alamat'	=> $request['alamat'],
    		'data'		=> $request['data'],
    		'latitude'	=> $request['latitude'],
    		'longitude'	=> $request['longitude'],
    		'email'		=> $request['email'],
    		'website'	=> $request['website'],
    		'telp'		=> $request['telp']
    	));
    	return $data;
	}

	function informationCreate($request,$id){
		$data = $this->informasi->create(array(
    		'nama'		=> $request['nama'],
    		'alamat'	=> $request['alamat'],
    		'data'		=> $request['data'],
    		'kategori_id'	=> $id,
    		'latitude'	=> $request['latitude'],
    		'longitude'	=> $request['longitude'],
    		'email'		=> $request['email'],
    		'website'	=> $request['website'],
    		'telp'		=> $request['telp']
    	));
    	return $data;
	}

	function getFoto($id_informasi, $id_kategori){
		$kat = $this->kategori->find($id_kategori);
		$data = $this->foto->select('id','nama','path')->where('informasi_id',$id_informasi)->orderBy('id');
        return $data;
	}

	function detailFoto($id){
		$data = $this->foto
			->select('foto.id','foto.nama')
			->where('foto.id',$id)
			->first();
		return $data;
	}

	function fotoUpdate($request,$id_foto,$id_informasi,$id_kategori){
		$kat = $this->kategori->find($id_kategori);
		if($request['path'] != "[object FileList]"){
			// if(isWisata($kat->nama)){
				$path       = 'informasi/';
				$request['nama'] = str_replace(' ','-',$request['nama']);
		        $fileName   = $request['nama'].'-'.$id_informasi.'-'.$request['path']->getClientOriginalName();
		        $request['path']->move($path, $fileName);
				$data = $this->foto->where('id',$id_foto)->update(array(
		    		'nama'		=> $request['nama'],
		    		'path'		=> $path.$fileName,
		    	));
				// if($request['fotoparent'] !=  '--'){
	   //      		$check = $this->relasi->where('id',$request['relasi_id'])->count();
	   //      		if($check > 0){
				//     	$data = $this->relasi->where('id',$request['relasi_id'])->update(array(
				//     		'fotoparent'	=> $request['fotoparent'],
				//     		'nama_parent'	=> $request['nama_parent'],
				//     		'fotochild'		=> $id_foto,
				//     		'derajat'		=> $request['derajat']
				//     	));
	   //      		} 
	   //      		else{
	   //      			$data = $this->relasi->create(array(
				//     		'fotoparent'	=> $request['fotoparent'],
				//     		'nama_parent'	=> $request['nama_parent'],
				//     		'fotochild'		=> $id_foto,
				//     		'derajat'		=> $request['derajat']
				//     	));
	   //      		}
	   //      	}
	   //      	else{
	   //      		$data = $this->relasi->where('id',$request['relasi_id'])->delete();
	   //      	}

			// }
			// else{
			// 	$data = $this->foto->where('id',$id_foto)->update(array(
		 //    		'nama'		=> $request['nama'],
		 //    		'path'		=> $path.$fileName,
		 //    	));
			// }
		}
		else{
			// if(isWisata($kat->nama)){
				$data = $this->foto->where('id',$id_foto)->update(array(
		    		'nama'		=> $request['nama']
		    	));
		    	// if($request['fotoparent'] !=  '--')
	      //   	{
	      //   		$check = $this->relasi->where('id',$request['relasi_id'])->count();
	      //   		if($check > 0){
				   //  	$data = $this->relasi->where('id',$request['relasi_id'])->update(array(
				   //  		'fotoparent'	=> $request['fotoparent'],
				   //  		'nama_parent'	=> $request['nama_parent'],
				   //  		'fotochild'		=> $id_foto,
				   //  		'derajat'		=> $request['derajat']
				   //  	)); 
	      //   		}
	      //   		else{
	      //   			$data = $this->relasi->create(array(
				   //  		'fotoparent'	=> $request['fotoparent'],
				   //  		'nama_parent'	=> $request['nama_parent'],
				   //  		'fotochild'		=> $id_foto,
				   //  		'derajat'		=> $request['derajat']
				   //  	));
	      //   		}
	      //   	}
	      //   	else{
	      //   		$data = $this->relasi->where('id',$request['relasi_id'])->delete();
	      //   	}
			// }
			// else{
			// 	$data = $this->foto->where('id',$id_foto)->update(array(
		 //    		'nama'		=> $request['nama']
		 //    	));
			// }
			
		}
    	return $data;
	}

	function fotoCreate($request,$id,$id_kategori){
		$path       = 'informasi/';
		$request['nama'] = str_replace(' ','-',$request['nama']);
        $fileName   = $request['nama'].'-'.$id.'-'.$request['path']->getClientOriginalName();
        $request['path']->move($path, $fileName);
        $kat = $this->kategori->find($id_kategori);
      //   if(isWisata($kat->nama)){
      //   	$idRelasi = $this->foto->insertGetId(array(
	    	// 	'nama'			=> $request['nama'],
	    	// 	'informasi_id'	=> $id,
	    	// 	'path'			=> $path.$fileName,
	    	// ));

       //  	if($request['fotoparent'] !=  '--')
       //  	{
		    	// $data = $this->relasi->create(array(
		    	// 	'fotoparent'	=> $request['fotoparent'],
		    	// 	'nama_parent'	=> $request['nama_parent'],
		    	// 	'fotochild'		=> $idRelasi,
		    	// 	'derajat'		=> $request['derajat']
		    	// ));

		    	// if($request['derajat'] >= 0) $derajatLawan = 180 - $request['derajat'];
		    	// elseif($request['derajat'] < 0) $derajatLawan = 0 - ($request['derajat'] + 180);
		    	// $data = $this->relasi->create(array(
		    	// 	'fotoparent'	=> $idRelasi,
		    	// 	'nama_parent'	=> str_replace('-',' ',$request['nama']),
		    	// 	'fotochild'		=> $request['fotoparent'],
		    	// 	'derajat'		=> $derajatLawan
		    	// ));
       //  	}
        // }
        // else{
			$data = $this->foto->create(array(
	    		'nama'			=> $request['nama'],
	    		'informasi_id'	=> $id,
	    		'path'			=> $path.$fileName,
	    	));
        // }
    	return $data;
	}

	function fotoDelete($request,$id){
		return $this->foto->where('id',$id)->delete();
	}

	function getParent($id){
		$informasi = $this->foto->find($id);
		$nama = $this->informasi->select('id')->where('nama',$informasi->informasi_id)->first();
		$data = $this->foto->where('informasi_id',$nama->id)->where('id','!=',$id)->get();
		return $data;
	}

	function getParentAll($idinformasi){
		$data = $this->foto->where('informasi_id',$idinformasi)->get();
		return $data;
	}

	function getChildAll($id){
		$foto = $this->foto->find($id);
		$nama = $this->informasi->select('id')->where('nama',$foto->informasi_id)->first();
		$data = $this->foto->where('informasi_id',$nama->id)->where('id','!=',$id)->get();
		return $data;
	}

	function getRelasi($idfoto){
		$data = $this->relasi->select('relasi.id','relasi.nama_child','relasi.derajat','foto.path')
				->join('foto','foto.id','=','relasi.fotochild')->where('fotoparent',$idfoto)->orderBy('id');
        return $data;
	}

	function relasiCreate($request,$id_kategori,$id_informasi,$id_foto){
		$data = $this->relasi->create(array(
    		'fotoparent'	=> $id_foto,
    		'nama_child'	=> $request['nama_child'],
    		'fotochild'		=> $request['fotochild'],
    		'derajat'		=> $request['derajat']
    	));

    	if($request['derajat'] >= 0) $derajatLawan = 180 - $request['derajat'];
    	elseif($request['derajat'] < 0) $derajatLawan = 0 - ($request['derajat'] + 180);
    	$foto = $this->foto->find($id_foto);
    	$data = $this->relasi->create(array(
    		'fotoparent'	=> $request['fotochild'],
    		'nama_child'	=> $foto->nama,
    		'fotochild'		=> $id_foto,
    		'derajat'		=> $derajatLawan
    	));

    	return $data;
	}

	function detailRelasi($id){
		$data = $this->relasi
			->select('id','fotochild','derajat')
			->where('id',$id)
			->first();
		return $data;
	}

	function relasiUpdate($request,$id1,$id2,$idFoto,$idRelasi){
		$relasi = $this->relasi->find($idRelasi);
		$this->relasi->where('fotochild',$relasi->fotoparent)->where('fotoparent',$relasi->fotochild)->delete();
		$this->relasi->where('fotochild',$relasi->fotochild)->where('fotoparent',$relasi->fotoparent)->delete();
		$data = $this->relasi->create(array(
    		'fotoparent'	=> $relasi->fotoparent,
    		'nama_child'	=> $request['nama_child'],
    		'fotochild'		=> $request['fotochild'],
    		'derajat'		=> $request['derajat']
    	));

    	if($request['derajat'] >= 0) $derajatLawan = 180 - $request['derajat'];
    	elseif($request['derajat'] < 0) $derajatLawan = 0 - ($request['derajat'] + 180);
    	$foto = $this->foto->find($idFoto);
    	$data = $this->relasi->create(array(
    		'fotoparent'	=> $request['fotochild'],
    		'nama_child'	=> $foto->nama,
    		'fotochild'		=> $idFoto,
    		'derajat'		=> $derajatLawan
    	));
    	return $data;
	}

	function relasiDelete($request,$id1,$id2,$idFoto,$idRelasi){
		$relasi = $this->relasi->find($idRelasi);
		$this->relasi->where('fotochild',$relasi->fotoparent)->where('fotoparent',$relasi->fotochild)->delete();
		$this->relasi->where('fotochild',$relasi->fotochild)->where('fotoparent',$relasi->fotoparent)->delete();
		return true;
	}
}