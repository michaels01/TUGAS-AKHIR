<?php if(!defined('BASEPATH')) die('You are not allowed to access this page'); ?>
<?php
	if($_POST){
		extract(html_entities($_POST));
		$Qry = "UPDATE bahan SET nama_bahan_baku='".$nama_bahan_baku."', harga='".$harga."', 
			qty='".$qty."' WHERE kode_bahan_baku='".$id."'";
		$Res = mysql_query($Qry);
		if($Res){
			$message = "<div class='success'>Berhasil mengupdate record..</div>";
		} else {
			$message = "<div class='error'>".mysql_error()."</div>";
		}
		$_SESSION['msg'] = $message;
		header("Location: index.php?p=bahan");
	}
	
	$doSql = "SELECT * FROM bahan WHERE kode_bahan_baku='".$_GET['id']."'";
	$doQry = mysql_query($doSql);
	$r = mysql_fetch_array($doQry);
	
?>
<span class="page-title">Edit Rekening</span>
<div class="inner">
<form id="formContent" name="formContent" method="post" action="" onsubmit="return validateForm('formContent')">
<input type="hidden" name="id" value="<?php echo $r['kode_bahan_baku'];?>" />
  <table width="480" border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td width="151">Nama Bahan Baku</td>
      <td width="3">:</td>
      <td width="242"><input type="text" value="<?php echo $r['nama_bahan_baku'];?>" class="input required" name="nama_bahan_baku" id="nama_bahan_baku" /></td>
    </tr>
    <tr>
      <td>Harga</td>
      <td>:</td>
      <td><input type="text"  class="input required" value="<?php echo $r['harga'];?>" name="harga" id="harga" /></td>
    </tr>
    <tr>
      <td>Qty</td>
      <td>:</td>
      <td><input type="text"  class="input required" value="<?php echo $r['qty'];?>" name="qty" id="qty" /></td>
    </tr>
  </table>
  <hr />
  <input type="button" value="Cancel" class="button" onclick="window.location='index.php?p=bahan';" />
  <input type="submit" value="Simpan" class="button" />
</form>
<div class="clr"></div>
</div>