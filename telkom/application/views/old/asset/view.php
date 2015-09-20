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
		$("#idasset").focus();
	});
	
	$("#kodecab").keyup(function(){
		CariSingCab();
	});
	
	$("#kodecab").change(function(){
		CariSingCab();
	});
	
	function CariSingCab(){
		var kodecab = $("#kodecab").val();
		var string = "kodecab="+kodecab;
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/ref_json/CariNamaCab",
			data	: string,
			cache	: false,
			dataType: "json",
			success	: function(data){
				$("#singcab").val(data.singcab);
			}
		});
	}
	
	function kosong(){

		$("#kodecab").val('');
		$("#tahun").val('');
		$("#dept").val('');
		$("#singcab").val('');
		$("#serial_number").val('');
		$("#item").val('');
		$("#detail").val('');
		$("#kategori").val('');
		$("#user_dept").val('');
		
	}
	$("#simpan").click(function(){
		var idasset			= $("#idasset").val();
		var dept		= $("#dept").val();
		var bln		= $("#bln").val();
		var thn		= $("#thn").val();
		var kodecab				= $("#kodecab").val();
		var singcab				= $("#singcab").val();
		var tahun				= $("#tahun").val();
		var serial_number		= $("#serial_number").val();
		var item				= $("#item").val();
		var detail				= $("#detail").val();
		var kategori			= $("#kategori").val();
		var user_dept			= $("#user_dept").val();

		var string ="idasset="+idasset+"&dept="+dept+"&bln="+bln+"&thn="+thn+"&kodecab="+kodecab+"&singcab="+singcab+"&tahun="+tahun+"&serial_number="+serial_number+"&item="+item+"&detail="+detail+"&kategori="+kategori+"&user_dept="+user_dept;
		
		if(dept.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, singkatan dept tidak boleh kosong',
				timeout:2000,
				showType:'slide'
			});
			
			$("#dept").focus();
			return false;
		}
		
		if(kodecab.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, cabang tidak boleh kosong',
				timeout:2000,
				showType:'slide'
			});
			
			$("#kodecab").focus();
			return false;
		}
		
		if(tahun.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, tahun tidak boleh kosong',
				timeout:2000,
				showType:'slide'
			});
			
			$("#tahun").focus();
			return false;
		}
		
		if(serial_number.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, serial number tidak boleh kosong',
				timeout:2000,
				showType:'slide'
			});
			
			$("#serial_number").focus();
			return false;
		}
		
		if(item.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, item tidak boleh kosong',
				timeout:2000,
				showType:'slide'
			});
			
			$("#item").focus();
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
		
		if(kategori.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, kategori tidak boleh kosong',
				timeout:2000,
				showType:'slide'
			});
			
			$("#kategori").focus();
			return false;
		}
		
		if(user_dept.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, departement tidak boleh kosong',
				timeout:2000,
				showType:'slide'
			});
			
			$("#user_dept").focus();
			return false;
		}
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/asset/simpan",
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
		$("#idasset").focus();

	});

	
	$("#kembali").click(function(){
		window.location.assign('<?php echo base_url();?>index.php/asset');
	});
});

function editData(id){
	var string = "id="+id;
	$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/asset/edit",
			data	: string,
			cache	: true,
			dataType : "json",
			success	: function(data){
				$("#view").hide();
				$("#form").show();
				
				$("#idasset").focus();
				
				$("#idasset").val(id);
				$("#asset_label").val(data.asset_label);
				$("#kodecab").val(data.kodecab);
				$("#tahun").val(data.tahun);
				$("#serial_number").val(data.serial_number);
				$("#item").val(data.item);
				$("#detail").val(data.detail);
				$("#kategori").val(data.kategori);
				$("#user_dept").val(data.user_dept);

			}
	});
}
</script>
<div id="view">
<div style="float:left; padding-bottom:5px;">
<button type="button" name="tambah" id="tambah" class="easyui-linkbutton" data-options="iconCls:'icon-add'">Tambah Data</button>

<a href="<?php echo base_url();?>index.php/asset">
<button type="button" name="refresh" id="refresh" class="easyui-linkbutton" data-options="iconCls:'icon-reload'">Refresh</button>
</a>
</div>
<div style="float:right; padding-bottom:5px;">
<form name="form" method="post" action="<?php echo base_url();?>index.php/asset">
Cari Perihal : <input type="text" name="txt_cari" id="txt_cari" size="50" />
<button type="submit" name="cari" id="cari" class="easyui-linkbutton" data-options="iconCls:'icon-search'">Cari</button>
</form>
</div>
<table id="dataTable" width="100%">
<tr>
	<th>No</th>
    <th>ID Inventaris</th>
	<th>Asset label</th>
    <th>Kode Cabang</th>
	<th>Tahun</th>
	<th>Serial Number</th>
	<th>Item</th>
	<th>Detail</th>
	<th>Kategori</th>
	<th>User Departement</th>
	<th>Aksi</th>
