<div id="contenido">
    <h1>Informacion del Usuario</h1>
    <p>
    <table border='2'>
        <tr>
            <td>Registration: </td>
            <td>
                <?php
                    echo $user['registration'];
                ?>
            </td>
        </tr>
    
        <tr>
            <td>Brand: </td>
            <td>
                <?php
                    echo $user['brand'];
                ?>
            </td>
        </tr>
        
        <tr>
            <td>Model: </td>
            <td>
                <?php
                    echo $user['model'];
                ?>
            </td>
        </tr>
        
        <tr>
            <td>Registration Date: </td>
            <td>
                <?php
                    echo $user['regdate'];
                ?>
            </td>
        </tr>
        
        <tr>
            <td>Car Condition: </td>
            <td>
                <?php
                    echo $user['carcondition'];
                ?>
            </td>
        </tr>
        
        <tr>
            <td>Upgrades: </td>
            <td>
                <?php
                    echo $user['upgrades'];
                ?>
            </td>
        </tr>

    </table>
    </p>
    <p><a href="index.php?page=controller_user&op=list">Volver</a></p>
</div>