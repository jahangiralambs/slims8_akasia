<form action="index.php" method="get">
	<div class="modalbox hide">
		<div class="inner-content" style="display: block; margin-left: auto; margin-right: auto; width: 60%;">
			<table width="100%">
				<tr>
					<td colspan="2"><h3>Pencarian Spesifik</h3></td>
				</tr>
				<tr>
					<td>Judul</td>
					<td>Pengarang</td>
				</tr>
				<tr>
					<td><input type="text" name="title" class="adv-title form-class"></td>
					<td><input type="text" name="author" class="adv-author form-class"></td>
				</tr>
				<tr>
					<td>Subyek</td>
					<td>ISBN/ISSN</td>
				</tr>
				<tr>
					<td><input type="text" name="subject" class="adv-subyek form-class"></td>
					<td><input type="text" name="isbn" class="adv-isbn form-class"></td>
				</tr>
				<tr>
					<td>GMD</td>
					<td>Lokasi</td>
				</tr>
				<tr>
					<td>
						<select name="colltype">
							<?php echo $colltype_list;?>
						</select>
					</td>
					<td>
						<select name="location">
							<?php echo $location_list;?>
						</select>
					</td>
				</tr>
				<tr>
					<td>GMD</td>
				</tr>
				<tr>
					<td>
						<select name="gmd">
							<?php echo $gmd_list;?>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="2" style="text-align: right; padding-right: 35px;">
						<button class="btn btn-primary">Pencarian</button>
						<input type="hidden" name="search" value="search"/>
						<a href="javascript:void(0)" class="cls btn btn-danger">Batal</a>
					</td>
				</tr>
			</table>
		</div>
	</div>
</form>