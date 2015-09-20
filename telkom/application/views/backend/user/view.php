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
		$("#username").focus();
	});
	
	function kosong(){
		$("#username").val('');
		$("#password").val('');
		$("#level").val('');
		
	}
	$("#simpan").click(function(){
		var userid		= $("#userid").val();
		var nomerid		= $("#nomerid").val();
		var username		= $("#username").val();
		var password	= $("#password").val();
		var level		= $("#level").val();
		
		var string ="userid="+userid+"&username="+username+"&password="+password+"&level="+level+"&nomerid="+nomerid;
		
		if(username.length==0 ||password.length==0 ||level.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, isi data dengan lengkap',
				timeout:2000,
				showType:'slide'
			});
			
			$("#username").focus();
			return false;
		}
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo base_url(); ?>backend/user/simpan",
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
			url		: "<?php echo site_url(); ?>backend/user/tambah",
			cache	: false,
			success	: function(data){
				kosong();
				$("#username").focus();
			}
		});
	});
	
	$("#kembali").click(function(){
		window.location.assign('<?php echo base_url();?>backend/user');
	});
});

function editData(id){
	var string = "id="+id;
	$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>backend/user/edit",
			data	: string,
			cache	: true,
			dataType : "json",
			success	: function(data){
				$("#view").hide();
				$("#form").show();
				
				$("#username").focus();
				
				$("#userid").val(id);
				$("#username").val(data.username);
				$("#password").val(data.password);
				$("#level").val(data.level);
			}
	});
}
</script>
<div id="view">
<div style="float:left; padding-bottom:5px;">
<button type="button" name="tambah" id="tambah" class="easyui-linkbutton" data-options="iconCls:'icon-add'">Tambah Data</button>

<a href="<?php echo base_url();?>backend/user">
<button type="button" name="refresh" id="refresh" class="easyui-linkbutton" data-options="iconCls:'icon-reload'">Refresh</button>
</a>
</div>
<div style="float:right; padding-bottom:5px;">
<form name="form" method="post" action="<?php echo base_url();?>backend/user">
Cari Perihal : <input type="text" name="txt_cari" id="txt_cari" size="50" />
<button type="submit" name="cari" id="cari" class="easyui-linkbutton" data-options="iconCls:'icon-search'">Cari</button>
</form>
</div>
<table id="dataTable" width="100%">
<tr>
	<th>No</th>
    <th>Userid</th>
    <th>Username</th>
	<th>Password</th>
	<th>Level</th>
	<th>Action</th>
</tr>
<?php
	if($data->num_rows()>0){
		$no =1+$hal;
		foreach($data->result_array() as $db){  
			if($db['level']== 1){
				$db['level']="admin" ;
			}elseif($db['level']==2){
				$db['level']="pelanggan";
			}else{
				$db['level']="teknisi";
			}
		?>    
    	<tr>
			<td align="center" width="20"><?php echo $no; ?></td>
            <td align="center" width="100" ><?php echo $db['userid']; ?></td>
            <td><?php echo $db['username']; ?></td>
			<td><?php echo $db['password']; ?></td>
			<td><?php echo $db['level']; ?></td>		
            <td align="center" width="80">
            <?php echo "<a href='javascript:editData(\"{$db['userid']}\")'>";?>
			<img src="<?php echo base_url();?>asset/images/ed.png" title='Edit'>
			</a>
            <a href="<?php echo base_url();?>backend/user/hapus/<?php echo $db['userid'];?>"
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
<input type="hidden" name="userid" id="userid" size="30" maxlength="100" />
<tr>    
	<td>Username</td>
    <td>:</td>
    <td><input type="text" name="username" id="username" size="30" maxlength="100" /></td>
</tr>
<tr>    
	<td>Password</td>
    <td>:</td>
    <td><input type="password" name="password" id="password"  size="10" maxlength="10" /></td>
</tr>
<tr>    
	<td>NomerID Pelanggan / Petugas</td>
    <td>:</td>
    <td><input type="text" name="nomerid" id="nomerid"  size="10" maxlength="10" /></td>
</tr>

<tr>    
	<td>Level User</td>
    <td>:</td>
    <td><select name="level" id="level" class="combo">
		<option value="">-PILIH-</option>
		<option value="1">Admin</option>
		<option value="2">Pelanggan</option>
		<option value="3">Teknisi</option>
		</select> </td></td>
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