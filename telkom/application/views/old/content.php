<p>Hai, Selamat datang <b><?php echo $this->session->userdata('nama_lengkap');?></b> di Manajeman <b><?php echo $nama_program;?></b></p>
<br />
<table class="list" width="100%">
	<thead>
    <td class="btn" colspan="6"><center><b>CONTROL PANEL</b></center></td>
    </thead>
    <tr>
    	<td class="btn" align="center" width="20%"><a href="<?php echo base_url();?>index.php/budgeting"><img src="<?php echo base_url();?>asset/images/surat_perintah.png" /><br />
        <b>Budgeting</b></a>
        </td>
        <td align="center" width="20%"><a href="<?php echo base_url();?>index.php/asset"><img src="<?php echo base_url();?>asset/images/berita.png" /><br />
        <b>Data Asset</b></a>
        </td>
        <td  class="btn" align="center" width="20%"><a href="<?php echo base_url();?>index.php/master_usulan"><img src="<?php echo base_url();?>asset/images/surat_keputusan.png" /><br />
        <b>Master Usulan</b></a>
        </td>
		<td align="center" width="20%"><a href="<?php echo base_url();?>index.php/input_budget"><img src="<?php echo base_url();?>asset/images/surat_keluar.png" /><br />
        <b>Input Budget</b></a>
        </td>
        <td class="btn" align="center" width="20%"><a href="<?php echo base_url();?>index.php"><img src="<?php echo base_url();?>asset/images/keuangan.png" /><br />
        <b>Laporan</b></a>
        </td>
	</tr>       
</table> 