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
		$("#kodecab").focus();
	});
	
	function kosong(){
		$("#kodecab").val('');
		$("#singcab").val('');
		$("#namacabang").val('');
		
	}
	$("#simpan").click(function(){
		var kodecab		= $("#kodecab").val();
		var singcab	= $("#singcab").val();
		var namacabang		= $("#namacabang").val();

		var string ="kodecab="+kodecab+"&singcab="+singcab+"&namacabang="+namacabang;
		
		if(kodecab.length==0 ||singcab.length==0 ||namacabang.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, isi data dengan lengkap',
				timeout:2000,
				showType:'slide'
			});
			
			$("#kodecab").focus();
			return false;
		}
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/cabang/simpan",
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
			url		: "<?php echo site_url(); ?>/cabang/tambah",
			cache	: false,
			success	: function(data){
				kosong();
				$("#kodecab").focus();
			}
		});
	});
	
	$("#kembali").click(function(){
		window.location.assign('<?php echo base_url();?>index.php/cabang');
	});
});

function editData(id){
	var string = "id="+id;
	$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/cabang/edit",
			data	: string,
			cache	: true,
			dataType : "json",
			success	: function(data){
				$("#view").hide();
				$("#form").show();
				
				$("#kodecab").focus();
				
				$("#kodecab").val(id);
				$("#singcab").val(data.singcab);
				$("#namacabang").val(data.namacabang);

			}
	});
}
</script>
<div id="view">
<div style="float:left; padding-bottom:5px;">
<button type="button" name="tambah" id="tambah" class="easyui-linkbutton" data-options="iconCls:'icon-add'">Tambah Data</button>

<a href="<?php echo base_url();?>index.php/cabang">
<button type="button" name="refresh" id="refresh" class="easyui-linkbutton" data-options="iconCls:'icon-reload'">Refresh</button>
</a>
</div>
<div style="float:right; padding-bottom:5px;">
<form name="form" method="post" action="<?php echo base_url();?>index.php/cabang">
Cari Perihal : <input type="text" name="txt_cari" id="txt_cari" size="50" />
<button type="submit" name="cari" id="cari" class="easyui-linkbutton" data-options="iconCls:'icon-search'">Cari</button>
</form>
</div>
<table id="dataTable" width="100%">
<tr>
	<th>No</th>
    <th>Kode Cabang</th>
    <th>Singkatan</th>
	<th>Nama Cabang</th>
	<th>Aksi</th>
</tr>
<?php
	if($data->num_rows()>0){
		$no =1+$hal;
		foreach($data->result_array() as $db){  
		?>    
    	<tr>
			<td align="center" width="20"><?php echo $no; ?></td>
            <td align="center" width="100" ><?php echo $db['kodecab']; ?></td>
            <td align="center" width="100" ><?php echo $db['singcab']; ?></td>
			<td><?php echo $db['namacabang']; ?></td>		
            <td align="center" width="80">
            <?php echo "<a href='javascript:editData(\"{$db['kodecab']}\")'>";?>
			<img src="<?php echo base_url();?>asset/images/ed.png" title='Edit'>
			</a>
            <a href="<?php echo base_url();?>index.php/cabang/hapus/<?php echo $db['kodecab'];?>"
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
<tr>    
	<td>Kode Cabang</td>
    <td>:</td>
    <td><input type="text" name="kodecab" id="kodecab" size="12" maxlength="6" /></td>
</tr>
<tr>    
	<td>Singkatan</td>
    <td>:</td>
    <td><input type="text" name="singcab" id="singcab"  size="10" maxlength="10" /></td>
</tr>
<tr>    
	<td>Nama Cabang</td>
    <td>:</td>
    <td><input type="text" name="namacabang" id="namacabang"  size="50" maxlength="50" /></td>
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