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
		$("#user").focus();
	});
	
	function kosong(){
		$("#user").val('');
		$("#password").val('');
		$("#nama").val('');
		$("#kodecab").val('');
		$("#level").val('');
		
	}
	$("#simpan").click(function(){
		var user		= $("#user").val();
		var password	= $("#password").val();
		var nama		= $("#nama").val();
		var kodecab		= $("#kodecab").val();
		var level		= $("#level").val();
		
		var string ="user="+user+"&password="+password+"&nama="+nama+"&kodecab="+kodecab+"&level="+level;
		
		if(user.length==0 ||password.length==0 ||nama.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, isi data dengan lengkap',
				timeout:2000,
				showType:'slide'
			});
			
			$("#user").focus();
			return false;
		}
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/user/simpan",
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
			url		: "<?php echo site_url(); ?>/user/tambah",
			cache	: false,
			success	: function(data){
				kosong();
				$("#user").focus();
			}
		});
	});
	
	$("#kembali").click(function(){
		window.location.assign('<?php echo base_url();?>index.php/user');
	});
});
</script>
<fieldset class="atas">
<table width="100%">
<tr>    
	<td>NIK</td>
    <td>:</td>
    <td><input type="text" name="user" id="user" size="12" maxlength="12" /></td>
</tr>
<tr>    
	<td>Password</td>
    <td>:</td>
    <td><input type="password" name="password" id="password"  size="10" maxlength="10" /></td>
</tr>
<tr>    
	<td>Nama User</td>
    <td>:</td>
    <td><input type="text" name="nama" id="nama"  size="50" maxlength="50" /></td>
</tr>
<tr>    
	<td>Cabang</td>
    <td>:</td>
    <td><select name="kodecab" id="kodecab" class="combo">
		<option value="">-PILIH-</option>
			<?php
				foreach($list1->result() as $t){
			?>
		<option value="<?php echo $t->kodecab;?>"><?php echo $t->namacabang;?></option>
			<?php } ?>
		</select> </td>
</tr>
<tr>    
	<td>Level User</td>
    <td>:</td>
    <td><select name="level" id="level" class="combo">
		<option value="">-PILIH-</option>
		<option value="admin">Admin</option>
		<option value="superuser">Super User</option>
		<option value="user">User</option>
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