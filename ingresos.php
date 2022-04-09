<?php 
    include_once("conexion.php");
    $db= new db('localhost','root','','nuevo');
    if(isset($_POST['rubro'])){
        $db->query("INSERT INTO ingresos (id_rubro, cantidad,fecha) VALUES ({$_POST['rubro']}, {$_POST['cantidad']}, {$_POST['fecha']}  )" );
    }
    else if(isset($_POST['id_eliminar'])){
        $db->query("DELETE FROM  ingresos WHERE id={$_POST['id_eliminar']}");
    }
    $strQuery=$db->query("SELECT * FROM rubros WHERE tipo='ingreso'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresos</title>
</head>
<body>

<style>
        body {
            background-color: #E67E22;
        }
    </style>

<Center>
    <form action="ingresos.php" method="post">
        <h1>Ingresos</h1>
        <table>
            <tr>
                <th>Rubro</th>
                <th>Cantidad</th>
                <th>Fecha</th>
            </tr>
            <tr>
                <td>
                    <select name="rubro">
                        <?php 
                            while($row=$db->assoc($strQuery)){
                                ?>
                                <option value="<?php print $row['id'] ?>"><?php print $row['nombre'] ?></option>;
                                <?php
                            }
                        ?>
                    </select>
                </td>
                <td>
                    <input type="number" name="cantidad" id="">
                </td>
                <td>
                    <input type="text" name="fecha" id="">
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <button type="submit">Guardar</button>
                </td>
            </tr>
        </table>
    </form>
    <table>
        <tr>
            <th>Rubro</th>
            <th>Cantidad</th>
            <th>Fecha</th>
            <th>&nbsp;</th>
        </tr>
        <?php 
            $strQuery=$db->query("SELECT i.id, r.nombre as rubro, i.cantidad as cantidad, i.fecha FROM ingresos as i INNER JOIN  rubros as r ON i.id_rubro = r.id");
            while($row=$db->assoc($strQuery)){
                ?>
                <tr>
                    <td>
                         <?php print $row['rubro'] ?>
                    </td>
                    <td align="center">
                         <?php print $row['cantidad'] ?>
                    </td>
                    <td align="center">
                         <?php print $row['fecha'] ?>
                    </td>
                    <td>
                        <form action="ingresos.php" method="post">
                            <input type="hidden" name="id_eliminar" value="<?php print $row['id'] ?>">
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
                <?php
            }
        ?>
    </table>
    <br>
    <br>
    <a href="index.php">SALIR</a>

</Center>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

    
</body>
</html>