</tr>
<?php
    $idasset = $this->app_model->MaxNoInventaris();
	if($data->num_rows()>0){
		$no =1+$hal;
		foreach($data->result_array() as $db){  
		?>    
    	<tr>
			<td align="center" width="20"><?php echo $no; ?></td>
            <td align="center" width="100" ><?php echo $db['idasset']; ?></td>
			<td align="center" width="100" ><?php echo $db['asset_label']; ?></td>
            <td align="center" width="100" ><?php echo $db['kodecab']; ?></td>
			<td align="center" width="100" ><?php echo $db['tahun']; ?></td>
			<td><?php echo $db['serial_number']; ?></td>
			<td><?php echo $db['item']; ?></td>
			<td><?php echo $db['detail']; ?></td>	
			<td><?php echo $db['kategori']; ?></td>
			<td><?php echo $db['user_dept']; ?></td>				
            <td align="center" width="80">
            <?php echo "<a href='javascript:editData(\"{$db['idasset']}\")'>";?>
			<img src="<?php echo base_url();?>asset/images/ed.png" title='Edit'>
			</a>
            <a href="<?php echo base_url();?>index.php/asset/hapus/<?php echo $db['idasset'];?>"onClick="return confirm('Anda yakin ingin menghapus data ini?')">
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
	<td>ID Inventaris</td>
    <td>:</td>
    <td><input type="text" name="idasset" id="idasset" size="20" maxlength="20" value="<?php echo $idasset; ?>"/></td>
</tr>
<tr>  
<tr>    
	<td>Singkatan Dept</td>
    <td>:</td>
    <td><input type="text" name="dept" id="dept" size="4" maxlength="3" />C/h: LOG<input type="hidden" name="bln" id="bln" size="3" maxlength="3" value="<?php echo date('m'); ?>"/><input type="hidden" name="thn" id="thn" size="3" maxlength="3" value="<?php echo date('y'); ?>"/></td>
</tr>
<tr>   
	<td>Kode Cabang</td>
    <td>:</td>
    <td>
	<select name="kodecab" id="kodecab" class="kosong">
	<option value="">-PILIH-</option>

    <?php
	foreach($list->result_array() as $t){
	?>
    <option value="<?php echo $t['kodecab'];?>"><?php echo $t['namacabang'];?></option>
    <?php } ?>
	</select> <input type="text" name="singcab" id="singcab" size="4" maxlength="4" class="kosong" /><br />
	
	</td>
</tr>
<tr>    
	<td>Tahun</td>
    <td>:</td>
    <td><input type="text" name="tahun" id="tahun"  size="5" maxlength="4" /></td>
</tr>
<tr>    
	<td>Serial Number</td>
    <td>:</td>
    <td><input type="text" name="serial_number" id="serial_number"  size="30" maxlength="30" /></td>
</tr>
<tr>    
	<td>Item</td>
    <td>:</td>
    <td><input type="text" name="item" id="item"  size="50" maxlength="50" /></td>
</tr>
<tr>    
	<td>Detail</td>
    <td>:</td>
    <td><input type="text" name="detail" id="detail"  size="50" maxlength="50" /></td>
</tr>
<tr>    
	<td>Kategori</td>
    <td>:</td>
    <td><select name="kategori" id="kategori"/>
		<option value="">-PILIH-</option>
		<option value="kendaraan niaga">Kendaraan Niaga</option>
		<option value="kendaraan non niaga">Kendaraan Non Niaga</option>
		<option value="Sepeda Motor">Sepeda Motor</option>
		<option value="Komputer">Komputer</option>
		<option value="laptop">Laptop</option>
		<option value="meja">Meja</option>
		<option value="kursi">Kursi</option>
		<option value="Lemari">Lemari</option>
		<option value="filing kabinet">Filling Kabinet</option>
		<option value="brangkas">Brangkas</option>
		<option value="tabung pemadam">Tabung Pemadam</option>
		<option value="pallet">Pallet</option>
		<option value="hand pallet">Hand Pallet</option>
		<option value="rak gudang">Rak Gudang</option>
		<option value="forklift">Forklift</option>
		<option value="air conditioner">Air Conditioner</option>
		<option value="perlengkapan gudang">Perlengkapan Gudang</option>
		<option value="tool kit">tool kit</option>
		<option value="peralatan kantor">Peralatan Kantor</option>
		</select>
	</td>
</tr>
<tr>    
	<td>User Departement</td>
    <td>:</td>
    <td><input type="text" name="user_dept" id="user_dept"  size="25" maxlength="25" /></td>
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