<script type="text/javascript">
$(document).ready(function(){
	$(':input:not([type="submit"])').each(function() {
		$(this).focus(function() {
			$(this).addClass('hilite');
		}).blur(function() {
			$(this).removeClass('hilite');});
	});	
	
	
	$("#view").show();
	$("#form").hide();
	
	$("#tambah").click(function(){
		$("#view").hide();
		$("#form").show();
		$("#nama_pel").focus();
	});
	
	function kosong(){
		$("#id_pelanggan").val('');
		$("#id_produk").val('');
		$("#id_area").val('');
		$("#nama_pel").val('');
		$("#alamat_pel").val('');
		$("#telp_pel").val('');
		$("#email_pel").val('');
		$("#tgl_lahir").val('');

		
	}
	$("#simpan").click(function(){
		var id_pelanggan =	$("#id_pelanggan").val();
		var id_produk =	$("#id_produk").val();
		var id_area =	$("#id_area").val();
		var nama_pel =	$("#nama_pel").val();
		var alamat_pel =	$("#alamat_pel").val();
		var telp_pel =	$("#telp_pel").val();
		var speedyno =	$("#speedyno").val();
		var email_pel =	$("#email_pel").val();
		var tgl_lahir =	$("#tgl_lahir").val();
	
		
		var string ="id_pelanggan="+id_pelanggan+
					"&id_produk="+id_produk+
					"&id_area="+id_area+
					"&nama_pel="+nama_pel+
					"&alamat_pel="+alamat_pel+
					"&telp_pel="+telp_pel+
					"&speedyno="+speedyno+
					"&email_pel="+email_pel+
					"&tgl_lahir="+tgl_lahir;
	
		
		if(nama_pel.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, isi data nama pelanggan',
				timeout:2000,
				showType:'slide'
			});
			
			$("#nama_pel").focus();
			return false;
		}
		if(alamat_pel.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, isi data alamat pelanggan',
				timeout:2000,
				showType:'slide'
			});
			
			$("#alamat_pel").focus();
			return false;
		}
			if(telp_pel.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, isi data telepon pelanggan',
				timeout:2000,
				showType:'slide'
			});
			
			$("#telp_pel").focus();
			return false;
		}
				if(email_pel.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, isi data email pelanggan',
				timeout:2000,
				showType:'slide'
			});
			
			$("#email_pel").focus();
			return false;
		}
				if(tgl_lahir.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, isi data tanggal lahir pelanggan',
				timeout:2000,
				showType:'slide'
			});
			
			$("#tgl_lahir").focus();
			return false;
		}
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>backend/pelanggan/simpan",
			data	: string,
			cache	: false,
			success	: function(data){
				$.messager.show({
					title:'Info',
					msg:data,
					timeout:2000,
					showType:'slide'
				});
			}
			/*,
			error : function(xhr, teksStatus, kesalahan) {
				$.messager.show({
					title:'Info',
					msg: 'Server tidak merespon :'+kesalahan,
					timeout:2000,
					showType:'slide'
				});
			}
			*/
		});
		
	});
	
	$("#tambah_data").click(function(){
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>backend/pelanggan/tambah",
			cache	: false,
			success	: function(data){
				kosong();
				$("#nama_pel").focus();
			}
		});
	});
	
	$("#kembali").click(function(){
		window.location.assign('<?php echo base_url();?>backend/pelanggan');
	});
});

function editData(id){
	var string = "id="+id;
	$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>backend/pelanggan/edit",
			data	: string,
			cache	: true,
			dataType : "json",
			success	: function(data){
				$("#view").hide();
				$("#form").show();
				
				$("#nama_pel").focus();
				
				$("#id_pelanggan").val(id);
				$("#id_produk").val(data.id_produk);
				$("#id_area").val(data.id_area);
				$("#nama_pel").val(data.nama_pel);
				$("#alamat_pel").val(data.alamat_pel);
				$("#telp_pel").val(data.telp_pel);
				$("#email_pel").val(data.email_pel);
				$("#tgl_lahir").val(data.tgl_lahir);
			}
	});
}
</script>
<div id="view">
<div style="float:left; padding-bottom:5px;">
<button type="button" name="tambah" id="tambah" class="easyui-linkbutton" data-options="iconCls:'icon-add'">Tambah Data</button>

<a href="<?php echo base_url();?>backend/pelanggan">
<button type="button" name="refresh" id="refresh" class="easyui-linkbutton" data-options="iconCls:'icon-reload'">Refresh</button>
</a>
</div>
<div style="float:right; padding-bottom:5px;">
<form name="form" method="post" action="<?php echo base_url();?>backend/pelanggan">
Cari Perihal : <input type="text" name="txt_cari" id="txt_cari" size="50" />
<button type="submit" name="cari" id="cari" class="easyui-linkbutton" data-options="iconCls:'icon-search'">Cari</button>
</form>
</div>
<table id="dataTable" width="100%">
<tr>
	<th>No</th>
    <th>ID Pelanggan</th>
	<th>Nama</th>
	<th>Alamat</th>
	<th>No Telp</th>
	<th>No Speedy</th>
	<th>Email</th>
	<th>Tgl Lahir</th>
	<th>Pelanggan</th>
	<th>Action</th>
