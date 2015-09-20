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
		$("#name_produk").focus();
	});
	
	function kosong(){
		$("#id_produk").val('');
		$("#name_produk").val('');
		
	}
	$("#simpan").click(function(){
	
	$("#simpan").attr('disabled','disabled');
	
		var id_produk		= $("#id_produk").val();
		var name_produk	= $("#name_produk").val();
		
		var string ="id_produk="+id_produk+"&name_produk="+name_produk;
		
		if(name_produk.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, isi data dengan lengkap',
				timeout:2000,
				showType:'slide'
			});
			
			$("#name_produk").focus();
			return false;
		}
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>backend/produk/simpan",
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
			url		: "<?php echo site_url(); ?>backend/produk/tambah",
			cache	: false,
			success	: function(data){
				kosong();
				$("#name_produk").focus();
			}
		});
	});
	
	$("#kembali").click(function(){
		window.location.assign('<?php echo base_url();?>backend/produk');
	});
});

function editData(id){
	var string = "id="+id;
	$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>backend/produk/edit",
			data	: string,
			cache	: true,
			dataType : "json",
			success	: function(data){
				$("#view").hide();
				$("#form").show();
				
				$("#name_produk").focus();
				
				$("#id_produk").val(id);
				$("#name_produk").val(data.name_produk);
			}
	});
}
</script>
<div id="view">
<div style="float:left; padding-bottom:5px;">
<button type="button" name="tambah" id="tambah" class="easyui-linkbutton" data-options="iconCls:'icon-add'">Tambah Data</button>

<a href="<?php echo base_url();?>backend/produk">
<button type="button" name="refresh" id="refresh" class="easyui-linkbutton" data-options="iconCls:'icon-reload'">Refresh</button>
</a>
</div>
<div style="float:right; padding-bottom:5px;">
<form name="form" method="post" action="<?php echo base_url();?>backend/produk">
Cari Perihal : <input type="text" name="txt_cari" id="txt_cari" size="50" />
<button type="submit" name="cari" id="cari" class="easyui-linkbutton" data-options="iconCls:'icon-search'">Cari</button>
</form>
</div>
<table id="dataTable" width="100%">
<tr>
	<th>No</th>
    <th>ID</th>
    <th>Produk</th>
	<th>Action</th>
</tr>
<?php
	if($data->num_rows()>0){
		$no =1+$hal;
		foreach($data->result_array() as $db){  
		?>    
    	<tr>
			<td align="center" width="20"><?php echo $no; ?></td>
            <td align="center" width="20" ><?php echo $db['id_produk']; ?></td>
            <td width="150" ><?php echo $db['name_produk']; ?></td>
            <td align="center" width="80">
            <?php echo "<a href='javascript:editData(\"{$db['id_produk']}\")'>";?>
			<img src="<?php echo base_url();?>asset/images/ed.png" title='Edit'>
			</a>
            <a href="<?php echo base_url();?>backend/produk/hapus/<?php echo $db['id_produk'];?>"
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
<input type="hidden" name="id_produk" id="id_produk"  size="20" maxlength="20" />
<tr>    
	<td>Nama Produk</td>
    <td>:</td>
    <td><input type="text" name="name_produk" id="name_produk"  size="50" maxlength="100" /></td>
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