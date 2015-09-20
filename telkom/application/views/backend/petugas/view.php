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
		$("#nama").focus();
	});
	
	function kosong(){
		$("#id_petugas").val('');
		$("#nama").val('');
		$("#member").val('');
		$("#no_telpon").val('');
		
	}
	$("#simpan").click(function(){
		var id_petugas		= $("#id_petugas").val();
		var area		= $("#id_area").val();
		var nama		= $("#nama").val();
		var member	= $("#member").val();
		var no_telpon		= $("#no_telpon").val();
		
		var string ="id_petugas="+id_petugas+"&nama="+nama+"&member="+member+"&no_telpon="+no_telpon+"&idarea="+area;
		
		if(nama.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, isi data dengan lengkap',
				timeout:2000,
				showType:'slide'
			});
		
			$("#nama").focus();
			return false;
		}
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo base_url(); ?>backend/petugas/simpan",
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
			url		: "<?php echo site_url(); ?>backend/petugas/tambah",
			cache	: false,
			success	: function(data){
				kosong();
				$("#nama").focus();
			}
		});
	});
	
	$("#kembali").click(function(){
		window.location.assign('<?php echo base_url();?>backend/petugas');
	});
});

function editData(id){
	var string = "id="+id;
	$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>backend/petugas/edit",
			data	: string,
			cache	: true,
			dataType : "json",
			success	: function(data){
				$("#view").hide();
				$("#form").show();
				
				$("#nama").focus();
				
				$("#id_petugas").val(id);
				$("#nama").val(data.nama);
				$("#member").val(data.member);
				$("#no_telpon").val(data.no_telpon);
			}
	});
}
</script>
<div id="view">
<div style="float:left; padding-bottom:5px;">
<button type="button" name="tambah" id="tambah" class="easyui-linkbutton" data-options="iconCls:'icon-add'">Tambah Data</button>

<a href="<?php echo base_url();?>backend/petugas">
<button type="button" name="refresh" id="refresh" class="easyui-linkbutton" data-options="iconCls:'icon-reload'">Refresh</button>
</a>
</div>
<div style="float:right; padding-bottom:5px;">
<form name="form" method="post" action="<?php echo base_url();?>backend/petugas">
Cari Perihal : <input type="text" name="txt_cari" id="txt_cari" size="50" />
<button type="submit" name="cari" id="cari" class="easyui-linkbutton" data-options="iconCls:'icon-search'">Cari</button>
</form>
</div>
<table id="dataTable" width="100%">
<tr>
	<th>No</th>
    <th>ID Petugas</th>
    <th>Nama</th>
    <th>Area</th>
	<th>Member</th>
	<th>No Telpon</th>
	<th>Action</th>
</tr>
<?php
	if($data->num_rows()>0){
		$no =1+$hal;
		foreach($data->result_array() as $db){  
		?>    
    	<tr>
			<td align="center" width="20"><?php echo $no; ?></td>
            <td align="center" width="100" ><?php echo $db['id_petugas']; ?></td>
            <td><?php echo $db['nama']; ?></td>
            <td><?php echo $db['area_name']; ?></td>
			<td><?php echo $db['member']; ?></td>
			<td><?php echo $db['no_telpon']; ?></td>		
            <td align="center" width="80">
            <?php echo "<a href='javascript:editData(\"{$db['id_petugas']}\")'>";?>
			<img src="<?php echo base_url();?>asset/images/ed.png" title='Edit'>
			</a>
            <a href="<?php echo base_url();?>backend/user/hapus/<?php echo $db['id_petugas'];?>"
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
<input type="hidden" name="id_petugas" id="id_petugas" size="30" maxlength="100" />
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
	<td>Nama</td>
    <td>:</td>
    <td><input type="text" name="nama" id="nama" size="100" maxlength="100" /></td>
</tr>
<tr>    
	<td>Member</td>
    <td>:</td>
    <td><input type="text" name="member" id="member"  size="100" maxlength="100" /></td>
</tr>
<tr>    
	<td>No Telp</td>
    <td>:</td>
    <td><input type="text" name="no_telpon" id="no_telpon"  size="100" maxlength="100" /></td>
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