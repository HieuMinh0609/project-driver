<?php 
function printTable($data, $columns, $editLink = "",$id="", $deleteLink = "",$editdetailLink = "", $deleteCondition = null, $btn = "",$addLink="")
{
	
	echo("<div class=\"container\">");
	echo("<div class=\"row\">");
	echo("<table id=\"tableID\" class=\"table table_backcolor table-bordered\">");
	echo("<thead>");
	echo("<tr>");
	foreach ($columns as $column) {
		echo ("<th scope=\"col\">$column</th>");
	}
	if($addLink != "") {
		echo("<th ></th>");
	}
	if($editLink != "") {
		echo("<th ></th>");
	}
	if($btn != "") {
		echo("<th ></th>");
	}
	if($deleteLink != "") {
		echo("<th></th>");
	}
	if($editdetailLink != "") {
		echo("<th></th>");
	}
	echo("</tr>");
	echo("</thead>");

	while($row = mysqli_fetch_assoc($data)) {
		echo("<tr  class=\"table_show\">");
		foreach ($columns as $field => $title) {
			if($field=="status"){

				if($row[$field]==1){
					echo ("<td class=\"table_show\"><a title=\"unfinished\"  class=\"btn btn-danger glyphicon glyphicon-remove\"></a> </td>");
					 
				}
				if($row[$field]==0){
					echo ("<td class=\"table_show\" ><a title=\"finished\"  class=\"btn btn-success glyphicon glyphicon-ok\"></a> </td>");

				}
				 
			}else{
				echo ("<td class=\"table_show\" >$row[$field]</td>");
			}
			
		}
		if($addLink != "") {
				echo("<td style=\" width: 30px;\" ><a  class=\"btn btn-primary\" href=\"$addLink?id={$row["$id"]}\">Add</a></td>");	
		}
		if($editdetailLink != "") {
				echo("<td style=\" width: 30px;\" ><a  class=\"btn btn-primary\" href=\"$editdetailLink?id={$row["$id"]}\">Detail</a></td>");	
		}
		if($editLink != "") {
				echo("<td style=\" width: 30px;\" ><a  class=\"btn btn-warning\" href=\"$editLink?id={$row["$id"]}\">Edit</a></td>");	
		}
		if($deleteLink != "") {
				$result = 0;
				if($deleteCondition)  {
					$result = $deleteCondition($row["$id"]);
				}

				if($result == 0) {
					echo("<td style=\" width: 30px;\"><a class=\"btn btn-danger\" href=\"$deleteLink?id={$row["$id"]}\" onclick=\"return confirm('Are you sure?')\">Delete</a></td>");	
				}
				else {
					echo("<td>Cannot delete category contains news</td>");
				}
		}
		if($btn != "") {
				echo("<td style=\" width: 30px;\" ><button    id_urc=\"{$row["$id"]}\" class=\"btn btn-primary table_show\">Show</button></td>");	
		}
		echo ("</tr>");
	}
	
	echo ("</table>");
	echo("</div >");
	echo("</div >");
}

function printCombobox($data, $selectedValue, $name, $id = "",$name2="") {
	 
	while ($record = mysqli_fetch_assoc($data)) {
		$selected = $selectedValue == $record["$id"] ? "selected" : "";
		echo("<option value=\"{$record["$id"]}\" $selected>{$record["$name2"]}</option>");
	}
	 
}
function printCombobox_two($data, $name, $id = "",$name2="") {
	 
	while ($record = mysqli_fetch_assoc($data)) {
		echo("<option value=\"{$record["$id"]}\">{$record["$name2"]}</option>");
	}
	 
}



?>

