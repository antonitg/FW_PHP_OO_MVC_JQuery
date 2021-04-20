<div id="contenido">
    <div class="container">
    	<div class="row"> 
    			<p class="titlelist">Car List</p>
    	</div>
    	<div class="row">
    		<p><a href="index.php?page=controller_user&op=create"><img src="view/img/anadir.png"></a></p>
    		
    		<table id="carTable" class="order-column stripe hover">
                <thead>
                    <tr>
                        <th width=125><b>Registration</b></th>
                        <th width=125><b>Brand</b></th>
                        <th width=125><b>Model</b></th>
                        <th width=350><b>Registration Date</b></th>
                        <th width=350><b>Condition</b></th>
                        <th width=350><b>Upgrades</b></th>
                        <th><b>Category</b></th>
                        <th><b>Price</b></th>
                        <th></th>

                    </tr>
                </thead>
                    <tbody>
                    <?php
                        if ($rdo->num_rows === 0){
                            echo '<tr>';
                            echo '<td align="center"  colspan="3">No cars found</td>';
                            echo '</tr>';
                        }else{
                            foreach ($rdo as $row) {
                                echo '<tr>';
                                echo '<td width=125>'. $row['registration'] . '</td>';
                                echo '<td width=125>'. $row['brand'] . '</td>';
                                echo '<td width=125>'. $row['model'] . '</td>';
                                echo '<td width=125>'. $row['regdate'] . '</td>';
                                echo '<td width=125>'. $row['carcondition'] . '</td>';
                                echo '<td width=125>'. $row['upgrades'] . '</td>';
                                echo '<td width=125>'. $row['category'] . '</td>';
                                echo '<td width=125>'. $row['price'] . '</td>';

                                echo '<td width=350>';
                                print ("<span class='readcar' id='".$row['registration']."'>Read</span>");
                                // echo '<a class="Button_blue" id>Read</a>';
                                echo '&nbsp;';
                                echo '<a class="Button_green" href="index.php?page=controller_user&op=update&id='.$row['registration'].'">Update</a>';
                                echo '&nbsp;';
                                echo '<a class="Button_red" href="index.php?page=controller_user&op=delete&id='.$row['registration'].'">Delete</a>';
                                echo '</td>';
                                echo '</tr>';
                            }
                        }
                    ?>
                </tbody>
            </table>
    	</div>
    </div>
</div>
<section id="car_modal">
    <div id="car_details" hidden>
   
    </div>
    
</section>