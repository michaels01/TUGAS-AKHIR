<?php if(!defined('BASEPATH')) die('You are not allowed to access this page'); ?>
<?php
	$limit = 10;
	if(isset($_GET['h'])){
		$page = $_GET['h'];
   		$offset = $limit * ($page - 1);
	} else {
		$offset = 0;
		$page = 1;
	}
	
	//search
	$uri = "?p=roti";
	$search = "";
	if(isset($_GET['s'])) {		
		$uri.="&s=".$_GET['s'];
		$search.="AND roti LIKE '%".urldecode($_GET['s'])."%'";
	}
	
	//get total record
	$qryTotal = "SELECT count(*) total FROM roti WHERE 0=0 ".$search." ";
	$resTotal = mysql_query($qryTotal);
	$row = mysql_fetch_array($resTotal, MYSQL_NUM );
	$totalRec = $row[0];
	
	//pagination
	$pagination = paging($totalRec, $limit, $page, $uri); 	
	
	//get record selected	
	$resQry = "SELECT * FROM roti 
        INNER JOIN bahan ON roti.id_bahan = bahan.kode_bahan_baku
		WHERE 0=0 ".$search." 
		ORDER BY id DESC
		LIMIT ".$offset.",".$limit;
	$results = mysql_query($resQry);
	$countResults = mysql_num_rows($results);
?>
<span class="page-title">Rekening Bank</span>
<div class="inner">

<div class="searchform">
	<form action="index.php" method="get">
    	<input type="hidden" name="p" value="<?php echo $_GET['p'];?>" />
   	  <input type="text" value="<?php echo isset($_GET['s'])?$_GET['s']:'';?>" id="search" name="s" placeholder="Search data..">
    </form>
</div>
<a class="addButton button" href="?p=addRoti" title="Add New Record">Tambah Baru</a>
<a class="addButton button" href="?p=<?php echo $_GET['p'];?>" title="Clear Filter">Hapus Filter</a>
<div class="clr"></div><br>
<table id="listTable" width="100%" cellpadding="5" cellspacing="1">
<thead>	
    <tr>
    	<td width="2%">No</td>
        <td width="22%">Nama Roti</td>
        <td width="18%">Bahan yang digunakan</td>
        <td width="35%">Qty Bahan yang dibutuhkan</td>
        <td width="12%">Tools</td>
    </tr>
</thead>
<tbody>
	<?php
	if($countResults > 0){  
		$i = 1;
		while($r = mysql_fetch_array($results)){
	?>
	<tr class="<?php echo ($i%2)==0?'odd':'';?>">
    	<td align="center"><?php echo $i;?></td>
        <td><?php echo $r['nama_roti'];?></td>
        <td><?php echo $r['nama_bahan_baku'];?></td>
        <td><?php echo $r['qty_yg_dibutuhkan'];?></td>
      <td align="center">
        	<a class="bTools" href="?p=edRoti&id=<?php echo $r['id'];?>" title="Edit">E</a>
            <a class="bTools" href="?p=delRoti&id=<?php echo $r['id'];?>" title="Delete" onClick="return confirm('Hapus record <?php echo $r['nama_roti'];?> ?');">D</a>
        </td>
    </tr>
    <?php $i++; }
	
	} else  {
    ?>
    <tr>
    	<td colspan="5" align="center">Record Not Available</td>
    </tr>
    <?php } ?>
</tbody>    
</table>
<div class="clr"></div>
<div class="paging clr">
	<?php echo $pagination; ?>
</div>
<div class="clr"></div>
</div>