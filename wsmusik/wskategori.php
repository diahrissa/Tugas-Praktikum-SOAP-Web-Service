<?php
    $ns = "http://".$_SERVER['HTTP_HOST']."/wsmusik/wskategori.php";//setting namespace
    require_once 'lib/nusoap.php'; // load nusoap toolkit library in controller
    $server = new soap_server; // create soap server object
    $server->configureWSDL("WEB SERVICE MUSIK MENGGUNAKAN SOAP WSDL", $ns); // wsdl configuration
    $server->wsdl->schemaTargetNamespace = $ns; // server namespace

    ########################Kategori musik##############################################################
    // Complex Array Keys and Types kategori musik++++++++++++++++++++++++++++++++++++++++++
    $server->wsdl->addComplexType("kategoriData","complexType","struct","all","",
        array(
        "id"=>array("name"=>"id","type"=>"xsd:int"),
        "title"=>array("name"=>"title","type"=>"xsd:string"),
        "penyanyi"=>array("name"=>"penyanyi","type"=>"xsd:string"),
        "genre"=>array("name"=>"genre","type"=>"xsd:string")
        )
    );
    // Complex Array kategori musik++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    $server->wsdl->addComplexType("kategoriArray","complexType","array","","SOAP-ENC:Array",
        array(),
        array(
            array(
                "ref"=>"SOAP-ENC:arrayType",
                "wsdl:arrayType"=>"tns:kategoriData[]"
            )
        ),
        "kategoriData"
    );
    // End Complex Type kategori++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    //create kategori musik
    $input_create = array('title' => "xsd:string",'penyanyi' => "xsd:string",'genre' => "xsd:string"); // parameter create kategori
    $return_create = array("return" => "xsd:string");
    $server->register('create',
        $input_create,
        $return_create,
        $ns,
        "urn:".$ns."/create",
        "rpc",
        "encoded",
        "Menyimpan kategori Musik Baru");

    // $input_create = array('penyanyi' => "xsd:string"); // parameter create kategori
    // $return_create = array("return" => "xsd:string");
    // $server->register('create',
    //     $input_create,
    //     $return_create,
    //     $ns,
    //     "urn:".$ns."/create",
    //     "rpc",
    //     "encoded",
    //     "Menyimpan kategori Penyanyi Baru");

    // $input_create = array('genre' => "xsd:string"); // parameter create kategori
    // $return_create = array("return" => "xsd:string");
    // $server->register('create',
    //     $input_create,
    //     $return_create,
    //     $ns,
    //     "urn:".$ns."/create",
    //     "rpc",
    //     "encoded",
    //     "Menyimpan kategori Genre Baru");
    //end create kategori musik
    //readbyid kategori musik
    $input_readbyid = array('id' => "xsd:int"); // parameter readbyid kategori
    $return_readbyid = array("return" => "tns:kategoriArray");
    $server->register('readbyid',
        $input_readbyid,
        $return_readbyid,
        $ns,
        "urn:".$ns."/readbyid",
        "rpc",
        "encoded",
        "Mengambil kategori Musik by id");
    //end readbyid kategori musik
    //update kategori musik
    $input_update = array('id' => "xsd:int","title"=>"xsd:string","penyanyi"=>"xsd:string","genre"=>"xsd:string"); // parameter update kategori
    $return_update = array("return" => "xsd:string");
    $server->register('updatebyid',
        $input_update,
        $return_update,
        $ns,
        "urn:".$ns."/updatebyid",
        "rpc",
        "encoded",
        "Mengupdate kategori by id");
    //end update kategori musik
    //delete kategori musik
    $input_delete = array('id' => "xsd:string"); // parameter hapus kategori
    $return_delete = array("return" => "xsd:string");
    $server->register('deletebyid',
        $input_delete,
        $return_delete,
        $ns,
        "urn:".$ns."/deletebyid",
        "rpc",
        "encoded",
        "Menghapus kategori by id");
    //end delete kategori musik
    //Ambil Semua Data kategori musik
    $input_readall = array(); // parameter ambil data kategori
    $return_readall = array("return" => "tns:kategoriArray");
    $server->register('readall',
        $input_readall,
        $return_readall,
        $ns,
        "urn:".$ns."/readall",
        "rpc",
        "encoded",
        "Mengambil Semua Data kategori Musik");
    //Ambil Semua Data kategori musik
    ################################Kategori musik#######################################################
    ###########################FUNCTION KATEGORI musik###################################################
    function create($title,$penyanyi,$genre){
        require_once 'classDb/Classkategori.php';
        $kategori = new Classkategori;
        if ($kategori->create($title,$penyanyi,$genre)) {
            $respon = "sukses";
        }else{
            $respon = "error";
        }
        return $respon;
    }
    // function create($penyanyi){
    //     require_once 'classDb/Classkategori.php';
    //     $kategori = new Classkategori;
    //     if ($kategori->create($penyanyi)) {
    //         $respon = "sukses";
    //     }else{
    //         $respon = "error";
    //     }
    //     return $respon;
    // }
    // function create($genre){
    //     require_once 'classDb/Classkategori.php';
    //     $kategori = new Classkategori;
    //     if ($kategori->create($genre)) {
    //         $respon = "sukses";
    //     }else{
    //         $respon = "error";
    //     }
    //     return $respon;
    // }
    function readbyid($id){
        require_once 'classDb/Classkategori.php';
        $kategori = new Classkategori;
        $hasil = $kategori->readbyid($id);
        $daftar = array();
        while ($item = $hasil->fetch_assoc()) {
            array_push($daftar, array('id'=>$item['id'],'title'=>$item['title'],'penyanyi'=>$item['penyanyi'],'genre'=>$item['genre']));
        }
        return $daftar;
    }
    function readall(){
        require_once 'classDb/Classkategori.php';
        $kategori = new Classkategori;
        $hasil = $kategori->readAll();
        $daftar = array();
        while ($item = $hasil->fetch_assoc()) {
            array_push($daftar, array('id'=>$item['id'],'title'=>$item['title'],'penyanyi'=>$item['penyanyi'],'genre'=>$item['genre']));
        }
        return $daftar;
    }
    function updatebyid($id,$title,$penyanyi,$genre){
        require_once 'classDb/Classkategori.php';
        $kategori = new Classkategori;
        if ($kategori->updatebyid($id,$title,$penyanyi,$genre)) {
            $respon = "sukses";
        }else{
            $respon = "error";
        }
        return $respon;
    }
    function deletebyid($id){
        require_once 'classDb/Classkategori.php';
        $kategori = new Classkategori;
        if ($kategori->deletebyid($id)) {
            $respon = "sukses";
        }else{
            $respon = "error";
        }
        return $respon;
    }

    $server->service(file_get_contents("php://input"));
 ?>