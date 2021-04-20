<div id="contenido">
    <form autocomplete="on" method="post" name="aupdate_user" id="update_user" action="index.php?page=controller_user&op=update">
        <h1>Modificar usuario</h1>
        <table border='0'>
            <tr>
                <td>Registration: </td>
                <td><input type="text" id="Registration" name="Registration" placeholder="Registration" value="<?php echo $user['registration'];?>" readonly/></td>
            </tr>
        
            <tr>
                <td>Brand: </td>
                <td><input type="text" id="Brand" name="Brand" placeholder="Brand" value="<?php echo $user['brand'];?>"/></td>
            </tr>
            
            <tr>
                <td>Model: </td>
                <td><input type="text" id="Model" name="Model" placeholder="Model" value="<?php echo $user['model'];?>"/></td>
            </tr>
            <tr>
                <td>Category: </td>
                <td><input type="text" id="Category" name="Category" placeholder="Cat1,Cat2,Cat3" value="<?php echo $user['category'];?>"/></td>
            </tr>
            <tr>
                <td>Model: </td>
                <td><input type="text" id="Price" name="Price" placeholder="3000" value="<?php echo $user['price'];?>"/></td>
            </tr>
            <tr>
                <td>Registration Date: </td>
                <td><input type="text" id= "DNI" name="RegDate" placeholder="RegDate" value="<?php echo $user['regdate'];?>"/></td>
            </tr>           
            <tr>
                <td>Condition: </td>
                <td>
                    <?php
                        if ($user['carcondition']==="New"){
                    ?>
                    	<label for="Condition">Condition: </label>
                        <label>New (Not used)</label>
                        <input type="radio" name="Condition" class="Condition" id="New" value="New" checked>
                        <label>Used (0-80K KM)</label>
                        <input type="radio" name="Condition" class="Condition" id="Used" value="Used">
                        <label>Old (81K+ KM)</label>
                        <input type="radio" name="Condition" class="Condition" id="Old" value="Old">			
                        <label id="error_Condition" class="error"></label>
                    <?php    
                        }else if($user['carcondition']==="Used"){
                    ?>
                    	<label for="Condition">Condition: </label>
                        <label>New (Not used)</label>
                        <input type="radio" name="Condition" class="Condition" id="New" value="New">
                        <label>Used (0-80K KM)</label>
                        <input type="radio" name="Condition" class="Condition" id="Used" value="Used" checked>
                        <label>Old (81K+ KM)</label>
                        <input type="radio" name="Condition" class="Condition" id="Old" value="Old">			
                        <label id="error_Condition" class="error"></label>
                    <?php
                        }else{
                    ?>
                    	<label for="Condition">Condition: </label>
                        <label>New (Not used)</label>
                        <input type="radio" name="Condition" class="Condition" id="New" value="New">
                        <label>Used (0-80K KM)</label>
                        <input type="radio" name="Condition" class="Condition" id="Used" value="Used">
                        <label>Old (81K+ KM)</label>
                        <input type="radio" name="Condition" class="Condition" id="Old" value="Old" checked>			
                        <label id="error_Condition" class="error"></label>
                    <?php   
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td>Aficiones: </td>
                <?php
                    $afi=explode(":", $user['upgrades']);
                ?>
                <td>
                    <?php
                        $busca_array=in_array("Motor", $afi);
                        if($busca_array){
                    ?>
                        <input type="checkbox" id= "Upgrade" name="Upgrade[]" class="Upgrade" value="Motor" checked/>Motor
                   
                    <?php
                        }else{
                    ?>
                        <input type="checkbox" id= "Upgrade" name="Upgrade[]" class="Upgrade" value="Motor"/>Motor
                    <?php
                        }
                    ?>
                    <?php
                        $busca_array=in_array("Wheels", $afi);
                        if($busca_array){
                    ?>
                        <input type="checkbox" id= "Upgrade" name="Upgrade[]" class="Upgrade" value="Wheels" checked/>Wheels
                    <?php
                        }else{
                    ?>
                        <input type="checkbox" id= "Upgrade" name="Upgrade[]" class="Upgrade" value="Wheels"/>Wheels
                    <?php
                        }
                    ?>
                    <?php
                        $busca_array=in_array("Seats", $afi);
                        if($busca_array){
                    ?>
                        <input type="checkbox" id= "Upgrade" name="Upgrade[]" class="Upgrade" value="Seats" checked/>Seats</td>
                    <?php
                        }else{
                    ?>
                    <input type="checkbox" id= "Upgrade" name="Upgrade[]" class="Upgrade" value="Seats"/>Seats</td>
                    <?php
                        }
                    ?>
                </td>
            </tr>
            
            <tr>
                <td><input type="submit" name="update" id="update"/></td>
                <td align="right"><a href="index.php?page=controller_user&op=list">Volver</a></td>
            </tr>
        </table>
    </form>
</div>