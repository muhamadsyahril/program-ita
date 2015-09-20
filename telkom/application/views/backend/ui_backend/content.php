<p>Hai, Selamat datang <b><?php echo $this->session->userdata('nama_lengkap');?></b> di <b><?php echo $nama_program;?></b></p>
<br />
<table class="list" width="100%">
	<thead>
    <td class="btn" colspan="6"><center><b>CONTROL PANEL</b></center></td>
    </thead>
    <tr>
    	<td class="btn" align="center" width="20%"><a href="<?php echo base_url();?>backend/produk"><img src="<?php echo base_url();?>asset/images/surat_perintah.png" /><br />
        <b>Produk</b></a>
        </td>
        <td align="center" width="20%"><a href="<?php echo base_url();?>backend/area"><img src="<?php echo base_url();?>asset/images/berita.png" /><br />
        <b>Area</b></a>
        </td>
        <td  class="btn" align="center" width="20%"><a href="<?php echo base_url();?>backend/petugas"><img src="<?php echo base_url();?>asset/images/surat_keputusan.png" /><br />
        <b>Petugas</b></a>
        </td>
		<td align="center" width="20%"><a href="<?php echo base_url();?>backend/pelanggan"><img src="<?php echo base_url();?>asset/images/surat_keluar.png" /><br />
        <b>Pelanggan</b></a>
        </td>
        <td class="btn" align="center" width="20%"><a href="<?php echo base_url();?>backend/laporan"><img src="<?php echo base_url();?>asset/images/keuangan.png" /><br />
        <b>Laporan</b></a>
        </td>
	</tr>       
</table> 