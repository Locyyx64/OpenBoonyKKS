<table id="products-list">	
	<thead>
                <tr>
                        <th>Profile Picture</th>
			<?php 
				$links = array("Username", "UserNickname", "PointCount");
				foreach($links as $link){
					if(isset($_GET["sort_type"])){
						switch($_GET["sort_type"]){
							case "ASC":
								echo "<th><a href='social.php?q={$_GET["q"]}&sort={$link}&sort_type=DESC'>{$link}</th>";
								break;
							case "DESC":
								echo "<th><a href='social.php?q={$_GET["q"]}&sort={$link}&sort_type=ASC'>{$link}</th>";
								break;
							default:
								die("Invalid Sort Type!");
						}
		                        }
					elseif(isset($_GET["sort"])){
						echo "<th><a href='social.php?q={$_GET["q"]}&sort={$link}&sort_type=DESC'>{$link}</th>";
					}
					else{
						echo "<th><a href='social.php?q={$_GET["q"]}&sort={$link}'>{$link}</th>";
					}
				}
			?>
		</tr>
        </thead>
        <tbody>
                <?php
                        $users_per_page = 20;
                        $page = getPage();
			$sort = getSort("Username");
                        $limit = getLimit($users_per_page, $page);
			$search_kw = $_GET["q"];
			$condition = "Username LIKE '%{$search_kw}%'";

			if(isset($_GET["sort_type"])){
				$sort_type = $_GET["sort_type"];
				getUsersBy($limit, $sort, $condition, $sort_type);
			} else{
				getUsersBy($limit, $sort, $condition);
			}
		?>
                <tr>
                <!--Pagination-->
			<td colspan=4 id="pagination">
				<div id="page-nav">
					<ul>
						<?php
							$iter_num = ceil(getNumOfTable("Users", $condition) / $users_per_page);
							if($iter_num > 1){
								for ($i = 1; $i <= $iter_num; $i++){
									if ($i == $page){
										echo "<li><a id='page-selected' href='social.php?page=$i'>$i</a></li>";
									} else{
										echo "<li><a href='social.php?page=$i'>$i</a></li>";
									}
								}
							}
						?>
					</ul>
				</div>
			</td>
                </tr>
        </tbody>
</table>