</tr>
<?php
	if($data->num_rows()>0){
		$no =1+$hal;
		foreach($data->result_array() as $db){  
		?>    
    	<tr>
			<td align="center" width="20"><?php echo $no; ?></td>
            <td align="center" width="20" ><?php echo $db['id_pelanggan']; ?></td>
			<td width="150" ><?php echo $db['nama_pel']; ?></td>
			<td width="150" ><?php echo $db['alamat_pel']; ?></td>
			<td width="150" ><?php echo $db['telp_pel']; ?></td>
			<td width="150" ><?php echo $db['speedyno']; ?></td>
			<td width="150" ><?php echo $db['email_pel']; ?></td>
			<td width="150" ><?php echo $db['tgl_lahir']; ?></td>
			<td width="150" ><?php echo $db['produk']; ?></td>
            <td align="center" width="80">
            <?php echo "<a href='javascript:editData(\"{$db['id_pelanggan']}\")'>";?>
			<img src="<?php echo base_url();?>asset/images/ed.png" title='Edit'>
			</a>
            <a href="<?php echo base_url();?>backend/pelanggan/hapus/<?php echo $db['id_pelanggan'];?>"
            onClick="return confirm('Anda yakin ingin menghapus data ini?')">
			<img src="<?php echo base_url();?>asset/images/del.png" title='Hapus'>
			</a>
            </td>
    </tr>
    <?php
		$no++;
		}
	}else{
	?>
    	<tr>
        	<td colspan="6" align="center" >Tidak Ada Data</td>
        </tr>
    <?php	
	}
?>
</table>
<?php echo "<table align='center'><tr><td>".$paginator."</td></tr></table>"; ?>
</div>
<div id="form">
<fieldset class="atas">
<table width="100%">
<input type="hidden" name="id_pelanggan" id="id_pelanggan"  size="20" maxlength="20" />

<tr>    
	<td>Produk</td>
    <td>:</td>
    <td>
	<select name="id_produk" id="id_produk" class="kosong">
	<option>-pilih-</option>
		<?php
			foreach($produk->result_array() as $v) {
		?>
	<option value="<?php echo $v['id_produk']; ?>"> <?php echo $v['name_produk']; ?> </option>
		<?php } ?>
	</select>
	
	
	</td>
</tr>

<tr>    
	<td>Area</td>
    <td>:</td>
    <td>
	<select name="id_area" id="id_area" class="kosong">
	<option>-pilih-</option>
		<?php
			foreach($area->result_array() as $a) {
		?>
	<option value="<?php echo $a['id_area']; ?>"><?php echo $a['area_name']; ?> </option>
		<?php } ?>
	</select>
	
	
	</td>
</tr>

<tr>    
	<td>Nama Pelanggan</td>
    <td>:</td>
    <td><input type="text" name="nama_pel" id="nama_pel"  size="50" maxlength="100" /></td>
</tr>

<tr>    
	<td>Alamat</td>
    <td>:</td>
    <td><input type="text" name="alamat_pel" id="alamat_pel"  size="50" maxlength="100" /></td>
</tr>

<tr>    
	<td>Telepon</td>
    <td>:</td>
    <td><input type="text" name="telp_pel" id="telp_pel"  size="50" maxlength="100" /></td>
</tr>

<tr>    
	<td>No Speedy</td>
    <td>:</td>
    <td><input type="text" name="speedyno" id="speedyno"  size="50" maxlength="100" /></td>
</tr>

<tr>    
	<td>Email</td>
    <td>:</td>
    <td><input type="text" name="email_pel" id="email_pel"  size="50" maxlength="100" /></td>
</tr>
<tr>    
	<td>Tgl lahir</td>
    <td>:</td>
    <td><input type="text" name="tgl_lahir" id="tgl_lahir"  size="50" maxlength="100" /></td>
</tr>


</table>
</fieldset>
<fieldset class="bawah">
<table width="100%">
<tr>
	<td colspan="3" align="center">
    <button type="button" name="simpan" id="simpan" class="easyui-linkbutton" data-options="iconCls:'icon-save'">SIMPAN</button>
    <button type="button" name="tambah_data" id="tambah_data" class="easyui-linkbutton" data-options="iconCls:'icon-add'">TAMBAH</button>
    <button type="button" name="kembali" id="kembali" class="easyui-linkbutton" data-options="iconCls:'icon-back'">KEMBALI</button>
    </td>
</tr>
</table>  
</fieldset>   
</div>