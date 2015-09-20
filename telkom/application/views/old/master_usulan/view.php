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
		$("#idusulan").focus();
	});
	
	
	function kosong(){

		$("#idusulan").val('');
		$("#detail").val('');
		$("#satuan").val('');
		$("#jenis").val('');
	
	}
	$("#simpan").click(function(){
		var idusulan	= $("#idusulan").val();
		var detail		= $("#detail").val();
		var satuan		= $("#satuan").val();
		var jenis		= $("#jenis").val();


		var string ="idusulan="+idusulan+"&detail="+detail+"&satuan="+satuan+"&jenis="+jenis;
		
		if(idusulan.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, id usulan tidak boleh kosong',
				timeout:2000,
				showType:'slide'
			});
			
			$("#idusulan").focus();
			return false;
		}
		
		if(detail.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, detail tidak boleh kosong',
				timeout:2000,
				showType:'slide'
			});
			
			$("#detail").focus();
			return false;
		}
		
		if(satuan.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, satuan tidak boleh kosong',
				timeout:2000,
				showType:'slide'
			});
			
			$("#satuan").focus();
			return false;
		}
		
		if(jenis.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, jenis tidak boleh kosong',
				timeout:2000,
				showType:'slide'
			});
			
			$("#jenis").focus();
			return false;
		}
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/master_usulan/simpan",
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
		kosong();
		$("#idusulan").focus();

	});

	
	$("#kembali").click(function(){
		window.location.assign('<?php echo base_url();?>index.php/master_usulan');
	});
});

function editData(id){
	var string = "id="+id;
	$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/master_usulan/edit",
			data	: string,
			cache	: true,
			dataType : "json",
			success	: function(data){
				$("#view").hide();
				$("#form").show();
				
				$("#idusulan").focus();
				
				$("#idusulan").val(id);
				$("#detail").val(data.detail);
				$("#satuan").val(data.satuan);
				$("#jenis").val(data.jenis);

			}
	});
}
</script>
<div id="view">
<div style="float:left; padding-bottom:5px;">
<button type="button" name="tambah" id="tambah" class="easyui-linkbutton" data-options="iconCls:'icon-add'">Tambah Data</button>

<a href="<?php echo base_url();?>index.php/master_usulan">
<button type="button" name="refresh" id="refresh" class="easyui-linkbutton" data-options="iconCls:'icon-reload'">Refresh</button>
</a>
</div>
<div style="float:right; padding-bottom:5px;">
<form name="form" method="post" action="<?php echo base_url();?>index.php/master_usulan">
Cari Perihal : <input type="text" name="txt_cari" id="txt_cari" size="50" />
<button type="submit" name="cari" id="cari" class="easyui-linkbutton" data-options="iconCls:'icon-search'">Cari</button>
</form>
</div>
<table id="dataTable" width="100%">
<tr>
	<th>No</th>
	<th>ID</th>
    <th>Detail</th>
	<th>Satuan</th>
    <th>Jenis</th>
	<th>Action</th>
</tr>
<?php

	if($data->num_rows()>0){
		$no =1+$hal;
		foreach($data->result_array() as $db){  
		?>    
    	<tr>
			<td align="center" width="20"><?php echo $no; ?></td>
            <td><?php echo $db['idusulan']; ?></td>
			<td><?php echo $db['detail']; ?></td>
            <td><?php echo $db['satuan']; ?></td>
			<td><?php echo $db['jenis']; ?></td>			
            <td align="center" width="80">
            <?php echo "<a href='javascript:editData(\"{$db['idusulan']}\")'>";?>
			<img src="<?php echo base_url();?>asset/images/ed.png" title='Edit'>
			</a>
            <a href="<?php echo base_url();?>index.php/master_usulan/hapus/<?php echo $db['idusulan'];?>"onClick="return confirm('Anda yakin ingin menghapus data ini?')">
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
<tr>    
	<td>ID</td>
    <td>:</td>
    <td><input type="text" name="idusulan" id="idusulan" size="20" maxlength="20" value=""/></td>
</tr>
<tr>  
<tr>    
	<td>Detail</td>
    <td>:</td>
    <td><input type="text" name="detail" id="detail" size="100" maxlength="100" /></td>
</tr>
<tr>   
	<td>Satuan</td>
    <td>:</td>
    <td>
	<input type="text" name="satuan" id="satuan" size="20" maxlength="20" />
	</td>
</tr>
<tr>    
	<td>Jenis</td>
    <td>:</td>
    <td><select name="jenis" id="jenis"/>
		<option value="">-PILIH-</option>
		<option value="ajuservice">Aju Service</option>
		<option value="spp">SPP</option>
		<option value="cetakan">Cetakan</option>
		<option value="atk">Atk</option>
		</select>
	</td>
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