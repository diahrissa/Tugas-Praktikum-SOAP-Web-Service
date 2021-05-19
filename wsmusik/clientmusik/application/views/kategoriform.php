<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="decription" content="Administrator">
	<meta name="author" content="syarif">
	<link rel="shortcut icon" href="">
	<title><?php if(isset($title)){echo $title." || ";} ?>Administrator</title>
	<link rel="stylesheet" type="text/css" href="http://localhost/wsmusik/clientmusik/public/css/bootstrap.css">
	<script src="http://localhost/wsmusik/clientmusik/public/js/jquery-1.11.3.min.js"></script>
	<script src="http://localhost/wsmusik/clientmusik/public/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="row">
<!--content-->
<div class="col-md-4 col-sm-4">
	<div class="panel panel-primary">
		<div class="panel-heading"><span class="glyphicon glyphicon-list"></span> Form Musik</div>
		<div class="panel-body">
			<form action="#">
				<div class="form-group">
					<label for="title">Title</label>
					<input type="text" class="form-control" id="title" name="title">
					<label for="penyanyi">Penyanyi</label>
					<input type="text" class="form-control" id="penyanyi" name="penyanyi">
					<label for="genre">Genre</label>
					<input type="text" class="form-control" id="genre" name="genre">
					<input type="hidden" id="id" name="id">
				</div>
				<div class="form-group">
					<button class="btn btn-primary" id="simpankategori"><span class="glyphicon glyphicon-save"></span> Simpan</button>
					<button class="btn btn-primary" id="updatekategori" disabled><span class="glyphicon glyphicon-edit" disabled></span> Update</button>
					<button class="btn btn-warning" id="resetkategori"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="col-md-8 col-sm-8">
	<div class="panel panel-primary">
		<div class="panel-heading"><span class="glyphicon glyphicon-th-list"></span> Daftar Musik</div>
		<div class="panel-body">
			<table class="table">
				<th>No</th>
				<th>Id</th>
				<th>Title</th>
				<th>Penyanyi</th>
				<th>Genre</th>
				<th>Action</th>
				<tbody id="daftarmusik">
			<?php if (sizeof($itemkategori)!=null) {
				$no = 1;
				foreach ($itemkategori as $kategori) {
					echo "<tr>";
					echo "<td>".$no++."</td>";
					echo "<td>".$kategori['id']."</td>";
					echo "<td>".$kategori['title']."</td>";
					echo "<td>".$kategori['penyanyi']."</td>";
					echo "<td>".$kategori['genre']."</td>";
					echo "<td>";
					echo "<button class='btn btn-sm btn-primary' id='editkategori' data-id = '".$kategori['id']."'><span class='glyphicon glyphicon-edit'></span></button> ";
					echo "<button class='btn btn-sm btn-danger' id='removekategori' data-id = '".$kategori['id']."'><span class='glyphicon glyphicon-remove'></span></button>";
					echo "</td>";
					echo "</tr>";
				}
				//var_dump($itemkategorimusik);
			} ?>
			</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	$(document).on('click','#simpankategori',simpankategori)
	.on('click','#updatekategori',updatekategori)
	.on('click','#editkategori',editkategori)
	.on('click','#removekategori',removekategori)
	.on('click','#resetkategori',resetkategori);
	function simpankategori(e){
		e.preventDefault();
		var datakategori = {'title':$('#title').val(),'penyanyi':$('#penyanyi').val(),'genre':$('#genre').val()};
		console.log(datakategori);
		$.ajax({
			url : '<?php echo site_url("welcome/createkategori") ?>',
			data : datakategori,
			dataType : 'json',
			type : 'POST',
			success : function(data,status){
				if (data.status!='error') {
					alert(data.msg);
					resetkategori(e);
					$('#daftarmusik').load('<?php echo current_url()."/ #daftarmusik > *" ?>');
				}else{
					alert(data.msg);
				}
			}
		})
	}
	function editkategori(e){
		e.preventDefault();
		var datakategori = {'id':$(this).data('id')};
		console.log(datakategori);
		$.ajax({
			url : '<?php echo site_url("welcome/editkategori") ?>',
			data : datakategori,
			dataType : 'json',
			type : 'POST',
			success : function(data,status){
				if (data.status!='error') {
					$.each(data.kategori,function(k,v){
						$('#id').val(v['id']);
						$('#title').val(v['title']);
						$('#penyanyi').val(v['penyanyi']);
						$('#genre').val(v['genre']);
					})
					$('#simpankategori').attr('disabled',true);
					$('#updatekategori').attr('disabled',false);
					alert(data.msg);
				}else{
					alert(data.msg);
				}
			}
		})
	}
	function updatekategori(e){
		e.preventDefault();
		var datakategori = {'id':$('#id').val(),'title':$('#title').val(),'penyanyi':$('#penyanyi').val(),'genre':$('#genre').val()};
		console.log(datakategori);
		$.ajax({
			url : '<?php echo site_url("welcome/updatekategori") ?>',
			data : datakategori,
			dataType : 'json',
			type : 'POST',
			success : function(data,status){
				if (data.status!='error') {
					alert(data.msg);
					$('#daftarmusik').load('<?php echo current_url()."/ #daftarmusik > *" ?>');
					resetkategori(e);
				}else{
					alert(data.msg);
				}
			}
		})
	}
	function removekategori(e){
		e.preventDefault();
		var datakategori = {'id':$(this).data('id')};
		console.log(datakategori);
		$.ajax({
			url : '<?php echo site_url("welcome/removekategori") ?>',
			data : datakategori,
			dataType : 'json',
			type : 'POST',
			success : function(data,status){
				if (data.status!='error') {
					alert(data.msg);
					$('#daftarmusik').load('<?php echo current_url()."/ #daftarmusik > *" ?>');
				}else{
					alert(data.msg);
				}
			}
		})
	}
	function resetkategori(e){
		e.preventDefault();
		$('#simpankategori').attr('disabled',false);
		$('#updatekategori').attr('disabled',true);
		$('#id').val('');
		$('#title').val('');
		$('#penyanyi').val('');
		$('#genre').val('');
	}
</script>
<!--content-->
		</div>
			<p class="text-center">&copy Copyright <a href="#">Kelompok Web Services</a></p>
	</div>
</body>
</html>