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
		$("#idproceed").focus();
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

		$("#idproceed").val('');
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
			url		: "<?php echo site_url(); ?>/input_budget/simpan",
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
		window.location.assign('<?php echo base_url();?>index.php/input_budget');
	});
});

function editData(id){
	var string = "id="+id;
	$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/input_budget/edit",
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

<a href="<?php echo base_url();?>index.php/input_budget">
<button type="button" name="refresh" id="refresh" class="easyui-linkbutton" data-options="iconCls:'icon-reload'">Refresh</button>
</a>
</div>
<div style="float:right; padding-bottom:5px;">
<form name="form" method="post" action="<?php echo base_url();?>index.php/input_budget">
Cari Perihal : <input type="text" name="txt_cari" id="txt_cari" size="50" />
<button type="submit" name="cari" id="cari" class="easyui-linkbutton" data-options="iconCls:'icon-search'">Cari</button>
</form>
</div>
<table id="dataTable" width="100%">
<tr>
	<th>No</th>
    <th>Tanggal</th>
	<th>Id Proses</th>
    <th>Cabang</th>
	<th>Nama Coa</th>
	<th>Detail Pengajuan</th>
	<th>Jumlah</th>
	<th>Aksi</th>
</tr>
<?php
    $idproceed = $this->app_model->CariIDTransaksi();
	if($data->num_rows()>0){
		$no =1+$hal;
		foreach($data->result_array() as $db){  
		?>    
    	<tr>
			<td align="center" width="20"><?php echo $no; ?></td>
            <td align="center" width="100" ><?php echo $db['tanggal']; ?></td>
			<td align="center" width="100" ><?php echo $db['idproceed']; ?></td>
            <td><?php echo $db['namacabang']; ?></td>
			<td><?php echo $db['nama_coa']; ?></td>
			<td><?php echo $db['detail_pengajuan']; ?></td>
			<td align="right" width="100" ><?php echo $db['kredit']; ?></td>			
            <td align="center" width="80">
            <?php echo "<a href='javascript:editData(\"{$db['idproceed']}\")'>";?>
			<img src="<?php echo base_url();?>asset/images/ed.png" title='Edit'>
			</a>
            <a href="<?php echo base_url();?>index.php/input_budget/hapus/<?php echo $db['idproceed'];?>"onClick="return confirm('Anda yakin ingin menghapus data ini?')">
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
	<td>ID Proceed</td>
    <td>:</td>
    <td><input type="text" name="idproceed" id="idproceed" size="20" maxlength="20" value="<?php print $idproceed ?>"/></td>
</tr>
<tr>    
	<td>Nama Cabang</td>
    <td>:</td>
    <td><select name="kodecab" id="kodecab"/>
	<?php
	foreach($cabang->result_array() as $cab){
	?>
	<option value="<?php echo $cab['kodecab'] ?>"><?php echo $cab['namacabang'] ?></option>
	<?php
	}
	?>
	</td>
</tr> 
<tr>    
	<td>Nomer Pengajuan</td>
    <td>:</td>
    <td><input type="text" name="idpengajuan" id="idpengajuan" size="30" maxlength="30" />
	</td>
</tr>
<tr>   
	<td>Nama Coa</td>
    <td>:</td>
	<td><select name="idcoa" id="idcoa"/>
	<?php
	foreach($coa->result_array() as $coa){
	?>
	<option value="<?php echo $coa['idcoa'] ?>"><?php echo $coa['nama_coa'] ?></option>
	<?php
	}
	?>
	
	</td>
</tr>
<tr>   
	<td>Detail Pengajuan</td>
    <td>:</td>
	<td><input type="text" name="detail_pengajuan" id="detail_pengajuan"  size="100" maxlength="100" />
	</td>
</tr>
<tr>    
	<td>Jumlah</td>
    <td>:</td>
    <td><input type="text" name="kredit" id="kredit"  size="15" maxlength="15" /></td>
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