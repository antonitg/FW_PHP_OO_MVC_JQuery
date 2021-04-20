<div id="contenido">
    <form autocomplete="on" method="post" name="delete_user" id="delete_user" action="index.php?page=controller_user&op=delete&id=<?php echo $_GET['id']; ?>">
        <table border='0'>
            <tr>
                <td align="center"  colspan="2"><h3>¿Do you want to delete the car with the registration <?php echo $_GET['id']; ?> of the database?</h3></td>
                
            </tr>
            <tr>
                <td align="center"><button type="submit" class="Button_green"name="delete" id="delete">Aceptar</button></td>
                <td align="center"><a class="Button_red" href="index.php?page=controller_user&op=list">Cancelar</a></td>
            </tr>
        </table>
    </form>
</div>